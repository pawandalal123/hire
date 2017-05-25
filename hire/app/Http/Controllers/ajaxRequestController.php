<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Model\Common;
use Appfiles\Repo\UsersInterface;
use Appfiles\Repo\StateInterface;
use Appfiles\Repo\SubcategoryInterface;
use Appfiles\Common\Functions;
use App\Model\Comments;
use App\Model\User_followers;
use App\Model\Apply_for_job;
use App\Model\Jobdetail;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Appfiles\Repo\CityInterface;
use DB;
use Mail;
use URL;
use Validator;

class AjaxRequestController extends Controller
{

    protected $APIURL;
    protected $functions;
    protected $s3;

    public function  __construct(Functions $functions,UsersInterface $usersInterface,StateInterface $state,SubcategoryInterface $subcat,CityInterface $city)
    {
       $this->APIURL= URL::to('api/');
       $this->functions=$functions;
       $this->usersInterface = $usersInterface;
       $this->state= $state;
       $this->subcat=$subcat;
       $this->city = $city;
   
      
    }
 ////////////login model/////////
  public function loginform(Request $request)
  {
      echo  csrf_field();
 
      return view('includes/web/loginmodel');
  }

  //////////// sasavedetails/////
  public function savedetails(Request $request)
  {
    if($request->ajax())
    {
      $status['status'] = 'error';
      $user = Auth::user();
      $dataComment = array('comment'=>$request->message,
                           'commented_id'=>$request->id,
                           'comment_by'=>$user->id,
                           'created_at'=>date('Y-m-d H:i:s'),
                           'status'=>1,
                           'type'=>2);
      if($request->detailfor=='article')
      {
        $dataComment['type'] = 1;

      }
      if($request->detailfor=='news')
      {
        $dataComment['type'] = 3;

      }
      $createcomment = Comments::insert($dataComment);
      if($createcomment)
      {
        $status['status'] = 'success';
      }

      return response()->json($status);
   }

  }

  public function getuserlist(Request $request)
  {
    $datausers = array();
    $completeformData = Input::all();
    @extract($completeformData);
    $commonObj =  new Common();
    $allusers = $this->usersInterface->getallByRawlimit("(email like '%".$request->term."%') ",array('email'));
    // dd($allusers);
    foreach($allusers as $allusers)
    {
           
        $datausers[$allusers->email] =  ucwords($allusers->email);
    }
        return response()->json($datausers);

  }


  public function connectviamailbox(Request $request)
   {
    
    if($request->ajax())
        {
          ?>
          
              
                <div class="input-field">
                  <input type="text" class="validate">
                  <label class="">Email</label>
                </div>
                <div class="input-field">
                <button class="waves-effect waves-light btn">Connect</button>
                </div>
              
            <?php  
      }

   }

   /*save contect form data for user*/

  public function saveforwardform(Request $request)
  {
      if($request->ajax())
      {
          $eventFormData = Input::all();
          @extract($eventFormData);
          $commonObj = new Common();
          $usercity = $commonObj->iplocation('182.64.161.94');
          $Event_forward_details = new Event_forward_details();
          $Event_forward_details->event_id =$request->eventid;
          $Event_forward_details->forward_by =$request->name;
          $Event_forward_details->forward_to_email =$request->email;
          $Event_forward_details->forward_message =$request->message;
          $Event_forward_details->forward_ip_address =$_SERVER['REMOTE_ADDR'];
          $Event_forward_details->forward_from_location =$usercity;
          $Event_forward_details->save();
          echo 1;
      }
  }

  
  //////////statelist countrybased/////
  public function statelist(Request $request)
  {

    //dd($request->all());
    $html='';
    $getstatelist = $this->state->getallBy(array('status'=>1,'country_id'=>$request->countryid));
    if($request->type)
    {
      // dd($getstatelist);
      $html=' <select name="state" class="statechange"><option >Select State</option>';
      if(count($getstatelist)>0)
      {
        foreach($getstatelist as $getstatelist)
        {
          
             $html.='<option value='.$getstatelist->id.' id='.$getstatelist->id.'>'.$getstatelist->state.'</option>';
        }
      }

    }
    else
    {
      $html=' <select name="state" class="statechange"><option >Select State</option>';
      // dd($getstatelist);
      if(count($getstatelist)>0)
      {
        foreach($getstatelist as $getstatelist)
        {
          if(isset($request->type))
          {
             $html.='<option value='.$getstatelist->id.' id='.$getstatelist->id.'>'.$getstatelist->state.'</option>';

          }
          else
          {
             $html.='<option value='.$getstatelist->id.' id='.$getstatelist->id.'>'.$getstatelist->state.'</option>';
          }
        }
      }
    }
    $html.='</select>';
    return $html;

  }
  //////////citylist countrybased/////
  public function citylist(Request $request)
  {

    //dd($request->all());
    $html=' <select name="city" class="citychange"><option >Select City</option>';
    $getstatelist = $this->city->getallBy(array('status'=>1,'state'=>$request->stateid));
    // dd($getstatelist);
    if(count($getstatelist)>0)
    {
      foreach($getstatelist as $getstatelist)
      {
        
        $html.='<option value='.$getstatelist->id.' id='.$getstatelist->id.'>'.$getstatelist->city.'</option>';
        
      }
    }
    $html.='</select>';
    return $html;

  }

  public function subcatlistajax(Request $request)
  {
      if($request->ajax())
      {
          $type=1;
          if($request->type)
          {
            $type=$request->type;
          }
          $condition = array('category_id'=>$request->catid,'type'=>1);
          $subcat =$this->subcat->getallBy($condition);
          $html='<option value="" rel="">Select option</option>';
          if(count($subcat)>0)
          {
            foreach($subcat as $subcat)
            {
              $html.='<option value='.str_replace(' ','-',$subcat->name).' rel='.$subcat->id.'>'.$subcat->name.'</option>';

            }

          }
          return $html;

      }
  }

  //////////// useraction ////////
    public function saveuseraction(Request $request)
   {
      $eventFormData = Input::all();
      @extract($eventFormData);
      if(Auth::check())
      {
          $userlogin = Auth::user();
          $data=array();
          if($request->actionfor=='company' || $request->actionfor=='user' || $request->actionfor=='people' || $request->actionfor=='connection')
          {
            $type=1;
            if($request->actionfor=='company')
            {
               $type =2;

            }
            $conditioncheck = array('action_id'=>$request->id,'followed_by_id'=>$userlogin->id,'type'=>$type);
            $followcheck = User_followers::where($conditioncheck)->first();
            if($followcheck)
            {
              $deletefollower = User_followers::where($conditioncheck)->delete();
              $data['success'] = array('status'=>1);
            }
            else
            {
                $followingData = new User_followers();
                $followingData->action_id = $request->id;
                $followingData->followed_by_id = $userlogin->id;
                $followingData->followed_ip_address = $_SERVER['REMOTE_ADDR'];
                $followingData->type =$type;
                $followingData->created_at =date('Y-m-d H:i:s');
                $followingData->save();
                $data['success'] = array('status'=>0);

            }

          }
          elseif($request->actionfor=='applyjob')
          {
            $checkjob=Jobdetail::where(array('id'=>$request->id))->first();
            if($checkjob)
            {
              $checkapply = Apply_for_job::where(array('job_id'=>$request->id,'apply_by_id'=>$userlogin->id,'type'=>1))->first();
              if($checkapply)
              {
                $data['success'] = array('status'=>1);

              }
              else
              {
                  $Apply_for_job = new Apply_for_job();
                  $Apply_for_job->job_id = $request->id;
                  $Apply_for_job->compnay_id = $checkjob->compnay_id;
                  $Apply_for_job->apply_by_id = $userlogin->id;
                  $Apply_for_job->type = 1;
                  $Apply_for_job->ip_address = $_SERVER['REMOTE_ADDR'];
                  $Apply_for_job->created_at =date('Y-m-d H:i:s');
                  $Apply_for_job->save();
                  $data['success'] = array('status'=>1);
              }
            }
            else
            {
              $data['success'] = array('status'=>'error');
            }

          }
          elseif($request->actionfor=='savejob')
          {
            $checkjob=Jobdetail::where(array('id'=>$request->id))->first();
            if($checkjob)
            {
              $checkapply = Apply_for_job::where(array('job_id'=>$request->id,'apply_by_id'=>$userlogin->id,'type'=>2))->first();
              if($checkapply)
              {
                $data['success'] = array('status'=>1);

              }
              else
              {
                  $Apply_for_job = new Apply_for_job();
                  $Apply_for_job->job_id = $request->id;
                  $Apply_for_job->compnay_id = $checkjob->compnay_id;
                  $Apply_for_job->apply_by_id = $userlogin->id;
                   $Apply_for_job->type = 2;
                  $Apply_for_job->ip_address = $_SERVER['REMOTE_ADDR'];
                  $Apply_for_job->created_at =date('Y-m-d H:i:s');
                  $Apply_for_job->save();
                  $data['success'] = array('status'=>1);
              }
            }
            else
            {
              $data['success'] = array('status'=>'error');
            }

          }
      }
      else
      {
        $data['success'] = array('status'=>'error');
      }

      return json_encode($data);
   }
    public function eventviewcounter(Request $request)
    {
      $commonObj = new Common();
      $viewconter= $commonObj->eventviewcounter($request->eventid,$request->type);
      return $viewconter;

    }

    /////// update userprofile//////

    public function userupdates(Request $request)
    {
      if($request->ajax())
      {
        $return['status']='success';
        if($request->type=='changestatus')
        {

          if(Auth::check())
          {
            // dd('pawan');
            $user = Auth::user();
            if($user->profile_status==1)
            {
              $status=0;

            }
            else
            {
              $status=0;
            }
            $update = $this->usersInterface->updateuser(array('profile_status'=>$status),array('id'=>$user->id));
            $return['status']='success';

          }
          else
          {
            $return['status']='error';
          }

        }

        return json_encode($return);

      }

    }
 
}
?>
