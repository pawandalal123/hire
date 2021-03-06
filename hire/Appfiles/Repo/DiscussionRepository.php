<?php
namespace Appfiles\Repo;
use Illuminate\Container\Container as App;
use App\Model\Discussion;
use Auth;
use App\Model\Common;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Validator;

class DiscussionRepository implements DiscussionsInterface
{
	use RepositoryTrait;
  // use ValidationTrait;
	protected $model,$app;
    
    public function __construct(App $app)
    {
  
    	$this->app=$app;
    	$this->makeModel();  
    }
    

    public function getallBy($condition, $columns = array('*'))
    {
        return Discussion::where($condition)->get($columns);
    }
     public function getallpaginate($condition, $columns = array('*'))
    {
        return Discussion::select($columns)->where($condition)->paginate(15);
    }
    public function getBy($condition, $columns = array('*')) {

        return Discussion::where($condition)->first($columns);
    }
    public function getByraw($condition, $columns = array('*'),$order) {

        return Discussion::whereRaw($condition)->orderBy('id',$order)->first($columns);
    }
      public function getallByRaw($condition, $columns = array('*'),$take=false)
    {
        if($take)
        {
            return Discussion::whereRaw($condition)->orderBy('id','desc')->take($take)->get($columns);

        }
        else
        {
            return Discussion::whereRaw($condition)->get($columns);

        }
    }


    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */

    public function update(array $data, $condition)
     {
      
          $Discussion = Discussion::where($condition)->update($data);
          return $Discussion;
     }
    
	 public function getList($condition,$key,$value ) {
        return Discussion::where($condition)->lists($key,$value);
    }
    public function discussionlist($request,$columns = array('*'))
    {

        $completeformData = Input::all();
        @extract($completeformData);
        $discussionlist = Discussion::select($columns);
        $pageData =6;
        $wherecondition = array('status'=>1);
        if($request->showall==1)
        {
          $wherecondition = array();

        }
         
        $discussionlist = $discussionlist->where($wherecondition);
        if(Input::has('idnotin'))
        {
          $discussionlist = $discussionlist->whereRaw("event_id != '".$request->idnotin."'");

        }
        if($request->userid)
        {
          $discussionlist = $discussionlist->whereRaw("user_id = '".$request->userid."'");

        }
   
        if($request->keywords)
        {
          $discussionlist = $discussionlist->whereRaw("( title like '%".str_replace('-',' ',$request->keywords)."%')");

        }
        if($request->paginate)
        {
          if($request->paginate=='all')
          {
             $discussionlist = $discussionlist->take(5)->get();

          }
          else
          {
            $discussionlist = $discussionlist->paginate($request->paginate);

          }

        }

        else
        {
          $discussionlist = $discussionlist->paginate($pageData);
        }

        return $discussionlist;
    }

     public function saveform($request)
     {
        $user = Auth::user();
        $CommonObj = new Common();
        $titleurl = $CommonObj->cleanURL($request->title);
        $dataArray = array('title'=>$request->title,
                           'short_desc'=>$request->short_desc,
                           'tags'=>$request->tags,
                           'description'=>$request->description,
                           'discussion_url'=>$titleurl,
                           'status'=>1,
                           'user_id'=>$user->id,
                           'created_at'=>date('Y-m-d H:i:s'));
        if($request->editid)
        {
            unset($dataArray['created_at']);
            
            $create = $this->update($dataArray,array('id'=>$request->editid));
            $message='Update';
        }
        else
        {
            $create = $this->create($dataArray);
            $message='Your Discussion has now been posted , check your profile to manage all your Discussions';
        }
        if($create)
        {
            Session::flash('message',''.$message.' Successfully.'); 
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

       public function deletearticle($id) {
        return Discussion::destroy($id);
    }


        function model()
    {
        return 'App\Model\Discussion';
    }
}
