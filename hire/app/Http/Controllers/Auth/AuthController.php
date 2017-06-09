<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Model\Userdetail;
use App\Model\Common;
use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Cookie;
use URL;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;
// adding default redirect path if not set
    protected $redirectTo='/';
    private $socialite;
    private $auth;
    private $users;

    public function __construct(Guard $auth,Socialite $socialite )
    {
         $this->middleware('guest', ['except' => 'getLogout']);
         $this->auth = $auth;
         $this->socialite=$socialite;
    }

        /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }
     public function getSocialAuth($provider=null)
     {
         if(!config("services.$provider")) abort('404'); 
         //just to handle providers that doesn't exist
         return $this->socialite->with($provider)->redirect();
     }
     public function getSocialAuthCallback($provider=null)
     {
        if($user = $this->socialite->with($provider)->user())
        {
           $this->finduser($user ,$provider );
           return redirect($this->loginPath());
        }
        else
        {
           return 'something went wrong';
        }
     }
     public function finduser($userData , $provider)
     {
        $checkemail =  User::where('email', '=', $userData->email)->first();
        if(!$checkemail)
        {
            try
            {
                $usercreate = new user();
                $usercreate->name = $userData->name;
                $usercreate->email = $userData->email;
                $usercreate->password = bcrypt($userData->email);
                $usercreate->profile_image = $userData->avatar;
                switch ($provider)
                {
                    case 'facebook':
                    $usercreate->facebook_id = $userData->id;
                    break;
                    case 'google':
                    $usercreate->googleplus_id = $userData->id;
                    break;
                }
                $usercreate->login_type = 1;
                $usercreate->save();
                $insertUserId  = $usercreate->id;
                if($usercreate)
                { 
                    $profileId = rand(1000,999999);
                    $uniqName =explode('@', $userData->email);
                    $lastInsertedId= $usercreate->id;
                    $UersDetail =  new Userdetail();
                    $UersDetail->user_id=$lastInsertedId;
                    $UersDetail->profile_id=$profileId;
                    $UersDetail->profile_url=$profileId;
                    $UersDetail->save();
                }
                Auth::loginUsingId($insertUserId);
            }
            catch(Exception $ex)
            {
                throw $e;
            }
            
        }
        else
        {
            Auth::loginUsingId($checkemail->id);
            return redirect($this->loginPath());
        }
         
     }


 
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
     protected function create(array $data)
    {
       // $ipaddress = $_SERVER['REMOTE_ADDR'];
       $ipaddress = '125.63.90.66';
       $commonObj = new Common();
       $getlocation = $commonObj->getuserlocation($ipaddress);
       // dd($getlocation);
        $Makeuser =  User::insertGetId([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'first_login' =>1,
            'country' =>@$getlocation['country'],
            'city' =>@$getlocation['city'],
            'state' =>@$getlocation['state'],
            'looking_for_job' =>1,
            'is_register'=>1]);
        if($Makeuser)
        {
            $profile_id = rand(1000,999999);
            $uniqName =explode('@', $data['email']);
            $lastInsertedId= $Makeuser;
            $UersDetail =  new Userdetail();
            $UersDetail->user_id=$lastInsertedId;
            $UersDetail->profile_id=$profile_id;
            $UersDetail->profile_url=$profile_id;
            $UersDetail->save();
           return $Makeuser;
 
        }

    }
    public function getLogout()
    {
       Auth::logout();
       $commonObj = new Common();
       $name='userLoginid';
       $getcokkies = $commonObj->getcokkies('userLoginid');
       $cookie='';
       if($getcokkies!=false)
       {
          $cookie = $commonObj->deletecokkies('userLoginid');
       }
       
      return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/')->withCookie($cookie);
    }
}
