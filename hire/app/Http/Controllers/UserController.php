<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Appfiles\Common\Functions;
use App\Model\Password_resets;
use Appfiles\Repo\UsersInterface;
use Appfiles\Repo\UserdetailInterface;
use Appfiles\Repo\ArticlesInterface;
use Appfiles\Repo\PostnewsInterface;
use Appfiles\Repo\CategoryInterface;
use Appfiles\Repo\SubcategoryInterface;
use Appfiles\Repo\DiscussionsInterface;
use Appfiles\Repo\CountryInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Model\Common;
use App\Model\Courselist;
use App\Model\Subcourselist;
use App\Model\Schoolboard;
use App\Model\Schoolmedium;
use Appfiles\Repo\EmploymentInterface;
use App\Model\Discussion_invite;
use App\Model\Eductiondetails;
use App\Model\Jobprefrences;
use App\Model\Company_detail;
use App\Model\Industry;
use App\Model\Jobdetail;
use App\Model\Functionalarea;
use App\Model\User_followers;
use App\Model\Projectlist;
use App\Model\Apply_for_job;
use App\Model\View;
use App\Model\State;
use App\Model\City;
use App\Model\Departments;
use App\Model\Credibility_category;
use App\Model\Credibility_factors;
use App\Model\Employee_details;
use App\Model\Employee_credibility;


Use DB;
use Validator;
use Auth;
use URL;
// use View;
class UserController extends Controller
{
  use ValidationTrait;
	protected $APIURL;
    protected $functions;
    protected $s3;

	public function  __construct(Functions $functions, UsersInterface $usersInterface,ArticlesInterface $articles,CategoryInterface $category,SubcategoryInterface $subcat,DiscussionsInterface $discussion,CountryInterface  $country,UserdetailInterface $userdetail,EmploymentInterface $employment,PostnewsInterface $postnews)
    {
        //$this->user_id= 1;
        
		    $this->APIURL= URL::to('api/');
        $this->functions=$functions;
		    $this->usersInterface = $usersInterface;
        $this->articles = $articles;
        $this->category=$category;
        $this->subcat=$subcat;
        $this->discussion = $discussion;
        $this->country = $country;
        $this->userdetail =$userdetail;
        $this->employment = $employment;
        $this->postnews = $postnews;
        // $this->Discussion_invite = new Discussion_invite();

}
   
 ////// $pagename which page display///////
  public function index(Request $request,$pagename=false)
  {
    /////// first check login
    $user = Auth::user();
    if(empty($user->id))
    {
         return redirect('auth/login');//////// rdirect for login
    }
    else
    {
        ////////// submit article///////
        if(isset($request->submitarticle))
        {
           $validator = $this->postarticle($request);
        }
        /////// submit///////////
        if(isset($request->submitdiscussion))
        {
            $validator = $this->postdiscussion($request);
        }
        //////////////invitation
        if(isset($request->sendinvite))
        {
          $validator = $this->sendinvite($request);
          $dataArray = array('discussion_id'=>$request->discussion_name,
                             'name'=>$request->name,
                             'email'=>$request->email,
                             'created_by'=>$user->id,
                             'created_at'=>date('Y-m-d H:i:s'));
          $sendinvitation = Discussion_invite::insertGetId($dataArray);
          if($sendinvitation)
          {
            Session::flash('message','Create Successfully.'); 
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
        
        $articlelist=array();////// article array
        $articledetail='';
        $currenttab='';///// which tab active
        $catlist='';
        $subcatlist='';
        $duscussionlist = '';
        $invitationlist = array();
        if($pagename=='articles')
        {
          $request->userid=$user->id;
          $articlelist= $this->articles->articleslist($request);
          if($request->editid)
          {
            $articledetail= $this->articles->getBy(array('id'=>$request->editid));
            $currenttab='edittab';

          }
           $catlist = $this->category->getallBy(array('type'=>1,'status'=>1),array('name'));
           $subcatlist = $this->subcat->getallBy(array('type'=>1,'status'=>1),array('name'));
        }
        if($pagename=='discussions')
        {
          $request->userid=$user->id;
          $request->showall=1;
          $duscussionlist= $this->discussion->discussionlist($request);
          if($request->editid)
          {
            $duscussiondetail= $this->discussion->getBy(array('id'=>$request->editid));
            $currenttab='edittab';
          }
           
        }
        ///////// if pagenmae invitediscussion/
        if($pagename=='invitediscussion')
        {
          $duscussionlist= $this->discussion->getallBy(array('status'=>1,'user_id'=>$user->id),array('id','title'));
          $invitationlist = Discussion_invite::where(array('created_by'=>$user->id))->get(array('name','email','created_at'));

        }
        $employmentdetails='';
        $jobprefrence='';
        $usereducationArry = array();////// eduction array
        $projectlistarray = array();///////// project array
        /////// if user register from job looking///
        if($user->looking_for_job==1)
        {
          $employmentdetails = $this->employment->getallBy(array('user_id'=>$user->id));
          $jobprefrence = Jobprefrences::where(array('user_id'=>$user->id))->first();
          $usereducation = Eductiondetails::where(array('user_id'=>$user->id))->get();
          if(count($usereducation)>0)
          {
            foreach($usereducation as $usereducation)
            {
              $course_name='';
              $educate_from='';
              if($usereducation->type==3)
              {
                $course_name='Xii';

              }
              else if($usereducation->type==4)
              {
                $course_name='X';

              }
              if($usereducation->type==1 || $usereducation->type==2)
              {
                $getcousename = Courselist::where(array('id'=>$usereducation->course_name))->first();
                if($getcousename)
                {
                  $course_name=$getcousename->course_name;
                }
                $educate_from = $usereducation->educate_from;

              }
              if($usereducation->type==4 || $usereducation->type==3)
              {
                $borad_name = Schoolboard::where(array('id'=>$usereducation->borad))->first();
                if($borad_name)
                {
                  $educate_from=$borad_name->board_name;
                }
                
              }
              if($educate_from!='')
              {
                $usereducationArry[$usereducation->type] = array('course_name'=>$course_name,
                                                               'educate_from'=>$educate_from,
                                                               'passing_year'=>$usereducation->passing_year,
                                                               'marks'=>$usereducation->marks);

              }
              

            }

          }

          /////////// make project array////
          $getlist = Projectlist::where(array('user_id'=>$user->id))->get();
          if(count($getlist)>0)
          {
            foreach($getlist as $getlist)
            {
              $projectlistarray[$getlist->id] = array('project_name'=>$getlist->project_name,
                'id'=>$getlist->id,
                                                      'project_nature'=>$getlist->project_nature,
                                                      'project_skill'=>$getlist->project_skill,
                                                      'worked_to'=>$getlist->worked_to,
                                                      'worked_from'=>$getlist->worked_from);

            }

          }

        }
        $userdetails = '';
        if($pagename=='')
        {
          $userdetails = $this->userdetail->getBy(array('user_id'=>$user->id));

        }

        //////// list all saves////
        $allylistArray = array();
        $allbooklistArray = array();
        $getapplyList='';
        $getbookList='';
        if($pagename=='all-saves')
        {
          
          $jobid='';
          $useridlist='';
          $getapplyList= Apply_for_job::where(array('type'=>1,'apply_by_id'=>$user->id))->paginate(15);
          if(count($getapplyList)>0)
          {
            foreach($getapplyList as $applylist)
            {
              $jobid=$applylist->job_id.',';
              $useridlist=$applylist->apply_by_id.',';
              $allylistArray[$applylist->id] = array('jobtitle'=>'',
                                                     'jobid'=>$applylist->job_id,
                                                     'skills'=>'',
                                                     'extra_skills'=>'',
                                                     'ipaddress'=>$applylist->ip_address,
                                                     'date'=>$applylist->created_at);

            }

             //////////////////make job array////////
            $jobArray= array();
            $condition = "id in ".'('.substr($jobid,0,-1).')'."";
            $getjob = Jobdetail::whereRaw($condition)->get(array('id','jobtitle','skill','job_quality'));
            foreach($getjob as $getjob)
            {
              $jobArray[$getjob->id] = array('jobtitle'=>$getjob->jobtitle,
                                             'skills'=>$getjob->skill,
                                             'extra_skills'=>$getjob->job_quality) ;
            }
 
            array_walk($allylistArray, function(&$value, $key, $sourceArray)
            { 
               
                if(array_key_exists($value['jobid'], $sourceArray))
                {
                     $value['jobtitle'] = $sourceArray[$value['jobid']]['jobtitle'];
                     $value['skills'] = $sourceArray[$value['jobid']]['skills'];
                     $value['extra_skills'] = $sourceArray[$value['jobid']]['extra_skills'];
                    
                }

            },$jobArray);

          }


          //////// forbookmarks/////
           $jobid='';
          $getbookList= Apply_for_job::where(array('type'=>2,'apply_by_id'=>$user->id))->paginate(15);
          if(count($getbookList)>0)
          {
            foreach($getbookList as $applylist)
            {
              $jobid=$applylist->job_id.',';
              $allbooklistArray[$applylist->id] = array('jobtitle'=>'',
                                                     'jobid'=>$applylist->job_id,
                                                     'skills'=>'',
                                                     'extra_skills'=>'',
                                                     'ipaddress'=>$applylist->ip_address,
                                                     'date'=>$applylist->created_at);

            }
    

             //////////////////make job array////////
            $jobArray= array();
            $condition = "id in ".'('.substr($jobid,0,-1).')'."";
            $getjob = Jobdetail::whereRaw($condition)->get(array('id','jobtitle','skill','job_quality'));
            foreach($getjob as $getjob)
            {
              $jobArray[$getjob->id] = array('jobtitle'=>$getjob->jobtitle,
                                             'skills'=>$getjob->skill,
                                             'extra_skills'=>$getjob->job_quality) ;
            }
 
            array_walk($allbooklistArray, function(&$value, $key, $sourceArray)
            { 
               
                if(array_key_exists($value['jobid'], $sourceArray))
                {
                     $value['jobtitle'] = $sourceArray[$value['jobid']]['jobtitle'];
                     $value['skills'] = $sourceArray[$value['jobid']]['skills'];
                     $value['extra_skills'] = $sourceArray[$value['jobid']]['extra_skills'];
                    
                }

            },$jobArray);

          }


       

        }

        // dd($usereducationArry);

        return view('web/userfiles/userhomepage',compact('pagename','articlelist','articledetail','currenttab','catlist','subcatlist','duscussiondetail','duscussionlist','invitationlist','user','employmentdetails','jobprefrence','usereducationArry','projectlistarray','userdetails','allbooklistArray','allylistArray','getapplyList','getbookList'));
    }
  }

 
  //////// function for edit user profile /////////
  ////// pagename which page to edit//////
  public function editprofile(Request $request,$pagename=false)
  {
    //////// first check login///////
    $user = Auth::user();
    if(empty($user->id))
    {
         return redirect('auth/login');
    }
    else
    {
      $request->id=$user->id;
        ////// save and update basicinformation////
      if(isset($request->editbasicdetails))
      {
        //////userbasci_info in validation trait////
        $validator = $this->userbasci_info($request);
        return redirect('editprofile');
      }
      ////////save and update social details///////
      if(isset($request->editsocial))
      {
        $dataArray = array('facebook_url'=>$request->fb_url,
                           'linkedin_url'=>$request->Linkedin_url,
                           'googleplus_url'=>$request->g_plus_url,
                           'twitter_url'=>$request->twitter_url);
        $checkdetails = $this->userdetail->getBy(array('user_id'=>$user->id),array('id'));
        if($checkdetails)
        {
          $socialinfo  =$this->userdetail->upadte($dataArray,array('user_id'=>$user->id));

        }
        else
        {
          $dataArray['user_id'] = $user->id;
          $dataArray['created_at'] =date('Y-m-d H:i:s') ;
          $socialinfo = $this->userdetail->create($dataArray);

        }
        if($socialinfo)
        {
          Session::flash('message','Detail update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');

        }
        else
        {
            ///throw $e;
            Session::flash('message','Some technical problem.'); 
            Session::flash('alert-class', 'danger'); 
            Session::flash('alert-title', 'error');
        }
        return redirect('editprofile');
        
      }
      ////////save and update employment///////
      if(isset($request->makeemployment))
      {
        // dd($request->all());
        if($request->company!='')
        {
          $success=0;
          foreach($request->company as $key=>$val)
          {
            $insertArray = array('company_name'=>$val,
                                 'company_website'=>'',
                                 'company_name_website'=>'',
                                 'designation'=>'',
                                 'year'=>'',
                                 'month'=>'',
                                 'till'=>'',
                                 'job_profile'=>'',
                                 'user_id'=>$user->id,
                                 'created_at'=>date('Y-m-d H:i:scandir(directory)'));
            if(array_key_exists($key, $request->website))
            {
              $insertArray['company_website'] = $request->website[$key];
            }
            if(array_key_exists($key, $request->company_name_website))
            {
              $insertArray['company_name_website'] = $request->company_name_website[$key];
            }
            if(array_key_exists($key, $request->Designation))
            {
              $insertArray['designation'] = $request->Designation[$key];
            }
            if(isset($request->year) && array_key_exists($key, $request->year))
            {
              $insertArray['year'] = $request->year[$key];
            }
            if(isset($request->month) && array_key_exists($key, $request->month))
            {
              $insertArray['month'] = $request->month[$key];
            }
            if(isset($request->till) && array_key_exists($key, $request->till))
            {
              $insertArray['till']= $request->till[$key];
            }
            if(isset($request->job_profile) && array_key_exists($key, $request->job_profile))
            {
              $insertArray['job_profile']= $request->job_profile[$key];
            }
            $create = $this->employment->create($insertArray);
            if($create)
            {
              $success++;
            }

          }
          if($success>0)
          {
            Session::flash('message','Create Successfully.'); 
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

      }
      ///////////update employment///////
      ////////save and update employment///////
      if(isset($request->updateemployment))
      {
        // dd($request->all());
        $validator = $this->validateemp($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
          $upadteAray = array('company_name'=>$request->company,
                                 'company_website'=>$request->website,
                                 'company_name_website'=>$request->company_name_website,
                                 'designation'=>$request->Designation,
                                 'year'=>$request->year,
                                 'month'=>$request->month,
                                 'till'=>$request->till,
                                 'job_profile'=>$request->job_profile);
          $update = $this->employment->update($upadteAray,array('id'=>$request->edit));
          if($update)
          {
            Session::flash('message','Update Successfully.'); 
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
      ////////save and update education details///////
      if(isset($request->makeeducation))
      {
          // dd($request->all());
          ////////// undergraduacte///////
          $status=0;
          if($request->ugcourse!='')
          {
            $graducateArray = array('type'=>1,
                                    'course_name'=>$request->ugcourse,
                                    'course_spec'=>$request->ugspec,
                                    'educate_from'=>$request->ugcollage,
                                    'course_mode'=>$request->ugcoursemode,
                                    'passing_year'=>$request->ugpassingyear,
                                    'marks'=>$request->ugmarks,
                                    'user_id'=>$user->id,
                                    'created_at'=>date('Y-m-d H:i:s'));
            $condition = array('user_id'=>$user->id,'type'=>1);
            $checkprefrence = Eductiondetails::where($condition)->first();
            if($checkprefrence)
            {
               $create = Eductiondetails::where($condition)->update($graducateArray);
               $status++;

            }
            else
            {
               $create = Eductiondetails::insertGetId($graducateArray);
               $status++;
            }

          }
          if($request->postcourse!='')
          {
            $postgraducateArray = array('type'=>2,
                                    'course_name'=>$request->postcourse,
                                    'course_spec'=>$request->pgspec,
                                    'educate_from'=>$request->pgcollege,
                                    'course_mode'=>$request->pgcoursemode,
                                    'passing_year'=>$request->pgpassingyear,
                                    'marks'=>$request->pgmarks,
                                    'user_id'=>$user->id,
                                    'created_at'=>date('Y-m-d H:i:s'));
            $condition = array('user_id'=>$user->id,'type'=>2);
            $checkprefrence = Eductiondetails::where($condition)->first();
            if($checkprefrence)
            {
               $create = Eductiondetails::where($condition)->update($postgraducateArray);
               $status++;

            }
            else
            {
               $create = Eductiondetails::insertGetId($postgraducateArray);
               $status++;
            }

          }
          if($request->xiiboard!='')
          {
            $xiiArray = array('type'=>3,
                             'borad'=>$request->xiiboard,
                             'course_spec'=>$request->xiimedium,
                             'passing_year'=>$request->xiipassingyear,
                             'marks'=>$request->xiimarks,
                             'user_id'=>$user->id,
                             'created_at'=>date('Y-m-d H:i:s'));
            $condition = array('user_id'=>$user->id,'type'=>3);
            $checkprefrence = Eductiondetails::where($condition)->first();
            if($checkprefrence)
            {
               $create = Eductiondetails::where($condition)->update($xiiArray);
               $status++;

            }
            else
            {
               $create = Eductiondetails::insertGetId($xiiArray);
               $status++;
            }

          }
          if($request->xboard!='')
          {
            $xArray = array('type'=>4,
                            'borad'=>$request->xboard,
                            'course_spec'=>$request->xmedium,
                            'passing_year'=>$request->xpassingyear,
                            'marks'=>$request->xmarks,
                            'user_id'=>$user->id,
                            'created_at'=>date('Y-m-d H:i:s'));
            $condition = array('user_id'=>$user->id,'type'=>4);
            $checkedu = Eductiondetails::where($condition)->first();
            if($checkedu)
            {
              // dd('pawan');
               $create = Eductiondetails::where($condition)->update($xArray);
               $status++;

            }
            else
            {
              // dd('dalal');
               $create = Eductiondetails::insertGetId($xArray);
               $status++;
            }

          }
           if($status>0)
          {
            Session::flash('message','Education details update Successfully.'); 
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
      ////////save and update job prefrences///////
      if(isset($request->makejobprefremce))
      {
        $validator = $this->jobprefrence($request);
        // $create = $jobpreObj->makejobprefrence($request);
        $langaugesknow='';
        if(count($request->langaugesknow)>0)
        {
          $langaugesknow = implode(',', $request->langaugesknow);
        }
        // dd($request->all());
        $dataArray = array('exp_year'=>$request->expyear,
                           'exp_month'=>$request->expmonth,
                           'skills'=>$request->skills,
                           'extra_skills'=>$request->extra_skills,
                           'notice_days'=>$request->noticetime,
                           'annually_lakh'=>$request->annaulaysalary,
                           'annually_thousand'=>$request->annaulaysalaryth,
                           'expected_lakh'=>$request->expectedsalary,
                           'expected_thousand'=>$request->expectedsalaryth,
                           'job_type'=>$request->emp_type,
                           'langauges_known'=>$langaugesknow,
                           'industry'=>$request->industry,
                           'functional_area'=>$request->jobcategory,
                           'user_id'=>$user->id,
                           'created_at'=>date('Y-m-d H:i:s'));
        if($request->file('resumefile'))
        {
            $image = $request->file('resumefile');
            // $destinationPath = 'storage/articles'; // upload path
            $destinationPath = 'uplode/resume/';
            $extension = $request->file('resumefile')->getClientOriginalExtension(); // getting image extension
            $fileName = 'resume_'.time().'.'.$extension; // renameing image
            $request->file('resumefile')->move($destinationPath, $fileName); // uploading file to given path
             $dataArray['resume'] = $fileName;
        }
        $checkprefrence = Jobprefrences::where(array('user_id'=>$user->id))->first();
        if($checkprefrence)
        {
          $prefrence = Jobprefrences::where(array('user_id'=>$user->id))->update($dataArray);

        }
        else
        {
          $prefrence = Jobprefrences::insertGetId($dataArray);
        }


        if($prefrence)
        {
             Session::flash('message','Successfully.'); 
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
      ////////save and update project skils///////
      if(isset($request->makeproject))
      {
        // dd($request->all());
        if($request->projectcmp!='' || count($request->projectcmp)>0)
        {
          $success=0;
          foreach($request->projectcmp as $key=>$val)
          {
            ////// make insert data array for insert project/////////
          if(array_key_exists($key, $request->projectname))
          {
              $insertArray['project_location'] = $request->projectloc[$key];
            
              $insertArray = array('company_id'=>$val,
                                   'project_name'=>@$request->projectname[$key],
                                   'industry'=>'',
                                   'project_nature'=>'',
                                   'project_location'=>'',
                                   'project_skill'=>'',
                                   'worked_to'=>'',
                                   'worked_from'=>'',
                                   'user_id'=>$user->id,
                                   'created_at'=>date('Y-m-d H:i:s'));
            if(array_key_exists($key, $request->projectloc))
            {
              $insertArray['project_location'] = $request->projectloc[$key];
            }
            if(array_key_exists($key, $request->industry))
            {
              $insertArray['industry'] = $request->industry[$key];
            }
            if(array_key_exists($key, $request->projectskill))
            {
              $insertArray['project_skill'] = $request->projectskill[$key];
            }
            if(array_key_exists($key, $request->projectnature))
            {
              $insertArray['project_nature'] = $request->projectnature[$key];
            }
            if(isset($request->workedtoproject) && array_key_exists($key, $request->workedtoproject))
            {
              $insertArray['worked_to'] = $request->workedtoproject[$key];
            }
            if(isset($request->workedfromproject) && array_key_exists($key, $request->workedfromproject))
            {
              $insertArray['worked_from'] = $request->workedfromproject[$key];
            }
            $create = Projectlist::insertGetId($insertArray);
            if($create)
            {
              $success++;
            }
           }

          }
          if($success>0)
          {
            Session::flash('message','Create Successfully.'); 
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
        else
        {
          Session::flash('message','Some thing wrong with your input.'); 
          Session::flash('alert-class', 'danger'); 
          Session::flash('alert-title', 'error');

        }

      }
      ////////edit project detals
      if(isset($request->editproject))
      {
        // dd($request->all());
        $validator = $this->validateproject($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
          $upadteAray = array('company_id'=>$request->projectcmp,
                               'project_name'=>$request->projectname,
                               'industry'=>$request->industry,
                               'project_nature'=>$request->projectnature,
                               'project_location'=>$request->projectloc,
                               'project_skill'=>$request->projectskill,
                               'worked_to'=>$request->workedfromproject,
                               'worked_from'=>$request->workedtoproject);
          $update = Projectlist::where(array('id'=>$request->editprojectid))->update($upadteAray);
          if($update)
          {
            Session::flash('message','Update Successfully.'); 
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
      $courselist='';
      $Schoolboardlist='';
      $schoolmedium='';
      // $Subcourselist='';
      $usereducationArry = array();
      $indusrtylist='';
      $functionalarea='';
      $companywork='';
      $companyworklist='';
      $Subcourselist=array();
        $postSubcourselist=array();
      //////////////////////////// edit education details of user///////////
      if($pagename=='education')
      {
        $draduactionid='';
        $postgraduactionid='';
        
        $courselist = Courselist::where(array('status'=>1))->get(array('id','course_name','course_for'));
        $schoolboardlist = Schoolboard::where(array('status'=>1))->get(array('id','board_name'));
        $schoolmedium = Schoolmedium::where(array('status'=>1))->get();

        
        $usereducation = Eductiondetails::where(array('user_id'=>$user->id))->get();
        if(count($usereducation)>0)
        {
          foreach($usereducation as $usereducation)
          {
            switch ($usereducation->type)
             {
              case '1':
                $draduactionid=$usereducation->course_name;
                break;
                case '2':
                $postgraduactionid=$usereducation->course_name;
                break;
              
              
            }
            $usereducationArry[$usereducation->type] = array('course_name'=>$usereducation->course_name,
                                                             'course_spec'=>$usereducation->course_spec,
                                                             'educate_from'=>$usereducation->educate_from,
                                                             'course_mode'=>$usereducation->course_mode,
                                                             'passing_year'=>$usereducation->passing_year,
                                                             'borad'=>$usereducation->borad,
                                                             'marks'=>$usereducation->marks);

          }
          ////////////// ID USER ALREDY SET SPECLIZATION///////

          if($draduactionid!='')
          {
            $Subcourselist = Subcourselist::where(array('course_id'=>$draduactionid))->get();

          }
          if($postgraduactionid!='')
          {
            $postSubcourselist = Subcourselist::where(array('course_id'=>$postgraduactionid))->get();

          }

        }
        
      }
      /////// edit employment details//////
      $editempdata='';
      if($pagename=='employment')
      {
        if($request->edit)
        {
          $checkemp = $this->employment->getBy(array('id'=>$request->edit,'user_id'=>$user->id));
          if($checkemp)
          {
            $editempdata=$checkemp;
          }
          else
          {
            return redirect('error404');
          }

        }

      }
      /////////make and edit user other info//////
      if($pagename=='otherinfo')
      {
        $indusrtylist = Industry::where(array('status'=>1))->get();
        $functionalarea = Functionalarea::where(array('status'=>1))->get();
      }
      ////////// make and edit projectskills///////
      if($pagename=='projectskills')
      {
        /////// get compnaylist//////
        $indusrtylist = Industry::where(array('status'=>1))->lists('name','id')->all();
        $companywork = $this->employment->getListraw(array('user_id'=>$user->id),'company_name','id');
        $companyworklist = json_encode($companywork);
        
        ////// details for projectskills/////////
        if($request->editprojectid)
        {
          $checproject = Projectlist::where(array('id'=>$request->editprojectid,'user_id'=>$user->id))->first();
          if($checproject)
          {
            $editempdata=$checproject;
          }
          else
          {
            return redirect('error404');
          }

        }
      }
      // dd($companywork);
      $getuserdetails = $this->userdetail->getBy(array('user_id'=>$user->id));
      $countryList = $this->country->getallBy(array('status'=>1),array('id','country'));
      $jobprefrence = Jobprefrences::where(array('user_id'=>$user->id))->first();
      $educationdata = Eductiondetails::where(array('user_id'=>$user->id))->get();
      $statelist = array();
      
      
        if($user->country)
        {
          $statelist = State::where(array('country_id'=>$user->country))->get();

        }
     // }
      
      // dd($editempdata);

      return view('web/userfiles/editprofile',compact('pagename','countryList','getuserdetails','user','courselist','schoolboardlist','schoolmedium','jobprefrence','educationdata','Subcourselist','usereducationArry','functionalarea','indusrtylist','companywork','companyworklist','statelist','editempdata','postSubcourselist'));
    }

  }
    /////////// all user listing function //////
  public function userlisting(Request $request)
  {
    if(Auth::check())
    {
      $user = Auth::user();
      $userlistArray  = array();
      $request->isdefault=1;
      $getuserlist = $this->usersInterface->getpeoplelist($request);
      if(count($getuserlist)>0)
      {
        $useridlist='';
        $stateid='';
        $cityid='';
        foreach($getuserlist as $userDetails)
        {
          $useridlist = $userDetails->id.',';
          if($userDetails->state!='' && $userDetails->state!=NULL)
          {
            $stateid=$userDetails->state.',';

          }
           if($userDetails->city!='' && $userDetails->city!=NULL)
          {
            $cityid=$userDetails->city.',';

          }
          
          // $cityid=$userDetails->city.',';
          $imagePatah = URL::asset('web/images/profilePic.png');
           if($userDetails->profile_image)
           {
             $imagePatah = URL::asset($_ENV['CF_LINK'].$userDetails->profile_image);
             if($userDetails->login_type==1)
             {
                if(strpos($userDetails->profile_image, 'https')!==false)
                  {
                     $imagePatah = $userDetails->profile_image;
                  }
                // $imagePatah = $userDetails->profile_image;
             }
             
           }
           $name = substr(substr($userDetails->email,0,strpos($userDetails->email,'@')),0,10);
           if($userDetails->name)
           {
             $name = substr($userDetails->name,0,10);
           }
           $education='';
           $edudetails = Eductiondetails::where(array('user_id'=>$userDetails->id))->orderBy('type','desc')->first();
           if($edudetails)
           {
             $cousre = Courselist::where(array('id'=>$edudetails->course_name))->first();
             if($cousre)
             {
              $education = $cousre->course_name.' '.$edudetails->educate_from;

             }

           }
           $skills='';
           $extraskilss='';
           $getskills = Jobprefrences::where(array('user_id'=>$userDetails->id))->first();
           if($getskills)
           {
            $skills=$getskills->skills;
             $extraskilss=$getskills->extra_skills;

           }
           $isconnect='no';
   
          $userlistArray[$userDetails->id] = array('name'=>$name,
                                 'profile_title'=>$userDetails->profile_title,
                                 'userid'=>$userDetails->id,
                                 'image'=>$imagePatah,
                                 'skills'=>$skills,
                                 'stateid'=>$userDetails->state,
                                 'statename'=>'',
                                 'cityid'=>$userDetails->city,
                                 'cityname'=>'',
                                 'is_connect'=>'no',
                                 'view_count'=>0,
                                 'extra_skills'=>$extraskilss,
                                 'education'=>$education);

        }
        $getconnectid = User_followers::where(array('followed_by_id'=>$user->id,'type'=>1))->lists('action_id')->all();
                // dd($getconnectid);
                /////////// make final array/
        array_walk($userlistArray, function(&$value, $key, $sourceArray)
        { 
           
             
            if(in_array($value['userid'], $sourceArray))
            {
                $value['is_connect'] = 'yes';
            }

        },$getconnectid); 

      // } 

      ////// view count array///////////
      $viewcountArray = array();
      $condition = "type='user' and view_id in ".'('.substr($useridlist,0,-1).')'."";
      $selectRaw = "count(id) as totalcount,view_id";
      $getviewcount = View::selectRaw($selectRaw)->whereRaw($condition)->groupBy(array('view_id'))->get();
      foreach($getviewcount as $getviewcount)
      {
        $viewcountArray[$getviewcount->view_id] = $getviewcount->totalcount;

      }

       array_walk($userlistArray, function(&$value, $key, $sourceArray)
        { 
           
             
            if(in_array($value['userid'], $sourceArray))
            {
                $value['view_count'] = $sourceArray[$value['userid']];
            }

        },$viewcountArray); 

       ////////// make user city//////
       $getstate = array();
       $getcity = array();
       // echo ($stateid);
       // die;
       if($stateid!='' && !empty($stateid))
       {
         $condition = "id in ".'('.substr($stateid,0,-1).')'."";
         $getstate = State::whereRaw($condition)->lists('state','id')->all();
         if($cityid!='')
         {
          $condition = "id in ".'('.substr($cityid,0,-1).')'."";
          $getcity = City::whereRaw($condition)->lists('city','id')->all();

         }

       }
        array_walk($userlistArray, function(&$value, $key, $sourceArray)
        { 
             
            if(array_key_exists($value['stateid'], $sourceArray))
            {
                $value['statename'] = $sourceArray[$value['stateid']];
            }

        },$getstate);


        array_walk($userlistArray, function(&$value, $key, $sourceArray)
        { 
           
             
            if(array_key_exists($value['cityid'], $sourceArray))
            {
                $value['cityname'] = $sourceArray[$value['cityid']];
            }

        },$getcity); 

      } 
      // dd($userlistArray);
      $indusrtylist = Industry::where(array())->get(array('id','name'));
      $countryList = $this->country->getallBy(array('status'=>1),array('id','country'));
      return view('web.alluserlisting',compact('getuserlist','userlistArray','countryList','indusrtylist'));

    }
    else
    {
      return redirect('auth/login');
    }

  }
    //////// display user all connections//////
  public function allconnections(Request $request)
  {
    $userArray = array();
    $user = Auth::user();
    if(empty($user->id))
    {
         return redirect('auth/login');
    }
    $dataArray=array();
   //////////// get list of all connected users/////
    $useridlist='';
    $getlist = User_followers::where(array('followed_by_id'=>$user->id,'type'=>1))->get();
    if(count($getlist)>0)
    {

      foreach($getlist as $getlistall)
      {
        $useridlist.= $getlistall->action_id.',';
        $dataArray[$getlistall->id] = array('username'=>'',
                                            'userid'=>$getlistall->action_id,
                                            'useremail'=>'',
                                            'userimage'=>URL::asset('web/images/profilePic.png'));
      }
      // dd($dataArray);
      
      $condition = "id in ".'('.substr($useridlist,0,-1).')'."";
      $getuser = $this->usersInterface->getallByRaw($condition,array('id','email','name','profile_image','login_type'));
      foreach($getuser as $getuser)
      {
        $email = explode('@', $getuser->email);
        $imagePatah = URL::asset('web/images/profilePic.png');
        if($getuser->profile_image)
        {
          $imagePatah = $_ENV['CF_LINK'].$getuser->profile_image;
         if($getuser->login_type==1)
         {
            if(strpos($getuser->profile_image, 'https')!==false)
              {
                 $imagePatah = $getuser->profile_image;
              }
            // $imagePatah = $userDetails->profile_image;
         }

        }
    
        $userArray[$getuser->id] = array('email'=>$getuser->email,
                                         'name'=>$getuser->name ?  $getuser->name : $email[0],
                                         'profile_image'=>$imagePatah);
      }
      // dd($userArray);

      array_walk($dataArray, function(&$value, $key, $sourceArray)
      { 
         
          if(array_key_exists($value['userid'], $sourceArray))
          {
               $value['username'] = $sourceArray[$value['userid']]['name'];
               $value['useremail'] = $sourceArray[$value['userid']]['email'];
               $value['userimage'] = $sourceArray[$value['userid']]['profile_image'];
          }

      },$userArray);
    }

   
    return view('web/userfiles/allconnection',compact('dataArray'));

  }
   //////////// function for company profile /////////////
  public function companyprofile(Request $request,$editid=false)
  {
    $user = Auth::user();
    if(empty($user->id))
    {
         return redirect('auth/login');
    }
    $condition = array('user_id'=>$user->id);
    if($user->is_subuser)
    {
      $condition = array('user_id'=>$user->created_by);

    }
    //////// get company details///////////
    $checkcompnay = Company_detail::where($condition)->first();
    if($checkcompnay)
    {
      if($user->become_job_owner!=1)
      {
          // $userupadte['become_job_owner']=1;
          $this->usersInterface->updateuser(array('become_job_owner'=>1),array('id'=>$user->id));
      }
      
      $countryname = $this->country->getBy(array('id'=>$checkcompnay->country),array('id','country'));
      if($countryname)
      {
        $checkcompnay->country=$countryname->country;
        $statename = State::where(array('id'=>$checkcompnay->state))->first();
        if($statename)
        {
          $checkcompnay->state=$statename->state;
        }

        $checkcity  = City::where(array('id'=>$checkcompnay->city))->first();
        if($checkcity)
        {
          $checkcompnay->city=$checkcity->city;

        }
        
      }
      else
      {
        $checkcompnay->country='NA';
        $checkcompnay->city='NA';
        $checkcompnay->state='NA';
      }
      return view('web.userfiles.companyprofile',compact('checkcompnay','user'));
    }
    else
    {
      if(isset($request->createcompnay))
      {
        $validator = $this->validatorcompany($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $dataArray = array('compnay_name'=>$request->companyname,
                           'company_website'=>$request->website,
                           'about_company'=>$request->about,
                           'contact'=>$request->contact,
                           'user_id'=>$user->id,
                           'address'=>$request->address,
                           'pincode'=>$request->pincode,
                           'city'=>$request->city,
                           'state'=>$request->state,
                           'country'=>$request->country,
                           'industry'=>$request->industry,
                           'created_at'=>date('Y-m-d H:i:s'));
        if($request->file('companylogo'))
        {
            $image = $request->file('companylogo');
            // $destinationPath = 'storage/articles'; // upload path
            $destinationPath = 'uplode/profileimages/';
            $extension = $request->file('companylogo')->getClientOriginalExtension(); // getting image extension
            $fileName = 'profile_'.time().'.'.$extension; // renameing image
            $request->file('companylogo')->move($destinationPath, $fileName); // uploading file to given path
            $dataArray['compnay_logo'] = $fileName;
        }

        $inserCompany = Company_detail::insertGetId($dataArray);
        if($inserCompany>0)
        {
          $userupadte['become_job_owner']=1;
          $this->usersInterface->updateuser(array('become_job_owner'=>1),array('id'=>$user->id));
          return redirect('/companyprofile');

        }
        else
        {
          Session::flash('message','Some technical problem.'); 
          Session::flash('alert-class', 'danger'); 
          Session::flash('alert-title', 'error');

        }

      }
      $indusrtylist = Industry::where(array())->get(array('id','name'));
      $countryList = $this->country->getallBy(array('status'=>1),array('id','country'));
      return view('web.createcompany',compact('countryList','indusrtylist'));
    }
  }
    ////////// edit comonay profile//////////////
  public function editcompany(Request $request)
  {
    if(Auth::check())
    {
       $user = Auth::user();
       $checkcompnay = Company_detail::where(array('user_id'=>$user->id))->first();
      if(isset($request->editcompany)) /////////// on form submit
      {
        /////////check validation///////
        $validator = $this->validatorcompany($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $dataArray = array('compnay_name'=>$request->companyname,
                           'company_website'=>$request->website,
                           'about_company'=>$request->about,
                           'contact'=>$request->contact,
                           'user_id'=>$user->id,
                           'address'=>$request->address,
                           'pincode'=>$request->pincode,
                           'city'=>$request->city,
                           'state'=>$request->state,
                           'industry'=>$request->industry,
                           'country'=>$request->country);
        if($request->file('companylogo'))
        {
            $image = $request->file('companylogo');
            // $destinationPath = 'storage/articles'; // upload path
            $destinationPath = 'uplode/profileimages/';
            $extension = $request->file('companylogo')->getClientOriginalExtension(); // getting image extension
            $fileName = 'profile_'.time().'.'.$extension; // renameing image
            $request->file('companylogo')->move($destinationPath, $fileName); // uploading file to given path
            $dataArray['compnay_logo'] = $fileName;
        }

        $updatedetails = Company_detail::where(array('id'=>$checkcompnay->id))->update($dataArray);
        if($updatedetails)
        {
          Session::flash('message','Update successfully'); 
          Session::flash('alert-class', 'danger'); 
          Session::flash('alert-title', 'error');
          //return redirect('/companyprofile');

        }
        else
        {
          Session::flash('message','Some technical problem.'); 
          Session::flash('alert-class', 'danger'); 
          Session::flash('alert-title', 'error');

        }

      }
      $statelist = array();
      $countryList = $this->country->getallBy(array('status'=>1),array('id','country'));
      if($checkcompnay->country)
      {
        $statelist = State::where(array('country_id'=>$checkcompnay->country))->get();

      }
      $indusrtylist = Industry::where(array())->get(array('id','name'));
      return view('web.userfiles.editcompany',compact('countryList','checkcompnay','statelist','indusrtylist'));

    }
    else
    {
      return redirect('error404');
    }
    
  }
  ///////////////////////makenews /////////
  //////////// function for post new news and edit//////
  public function makenews(Request $request)
  {
    
    if(Auth::check())
    {
       ////////// submit news///////
        $user = Auth::user();
        $condition = array('user_id'=>$user->id);
        if($user->is_subuser)
        {
          $condition = array('user_id'=>$user->created_by);

        }
        $checkcompnay = Company_detail::where($condition)->first();
        $request->company_id= $checkcompnay->id;
        if(isset($request->submitnews))
        {
           $validator = $this->savenews($request);
        }
        $newsdetail='';
        $currenttab='';
        $request->userid=$user->id;
        $postnewslist= $this->postnews->getnewslist($request);
        if($request->editid)
        {
          $newsdetail= $this->postnews->getBy(array('id'=>$request->editid));
          $currenttab='edittab';

        }
      return view('web.userfiles.companynews',compact('postnewslist','newsdetail','currenttab'));

    }
    else
    {
      return redirect('error404');
    }

  }
   /////////////delete news function ////////
  public function deletenews(Request $request,$id)
  {
      if(Auth::check())
      {
          $user = Auth::user();
          if($id)
          {
              $check = $this->postjob->getBy(array('id'=>$id));
              if($check)
              {
                  if($user->id==$check->user_id)
                  {
                      $this->articles->deletearticle($id);
                      Session::flash('message','News delete successfully.'); 
                      Session::flash('alert-class', 'success'); 
                      Session::flash('alert-title', 'success');  
                      return redirect('makenews');

                  }
                  else
                  {
                      Session::flash('message','You have no permission to delete the news.'); 
                      Session::flash('alert-class', 'danger'); 
                      Session::flash('alert-title', 'error');  
                      return redirect('makenews');
                  }

              }
              else
              {
                 return redirect('error404');
              }

          }
          else
          {
              Session::flash('message','Please select news.'); 
              Session::flash('alert-class', 'danger'); 
              Session::flash('alert-title', 'error');  
              return redirect('makenews');
          }

      }
      else
      {
          return redirect('auth/login');

      }
  }

    /////////////// userdetail function //////
    public function userdetail(Request $request,$id)
    {
      ////$id is user id of user 
      if($id)
      {
        $userdata = $this->usersInterface->getBy(array('id'=>$id,'status'=>1));
        if($userdata)
        {
          $condition = "user_id = '".$id."' and status=1";
          $articlelist = $this->articles->getallByRaw($condition,array('id','title','description','article_url'),5);
          $discussion = $this->discussion->getallByRaw($condition,array('id','title','description','discussion_url','created_at'),5);
             $employmentdetails='';
        $jobprefrence='';
        $usereducationArry = array();
        if($userdata->looking_for_job==1)
        {
          $employmentdetails = $this->employment->getallBy(array('user_id'=>$id));
          $jobprefrence = Jobprefrences::where(array('user_id'=>$id))->first();
          $usereducation = Eductiondetails::where(array('user_id'=>$id))->get();
          if(count($usereducation)>0)
          {
            foreach($usereducation as $usereducation)
            {
              $course_name='';
              $educate_from='';
              if($usereducation->type==3)
              {
                $course_name='Xii';

              }
              else if($usereducation->type==4)
              {
                $course_name='X';

              }
              if($usereducation->type==1 || $usereducation->type==2)
              {
                $getcousename = Courselist::where(array('id'=>$usereducation->course_name))->first();
                if($getcousename)
                {
                  $course_name=$getcousename->course_name;
                }
                $educate_from = $usereducation->educate_from;

              }
              if($usereducation->type==4 || $usereducation->type==3)
              {
                $borad_name = Schoolboard::where(array('id'=>$usereducation->borad))->first();
                if($borad_name)
                {
                  $educate_from=$borad_name->board_name;
                }
                
              }
              if($educate_from!='')
              {
                $usereducationArry[$usereducation->type] = array('course_name'=>$course_name,
                                                               'educate_from'=>$educate_from,
                                                               'passing_year'=>$usereducation->passing_year,
                                                               'marks'=>$usereducation->marks);

              }
              

            }

          }

        }

          return view('web/userfiles/userdetail',compact('userdata','articlelist','discussion','usereducationArry','employmentdetails','jobprefrence'));

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

  public function createsubuser(Request $request)
  {
    
    if(Auth::check())
    {
      $user = Auth::user();
       ////////// submit makesubuser///////
        if(isset($request->makesubuser))
        {
          $request->userid = $user->id;
           $validator = $this->makesubuser($request);
        }
        
        $subuserdetsil='';
        $currenttab='';
        $request->userid=$user->id;
        $postnewslist= $this->postnews->getnewslist($request);
        if($request->editid)
        {
          $subuserdetsil= $this->postnews->getBy(array('id'=>$request->editid));
          $currenttab='edittab';

        }
        $allsubuser = $this->usersInterface->getallBy(array('is_subuser'=>1,'created_by'=>$user->id));
      return view('includes.partials.subuserform',compact('subuserdetsil','allsubuser','currenttab'));

    }
    else
    {
      return redirect('error404');
    }

  }

  public function compnaydetail(Request $request,$id)
  {
    if($id)
    {
      $checkcompnay = Company_detail::where(array('id'=>$id))->first();
      if($checkcompnay)
      {
        ///////// get country name////
        if($checkcompnay->country)
        {
          $countryname = $this->country->getBy(array('id'=>$checkcompnay->country),array('country'));
          $checkcompnay->country = $countryname->country;
          if($checkcompnay->state)
          {
            $statename = State::where(array('id'=>$checkcompnay->state))->first(array('state'));
            $checkcompnay->state = $statename->state;

          }
        }
        /////// get compnay industry details/////////
        if($checkcompnay->industry)
        {
          $getindustry = Industry::where(array('id'=>$checkcompnay->industry))->first(array('name'));
          $checkcompnay->industry = $getindustry->name;

        }
        $checkapply = array();
        $jobarary = array();
        $loginrequired='yes';
        if(Auth::check())
        {
          $loginrequired='no';
          $user = Auth::user();
          ///////////// check apply for job////
          $conditioncheck = array('job_id'=>$id,'apply_by_id'=>$user->id,'type'=>1);
          $checkapply = Apply_for_job::where($conditioncheck)->lists('job_id')->all();
        }
        ///// all jobs posted by compnay///////
        $data = Jobdetail::where(array('compnay_id'=>$id))->paginate(10);
        if(count($data)>0)
        {
          foreach($data as $joblist)
          {
            $jobarary[$joblist->id] =array('jobtitle'=>$joblist->jobtitle,
                                            'skill'=>$joblist->skill,
                                            'job_quality'=>$joblist->job_quality,
                                            'loginrequired'=>$loginrequired,
                                            'created_at'=>$joblist->created_at,
                                            'job_description'=>$joblist->job_description,
                                            'is_apply'=>'no');
            if(in_array($joblist->id,$checkapply))
            {
              $jobarary[$joblist->id]['is_apply']='yes';

            }
          }
        }
        ////// get all news posted by company///////
        $newslist = $this->postnews->getallpaginate(array('company_id'=>$id,'status'=>1));

        //////////// compnay credibilyty///////////
        $companyCreditArray = array();
        $checkdepartment = Departments::where(array('status'=>1,'company_id'=>$id))->lists('name','id')->all();
        if(count($checkdepartment)>0)
        {
          $departmentId=array_keys($checkdepartment);
          $selectRaw = "department_id,sum(points) as totalpoint";
          $groupBy = array('department_id','company_id');
          $getcredibilty = Employee_credibility::selectRaw($selectRaw)->join('credibility_factors','employee_credibilities.factor_id','=','credibility_factors.points')->whereIn('department_id',$departmentId)->groupBy($groupBy)->get();
          if(count($getcredibilty)>0)
          {
            foreach($getcredibilty as $getcredibilty)
            {
              $departmentname=$getcredibilty->department_id;
              if(array_key_exists($departmentname, $checkdepartment))
              {
                $departmentname=$checkdepartment[$getcredibilty->department_id];

              }
              $companyCreditArray[$departmentname] = $getcredibilty->totalpoint;

            }

          }

        }
        return view('web/compnaydetail',compact('checkcompnay','data','newslist','jobarary','companyCreditArray'));
      }

    }
    else
    {
      return redirect('error404');
    }
  }

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changepassword()
    {
        //
		$user = Auth::user();
		if(empty($user->id))
        {
             return redirect('auth/login');
        }
		$footerfix = 'footerfix';
		return view('web/changepassword',compact('user','footerfix'));
    }

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postpassword(Request $request)
    {
        //
		$user = Auth::user();
		if(empty($user->id))
        {
             return redirect('auth/login');
        }
		    $requestData = $request->all();
		   
			$whereCondiyion = 'id';
			$whereCondiyion1 = $user->id;
			$userData['password'] = bcrypt($requestData['password']);
			$this->usersInterface->update($userData,$whereCondiyion1,$whereCondiyion);
            
			      Session::flash('message', 'Password has been updated.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success'); 
            return redirect('user/changepassword');
		
    }
    ///////////////////////// company credibilty fucntion//////
    ///////////// this is used for create department as well as add employee/////

    public function companycredibility(Request $request)
    {
      $currenttab='';
      $user = Auth::user();
     if(empty($user->id))
      {
             return redirect('auth/login');
      }
      //////// get company details///////////
      $condition = array('user_id'=>$user->id);
    if($user->is_subuser)
    {
      $condition = array('user_id'=>$user->created_by);

    }
    $checkcompnay = Company_detail::where($condition)->first();
    if($checkcompnay)
    {

      /////////// save and upadte the department//////
      $datatoeditdet='';
      $datatoeditemp='';
      if(isset($request->submitdept))
      {
        $validator = $this->validatedept($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $dataArry = array('name'=>$request->departmentname,
                          'created_by'=>$user->id,
                          'company_id'=>$checkcompnay->id,
                          'created_at'=>date('Y-m-d H:i:s'));
        if($request->editid)
        {
          $checkdepartment = Departments::where(array('id'=>$request->editid))->first();
          if($checkdepartment)
          {
            unset($dataArry['created_at']);
            Departments::where(array('id'=>$request->editid))->upadte($dataArry);
            $currenttab='edittab';
            Session::flash('message', 'Upadte Successfully'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success'); 
          }
          else
          {
            return redirect('error404');

          }
        }
        else
        {
          $insert = Departments::insertGetId($dataArry);
          Session::flash('message', 'Create Successfully'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success'); 
        }
      }
      ///////// save and update employedetails//////
      if(isset($request->saveemployee))
      {
       // dd($request->all());
        $validator = $this->validateemployee($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $dataArry = array('employee_name'=>$request->employname,
                          'created_by'=>$user->id,
                          'department'=>$request->empdepartment,
                          'company_id'=>$checkcompnay->id,
                          'created_at'=>date('Y-m-d H:i:s'));
        if($request->editemp)
        {
          $checkdepartment = Employee_details::where(array('id'=>$request->editemp))->first();
          if($checkdepartment)
          {
            unset($dataArry['created_at']);
            Employee_details::where(array('id'=>$request->editemp))->upadte($dataArry);
            if(count($factorapont)>0)
            {
              foreach($factorapont as $factorapont)
              {
                $dataarray = array('factor_id'=>$factorapont,
                                   'department_id'=>$request->empdepartment,
                                   'employee_id'=>$request->editemp,
                                   'company_id'=>$checkcompnay->id,
                                   'created_by'=>$user->id,
                                   'created_at'=>date('Y-m-d H:i:s'));
                $conditionfactor=array('company_id'=>$checkcompnay->id,'employee_id'=>$request->editemp,'factor_id'=>$factorapont);
                $checkfactor = Employee_credibility::where($conditionfactor)->first();
                if($checkfactor)
                {
                  Employee_credibility::where($conditionfactor)->upadte($dataarray);

                }
                else
                {
                  Employee_credibility::insertGetId($dataarray);
                }
              }

            }
            $currenttab='edittab';
            Session::flash('message', 'Upadte Successfully'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success'); 
          }
          else
          {
            return redirect('error404');

          }
        }
        else
        {
          $insert = Employee_details::insertGetId($dataArry);
          $factorapont = $request->factorapont;
          if(count($factorapont)>0)
            {
              foreach($factorapont as $factorapont)
              {
                $dataarray = array('factor_id'=>$factorapont,
                               'department_id'=>$request->empdepartment,
                               'employee_id'=>$insert,
                               'company_id'=>$checkcompnay->id,
                               'created_by'=>$user->id,
                               'created_at'=>date('Y-m-d H:i:s'));
                $conditionfactor=array('company_id'=>$checkcompnay->id,'employee_id'=>$insert,'factor_id'=>$factorapont);
                $checkfactor = Employee_credibility::where($conditionfactor)->first();
                if($checkfactor)
                {
                  Employee_credibility::where($conditionfactor)->upadte($dataarray);

                }
                else
                {
                  Employee_credibility::insertGetId($dataarray);
                }
              }

            }
          Session::flash('message', 'Create Successfully'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success'); 
        }

      }
      ////////// get department list//////
      $getalldepartmetlist = Departments::where(array('company_id'=>$checkcompnay->id))->get();
      $getdepartmetlist = Departments::where(array('status'=>1,'company_id'=>$checkcompnay->id))->get();
      ////////////// get credibilty factors list//////
      $factorslist = array();
      $credibiltycatArray=array();
      $getcredibilitycat = Credibility_category::where(array('status'=>1))->get();////////// all credibilty list////
      if(count($getcredibilitycat)>0)
      {
        $getfactors = Credibility_factors::where(array('status'=>1))->get();
        if(count($getfactors)>0)
        {
          foreach($getfactors as $getfactors)
          {
            $factorslist[$getfactors->category_id][$getfactors->id] = array('name'=>$getfactors->name,
                                                                            'points'=>$getfactors->points);

          }
          foreach($getcredibilitycat as $getcredibilitycat)
          {
            
            if(array_key_exists($getcredibilitycat->id, $factorslist))
            {
              $credibiltycatArray[$getcredibilitycat->id]=array('name'=>$getcredibilitycat->name,
                                                                'factorsvalues'=>$factorslist[$getcredibilitycat->id]);

            }

          }
        }
      }

      return view('web.userfiles.companycredibility',compact('user','currenttab','getdepartmetlist','datatoeditdet','datatoeditemp','credibiltycatArray','getalldepartmetlist'));
    }
    else
    {
      return redirect('error404');

    }
  }

  
}
