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
dd('pawan');
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

    public function userlogin_register(Request $request)
    {
        
        $this->validate($request, [
            $this->loginUsername() => 'required|email', 'password' => 'required',
        ]);
        $path = $_SERVER['HTTP_HOST'];
        //check user exit or not//
        $checkemail =  User::where('email', '=', $request->email)->first();
        if($checkemail)
        {
          if($checkemail->is_register==0)
          {
            $updateUsers = User::where('id', '=', $checkemail->id)->update(array('password' => bcrypt($request->password),'is_register'=>1));
            Auth::loginUsingId($checkemail->id);
            $pathRedirect = $request->refferurl;
            $urlpaths = str_replace($_ENV['SITE_URL'], '', $pathRedirect);
            if($urlpaths=='/auth/login')
            {
                return redirect('/');
            }
            else
            {
                return redirect($pathRedirect);
            }

          }
          else
          {
            $throttles = $this->isUsingThrottlesLoginsTrait();
            if ($throttles && $this->hasTooManyLoginAttempts($request)) {
                return $this->sendLockoutResponse($request);
            }
            $credentials = $this->getCredentials($request);
            if (Auth::attempt($credentials, $request->has('remember')))
            {
                $pathRedirect = $request->refferurl;
                $urlpaths = str_replace($_ENV['SITE_URL'], '', $pathRedirect);
                if($urlpaths=='/auth/login')
                {
                    return redirect('/');
                }
                else
                {
                    return redirect($this->redirectTo);
                }
               //return $this->handleUserWasAuthenticated($request, $throttles);
            }
          }
           
        }
        else
        {
            Auth::loginUsingId($this->create($request->all()));
            return redirect('/');
        }

        return redirect($this->loginPath())
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
    
    }
    public function postLoginajax(Request $request)
    {
        $eventFormData = Input::all();
        @extract($eventFormData);
          // if(isset($request->requestfrom))
          // {
          //   $request->password=$password;
          // }
            $status = array();
            $errror  = array();
            if(empty($email))
            {
                if($email=='')
                {
                    $errror['email'] ='Email is required';
                }
                if($password=='')
                {
                    $errror['password'] ='Password is required';
                }
                return response()->json([
                   'error' => $errror
                   ]);
            }
            else
            {
                $credentials = $this->getCredentials($request);
                if (Auth::attempt($credentials, $request->has('remember')))
                {
                    $userData = Auth::user();
                   $imagePatah = URL::asset('web/images/profilePic.png');
                   if($userData->profile_image)
                   {
                     $imagePatah = URL::asset($_ENV['CF_LINK'].'/user/'.$userData->id.'/profile/logo/'.$userData->profile_image);
                     if($userData->login_type==1)
                     {
                       $imagePatah = $userData->profile_image;
                     }
                   }
                    $errror['auth']=true;
                    $errror['userid']=$userData->id;
                    $errror['name']=$userData->name;
                    $errror['email']=$userData->email;
                    $errror['mobile']=$userData->mobile;
                    $errror['imagePatah']=$imagePatah;
                    //return $this->handleUserWasAuthenticated($request, $throttles);
                }
                return response()->json([
                    'loginsuccess' => $errror
                   ]);
                // }
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
