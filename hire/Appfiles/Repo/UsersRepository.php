<?php
namespace Appfiles\Repo;
use Appfiles\Repo\UsersInterface;
use Illuminate\Container\Container as App;
use DB;
use App\User;
use App\Model\Userdetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

//echo "in here";
/**
 * User Details Repository
 */
class UsersRepository implements UsersInterface
{
	use RepositoryTrait;

	protected $model,$app;
    /**
     * User Details Repository
     */
    public function __construct(App $app)
    {
    	$this->app=$app;
    	$this->makeModel();  
    }

    

 public function all($columns = array('*')) {
       // dd('in here trait');
        return User::orderBy('id','DESC')->get($columns);
    }

public function allpaging($columns = array('*'),$paging=100) {
       // dd('in here trait');
        return User::orderBy('id','DESC')->paginate($paging);
    }


public function countTotalUsers($condition)
    {
     return  User::whereRaw($condition)->count();
     }

public function getallByBetween($condition,$wherebetween, $columns = array('*')) {
      
        return User::where($condition)->whereBetween('created_at', $wherebetween)->orderBy('id','desc')->get($columns);
    }


public function getpeoplelist($request,$columns = array('*'))
    {

        $completeformData = Input::all();
        @extract($completeformData);
        $userlist = User::select($columns);
        $wherecondition = array('status'=>1);

        $pageData =10;
        
        $userlist = $userlist->where($wherecondition);
        if($request->isdefault)
        {
          $userlist = $userlist->join('jobprefrences', 'users.id', '=', 'jobprefrences.user_id');
          $userlist = $userlist->whereRaw("profile_title != ''");

        }
       
        if(Input::has('userid'))
        {
          $userlist = $userlist->whereRaw("users.id = '".$request->userid."'");

        }
    
        if($request->keywords)
        {
          $userlist = $userlist->whereRaw("( name like '%".str_replace('-',' ',$request->keywords)."%' or middle_name like '%".str_replace('-',' ',$request->keywords)."%' or last_name like '%".str_replace('-',' ',$request->keywords)."%' )");

        }
        if($request->sort)
        {
          switch ($request->sort)
          {
            case 'desc':
              $userlist = $userlist->orderBy('users.created_at', 'desc');
              break;
            
            case 'asc':
              $userlist = $userlist->orderBy('users.created_at','asc');
              break;
          }
        }
        else
        {
         
          $userlist = $userlist->orderBy('users.created_at','desc');
       
        }
        if($request->paginate)
        {
          $userlist = $userlist->paginate($request->paginate);

        }
        else
        {
          $userlist = $userlist->paginate($pageData);
        }

        return $userlist;
    }



 public function getallBy($condition, $columns = array('*'))
    {
        return User::where($condition)->get($columns);
    }
     public function getallBylimit($condition, $columns = array('*'),$skip=false,$limit=false)
    {
        return User::where($condition)->skip($skip)
        ->take($limit)->get($columns);
    }

    public function getallByIn($array, $columns = array('*'))
    {
        return User::whereIn('id', $array)->get($columns);
    }

    public function getallByRaw($condition,$columns = array('*')) {
       // dd('in here trait');
      
        return User::whereRaw($condition)->get($columns);
    }

    public function getallByRawlimit($condition,$columns = array('*')) {
       // dd('in here trait');
      
        return User::whereRaw($condition)->take(20)->get($columns);
    }

    public function getBy($condition, $columns = array('*'))
    {
        return User::where($condition)->first($columns);
    }

    public function updateuser(array $data, $condition)
     {
      
          $Usertabs = User::where($condition)->update($data);
          return $Usertabs;
     }
      public function getList($condition,$key,$value )
      {
        return User::where($condition)->lists($key,$value)->all();
    }
    public function delete($id)
    {
        return User::destroy($id);
    }
     //////// update basci details///////
    public function updateuserdetails($request)
    {
       
        $usertableArray = array('name'=>$request->first_name,
                                'middle_name'=>$request->middle_name,
                                'last_name'=>$request->last_name,
                                'mobile'=>$request->mobile,
                                'profile_title'=>@$request->profile_title,
                                
                                 'country'=>$request->country,
                                 'state'=>$request->state,
                                 'city'=>$request->city,
                                 'pincode'=>$request->pincode,
                                 'address'=>$request->address);
        $userdetailArray = array( 'gender'=>$request->gender,
                                 'mother_name'=>$request->mothername,
                                 'father_name'=>$request->fathername,
                                 'dob'=>$request->dob,);
        if($request->file('profileimage'))
        {
            $image = $request->file('profileimage');
            // $destinationPath = 'storage/articles'; // upload path
            $destinationPath = 'uplode/profileimages/';
            $extension = $request->file('profileimage')->getClientOriginalExtension(); // getting image extension
            $fileName = 'profile_'.time().'.'.$extension; // renameing image
            $request->file('profileimage')->move($destinationPath, $fileName); // uploading file to given path
            $usertableArray['profile_image'] = $fileName;
        }
        try
        {
             $updateUser = $this->updateuser($usertableArray,array('id'=>$request->id));
            //////// check userdata in userdetail table
            $checkuserdetails = Userdetail::where(array('user_id'=>$request->id))->first(array('id'));
            if($checkuserdetails)
            {
                $upadtedetails = Userdetail::where(array('user_id'=>$request->id))->update($userdetailArray);

            }
            else
            {
                $userdetailArray['user_id'] =$request->id ;
                $userdetailArray['profile_id'] =$profile_id = rand(1000,999999) ;
                $userdetailArray['created_at'] =date('Y-m-d H:i:s') ;
                $cretedetails = Userdetail::insertGetId($userdetailArray);
            }
            Session::flash('message','Detail update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

        }
        catch(\Exception $ex)
        {
            ///throw $e;
            Session::flash('message','Some technical problem.'); 
            Session::flash('alert-class', 'danger'); 
            Session::flash('alert-title', 'error');

        }
       

    }

     public function createsubuser($request)
    {
       
        $usertableArray = array('name'=>$request->username,
                                'email'=>$request->email,
                                'mobile'=>$request->mobile,
                                'password' => bcrypt($request->password),
                                'is_register'=>1,
                                'is_subuser'=>1,
                                'status'=>1,
                                'created_by'=>$request->userid,
                                'created_at'=>1);
 
        try
        {
             $makesubuser = $this->create($usertableArray);
            //////// check userdata in userdetail table
           
            if($makesubuser)
            {
                $userdetailArray['user_id'] =$makesubuser ;
                $userdetailArray['profile_id'] =$profile_id = rand(1000,999999) ;
                $userdetailArray['created_at'] =date('Y-m-d H:i:s') ;
                $cretedetails = Userdetail::insertGetId($userdetailArray);

            }
         
            Session::flash('message','Sub user create.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

        }
        catch(\Exception $ex)
        {
          // throw $ex;
            Session::flash('message','Some technical problem.'); 
            Session::flash('alert-class', 'danger'); 
            Session::flash('alert-title', 'error');

        }
       

    }
     public function updateusersocialdetails($request)
    {
       
        $userdetailArray = array('gender'=>$request->id,
                                 'mother_name'=>$request->mothername,
                                 'father_name'=>$request->fathername,
                                 'country'=>$request->country,
                                 'state'=>$request->state,
                                 'city'=>$request->city,
                                 'pincode'=>$request->pincode,
                                 'area'=>$request->area_name);
        try
        {
            $checkuserdetails = Userdetail::where(array('user_id'=>$request->id))->first(array('id'));
            if($checkuserdetails)
            {
                $upadtedetails = Userdetail::where(array('user_id'=>$request->id))->update($userdetailArray);

            }
            else
            {
                $userdetailArray['user_id'] =$request->id ;
                $userdetailArray['created_at'] =date('Y-m-d H:i:s') ;
                $cretedetails = Userdetail::insertGetId($userdetailArray);
            }
            Session::flash('message','Detail update Successfully.'); 
            Session::flash('alert-class', 'success'); 
            Session::flash('alert-title', 'Success');

        }
        catch(\Exception $ex)
        {
            ///throw $e;
            Session::flash('message','Some technical problem.'); 
            Session::flash('alert-class', 'danger'); 
            Session::flash('alert-title', 'error');

        }
       

    }

    public function rulesForCreateuser(){
      return [
                'email' => 'required|email|unique:users',
                'name' => 'required|max:25',
                'mobile' => 'required|max:10'
                
            ];
    }
    public function rulesForediteuser(){
      return [
                
                'name' => 'required|max:25',
                'mobile' => 'required|max:10'
                
            ];
    }
     public function rulesForCreateuserMessage(){
      return [
                'email.required' => 'The field name is required',
                 'email.unique:users' => 'Must Be Unique',
                'name.max' => 'The field name may not be greater than 25 characters'
                
                
            ];
    }
     public function rulesForedituserMessage(){
      return [
               
                'name.max' => 'The field name may not be greater than 25 characters',
                'mobile.required'=>'Mobile is required'
                
                
            ];
    }
        public function rulesForfeatures(){
      return [
               
                'state'=>'required|not_in:0'
                
            ];
    }
     public function rulesForfeaturesMessage(){
      return [
                'state.required' => 'The feature is required',
                
                
                
            ];
    }

 


  function model()
    {
        return 'App\User';
    }
}
