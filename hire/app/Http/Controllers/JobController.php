<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Appfiles\Common\Functions;
use Appfiles\Repo\UsersInterface;
use Appfiles\Repo\UserdetailInterface;

use Appfiles\Repo\CountryInterface;
use Appfiles\Repo\StateInterface;
use Appfiles\Repo\CityInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Model\Common;
use App\Model\Company_detail;
use App\Model\Industry;
use App\Model\Functionalarea;
use App\Model\Jobdetail;
use App\Model\Jobprefrences;

use App\Model\State;
use App\Model\User_followers;
use App\Model\Apply_for_job;
use App\Model\View;
Use DB;
use Validator;
use Auth;
use URL;
// use View;
class JobController extends Controller
{
  use ValidationTrait;
	protected $APIURL;
    protected $functions;
    protected $s3;

	public function  __construct(Functions $functions, UsersInterface $usersInterface,CountryInterface  $country,UserdetailInterface $userdetail,StateInterface $state,CityInterface $city)
    {
        //$this->user_id= 1;
        
		    $this->APIURL= URL::to('api/');
        $this->functions=$functions;
		    $this->usersInterface = $usersInterface;
        $this->country = $country;
        $this->userdetail =$userdetail;
        $this->state=$state;
        $this->city=$city;
}
 ////////// job listing for all///////
  public function joblisting(Request $request,$pagename=false)
  {
    $jobarray = array();
    $countrylist = $this->country->getListraw(array(),'country','id');
    $companyid = '';

    ///////////////get all acive jobs//////////
    $condition = "valid_till>='".date('Y-m-d')."'";
    if($request->keyword)
    {
      $condition.=" and (jobtitle like '%".$request->keyword."%')";

    }
    $getalljobs = Jobdetail::whereRaw($condition)->orderBy('valid_till','desc')->paginate(5);
    foreach ($getalljobs as $alljobs) 
    {
      $companyid = $alljobs->compnay_id.',';
      $country='India';
      if(array_key_exists($alljobs->country, $countrylist))
      {
        $country=$countrylist[$alljobs->country];

      }
      $experience=$alljobs->experience_year.' yrs';
      if($alljobs->experience_month)
      {
        $experience=$alljobs->experience_year.'-'.$alljobs->experience_month.' yrs';

      }
      $salary=$alljobs->salary_min;
      if($alljobs->salary_max)
      {
        $salary=$alljobs->salary_min.' - '.$alljobs->salary_max;

      }
      $jobarray[$alljobs->id] = array('compnay_hiring'=>$alljobs->compnay_hiring,
                                      'compnay_name'=>'',
                                      'compnay_id'=>$alljobs->compnay_id,
                                      'jobid'=>$alljobs->id,
                                      'country'=>$country,
                                      'state'=>'',
                                      'city'=>'',
                                      'jobtitle'=>$alljobs->jobtitle,
                                      'skill'=>$alljobs->skill,
                                      'job_quality'=>$alljobs->job_quality,
                                      'experience'=>$experience,
                                      'salary'=>$salary);
    }
    ////////////// compnay list based on id///////////
    $companyArray = array();
    if($companyid!='')
    {
      $conditioncomp= " id in ".'('.substr($companyid,0,-1).')'."";
      $companylist = Company_detail::whereRaw($conditioncomp)->get(array('compnay_name','id'));
      foreach($companylist as $companylist)
      {
        $companyArray[$companylist->id] = array('compnay_name'=>$companylist->compnay_name,
                                                );

      }
    }

    /////////// make final array/
    array_walk($jobarray, function(&$value, $key, $sourceArray)
    { 
       
         
        if(array_key_exists($value['compnay_id'], $sourceArray))
        {
            $value['compnay_name'] = $sourceArray[$value['compnay_id']]['compnay_name'];
        }

    },$companyArray); 
    // dd($jobarray);
    return view('web/joblisting',compact('getalljobs','jobarray'));
    
  }

  /////////////////// job details //////////
  public function jobdetail(Request $request,$id)
  {
    if($id)
    {
      $checkjob = Jobdetail::where(array('id'=>$id))->first();
      if($checkjob)
      {
        $viewcount=0;
        $getviewcount = View::where(array('view_id'=>$id,'type'=>'job'))->count();
        if($getviewcount)
        {
          $viewcount = $getviewcount;

        }
        $details = array('industry'=>'NA',
                         'function'=>'NA',
                         'country'=>'NA',
                         'city'=>'NA',
                         'state'=>'NA',
                         'emp_type'=>'NA',
                         'job_type'=>'NA',
                         'viewcount'=>$viewcount,
                         'loginrequired'=>'yes',
                         'is_follow'=>'no',
                         'is_save'=>'no',
                         'is_apply'=>'no');
        
        $condition=array('id'=>$checkjob->compnay_id);
        $compnay = Company_detail::where($condition)->first();
        if(Auth::check())
        {
          $user = Auth::user();
          $details['loginrequired']='no';
          $conditioncheck = array('action_id'=>$compnay->id,'followed_by_id'=>$user->id,'type'=>2);
          $followcheck = User_followers::where($conditioncheck)->first();
          if($followcheck)
          {
            $details['is_follow']='yes';

          }

          ///////////// check apply for job////
          $conditioncheck = array('job_id'=>$id,'apply_by_id'=>$user->id,'type'=>1);
          $checkapply = Apply_for_job::where($conditioncheck)->first();
          if($checkapply)
          {
            $details['is_apply']='yes';

          }

          ///////////// check save for job////
          $conditioncheck = array('job_id'=>$id,'apply_by_id'=>$user->id,'type'=>2);
          $checkapply = Apply_for_job::where($conditioncheck)->first();
          if($checkapply)
          {
            $details['is_save']='yes';

          }

        }
          ////// location////
        if($checkjob->emp_level)
        {
          switch ($checkjob->emp_level) {
            case '1':
              $details['emp_type']='Executive';
              break;
              case '2':
              $details['emp_type']='Middel';
              break;
              case '3':
              $details['emp_type']='Management';
              break;
              case '4':
              $details['emp_type']='Higher management';
              break;
            
            default:
              $details['emp_type']='Senior';
              break;
          }

        }
         $countryname = $this->country->getBy(array('id'=>$checkjob->country),array('id','country'));
         if($countryname)
         {
          $details['country'] = ucwords($countryname->country);

         }
         $cityname = $this->city->getBy(array('id'=>$checkjob->city),array('id','city'));
         if($countryname)
         {
          $details['city'] = ucwords($cityname->city);

         }
        $industry = Industry::where(array('id'=>$checkjob->industry))->first();
        if($industry)
        {
          $details['industry'] = ucwords($industry->name);

        }
        $functionalarea = Functionalarea::where(array('id'=>$checkjob->functional_area))->first();
        if($functionalarea)
        {
          $details['function'] = ucwords($functionalarea->name);

        }
        if($checkjob->job_type)
        {
          $details['job_type']='Full Time';
          if($checkjob->job_type==2)
          {
            $details['job_type'] = 'Part Time';

          }

        }

        return view('web/jobdetail',compact('checkjob','compnay','details'));

      }
      else
      {
        return redirect('error404');

      }

    }
    else
    {
      return redirect('error404');

    }
    
  }
  //////////// post job fucntion/////////
  public function postjob(Request $request,$pagename=false)
  {
    ////////////first check login//////
    $user = Auth::user();
    if(empty($user->id))
    {
         return redirect('auth/login');
    }
    else
    {
      $jobdetails='';
      $statelist = array();
      $currenttab='';
      $checkcompnay = Company_detail::where(array('user_id'=>$user->id))->first();
        $CommonObj = new Common();
        ////////////save job///////////
        if(isset($request->savejob))
        {
          $validator = $this->jobvalidation($request);
          // dd($request->all());
          
          $joburl = $CommonObj->cleanURL($request->jobtitle);
          $jobArray = array('compnay_hiring'=>$request->comphiring,
                            'openings'=>$request->openings,
                            'company_client'=>$request->compclient,
                            'company_email'=>$request->contactemail,
                            'compnay_website'=>$request->website,
                            'valid_till'=>$request->jobvalid,
                            'country'=>$request->country,
                            'state'=>@$request->state,
                            'jobtitle'=>$request->jobtitle,
                            'job_url'=>$joburl,
                            'city'=>@$request->city,
                            'compnay_id'=>$checkcompnay->id,
                            'contact_landline'=>$request->contactlandline,
                            'contact_mobile'=>$request->contactmobile,
                            'industry'=>$request->industry,
                            'functional_area'=>$request->functionalarea,
                            'designation'=>$request->designation,
                            'emp_level'=>$request->emplevel,
                            'project_nature'=>$request->projectnature,
                            'skill'=>$request->projectskills,
                            'job_quality'=>$request->jobquality,
                            'job_type'=>$request->job_type,
                            'about_compnay'=>$request->aboutcompnay,
                            'job_description'=>$request->description,
                            'experience_year'=>$request->expyear,
                            'experience_month'=>$request->expmonth,
                            'salary_min'=>$request->salaryto,
                            'salary_max'=>$request->salaryfrom,
                            'joingtime'=>$request->joingtime,
                            'education_required'=>$request->job_education,
                            'user_id'=>$user->id,
                            'created_at'=>date('Y-m-d H:i:s'));
          $creteajob = Jobdetail::insertGetId($jobArray);
          if($creteajob)
          {
            Session::flash('message','Job Post Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

          }
          else
          {
            Session::flash('message','Some technical problem.'); 
            Session::flash('alert-class', 'danger'); 
            Session::flash('alert-title', 'error');

          }
        }
        if($request->editid)
        {
          if(isset($request->editjob))
          {
            $validator = $this->jobvalidation($request);
            $joburl = $CommonObj->cleanURL($request->jobtitle);
            // dd($request->all());
            $jobArray = array('compnay_hiring'=>$request->comphiring,
                              'openings'=>$request->openings,
                              'company_client'=>$request->compclient,
                              'company_email'=>$request->contactemail,
                              'compnay_website'=>$request->website,
                              'valid_till'=>$request->jobvalid,
                              'country'=>$request->country,
                              'state'=>@$request->state,
                              'city'=>@$request->city,
                              'jobtitle'=>$request->jobtitle,
                              'job_url'=>$joburl,
                              'compnay_id'=>$checkcompnay->id,
                              'contact_landline'=>$request->contactlandline,
                              'contact_mobile'=>$request->contactmobile,
                              'industry'=>$request->industry,
                              'functional_area'=>$request->functionalarea,
                              'designation'=>$request->designation,
                              'emp_level'=>$request->emplevel,
                              'project_nature'=>$request->projectnature,
                              'skill'=>$request->projectskills,
                              'job_quality'=>$request->jobquality,
                              'job_type'=>$request->job_type,
                              'about_compnay'=>$request->aboutcompnay,
                              'job_description'=>$request->description,
                              'experience_year'=>$request->expyear,
                              'experience_month'=>$request->expmonth,
                              'salary_min'=>$request->salaryto,
                              'salary_max'=>$request->salaryfrom,
                              'joingtime'=>$request->joingtime,
                              'education_required'=>$request->job_education,
                              'user_id'=>$user->id,
                              'created_at'=>date('Y-m-d H:i:s'));
            $creteajob = Jobdetail::where(array('id'=>$request->editid))->update($jobArray);
            if($creteajob)
            {
              Session::flash('message','Job Edit Successfully.'); 
              Session::flash('alert-class', 'success'); 
              Session::flash('alert-title', 'Success');

            }
            else
            {
              Session::flash('message','Some technical problem.'); 
              Session::flash('alert-class', 'danger'); 
              Session::flash('alert-title', 'error');

            }
          }
          $jobdetails= Jobdetail::where(array('id'=>$request->editid,'user_id'=>$user->id))->first();
          $currenttab='edittab';
          if($jobdetails)
          {
            if($jobdetails->country)
            {
              $statelist = State::where(array('country_id'=>$jobdetails->country))->get();
            }
          }
          else
          {
            return redirect('error404');
          }
          
        }
        
        $countryList = $this->country->getallBy(array('status'=>1),array('id','country'));
        $functionalarea = Functionalarea::where(array('status'=>1))->get();
        $industry = Industry::where(array('status'=>1))->get();
        return view('web/postjob',compact('countryList','functionalarea','industry','jobdetails','currenttab','statelist'));
    }
  }


   ///////// all jobs listion posted by user////
   //////pagename is optional /////////
  public function userjobslist(Request $request,$pagename=false)
  {
    ////////////first check login//////
    if(Auth::check())
    {
      $countrylist = $this->country->getListraw(array(),'country','id');
      $statelist = State::where(array())->lists('state','id')->all();
      $activejobarray=array();
      $pastjobarray=array();
      $user = Auth::user();
      $checkcompnay = Company_detail::where(array('user_id'=>$user->id))->first();
      $condition = 'user_id = "'.$user->id.'" and valid_till >="'.date('Y-m-d').'"';
      $conditionpast = 'user_id = "'.$user->id.'" and valid_till <"'.date('Y-m-d').'"';

      $joblist = Jobdetail::whereRaw($condition)->paginate(2);
      foreach($joblist as $alljobs)
      {
        $companyid = $alljobs->compnay_id.',';
        $country='India';
        $state='';
        if(array_key_exists($alljobs->country, $countrylist))
        {
          $country=$countrylist[$alljobs->country];

        }
        if(array_key_exists($alljobs->state, $statelist))
        {
          $state=$statelist[$alljobs->state];

        }
        $experience=$alljobs->experience_year.' yrs';
        if($alljobs->experience_month)
        {
          $experience=$alljobs->experience_year.'-'.$alljobs->experience_month.' yrs';

        }
        $salary=$alljobs->salary_min.'00000';
        if($alljobs->salary_max)
        {
          $salary=$alljobs->salary_min.'00000 - '.$alljobs->salary_max.'00000';

        }
        $activejobarray[$alljobs->id] = array('jobid'=>$alljobs->id,
                                              'country'=>$country,
                                              'state'=>$state,
                                              'city'=>'',
                                              'jobtitle'=>$alljobs->jobtitle,
                                              'skill'=>$alljobs->skill,
                                              'job_quality'=>$alljobs->job_quality,
                                              'experience'=>$experience,
                                              'salary'=>$salary);
      }
      $pastjoblist = Jobdetail::whereRaw($conditionpast)->paginate(2);
      if(count($pastjoblist)>0)
      {
        foreach($pastjoblist as $alljobs)
        {
          $companyid = $alljobs->compnay_id.',';
          $country='India';
          $state='';
          if(array_key_exists($alljobs->country, $countrylist))
          {
            $country=$countrylist[$alljobs->country];

          }
          if(array_key_exists($alljobs->state, $statelist))
          {
            $state=$statelist[$alljobs->state];

          }
          $experience=$alljobs->experience_year.' yrs';
          if($alljobs->experience_month)
          {
            $experience=$alljobs->experience_year.'-'.$alljobs->experience_month.' yrs';

          }
          $salary=$alljobs->salary_min.'00000';
          if($alljobs->salary_max)
          {
            $salary=$alljobs->salary_min.'00000 - '.$alljobs->salary_max.'00000';

          }
          $pastjobarray[$alljobs->id] = array('jobid'=>$alljobs->id,
                                                'country'=>$country,
                                                'state'=>$state,
                                                'city'=>'',
                                                'jobtitle'=>$alljobs->jobtitle,
                                                'skill'=>$alljobs->skill,
                                                'job_quality'=>$alljobs->job_quality,
                                                'experience'=>$experience,
                                                'salary'=>$salary);
        }

      }
      return view('web/userfiles/jobs',compact('activejobarray','joblist','pastjoblist','pastjobarray'));

    }
    else
    {
      return redirect('error404');

    }
    
  }

  /////////////delete job function///////////
  public function deletejob(Request $request)
  {
    if(Auth::check())
    {
      $user = Auth::user();
      $checkjob= Jobdetail::where(array('user_id'=>$user->id,'id'=>$id));
      if($checkjob)
      {
        Jobdetail::destroy($id);
        Session::flash('message','Delete Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('/admin/newslist');

      }
      else
      {
        return redirect('error404/');

      }
    }
    else
    {

        return redirect('error404/');
      
    }

  }
  ///////////////// who apply for jobs posted by user//////
  public function applylist(Request $request,$id)
  {
    ////////////first check login//////
    if(Auth::check())
    {
      if($id)
      {
        $user = Auth::user();
        // $condition = array('id'=>$user->id,''=>);
        if($user->is_subuser)////////if user is subuser
        {
          $condition = array('id'=>$id,'user_id'=>$user->created_by);
        }
        else
        {
            $checkcompnay = Company_detail::where(array('user_id'=>$user->id))->first();
            $condition = array('id'=>$id,'compnay_id'=>$checkcompnay->id);
        }
        //////// check compnay//////////

        $checkjob = Jobdetail::where($condition)->first();
        if($checkjob)
        {
           ////////make recomemded array//////
          $recomendedArray = array();
          $recomemdedCondition = "profile_status=1 and industry='".$checkjob->industry."' and skills like '%".$checkjob->skill."%'";
          if($checkjob->experience_year)
          {
            $recomemdedCondition.= "and exp_year >='".$checkjob->experience_year."'";

           
          }
          $getrecomndedlist = Jobprefrences::join('users','users.id','=','jobprefrences.user_id')->whereRaw($recomemdedCondition)->paginate(5);
         
          if(count($getrecomndedlist)>0)
          {
            $useridlist='';
            foreach($getrecomndedlist as $getrecomnded)
            {
              $useridlist=$getrecomnded->user_id.',';
              $recomendedArray[$getrecomnded->id] = array('userid'=>$getrecomnded->user_id,
                                                          'username'=>$getrecomnded->name,
                                                          'skills'=>$getrecomnded->skills,
                                                          'extra_skills'=>$getrecomnded->extra_skills,
                                                          'exp'=>$getrecomnded->exp_year,
                                                          'useremail'=>$getrecomnded->email);

            }

            // $userArray = array();
            // $condition = "id in ".'('.substr($useridlist,0,-1).')'."";
            // $getuser = $this->usersInterface->getallByRaw($condition,array('id','email','name'));
            // foreach($getuser as $getuser)
            // {
            //   $userArray[$getuser->id] = array('email'=>$getuser->email,
            //                                    'name'=>$getuser->name);
            // }

            // array_walk($recomendedArray, function(&$value, $key, $sourceArray)
            // { 
               
                 
            //     if(array_key_exists($value['userid'], $sourceArray))
            //     {
            //          $value['username'] = $sourceArray[$value['userid']]['name'];
            //          $value['useremail'] = $sourceArray[$value['userid']]['email'];
            //     }

            // },$userArray);

          }
           // dd($recomendedArray);
          ///////////make apply array////////
          $allylistArray = array();
          $jobid='';
          $useridlist='';
          $getapplyList= Apply_for_job::where(array('job_id'=>$id,'type'=>1))->paginate(5);
          if(count($getapplyList)>0)
          {
            foreach($getapplyList as $applylist)
            {
              $jobid=$applylist->job_id.',';
              $useridlist=$applylist->apply_by_id.',';
              $allylistArray[$applylist->id] = array('jobtitle'=>'',
                                                     'jobid'=>$applylist->job_id,
                                                     'userid'=>$applylist->apply_by_id,
                                                     'username'=>'',
                                                     'ipaddress'=>$applylist->ip_address,
                                                     'date'=>$applylist->created_at,
                                                     'useremail'=>'');

            }
            //////////////////make user array////////
            $userArray = array();
            $condition = "id in ".'('.substr($useridlist,0,-1).')'."";
            $getuser = $this->usersInterface->getallByRaw($condition,array('id','email','name'));
            foreach($getuser as $getuser)
            {
              $userArray[$getuser->id] = array('email'=>$getuser->email,
                                               'name'=>$getuser->name);
            }

             //////////////////make job array////////
            $jobArray= array();
            $condition = "id in ".'('.substr($jobid,0,-1).')'."";
            $getjob = Jobdetail::whereRaw($condition)->get(array('id','jobtitle'));
            foreach($getjob as $getjob)
            {
              $jobArray[$getjob->id] = $getjob->jobtitle ;
            }
            array_walk($allylistArray, function(&$value, $key, $sourceArray)
            { 
               
                 
                if(array_key_exists($value['userid'], $sourceArray))
                {
                     $value['username'] = $sourceArray[$value['userid']]['name'];
                     $value['useremail'] = $sourceArray[$value['userid']]['email'];
                }

            },$userArray);
            array_walk($allylistArray, function(&$value, $key, $sourceArray)
            { 
               
                if(array_key_exists($value['jobid'], $sourceArray))
                {
                     $value['jobtitle'] = $sourceArray[$value['jobid']];
                    
                }

            },$jobArray);

          }
          // dd($allylistArray);


          return view('web/userfiles/applylist',compact('getapplyList','allylistArray','recomendedArray','getrecomndedlist'));

        }
        else
        {
          return redirect('error404');

        }

      }
      
      else
      {
        return redirect('error404');

      }
    }
    else
    {
      return redirect('error404');

    }
    
  }
   
  
}
