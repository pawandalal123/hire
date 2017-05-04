<?php 

namespace App\Http\ViewComposers;
use App\Model\Common;
use App\User;
use Illuminate\Contracts\View\View;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Model\Company_detail;
class AutologinComposer 
{
    public function compose(View $view) 
    {
        $commonObj = new Common();
        if(Auth::check())
        {
            $user = Auth::user();
            $condition = array('user_id'=>$user->id);
            if($user->is_subuser)
            {
              $condition = array('user_id'=>$user->created_by);

            }
            $checkcompnay = Company_detail::where($condition)->first();
            $view->with('checkcompnay', $checkcompnay);
            $view->with('become_job_owner', $user->become_job_owner);
            $getcokkies = $commonObj->getcokkies('userLoginid');
            if($getcokkies==false )
            {
                $login_token=$user->id.rand(1000,999999);
                $setuserId=$user->id;
                //$updateuser = User::where('id', '=', $user->id)->update(array('login_token' =>$login_token));
                $getcokkuser = $commonObj->setcokkies('userLoginid',$setuserId);
                $getaccesstoken = $commonObj->setcokkies('loginToken',$login_token);
                $view->with('userLoginid', $getcokkuser);
            }
            else
            {
                $gettoken = $commonObj->getcokkies('loginToken');
                if($getcokkies==$user->id)
                {
                    $view->with('userLoginid', $getcokkies);
                }
                else
                {
                    Auth::logout();
                    $deleteuserLoginid = $commonObj->deletecokkies('userLoginid');
                    $deleteloginToken = $commonObj->deletecokkies('loginToken');
                    return redirect('/')->withCookie($deleteuserLoginid);
                }
            }


        }
        else
        {
            $getcokkies = $commonObj->getcokkies('userLoginid');
            $login_token=$getcokkies.rand(1000,999999);
            if($getcokkies!=false)
            {
                //$updateuser = User::where('id', '=', $getcokkies)->update(array('login_token' =>$login_token));
                $getaccesstoken = $commonObj->setcokkies('loginToken',$login_token);
                Auth::loginUsingId($getcokkies);
            }
            // return redirect('/');
            $view->with('userLoginid', $getcokkies);
        }
        
    }
}