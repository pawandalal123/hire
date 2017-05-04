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
use Appfiles\Repo\CategoryInterface;
use Appfiles\Repo\SubcategoryInterface;
use Appfiles\Repo\DiscussionsInterface;
use Appfiles\Repo\CountryInterface;
use Appfiles\Repo\StateInterface;
use Appfiles\Repo\CityInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Model\Common;
use Appfiles\Repo\PostnewsInterface;
use App\Model\Company_detail;
use App\Model\Jobdetail;
use App\Model\User_followers;
use App\Model\State;
use App\Model\Industry;
use App\Model\Functionalarea;
use App\Model\View;
use App\Model\Comments;
use App\Model\Apply_for_job;
Use DB;
use Validator;
use Auth;
use URL;
// use View;
class SearchController extends Controller
{
  use ValidationTrait;
	protected $APIURL;
    protected $functions;
    protected $s3;

	public function  __construct(Functions $functions, UsersInterface $usersInterface,ArticlesInterface $articles,CategoryInterface $category,SubcategoryInterface $subcat,DiscussionsInterface $discussion,CountryInterface  $country,UserdetailInterface $userdetail,PostnewsInterface $postnews,StateInterface $state,CityInterface $city)
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
        $this->postnews = $postnews;
        $this->state = $state;
        $this->city=$city;
        // $this->Discussion_invite = new Discussion_invite();

}
   

  public function makesearch(Request $request,$pagename)
  {
    // $user = Auth::user();
    // if(empty($user->id))
    // {
    //      return redirect('auth/login');
    // }
    // else
    // {
        $countrylist = $this->country->getListraw(array(),'country','id');
        $statelist=  $this->state->getListraw(array(),'state','id');
        $citylist=  $this->city->getListraw(array(),'city','id');
        $industrylist = Industry::where(array('status'=>1))->lists('name','id')->all();
        $data=array();
        $datalistArray = array();
        $commentArray=array();

         ////////// search for article///////
        $catlist='';
        $subcatlist='';
        $functionarea='';
        if($pagename=='article')
        {
          // dd($request->all());
          $catlist = $this->category->getallBy(array('type'=>1,'status'=>1),array('name','id'));
          $subcatlist = $this->subcat->getallBy(array('type'=>1,'status'=>1),array('name'));
          $data = $this->articles->articleslist($request);
            ///////// make final array////////
            $viewcount=array();
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
            $articleArrary = array();
            $commentedid=array();
            if(count($data)>0)
            {
              foreach($data as $articles)
              {
                $viewc=0;
                $totalcount=0;
                $commentedid[]=$articles->id;
                if(array_key_exists($articles->id, $viewcount))
                {
                  $viewc = $viewcount[$articles->id];

                }
                $datalistArray[$articles->id] = array('title'=>$articles->title,
                                                      'created_at'=>$articles->created_at,
                                                      'description'=>$articles->description,
                                                      'articles_image'=>$articles->articles_image,
                                                      'article_url'=>$articles->article_url,
                                                      'loginrequired'=>'yes',
                                                      'view_count'=>$viewc,
                                                      'totalcount'=>$totalcount);
                if(Auth::check())
                {
                  $datalistArray[$articles->id]['loginrequired']='no';

                }

              }

              $commentedidList = implode(',', $commentedid);
              $seleectRaw="count(id) as totalcomment,commented_id";
              $getcomments = Comments::selectRaw($seleectRaw)->where(array('status'=>1,'type'=>1))->whereIn('commented_id',$commentedid)->groupBY('commented_id')->get();
              foreach($getcomments as $getcomments)
              {
                $commentArray[$getcomments->commented_id]= $getcomments->totalcomment;

              }
              array_walk($datalistArray, function(&$value, $key, $sourceArray)
            { 
                 
                if(array_key_exists($key, $sourceArray))
                {
                    $value['totalcount'] = $sourceArray[$key];
                }

            },$commentArray); 

            }

        }
        ////////// search for discussion///////
        if($pagename=='discussion')
        {
           
            $data = $this->discussion->discussionlist($request);
            ///////// make final array////////
            $viewcount=array();
            $selectRaw = "count(id) as totalview,view_id";
            $getviewcount = View::selectRaw($selectRaw)->where(array('type'=>'discussion'))->groupBY('view_id')->get();
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
            if(count($data)>0)
            {
              foreach($data as $articles)
              {
                $commentedid[]=$articles->id;
                $viewc=0;
                $totalcount=0;
                if(array_key_exists($articles->id, $viewcount))
                {
                  $viewc = $viewcount[$articles->id];

                }
                $datalistArray[$articles->id] = array('title'=>$articles->title,
                                                      'created_at'=>$articles->created_at,
                                                      'description'=>$articles->description,
                                                      'articles_image'=>'',
                                                      'loginrequired'=>'yes',
                                                      'article_url'=>$articles->discussion_url,
                                                      'view_count'=>$viewc,
                                                      'totalcount'=>$totalcount);
                if(Auth::check())
                {
                  $datalistArray[$articles->id]['loginrequired']='no';

                }

              }

              $commentedidList = implode(',', $commentedid);
              $seleectRaw="count(id) as totalcomment,commented_id";
              $getcomments = Comments::selectRaw($seleectRaw)->where(array('status'=>1,'type'=>2))->whereIn('commented_id',$commentedid)->groupBY('commented_id')->get();
              foreach($getcomments as $getcomments)
              {
                $commentArray[$getcomments->commented_id]= $getcomments->totalcomment;

              }
              array_walk($datalistArray, function(&$value, $key, $sourceArray)
            { 
                 
                if(array_key_exists($key, $sourceArray))
                {
                    $value['totalcount'] = $sourceArray[$key];
                }

            },$commentArray); 

            }
        }
        ////////// search for nes///////
        if($pagename=='news')
        {
            
            $data = $this->postnews->getnewslist($request);
             ///////// make final array////////
            $viewcount=array();
            $selectRaw = "count(id) as totalview,view_id";
            $getviewcount = View::selectRaw($selectRaw)->where(array('type'=>'news'))->groupBY('view_id')->get();
            if(count($getviewcount)>0)
            {
              foreach($getviewcount as $getviewcount)
              {
                $viewcount[$getviewcount->view_id] = $getviewcount->totalview;

              }

            }


            /////process article list///
            $articleArrary = array();
            $commentedid=array();
            if(count($data)>0)
            {
              foreach($data as $articles)
              {
                $viewc=0;
                $totalcount=0;
                $commentedid[]=$articles->id;
                if(array_key_exists($articles->id, $viewcount))
                {
                  $viewc = $viewcount[$articles->id];

                }
                $datalistArray[$articles->id] = array('title'=>$articles->title,
                                                      'created_at'=>$articles->created_at,
                                                      'description'=>$articles->description,
                                                      'articles_image'=>$articles->news_image,
                                                      'article_url'=>$articles->news_url,
                                                      'loginrequired'=>'yes',
                                                      'view_count'=>$viewc,
                                                      'totalcount'=>$totalcount);
                if(Auth::check())
                {
                  $datalistArray[$articles->id]['loginrequired']='no';

                }

              }
                $commentedidList = implode(',', $commentedid);
              $seleectRaw="count(id) as totalcomment,commented_id";
              $getcomments = Comments::selectRaw($seleectRaw)->where(array('status'=>1,'type'=>3))->whereIn('commented_id',$commentedid)->groupBY('commented_id')->get();
              foreach($getcomments as $getcomments)
              {
                $commentArray[$getcomments->commented_id]= $getcomments->totalcomment;

              }
              array_walk($datalistArray, function(&$value, $key, $sourceArray)
            { 
                 
                if(array_key_exists($key, $sourceArray))
                {
                    $value['totalcount'] = $sourceArray[$key];
                }

            },$commentArray);
            }
        

        }
        if($pagename=='people')
        {
            
            $data = $this->usersInterface->getpeoplelist($request);
            $useridList='';
            if(count($data)>0)
            {
                foreach($data as $userdata)
                {
                    $useridList.=$userdata->id.',';
                    $country='India';
                    $state='';
                    $cityname='';
                    if(array_key_exists($userdata->country, $countrylist))
                    {
                      $country=$countrylist[$userdata->country];
                    }
                    if(array_key_exists($userdata->state, $statelist))
                    {
                      $state=$statelist[$userdata->state];
                    }
                    if(array_key_exists($userdata->city, $citylist))
                    {
                      $cityname=$citylist[$userdata->city];
                    }
                    $email = explode('@', $userdata['email']);
                    $datalistArray[$userdata->id] = array('id'=>$userdata->id,
                                                          'name'=>$userdata->name ?  $userdata->name : $email[0],
                                                          'profile_image'=>$userdata->profile_image,
                                                          'city'=>$cityname,
                                                          'state'=>$state,
                                                          'country'=>$country,
                                                          'loginrequired'=>'yes',
                                                          'is_connect'=>'no');
                }
                if(Auth::check())
                {
                    $user = Auth::user();
                      // $condition = "id in ".'('.substr($useridlist,0,-1).')'."";
                    $getconnectid = User_followers::where(array('followed_by_id'=>$user->id,'type'=>1))->lists('action_id')->all();
                    // dd($getconnectid);
                    /////////// make final array/
                    array_walk($datalistArray, function(&$value, $key, $sourceArray)
                    { 
                       $value['loginrequired'] = 'no';
                       
                         
                        if(in_array($value['id'], $sourceArray))
                        {
                           
                            $value['is_connect'] = 'yes';
                        }

                    },$getconnectid); 
                }
               
            }
        }
        if($pagename=='company')
        {
          // dd($industrylist);
          $condition='status=1';
          if($request->keywords)
          {
            $condition.=" and ( compnay_name like '%".str_replace('-',' ',$request->keywords)."%' or address like '%".str_replace('-',' ',$request->keywords)."%')";

          }
            
            $data = Company_detail::whereRaw($condition)->paginate(5);
            if(count($data)>0)
            {
                foreach($data as $compnaydata)
                {
                    $state='';
                    $cityname='';
                    $industry='';
                 
                    if(array_key_exists($compnaydata->state, $statelist))
                    {
                      $state=$statelist[$compnaydata->state];
                    }
                    if(array_key_exists($compnaydata->city, $citylist))
                    {
                      $cityname=$citylist[$compnaydata->city];
                    }
                    if(array_key_exists($compnaydata->industry, $industrylist))
                    {
                      $industry=$industrylist[$compnaydata->city];

                    }
                   
                    $datalistArray[$compnaydata->id] = array('id'=>$compnaydata->id,
                                                             'compnay_name'=>$compnaydata->compnay_name,
                                                             'cityname'=>$cityname,
                                                             'state'=>$state,
                                                             'industry'=>$industry,
                                                             'compnay_logo'=>$compnaydata->compnay_logo,
                                                             'loginrequired'=>'yes',
                                                             'is_connect'=>'no');
                }
              
                if(Auth::check())
                {
                    $user = Auth::user();
                    $getconnectid = User_followers::where(array('followed_by_id'=>$user->id,'type'=>2))->lists('action_id')->all();
                    // dd($getconnectid);

                    /////////// make final array/
                    array_walk($datalistArray, function(&$value, $key, $sourceArray)
                    { 
                      $value['loginrequired'] = 'no';
                       
                         
                        if(in_array($value['id'], $sourceArray))
                        {
                             
                             $value['is_connect'] = 'yes';
                        }

                    },$getconnectid);

              }
            }

        }
        if($pagename=='jobs')
        {
            $condition="valid_till>='".date('Y-m-d')."'";
            if($request->keywords)
            {
              $condition.=" and (compnay_hiring like '%".str_replace('-',' ',$request->keywords)."%' or company_client like '%".str_replace('-',' ',$request->keywords)."%' or jobtitle like '%".str_replace('-',' ',$request->keywords)."%' or skill like '%".str_replace('-',' ',$request->keywords)."%' or job_quality like '%".str_replace('-',' ',$request->keywords)."%')";
            }
            if($request->industry && $request->industry!='')
            {
              $indusArray = explode('-', $request->industry);
              $indutryid = implode(',', $indusArray);
              // dd($indutryid);
              $condition.=" and industry in ('".rtrim($indutryid,',')."')";

            }
            $data = Jobdetail::whereRaw($condition)->paginate(5);
            if(count($data)>0)
            {
              foreach($data as $jobdata)
              {

                $country='India';
                if(array_key_exists($jobdata->country, $countrylist))
                {
                  $country=$countrylist[$jobdata->country];

                }
                $experience=$jobdata->experience_year.' yrs';
                if($jobdata->experience_month)
                {
                  $experience=$jobdata->experience_year.'-'.$jobdata->experience_month.' yrs';

                }
                $salary=$jobdata->salary_min;
                if($jobdata->salary_max)
                {
                  $salary=$jobdata->salary_min.' - '.$jobdata->salary_max;

                }
                $datalistArray[$jobdata->id] = array('jobtitle'=>$jobdata->jobtitle,
                                           'skill'=>$jobdata->skill,
                                           'job_quality'=>$jobdata->job_quality,
                                           'experience'=>$experience,
                                           'salary'=>$salary,
                                           'job_description'=>$jobdata->job_description,
                                           'country'=>$country,
                                           'created_at'=>$jobdata->created_at,
                                           'loginrequired'=>'yes',
                                           'is_apply'=>'no');
                  if(Auth::check())
                  {
                      $user = Auth::user();
                      $getconnectid = Apply_for_job::where(array('apply_by_id'=>$user->id))->lists('job_id')->all();
                      // dd($getconnectid);

                      /////////// make final array/
                      array_walk($datalistArray, function(&$value, $key, $sourceArray)
                      { 
                         $value['loginrequired'] = 'no';
                           
                          if(in_array($key, $sourceArray))
                          {
                               
                               $value['is_apply'] = 'yes';
                          }

                      },$getconnectid);

                }
              }

            }
            $functionarea = Functionalarea::where(array())->get();


        }
        // dd($datalistArray);
       
        return view('web/makesearch',compact('pagename','keywords','data','datalistArray','countrylist','industrylist','catlist','subcatlist','functionarea'));
    
  }

  

  
}
