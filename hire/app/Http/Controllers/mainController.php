<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Model\Contactus;
use App\Model\Common;
use App\Model\Jobdetail;
use App\Model\Company_detail;
use Appfiles\Common\Functions;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Appfiles\Repo\UsersInterface;
use Appfiles\Repo\ArticlesInterface;

use Appfiles\Repo\CountryInterface;
use Appfiles\Repo\StateInterface;
use Appfiles\Repo\CityInterface;
use App\Model\View;
use App\Model\Comments;
use App\Model\Broadcast;
use Route;
//use SEO;
use Auth;
use URL;
// use View;
// use Input;
//use SEOMeta;

class mainController extends Controller 
{
    protected $eventCityList;
    protected $categoryList;
    protected $functions;

    public function  __construct(UsersInterface $usersInterface,Functions $functions,ArticlesInterface $articles,CountryInterface  $country,StateInterface $state,CityInterface $city)
    {
      $this->functions=$functions;
      $this->usersInterface = $usersInterface;
      $this->articles = $articles;
      $this->country = $country;
      $this->state = $state;
      $this->city = $city;
       // $commonObj = new common();
    }

    // home page display function//
    public function index(Request $request , $page = false, $pagenumber = false)
    {
        if(Auth::check())
        {
            ///////// get article list//////
            $articlelist = $this->articles->getallpaginate(array('status'=>1));
            $jobarray = array();
            $countrylist = $this->country->getListraw(array(),'country','id');
            $statelist = $this->state->getListraw(array(),'state','id');
            $citylist = $this->city->getListraw(array(),'city','id');
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
              $state='';
              $city='';
              if(array_key_exists($alljobs->country, $countrylist))
              {
                $country=$countrylist[$alljobs->country];

              }
              if(array_key_exists($alljobs->state, $statelist))
              {
                $state=$statelist[$alljobs->state];

              }
              if(array_key_exists($alljobs->city, $citylist))
              {
                $city=$citylist[$alljobs->city];

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
                                              'state'=>$state,
                                              'city'=>$city,
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


            ///////// make final array////////
            $viewcount=array();
            $commentArray=array();
            $selectRaw = "count(id) as totalview,view_id";
            $getviewcount = View::selectRaw($selectRaw)->where(array('type'=>'article'))->groupBY('view_id')->get();
            if(count($getviewcount)>0)
            {
              foreach($getviewcount as $getviewcount)
              {
                $viewcount[$getviewcount->view_id] = $getviewcount->totalview;

              }

            }
        
            /////process article list///
            $commentedid=array();
            $articleArrary = array();
            if(count($articlelist)>0)
            {
              foreach($articlelist as $articles)
              {
                $commentedid[]=$articles->id;
                $viewc=0;
                $totalcount=0;
                if(array_key_exists($articles->id, $viewcount))
                {
                  $viewc = $viewcount[$articles->id];

                }
                $articleArrary[$articles->id] = array('title'=>$articles->title,
                                                      'created_at'=>$articles->created_at,
                                                      'description'=>$articles->description,
                                                      'articles_image'=>$articles->articles_image,
                                                      'article_url'=>$articles->article_url,
                                                      'view_count'=>$viewc,
                                                      'totalcount'=>$totalcount);

              }
              $commentedidList = implode(',', $commentedid);
              $seleectRaw="count(id) as totalcomment,commented_id";
              $getcomments = Comments::selectRaw($seleectRaw)->where(array('status'=>1,'type'=>1))->whereIn('commented_id',$commentedid)->groupBY('commented_id')->get();
              foreach($getcomments as $getcomments)
              {
                $commentArray[$getcomments->commented_id]= $getcomments->totalcomment;

              }
              array_walk($articleArrary, function(&$value, $key, $sourceArray)
            { 
                 
                if(array_key_exists($key, $sourceArray))
                {
                    $value['totalcount'] = $sourceArray[$key];
                }

            },$commentArray); 

            }
            // dd($articleArrary);

            ////////// get broadcast message//////
            $user = Auth::user();
            $conditionbroad = 'status=1 and display_till>="'.date('Y-m-d').'" and user_id='.$user->id.'';
            $bmessage= Broadcast::whereRaw($conditionbroad)->orderBy('id','desc')->first();
            if(empty($bmessage))
            {
               $conditionbroad = 'status=1 and display_till>="'.date('Y-m-d').'"';
               $bmessage= Broadcast::whereRaw($conditionbroad)->orderBy('id','desc')->first();

            }
            
            return view('web/index',compact('articlelist','getalljobs','jobarray','articleArrary','bmessage','user'));

        }
        else
        {
            return view('auth.login');
        }
       
    }


      /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function careers()
    {
        SEO::setTitle('Career Page');
        SEO::setDescription('');
  
        //
        return view('web/staticpage/careers');
    }

    public function contactus(Request $request)
    {
       
        if($request->submitcontact)
        {
            $common = new Common();
            $contactArray['name']=$request->input('name');
            $contactArray['email']=$request->input('email');
            $contactArray['mobile']=$request->input('mobile');
            $contactArray['message']=$request->input('message');
            $response=Contactus::create($contactArray);

           
            // $mail= $common->sendmail($mailmessage,$mailArray);
            
            if($response)
            {
                Session::flash('message', 'Thank you for contacting us, we will get back to you soon.'); 
                Session::flash('alert-class', 'success'); 
                // Session::flash('alert-title', 'Message');  
            }
        }

        return view('web/staticpage/contactus');
    }




  

}
