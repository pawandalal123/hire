<?php
namespace App\Http\Controllers\Admin; 
use Auth;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Appfiles\Repo\UsersInterface;
use Appfiles\Repo\DiscussionsInterface;
// use Appfiles\Repo\AdminfeatureInterface;
// use Appfiles\Repo\FeaturesInterface;
use App\Model\Common;
use Appfiles\Repo\CategoryInterface;
use Appfiles\Repo\SubcategoryInterface;
use Appfiles\Repo\CountryInterface;
use Appfiles\Repo\StateInterface;
use Appfiles\Repo\CityInterface;
use Appfiles\Repo\ArticlesInterface;
Use App\Model\Discussion_invite;
use Appfiles\Repo\DocumentsInterface;
use Appfiles\Repo\DocumentstypeInterface;
use Appfiles\Repo\PostnewsInterface;
use App\Model\Courselist;
use App\Model\Comments;
use App\Model\Company_detail;
use App\Model\Jobdetail;
use App\Model\Industry;
use App\Model\Broadcast;
use App\Model\Apply_for_job;

use Redirect;
use Validator;
use DB;
use App\Model\Schoolboard;
use App\Model\Schoolmedium;
use App\Model\Subcourselist;

use Illuminate\Container\Container;
use Appfiles\Common\Functions;
use URL;
use Illuminate\Support\Collection;

// use Url;
class AdminController extends Controller {

   protected $functions;
   protected $s3;
   public function  __construct(Functions $function,UsersInterface $usersInterface,CountryInterface $country,StateInterface $state,CityInterface $city,CategoryInterface $category,SubcategoryInterface $subcat,ArticlesInterface $articles,DiscussionsInterface $discussion,DocumentsInterface $documents,DocumentstypeInterface $documenttype,PostnewsInterface $postnews)
    {
        //$this->user_id= 1;        
    $this->usersInterface = $usersInterface;
    // $this->adminfeature =$adminfeature;
    // $this->featuresassign=$featuresassign;
    $this->postnews = $postnews;
    $this->function=$function;
    $this->country=$country;
    $this->state=$state;
    $this->city=$city;
    $this->category=$category;
    $this->subcat=$subcat;
    $this->articles = $articles;
    $this->discussion=$discussion;
    $this->documents = $documents;
    $this->documenttype = $documenttype;
   
    }

    public function checkpermission($featuredid=false)
    {
      ///first check login///
      $user = Auth::user();
      $status=array();
      if(empty($user->id))
      {
        //return redirect('auth/login');
        $status['status']='login';
      }
      else
      {
        //check fetaure assign or not///   
        $status['loginid']=$user->id;
        if($user->user_type==1)
        {
            $status['status']='success';
           
        }
        else
        {
          $status['status']='notfound';

        }
      }
       return $status;
    }
  
  public function index()
  {
    if(Auth::check())
    {
      $user = Auth::user();
      if($user->user_type!= 0)
      {
          return redirect('/admin/dashboard');
      }
      else
      {
        return redirect('/');
      }
    }
    return \View::make('admin.index');
  }

  

  public function postIndex()
  {
    $username = Input::get('username');
    $password = Input::get('password');
    if (Auth::attempt(['email' => $username, 'password' => $password,'user_type'=>1,'status'=>1]))
    {
      return redirect('/admin/dashboard');
      
    }

    return Redirect::back()->withInput()
                           ->withErrors('That username/password combo does not exist.');
  }
    
  public function dashboard(Request $request)
  {   
    $user = Auth::user();

    if(empty($user->id))
    {
        return redirect('admin/login');
    }
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
    $postData = $request->all();
   
    
    return \View::make('admin.admindashboard');
   }
  }

  public function locationtype(Request $request,$type=false,$id=false)
  {
    $dataCuntry = array();
    $dataCity  =array();
    $dataState = array();
    $datatoedit='';
      $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      if(isset($request->submitcountry))
      {
          $data = array('country'=>$request->country,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>$checkstatus['loginid']);
            $validator = Validator::make($request->all(), $this->country->rulesForCreatecountry(),$this->country->rulesForCreatcountryMessage());

            if ($validator->fails())
            {
                return redirect('/admin/location')
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
              $this->country->create($data);
              Session::flash('message','Save Successfully.'); 
              Session::flash('alert-class', 'success'); 
              Session::flash('alert-title', 'Success');
            }

      }
      if(isset($request->submitstate))
      {
        $data = array('state'=>$request->state,
                        'country_id'=>$request->country,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>$checkstatus['loginid']);
            $validator = Validator::make($request->all(), $this->state->rulesForCreatestate(),$this->state->rulesForCreatstateMessage());

            if ($validator->fails())
            {
                return redirect('/admin/location/state')
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
              $this->state->create($data);
              Session::flash('message','Save Successfully.'); 
              Session::flash('alert-class', 'success'); 
              Session::flash('alert-title', 'Success');
            }

      }
      if(isset($request->citysubmit))
      {
        $data = array('city'=>$request->city,
          'state'=>$request->state,
                        'country_id'=>$request->country,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>$checkstatus['loginid']);
            $validator = Validator::make($request->all(), $this->city->rulesForCreatecity(),$this->city->rulesForCreatecityWMessage());

            if ($validator->fails())
            {
                return redirect('/admin/location/city')
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
              $this->city->create($data);
              Session::flash('message','Save Successfully.'); 
              Session::flash('alert-class', 'success'); 
              Session::flash('alert-title', 'Success');
            }

      }
      if(isset($request->updatecountry))
      {
          $data = array('country'=>$request->country);
          $this->country->update($data,array('id'=>$type));
          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');

      }
      if(isset($request->updatestate))
      {
          $data = array('country_id'=>$request->country,
                        'state'=>$request->state);
          $this->state->update($data,array('id'=>$id));
          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');

      }
      if($type=='state')
      {
        $dataCuntry = $this->country->getallBy(array('status'=>1),array('id','country'));
        $dataState = $this->state->getalldetails(array(),array('states.id','state','country','states.status','states.created_at'));
        if($id)
        {
          $datatoedit = $this->state->getBy(array('id'=>$id));
          if(empty($datatoedit))
          {
            return redirect('error404/');
          }
        }

      }
      elseif($type=='city')
      {
        $countryArray = array();
        $stateArray = array();
        $dataCuntry = $this->country->getallBy(array('status'=>1),array('id','country'));
        foreach($dataCuntry as $dataCuntrylist)
        {
          $countryArray[$dataCuntrylist->id] = $dataCuntrylist->country;

        }
        //////state array///
         $dataState = $this->state->getallBy(array('status'=>1),array('id','state'));
        foreach($dataState as $dataStatelist)
        {
          $stateArray[$dataStatelist->id] = $dataStatelist->state;
        }
       
          $dataCity = $this->city->getallBydetails(array());
           array_walk($dataCity, function(&$value, $key, $sourceArray)
            { 
                $value->country='';
                 
                if(array_key_exists($value->country_id, $sourceArray))
                {
                     $value->country = $sourceArray[$value->country_id];
                }

            },$countryArray); 

           array_walk($dataCity, function(&$value, $key, $sourceArray)
            { 
                
                if(array_key_exists($value->state, $sourceArray))
                {
                     $value->state = $sourceArray[$value->state];
                }
                else
                {
                  $value->state='';
                }

            },$stateArray); 

         
        if($id)
        {
          $datatoedit = $this->city->getBy(array('id'=>$id));
          if(empty($datatoedit))
          {
            return redirect('error404/');
          }
        }

      }
      else
      {
        $dataCuntry = $this->country->getallBy(array());
        if($type)
        {
          $datatoedit = $this->country->getBy(array('id'=>$type));
          if(empty($datatoedit))
          {
            return redirect('error404/');
          }
        }
      }
      return \View::make('admin.locationmaster',compact('dataCuntry','dataCity','dataState','type','datatoedit'));
   }
  }
  public function changelocationstatus(Request $request,$type=false,$id=false)
  {
      if($type=='state')
      {
        $checkstate = $this->state->getBy(array('id'=>$id));
        if($checkstate)
        {
          $status=0;
          if($checkstate->status==0)
          {
             $status=1;
          }
          $data = array('status'=>$status);
          $this->state->update($data,array('id'=>$id));

          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
          return redirect('/admin/location/state');

        }
        else
        {
          return redirect('error404/');

        }
      }
      elseif($type=='city')
      {
        $checkcity= $this->city->getBy(array('id'=>$id));
        if($checkcity)
        {
          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
          return redirect('/admin/location/city');

        }
        else
        {
          return redirect('error404/');

        }

      }
      else
      {
        $checkcountry= $this->country->getBy(array('id'=>$type));
        if($checkcountry)
        {
          $status=0;
          if($checkcountry->status==0)
          {
             $status=1;

          }
          $data = array('status'=>$status);
          $this->country->update($data,array('id'=>$type));
          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
          return redirect('/admin/location');
        }
        else
        {
          return redirect('error404/');

        }
      }
  }

  ////////////////////// articles management///////////////
  public function articlesmaster(Request $request,$type=false,$id=false)
  {
    $dataCat = array();
    $datasubcat = array();
    $datatoedit='';
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      if(isset($request->submitcat))
      {
          $data = array('name'=>$request->name,
            'type'=>1,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>$checkstatus['loginid']);
            $validator = Validator::make($request->all(), $this->category->rulesForCreate(),$this->category->rulesForCreatMessage());

            if ($validator->fails())
            {
                return redirect('/admin/articles')
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
              $this->category->create($data);
              Session::flash('message','Save Successfully.'); 
              Session::flash('alert-class', 'success'); 
              Session::flash('alert-title', 'Success');
            }

      }
      if(isset($request->submitsubcat))
      {
        $data = array('name'=>$request->name,
                        'category_id'=>$request->category,
                        'status'=>1,
                        'type'=>1,
                        'created_at'=>date('Y-m-d H:i:s'),
                        'created_by'=>$checkstatus['loginid']);
            $validator = Validator::make($request->all(), $this->subcat->rulesForCreate(),$this->subcat->rulesForCreateMessage());

            if ($validator->fails())
            {
                return redirect('/admin/articles/subcategory')
                            ->withErrors($validator)
                            ->withInput();
            }
            else
            {
              $this->subcat->create($data);
              Session::flash('message','Save Successfully.'); 
              Session::flash('alert-class', 'success'); 
              Session::flash('alert-title', 'Success');
            }

      }
      
      if(isset($request->updatecatgeroy))
      {
          $data = array('name'=>$request->name);
          $this->category->update($data,array('id'=>$type));
          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');

      }
      if(isset($request->updatesubcatgeroy))
      {
          $data = array('country_id'=>$request->country,
                        'state'=>$request->state);
          $this->state->update($data,array('id'=>$id));
          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');

      }
      if($type=='subcategory')
      {
        $dataCat = $this->category->getallBy(array('status'=>1,'type'=>1),array('id','name'));
        $datasubcat = $this->subcat->getallBy(array());
        if($id)
        {
          $datatoedit = $this->subcat->getBy(array('id'=>$id));
          if(empty($datatoedit))
          {
            return redirect('error404/');
          }
        }

      }
      else
      {
        $dataCat = $this->category->getallBy(array('type'=>1));
        if($type)
        {
          $datatoedit = $this->category->getBy(array('id'=>$type));
          if(empty($datatoedit))
          {
            return redirect('error404/');
          }
        }
      }
      return \View::make('admin.categorymaster',compact('dataCat','datasubcat','type','datatoedit'));
   }
  }

  public function changecategorystatus(Request $request,$type=false,$id=false)
  {
      if($type=='subcategory')
      {
        $checksubcat= $this->subcat->getBy(array('id'=>$id));
        if($checksubcat)
        {
          $status=0;
          if($checksubcat->status==0)
          {
             $status=1;
          }
          $data = array('status'=>$status);
          $this->subcat->update($data,array('id'=>$id));

          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
          return redirect('/admin/articles/subcategory');

        }
        else
        {
          return redirect('error404/');

        }
      }
      else
      {
        $checkcategory= $this->category->getBy(array('id'=>$type));
        if($checkcategory)
        {
          $status=0;
          if($checkcategory->status==0)
          {
             $status=1;

          }
          $data = array('status'=>$status);
          $this->category->update($data,array('id'=>$type));
          Session::flash('message','Update Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
          return redirect('/admin/articles');
        }
        else
        {
          return redirect('error404/');

        }
      }
  }

  public function articlelist(Request $request)
  {
    $articlesList = array();
    $userArray = array();
    $userids='';
    $getarticles = $this->articles->getallpaginate(array());
    if(count($getarticles)>0)
    {
      foreach($getarticles as $getarticleslist)
      {
        $userids.=$getarticleslist->user_id.',';
        $articlesList[$getarticleslist->id]= array('title'=>substr($getarticleslist->title,0,25),
                                               'description'=>substr($getarticleslist->description,0,25),
                                               'created_by'=>'',
                                               'created_at'=>$getarticleslist->created_at,
                                               'subcategory'=>$getarticleslist->subcategory,
                                               'category'=>$getarticleslist->category,
                                               'status'=>$getarticleslist->status);

      }
      $condition = "id in ".'('.substr($userids,0,-1).')'."";
      $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
      foreach($getuser as $getuser)
      {
        $userArray[$getuser->id] = $getuser->email;
      }
       array_walk($articlesList, function(&$value, $key, $sourceArray)
            { 
               
                 
                if(array_key_exists($key, $sourceArray))
                {
                     $value['created_by'] = $sourceArray[$key];
                }

            },$userArray); 


    }
 
    return  \View::make('admin.articlelisting',compact('articlesList','getarticles'));

  }
    ////////// enable and disable articles//////////
  public function articlestatus(Request $request,$id)
  {
    $checksarticle= $this->articles->getBy(array('id'=>$id));
    if($checksarticle)
    {
      $status=0;
      if($checksarticle->status==0)
      {
         $status=1;
      }
      $data = array('status'=>$status);
      $this->articles->update($data,array('id'=>$id));

      Session::flash('message','Update Successfully.'); 
      Session::flash('alert-class', 'success'); 
      Session::flash('alert-title', 'Success');
      return redirect('/articlelist');

    }
    else
    {
      return redirect('error404/');

    }

  }
  public function deletearticle(Request $request)
  {
    $checksarticle= $this->articles->getBy(array('id'=>$id));
    if($checksarticle)
    {
      
      $this->articles->delete($id);
      Session::flash('message','Delete Successfully.'); 
      Session::flash('alert-class', 'success'); 
      Session::flash('alert-title', 'Success');
      return redirect('/articlelist');

    }
    else
    {
      return redirect('error404/');

    }

  }
 /////////comments on articles////////////////
  public function article_comment(Request $request)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $commentsArray = array();
      $userArray = array();
      $userids='';
      $discussionid='';
      $discussionArray = array();
      $commentlist = Comments::where(array('type'=>1))->paginate(15);
      if(count($commentlist)>0)
      {
        foreach($commentlist as $commentval)
        {
          $userids.=$commentval->comment_by.',';
          $discussionid.=$commentval->commented_id.',';
          $commentsArray[$commentval->id]= array('comment'=>$commentval->comment,
                                                 'commented_id'=>$commentval->commented_id,
                                                 'created_by'=>$commentval->comment_by,
                                                 'created_at'=>$commentval->created_at,
                                                 'status'=>$commentval->status);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }
         array_walk($commentsArray, function(&$value, $key, $sourceArray)
              { 
                   
                  if(array_key_exists($value['created_by'], $sourceArray))
                  {
                       $value['created_by'] = $sourceArray[$value['created_by']];
                  }

              },$userArray); 
         $condition = "id in ".'('.substr($discussionid,0,-1).')'."";
        $getdiscussion = $this->discussion->getallByRaw($condition,array('id','title'));
        foreach($getdiscussion as $getdiscussion)
        {
          $discussionArray[$getdiscussion->id] = $getdiscussion->title;
        }
         array_walk($commentsArray, function(&$value, $key, $sourceArray)
              { 
                   
                  if(array_key_exists($value['commented_id'], $sourceArray))
                  {
                       $value['commented_id'] = $sourceArray[$value['commented_id']];
                  }

              },$discussionArray); 
      }


        
      
      // dd($commentsArray);
      return  \View::make('admin.article_comments',compact('invitationlist','discussionList','commentsArray','commentlist'));

    }
  }

  ///////////////////////// discussionmaster///////////////////
  public function discussionlist(Request $request)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $discussionList = array();
      $userArray = array();
      $userids='';
      $getdiscussion = $this->discussion->getallpaginate(array());
      if(count($getdiscussion)>0)
      {
        foreach($getdiscussion as $getdiscussionlist)
        {
          $userids.=$getdiscussionlist->user_id.',';
          $discussionList[$getdiscussionlist->id]= array('title'=>substr($getdiscussionlist->title,0,25),
                                                 'description'=>substr($getdiscussionlist->description,0,25),
                                                 'created_by'=>'',
                                                 'created_at'=>$getdiscussionlist->created_at,
                                                 'status'=>$getdiscussionlist->status);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }
         array_walk($discussionList, function(&$value, $key, $sourceArray)
              { 
                   
                  if(array_key_exists($key, $sourceArray))
                  {
                       $value['created_by'] = $sourceArray[$key];
                  }

              },$userArray); 
      }
 
      return  \View::make('admin.discussionlisting',compact('discussionList','getdiscussion'));
    }

  }

  public function discussionstatus(Request $request,$id)
  {
    $checksdiscussion= $this->discussion->getBy(array('id'=>$id));
    if($checksdiscussion)
    {
      $status=0;
      if($checksdiscussion->status==0)
      {
         $status=1;
      }
      $data = array('status'=>$status);
      $this->discussion->update($data,array('id'=>$id));

      Session::flash('message','Update Successfully.'); 
      Session::flash('alert-class', 'success'); 
      Session::flash('alert-title', 'Success');
      return redirect('/discussionlist');

    }
    else
    {
      return redirect('error404/');

    }

  }
  public function deletediscussion(Request $request)
  {
    $checksdiscussion= $this->discussion->getBy(array('id'=>$id));
    if($checksdiscussion)
    {
      
      $this->discussion->delete($id);
      Session::flash('message','Delete Successfully.'); 
      Session::flash('alert-class', 'success'); 
      Session::flash('alert-title', 'Success');
      return redirect('/discussionlist');

    }
    else
    {
      return redirect('error404/');

    }

  }
  public function invitationlist(Request $request)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      
      $discussionList = array();
      $userArray = array();
      $userids='';
      $invitationlist = Discussion_invite::where(array('created_by'=>$checkstatus['loginid']))->paginate(15);
      if(count($invitationlist)>0)
      {
        foreach($invitationlist as $invitation)
        {
          $userids.=$invitation->created_by.',';
          $discussionList[$invitation->id]= array('name'=>$invitation->name,
                                                 'email'=>$invitation->email,
                                                 'created_by'=>'',
                                                 'created_at'=>$invitation->created_at);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }
         array_walk($discussionList, function(&$value, $key, $sourceArray)
              { 
                   
                  if(array_key_exists($key, $sourceArray))
                  {
                       $value['created_by'] = $sourceArray[$key];
                  }

              },$userArray); 
      }
      return  \View::make('admin.invitationlisting',compact('invitationlist','discussionList'));
    }
  }

  public function discussion_comment(Request $request)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $commentsArray = array();
      $userArray = array();
      $userids='';
      $discussionid='';
      $discussionArray = array();
      $commentlist = Comments::where(array('type'=>2))->paginate(15);
      if(count($commentlist)>0)
      {
        foreach($commentlist as $commentval)
        {
          $userids.=$commentval->comment_by.',';
          $discussionid.=$commentval->commented_id.',';
          $commentsArray[$commentval->id]= array('comment'=>$commentval->comment,
                                                 'commented_id'=>$commentval->commented_id,
                                                 'created_by'=>$commentval->comment_by,
                                                 'created_at'=>$commentval->created_at,
                                                 'status'=>$commentval->status);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }
         array_walk($commentsArray, function(&$value, $key, $sourceArray)
              { 
                   
                  if(array_key_exists($value['created_by'], $sourceArray))
                  {
                       $value['created_by'] = $sourceArray[$value['created_by']];
                  }

              },$userArray); 
         $condition = "id in ".'('.substr($discussionid,0,-1).')'."";
        $getdiscussion = $this->discussion->getallByRaw($condition,array('id','title'));
        foreach($getdiscussion as $getdiscussion)
        {
          $discussionArray[$getdiscussion->id] = $getdiscussion->title;
        }
         array_walk($commentsArray, function(&$value, $key, $sourceArray)
              { 
                   
                  if(array_key_exists($value['commented_id'], $sourceArray))
                  {
                       $value['commented_id'] = $sourceArray[$value['commented_id']];
                  }

              },$discussionArray); 
      }


        
      
      // dd($commentsArray);
      return  \View::make('admin.discussion_comment_list',compact('invitationlist','discussionList','commentsArray','commentlist'));

    }
  }


  public function commentstatus(Request $request,$id)
  {
    $checksdiscussioncomment= Comments::where(array('id'=>$id))->first();
    if($checksdiscussioncomment)
    {
      $status=0;
      if($checksdiscussioncomment->status==0)
      {
         $status=1;
      }
      $data = array('status'=>$status);
      Comments::where(array('id'=>$id))->update($data);

      Session::flash('message','Update Successfully.'); 
      Session::flash('alert-class', 'success'); 
      Session::flash('alert-title', 'Success');
      return redirect('/discussion-comment-list');

    }
    else
    {
      return redirect('error404/');

    }

  }
  public function deletecomment(Request $request,$id)
  {
    if($id)
    {
      $checksdiscussioncomment= Comments::where(array('id'=>$id))->first();
      if($checksdiscussioncomment)
      {
        
        Comments::destroy($id);
        Session::flash('message','Delete Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('/discussion-comment-list');

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
  //////////////digitallocker////////
  public function digitallocker(Request $request)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $documenttypeArray = array();
      $userArray=array();
      $doctypelist = $this->documenttype->getallBy(array('status'=>1),array('id','name'));
      foreach($doctypelist as $doctype)
      {
          $documenttypeArray[$doctype->id] = $doctype->name;

      }
      $docArray = array();
      $userids='';
      $getdocumentList = $this->documents->getallpaginate(array());
      if(count($getdocumentList)>0)
      {
        foreach($getdocumentList as $getdocument)
        {
          $userids.=$getdocument->user_id.',';
          $docextension = explode('.', $getdocument->file_name);
          $docArray[$getdocument->id]  =array('id'=>$getdocument->id,
                                              'user_id'=>$getdocument->user_id,
                                              'uplode_by'=>'',
                                              'doctype'=>'',
                                              'status'=>$getdocument->status,
                                              'docextension'=>$docextension[1],
                                              'type'=>$getdocument->type,
                                              'created_at'=>$getdocument->created_at);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }

        array_walk($docArray, function(&$value, $key, $sourceArray)
        {
           
            if(array_key_exists($value['type'], $sourceArray))
            {
                 $value['doctype'] = $sourceArray[$value['type']];
            }

        },$documenttypeArray);

        array_walk($docArray, function(&$value, $key, $sourceArray)
        {
           
            if(array_key_exists($value['user_id'], $sourceArray))
            {
                 $value['uplode_by'] = $sourceArray[$value['user_id']];
            }

        },$userArray);
      }
      // dd($docArray);
     return  \View::make('admin.digitallocker',compact('docArray','getdocumentList'));
   }

  }
  ///////////////// common master/////////
  public function schoolist(Request $request,$editid=false)
  {
    $datatoedit='';
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      if($request->submitboard)
      {
        $messsages = [
        'boardname.required'=>'Please enter board name'];
       
        $rules = [
            'boardname'=>'required|max:255'
        ];
         $validator = Validator::make($request->all(), $rules,$messsages);
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
          $data = array('board_name'=>$request->boardname,
                        'created_at'=>date('Y-m-d H:i:s'));
          Schoolboard::insertGetId($data);
          Session::flash('message','Save Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
        }
      }
     
      $getschoollist = Schoolboard::where(array())->get();
      if($editid)
      {
        $datatoedit =  Schoolboard::where(array('id'=>$editid))->first();
        if(empty($datatoedit))
        {
          return redirect('error404/');
        }
        if($request->updateboard)
        {
            $messsages = [
            'boardname.required'=>'Please enter board name'];
           
            $rules = [
                'boardname'=>'required|max:255'
            ];
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails())
            {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            $data = array('board_name'=>$request->boardname);
            Schoolboard::where(array('id'=>$editid))->update($data);
            Session::flash('message','Update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

        }
      }
      return  \View::make('admin.schoollist',compact('getschoollist','datatoedit'));
    }

  }

  public function mediumlist(Request $request,$editid=false)
  {
    $datatoedit='';
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $getmediumlist = Schoolmedium::where(array())->get();
      if($request->submitmedium)
      {
        $messsages = [
        'medium.required'=>'Please enter board name'];
       
        $rules = [
            'medium'=>'required|max:255'
        ];
         $validator = Validator::make($request->all(), $rules,$messsages);
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
          $data = array('medium_name'=>$request->medium,
                        'created_at'=>date('Y-m-d H:i:s'));
          Schoolmedium::insertGetId($data);
          Session::flash('message','Save Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
        }
      }
     
      if($editid)
      {
        $datatoedit =  Schoolmedium::where(array('id'=>$editid))->first();
        if(empty($datatoedit))
        {
          return redirect('error404/');
        }
        if($request->updatemedium)
        {
            $messsages = [
            'medium.required'=>'Please enter board name'];
           
            $rules = [
                'medium'=>'required|max:255'
            ];
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails())
            {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            $data = array('medium_name'=>$request->medium);
            Schoolmedium::where(array('id'=>$editid))->update($data);
            Session::flash('message','Update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

        }
      }

      return  \View::make('admin.mediumlist',compact('getmediumlist','datatoedit'));
    }
    
  }




  public function coursetype(Request $request,$editid=false)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      
      $getcourselist = Courselist::where(array())->get();
      if($request->submitmedium)
      {
        $messsages = [
        'course_name.required'=>'Please enter board name'];
       
        $rules = [
            'course_name'=>'required|max:255'
        ];
         $validator = Validator::make($request->all(), $rules,$messsages);
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
          $data = array('course_name'=>$request->course_name,
                          'course_for'=>$request->coursefor,
                        'created_at'=>date('Y-m-d H:i:s'));
          Courselist::insertGetId($data);
          Session::flash('message','Save Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
        }
      }
      if($editid)
      {
        $datatoedit =  Courselist::where(array('id'=>$editid))->first();
        if(empty($datatoedit))
        {
          return redirect('error404/');
        }
        if($request->updatecourse)
        {
            $messsages = [
            'course_name.required'=>'Please enter course name'];
           
            $rules = [
                'course_name'=>'required|max:255'
            ];
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails())
            {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            $data = array('course_name'=>$request->course_name,
                          'course_for'=>$request->coursefor);
            Courselist::where(array('id'=>$editid))->update($data);
            Session::flash('message','Update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

        }
      }

      return  \View::make('admin.courselist',compact('getcourselist','datatoedit'));
    }
    
  }
  public function subcourselist(Request $request,$id=false)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {

        $couselitarray = array();
        $stateArray = array();
        $getcourselist = Courselist::where(array())->get();
        foreach($getcourselist as $getcourselist)
        {
          $couselitarray[$getcourselist->id] = $getcourselist->course_name;

        }
        //////state array///
        $datasubcourse = DB::table('subcourselists')->get();
        array_walk($datasubcourse, function(&$value, $key, $sourceArray)
            { 
                $value->forcourse='';
                 
                if(array_key_exists($value->course_id, $sourceArray))
                {
                     $value->forcourse = $sourceArray[$value->course_id];
                }

            },$couselitarray); 
          $datatoedit='';
        ///////////// if submit///////
        if($request->submitsubcourse)
        {
          $messsages = [
          'subcourse.required'=>'Please enter Sub course name',
          'course_id.required'=>'Please select course name'];
         
          $rules = [
              'subcourse'=>'required|max:255',
              'course_id'=>'required'
          ];
           $validator = Validator::make($request->all(), $rules,$messsages);
          if ($validator->fails())
          {
              $this->throwValidationException(
                  $request, $validator
              );
          }
          else
          {
            $data = array('sub_course_name'=>$request->subcourse,
                          'course_id'=>$request->course_id,
                          'status'=>1,
                          'created_at'=>date('Y-m-d H:i:s'));
            Subcourselist::insertGetId($data);
            Session::flash('message','Save Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');
          }
        }
        if($id)
        {
          $datatoedit = Subcourselist::where(array('id'=>$id))->first();
          if(empty($datatoedit))
          {
            return redirect('error404/');
          }
        }
     // dd($datasubcourse);
      return \View::make('includes.admin.subcoureselist',compact('couselitarray','datasubcourse','datatoedit'));
    
  }
}

  public function industrylist(Request $request,$editid=false)
  {
    $datatoedit='';
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      if($request->submitboard)
      {
        $messsages = [
        'industryname.required'=>'Please enter industry name'];
       
        $rules = [
            'industryname'=>'required|max:255'
        ];
         $validator = Validator::make($request->all(), $rules,$messsages);
        if ($validator->fails())
        {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else
        {
          $data = array('name'=>$request->industryname,
                        'created_at'=>date('Y-m-d H:i:s'));
          Industry::insertGetId($data);
          Session::flash('message','Save Successfully.'); 
          Session::flash('alert-class', 'success'); 
          Session::flash('alert-title', 'Success');
        }
      }
     
      $industrylist = Industry::where(array())->get();
      if($editid)
      {
        $datatoedit =  Industry::where(array('id'=>$editid))->first();
        if(empty($datatoedit))
        {
          return redirect('error404/');
        }
        if($request->updateboard)
        {
            $messsages = [
            'industryname.required'=>'Please enter industry name'];
           
            $rules = [
                'industryname'=>'required|max:255'
            ];
            $validator = Validator::make($request->all(), $rules,$messsages);
            if ($validator->fails())
            {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            $data = array('name'=>$request->industryname);
            Industry::where(array('id'=>$editid))->update($data);
            Session::flash('message','Update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

        }
      }
      return  \View::make('admin.industrylist',compact('industrylist','datatoedit'));
    }

  }

  public function changestatuscommon(Request $request,$id,$statusfor)
  {
    if($statusfor=='board' || $statusfor=='school')
    {
      $checkschool= Schoolboard::where(array('id'=>$id))->first();
      if($checkschool)
      {
        $status=0;
        if($checkschool->status==0)
        {
           $status=1;
        }
        $data = array('status'=>$status);
        Schoolboard::where(array('id'=>$id))->update($data);
        Session::flash('message','Update Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('/admin/schooboardlist');
      }
      else
      {
        return redirect('error404/');
      }

    }
    else if($statusfor=='medium')
    {
      $checkmedium= Schoolmedium::where(array('id'=>$id))->first();
      if($checkmedium)
      {
        $status=0;
        if($checkmedium->status==0)
        {
           $status=1;
        }
        $data = array('status'=>$status);
        Schoolmedium::where(array('id'=>$id))->update($data);

        Session::flash('message','Update Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('/admin/mediumlist');

      }
      else
      {
        return redirect('error404/');

      }
    }
    else if($statusfor=='industry')
    {
      $checkmedium= Industry::where(array('id'=>$id))->first();
      if($checkmedium)
      {
        $status=0;
        if($checkmedium->status==0)
        {
           $status=1;
        }
        $data = array('status'=>$status);
        Industry::where(array('id'=>$id))->update($data);

        Session::flash('message','Update Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('/articlelist');

      }
      else
      {
        return redirect('error404/');

      }
    }
    elseif($statusfor=='subcourse')
    {
      $checkmedium= Subcourselist::where(array('id'=>$id))->first();
      if($checkmedium)
      {
        $status=0;
        if($checkmedium->status==0)
        {
           $status=1;
        }
        $data = array('status'=>$status);
        Subcourselist::where(array('id'=>$id))->update($data);

        Session::flash('message','Update Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('admin/subcourselist');

      }
      else
      {
        return redirect('error404/');

      }

    }
    elseif($statusfor=='course')
    {
      $checkmedium= Courselist::where(array('id'=>$id))->first();
      if($checkmedium)
      {
        $status=0;
        if($checkmedium->status==0)
        {
           $status=1;
        }
        $data = array('status'=>$status);
        Courselist::where(array('id'=>$id))->update($data);

        Session::flash('message','Update Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('admin/courselist');

      }
      else
      {
        return redirect('error404/');

      }

    }
     elseif($statusfor=='broadcast')
    {
      $checkmedium= Broadcast::where(array('id'=>$id))->first();
      if($checkmedium)
      {
        $status=0;
        if($checkmedium->status==0)
        {
           $status=1;
        }
        $data = array('status'=>$status);
        Broadcast::where(array('id'=>$id))->update($data);

        Session::flash('message','Update Successfully.'); 
        Session::flash('alert-class', 'success'); 
        Session::flash('alert-title', 'Success');
        return redirect('admin/broadcast');

      }
      else
      {
        return redirect('error404/');

      }

    }
  }

  ///////////////////company master//////
  public function companylist(Request $request)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      
      $companylist = array();
      $userArray = array();
      $userids='';
      $getallcompany = Company_detail::where(array('status'=>1))->paginate(15);
      if(count($getallcompany)>0)
      {
        foreach($getallcompany as $getcompany)
        {
          $userids.=$getcompany->user_id.',';
          $companylist[$getcompany->id]= array('compnay_name'=>$getcompany->compnay_name,
                                               'company_website'=>$getcompany->company_website,
                                               'contact'=>$getcompany->contact,
                                               'created_at'=>$getcompany->created_at);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }
         array_walk($companylist, function(&$value, $key, $sourceArray)
              { 
                   
                  if(array_key_exists($key, $sourceArray))
                  {
                       $value['created_by'] = $sourceArray[$key];
                  }

              },$userArray); 
      }
      return  \View::make('admin.companylisting',compact('getallcompany','companylist'));
    }
  }

  /////////////news section /////////
  public function newslist(Request $request)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $allnewslist = array();
      $userArray = array();
      $userids='';
      $getnewslist= $this->postnews->getallpaginate(array());
      if(count($getnewslist)>0)
      {
        foreach($getnewslist as $getnews)
        {
          $userids.=$getnews->user_id.',';
          $allnewslist[$getnews->id]= array('title'=>substr($getnews->title,0,25),
                                                 'description'=>substr($getnews->description,0,25),
                                                 'created_by'=>'',
                                                 'created_at'=>$getnews->created_at,
                                                 'status'=>$getnews->status);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }
         array_walk($allnewslist, function(&$value, $key, $sourceArray)
              { 
                 
                   
                  if(array_key_exists($key, $sourceArray))
                  {
                       $value['created_by'] = $sourceArray[$key];
                  }

              },$userArray); 


      }
   
      return  \View::make('admin.postnewslist',compact('allnewslist','getnewslist'));
    }

  }

  public function newsstatus(Request $request,$id)
  {
    $checksarticle= $this->postnews->getBy(array('id'=>$id));
    if($checksarticle)
    {
      $status=0;
      if($checksarticle->status==0)
      {
         $status=1;
      }
      $data = array('status'=>$status);
      $this->postnews->update($data,array('id'=>$id));

      Session::flash('message','Update Successfully.'); 
      Session::flash('alert-class', 'success'); 
      Session::flash('alert-title', 'Success');
      return redirect('/admin/newslist');

    }
    else
    {
      return redirect('error404/');

    }

  }
  public function deletenews(Request $request)
  {
    $checksarticle= $this->postnews->getBy(array('id'=>$id));
    if($checksarticle)
    {
      $this->postnews->delete($id);
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

  ////////////// job master start////////
  public function joblist(Request $request,$pagename=false)
  {
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $alljoblist = array();
      $userArray = array();
      $userids='';
      $condition = 'valid_till >="'.date('Y-m-d H:i:s').'"';
      if($pagename)
      {
        $condition = 'valid_till <"'.date('Y-m-d H:i:s').'"';

      }
      $getjoblist= Jobdetail::whereRaw($condition)->paginate(15);
      if(count($getjoblist)>0)
      {
        foreach($getjoblist as $getjob)
        {
          $userids.=$getjob->user_id.',';
          $alljoblist[$getjob->id]= array('compnay_hiring'=>$getjob->compnay_hiring,
                                           'openings'=>$getjob->openings,
                                           'created_by'=>'',
                                           'created_at'=>$getjob->created_at);

        }
        $condition = "id in ".'('.substr($userids,0,-1).')'."";
        $getuser = $this->usersInterface->getallByRaw($condition,array('id','email'));
        foreach($getuser as $getuser)
        {
          $userArray[$getuser->id] = $getuser->email;
        }
         array_walk($alljoblist, function(&$value, $key, $sourceArray)
              { 
                 
                   
                  if(array_key_exists($key, $sourceArray))
                  {
                       $value['created_by'] = $sourceArray[$key];
                  }

              },$userArray); 


      }

      return  \View::make('admin.alljoblist',compact('alljoblist','getjoblist'));
    }

  }

  ///////////////////////////////////

  public function getLogout()
  {
    $commonObj = new Common();
    Auth::logout();
    $deleteuserLoginid = $commonObj->deletecokkies('userLoginid');
    $deleteloginToken = $commonObj->deletecokkies('loginToken');
    return redirect('/admin')->withCookie($deleteuserLoginid);;
  }
 
  public function manageuser()
  {   
    $user = Auth::user();

    if(empty($user->id))
    {
        return redirect('admin/login');
    }

    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      $userarray = array();
      $column = array('name','email','mobile','login_type','created_at','type','user_type','status','about','is_register','id');
      $dataUser = $this->usersInterface->allpaging($column); 
      $counter=1;
      if(count($dataUser)>0)
      {
        forecah($dataUser as $datalist)
        {
          $userarray[$getuser->id] = array('email'=>$datalist->email,
                                               'name'=>$datalist->name);
        }

      }
      return \View::make('admin.manageuser',compact('dataUser','counter'));
    }
    else
    {
      return redirect('error404/');
    }
  }
 

  //function for create admin users:Pawan//
  public function makeuser(request $request)
  {
       $user = Auth::user();
       if(empty($user->id) ||  $user->user_type != 1)
       {
           return redirect('auth/login');
       }
        if(isset($request->submit))
        {
            $userData = array('name'=>$request->name,
                              'email'=>$request->email,
                              'mobile'=>$request->mobile,
                              'type'=>$request->type,
                              'password'=>bcrypt($request->password),
                              'user_type'=>1,
                              'created_by'=>$user->id);
            $validator = Validator::make($request->all(), $this->usersInterface->rulesForCreateuser(),$this->usersInterface->rulesForCreateuserMessage());

            if ($validator->fails()) {
                return redirect('/admin/makeuser')
                            ->withErrors($validator)
                            ->withInput();
            }
            if($request->type==2)
            {
                $validator = Validator::make($request->all(), $this->usersInterface->rulesForfeatures(),$this->usersInterface->rulesForfeaturesMessage());
                if ($validator->fails())
                {
                    return redirect('/admin/makeuser')
                                ->withErrors($validator)
                                ->withInput();
                }
                $userData['assign_state'] = $request->state;
            
            }
            if(isset($request->userID))  //Is used for editing
            {
                $makeuser = $this->usersInterface->updateuser($userData, array('id'=>$request->userID));
                $changedValue='Updated';
                
            }
            else
            {  
                $makeuser = $this->usersInterface->create($userData);
                // if($request->type==2)
                // {
                //     $featuresData = array('user_id'=>$makeuser,'features'=>$featuresid,'created_by'=>$user->id);
                //     $makefeatures = $this->featuresassign->create($featuresData);
                // } 
                $changedValue='Created';
            }
            if($makeuser)
            {

                Session::flash('message', $changedValue.' Successfully.'); 
                Session::flash('alert-class', 'success'); 
                Session::flash('alert-title', 'Success');

            }
            else
            {
                Session::flash('message', 'Please try later.'); 
                Session::flash('alert-class', 'error'); 
                Session::flash('alert-title', 'error');
            }
                // dd(here);
               return redirect('admin/makeuser/');
                
        }
          // $featureslist =$this->adminfeature->getallBy(array('status'=>1));
          $featureslist='';
          $statelist = $this->state->getallBy(array('status'=>1));
          $alluserlist =$this->usersInterface->getallBy(array('user_type'=>1));
          return \View::make('admin.makeuserform',compact('alluserlist','featureslist','statelist'));

  }

  public function editadminuser(request $request,$id)
  {
       $user = Auth::user();
       if(empty($user->id) ||  $user->user_type != 1)
       {
           return redirect('/');
       }
        if(isset($request->submit))
        {
            $userData = array('name'=>$request->name,
                              'email'=>$request->email,
                              'mobile'=>$request->mobile,
                              'type'=>$request->type,
                              'user_type'=>1,
                              'updated_by'=>$user->id);
            $validator = Validator::make($request->all(), $this->usersInterface->rulesForediteuser(),$this->usersInterface->rulesForedituserMessage());

            if ($validator->fails()) {
                return redirect('/editadminuser/'.$id)
                            ->withErrors($validator)
                            ->withInput();
            }
             if($request->type==2)
            {
                $validator = Validator::make($request->all(), $this->usersInterface->rulesForfeatures(),$this->usersInterface->rulesForfeaturesMessage());
                if ($validator->fails())
                {
                    return redirect('/admin/makeuser')
                                ->withErrors($validator)
                                ->withInput();
                }
                $userData['assign_state'] = $request->state;
            
            }
            
            $updateuserDetails = $this->usersInterface->updateuser($userData, array('id'=>$id));
            $changedValue='User details';
            // if($request->type==2)
            // {
            //   $featuresData = array('user_id'=>$id,'features'=>$featuresid,'created_by'=>$user->id);
            //   $deletefeatures = $this->featuresassign->delete(array('user_id'=>$id));
            //   $makefeatures = $this->featuresassign->create($featuresData);
            //   $changedValue.=' and features';
            // } 
            $changedValue.=' update';
            if($updateuserDetails)
            {
                Session::flash('message', $changedValue.' Successfully.'); 
                Session::flash('alert-class', 'success'); 
                Session::flash('alert-title', 'Success');

            }
            else
            {
                Session::flash('message', 'Please try later.'); 
                Session::flash('alert-class', 'error'); 
                Session::flash('alert-title', 'error');
            }
                // dd(here);
               return redirect('admin/makeuser/');
        }

      $statelist = $this->state->getallBy(array('status'=>1));
      $getUserdetails =$this->usersInterface->getBy(array('id'=>$id,'user_type'=>1));
      // $getfeatures =$this->featuresassign->getBy(array('user_id'=>$id));
      // if(!$getfeatures)
      // {
        $getfeatures='';

      //}
      
      return \View::make('admin.editadminuser',compact('getUserdetails','featureslist','getfeatures','statelist'));

  }




 public function adminuserstatus(Request $request ,$id , $status)

 {

        $user = Auth::user();
        $condition = array('id'=>$id);
        $checkuser = $this->usersInterface->getBy($condition);
        if($checkuser)
        {
            $updateData = array('status'=>$status);
            $updateuser = $this->usersInterface->updateuser($updateData,$condition);
            if($updateuser)
            {
                Session::flash('message', 'Update Successfully.'); 
                Session::flash('alert-class', 'success'); 
                Session::flash('alert-title', 'Success');
            }
             return back();
            //return redirect();
        }
        else
        {
            Session::flash('message', 'Something went wrong! The page you are looking for can not be found.'); 
            Session::flash('alert-class', 'error'); 
            Session::flash('alert-title', 'error'); 
            return redirect('error404/');
        }

 }
  ////////// change password////////
  /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changepassword(Request $request)
    {
        //
    $user = Auth::user();
    if(empty($user->id)){
             return redirect('auth/login');
        }
        
     $footerfix = 'footerfix';
    return view('admin/changepassword',compact('user','footerfix'));
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
    if(empty($user->id)){
             return redirect('auth/login');
        }
        $requestData = $request->all();
    $rules = array('password'=> 'required',
                   'confirmpassword'=> 'required|same:password');

    $validator = Validator::make(Input::all(), $rules);
    if ($validator->fails()) 
    {
        return redirect('/admin/changepassword')
                    ->withErrors($validator)
                    ->withInput();
    }
      $whereCondiyion = 'id';
      $whereCondiyion1 = $user->id;
      $userData['password'] = bcrypt($requestData['password']);
      $this->usersInterface->update($userData,$whereCondiyion1,$whereCondiyion);
            
       Session::flash('message', 'Password has been updated.'); 
                Session::flash('alert-class', 'success'); 
                Session::flash('alert-title', 'Success'); 
            return redirect('admin/changepassword');
    
    }

    //////////// broadcastmsg///////
    public function broadcastmsg(Request $request,$editid=false)
      {
    $datatoedit='';
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
      if($request->submitmessage)
      {
        $messsages = [
        'messagedisplay.required'=>'Please enter industry name',
        'validtill.date'=>'Please enter valid date'];
       
        $rules = [
            'messagedisplay'=>'required|max:255',
            'validtill'=>'required|date|date_format:Y-m-d'
        ];
        if($request->type==1)
        {

         $validator = Validator::make($request->all(), $rules,$messsages);
        
          if ($validator->fails())
          {
              $this->throwValidationException(
                  $request, $validator
              );
          }
          else
          {
            $data = array('message'=>$request->messagedisplay,
                          'display_till'=>$request->validtill,
                          'created_at'=>date('Y-m-d H:i:s'));
            Broadcast::insertGetId($data);
            Session::flash('message','Save Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');
          }
        }
        if($request->type==2)
        {
          $messsages = [
          'messagedisplay.required'=>'Please enter industry name',
          'validtill.date'=>'Please enter valid date'];
         
          $rules = [
              'messagedisplay'=>'required|max:255',
              'validtill'=>'required|date|date_format:Y-m-d',
              'useremail' => 'required|email|exists:users,email'
          ];
          $validator = Validator::make($request->all(), $rules,$messsages);
          if ($validator->fails())
          {
              $this->throwValidationException(
                  $request, $validator
              );
          }
          else
          {
            $getuserid = $this->usersInterface->getBy(array('email'=>$request->useremail));
            $data = array('message'=>$request->messagedisplay,
              'user_id'=>$getuserid->id,
                          'display_till'=>$request->validtill,
                          'email_user'=>$request->useremail,
                          'type'=>2,
                          'created_at'=>date('Y-m-d H:i:s'));
            Broadcast::insertGetId($data);
            Session::flash('message','Save Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');
          }

        }
       
      }
     
      $broadcastlist = Broadcast::where(array())->get();
      if($editid)
      {
        $datatoedit =  Broadcast::where(array('id'=>$editid))->first();
        if(empty($datatoedit))
        {
          return redirect('error404/');
        }
        if($request->updatemassege)
        {
          $messsages = [
          'messagedisplay.required'=>'Please enter industry name',
          'validtill.date'=>'Please enter valid date'];
         
          $rules = [
              'messagedisplay'=>'required|max:255',
              'validtill'=>'required|date|date_format:Y-m-d'
          ];
          if($request->type==1)
          {

           $validator = Validator::make($request->all(), $rules,$messsages);
          
            if ($validator->fails())
            {
                $this->throwValidationException(
                    $request, $validator
                );
            }
            else
            {
              $data = array('message'=>$request->messagedisplay,
                            'display_till'=>$request->validtill,
                            'type'=>1);
              Broadcast::where(array('id'=>$editid))->update($data);
            Session::flash('message','Update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');
            }
          }
            if($request->type==2)
            {
              $messsages = [
              'messagedisplay.required'=>'Please enter industry name',
              'validtill.date'=>'Please enter valid date'];
             
              $rules = [
                  'messagedisplay'=>'required|max:255',
                  'validtill'=>'required|date|date_format:Y-m-d',
                  'useremail' => 'required|email|exists:users,email'
              ];
              $validator = Validator::make($request->all(), $rules,$messsages);
              if ($validator->fails())
              {
                  $this->throwValidationException(
                      $request, $validator
                  );
              }
              else
              {
                $getuserid = $this->usersInterface->getBy(array('email'=>$request->useremail));
                $data = array('message'=>$request->messagedisplay,
                  'user_id'=>$getuserid->id,
                              'display_till'=>$request->validtill,
                              'email_user'=>$request->useremail,
                              'type'=>2);
                Broadcast::where(array('id'=>$editid))->update($data);
            Session::flash('message','Update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');
              }

            }
        

        }
      }
      // dd($datatoedit);
      return  \View::make('admin.broadcastlist',compact('broadcastlist','datatoedit'));
    }

  }

  public function applylistall(Request $request)
  {
    $dataCat = array();
    $datasubcat = array();
    $datatoedit='';
    $checkstatus = $this->checkpermission();
    if($checkstatus['status']=='login')////////if login require
    {
      return redirect('auth/login');
    }
    else if($checkstatus['status']=='notfound')////////page not belong to user
    {
      return redirect('error404/');
    }
    elseif($checkstatus['status']=='success')
    {
          $allylistArray = array();
          $jobid='';
          $useridlist='';
          $getapplyList= Apply_for_job::where(array('type'=>1))->paginate(15);
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
      return \View::make('admin.allapplylist',compact('allylistArray','getapplyList'));
   }
  }
  
}


