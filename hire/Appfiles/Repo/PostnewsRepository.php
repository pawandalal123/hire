<?php
namespace Appfiles\Repo;
use App\Http\Requests;
use Illuminate\Http\Request;
use Appfiles\Repo\PostnewsInterface;
use Illuminate\Container\Container as App;
use App\Model\Post_news;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Model\Common;
use Illuminate\Support\Facades\Session;


class PostnewsRepository implements PostnewsInterface
{

	use RepositoryTrait;

	protected $model,$app;
    /**
     * Order Details Repository
     */
    public function __construct(App $app)
    {
  
    	$this->app=$app;
    	$this->makeModel();  
    }

    public function getBy($condition, $columns = array('*')) {

        return Post_news::where($condition)->first($columns);
    }
    public function getByraw($condition, $columns = array('*'),$order) {

        return Post_news::whereRaw($condition)->orderBy('id',$order)->first($columns);
    }
    
    public function getallBy($condition, $columns = array('*'))
    {
        return Post_news::where($condition)->get($columns);
    }
    public function getallByRaw($condition, $columns = array('*'),$take=false)
    {
        if($take)
        {
            return Post_news::whereRaw($condition)->orderBy('id','desc')->take($take)->get($columns);

        }
        else
        {
            return Post_news::whereRaw($condition)->get($columns);

        }
    }
    public function getallpaginate($condition, $columns = array('*'))
    {
        return Post_news::select($columns)->where($condition)->paginate(15);
    }
     public function deletearticle($id) {
        return Post_news::destroy($id);
    }
    public function getnewslist($request,$columns = array('*'))
    {

        $completeformData = Input::all();
        @extract($completeformData);
        $articleList = Post_news::select($columns);
        $pageData =1;
        $wherecondition = array('status'=>1);
         
        $articleList = $articleList->where($wherecondition);
        if(Input::has('idnotin'))
        {
          $articleList = $articleList->whereRaw("event_id != '".$request->idnotin."'");

        }
       
        if(Input::has('userid'))
        {
          $articleList = $articleList->whereRaw("user_id = '".$request->userid."'");

        }
        
        if($request->keyword)
        {
          $articleList = $articleList->whereRaw("( title like '%".str_replace('-',' ',$request->keyword)."%')");

        }
        if($request->sort)
        {
          switch ($request->sort)
          {
            case 'desc':
              $articleList = $articleList->orderBy('created_at', 'desc');
              break;
            
            case 'asc':
              $articleList = $articleList->orderBy('created_at','asc');
              break;
          }
        }
        else
        {
         
          $articleList = $articleList->orderBy('created_at','desc');
       
        }
        if($request->paginate)
        {
          if($request->paginate=='all')
        {
           $articleList = $articleList->take(5)->get();

        }
        else
        {
          
          $articleList = $articleList->paginate($request->paginate);
        }

        }
        
        else
        {
          $articleList = $articleList->paginate($pageData);
        }

        return $articleList;
    }

    public function update(array $data, $condition) {
        return Post_news::where($condition)->update($data);
    }
    
     public function all($columns = array('*')) {
       // dd('in here trait');
        return Post_news::orderBy('id','DESC')->get($columns);
    }
     /////////////////article form validation//////
    public function validator()
    {
        return  [
        'title.required'=>'You cant leave title field empty',
       
        'articlefile.mimes'=>'Please select valid file'];
    

    }
    public function validatemassege()
    {
        return [
        'title'=>'required|max:255',
        'articlefile' => 'mimes:jpeg,png,bmp,gif,jpg'
           ];
    }
   
  public function savepostnews($request)
  {
  
    $user = Auth::user();
    $fileName='';
    if($request->file('articlefile'))
    {
        $image = $request->file('articlefile');
        // $destinationPath = 'storage/articles'; // upload path
        $destinationPath = 'uplode/articles/';
        $extension = $request->file('articlefile')->getClientOriginalExtension(); // getting image extension
        $fileName = 'article_'.time().'.'.$extension; // renameing image
        $request->file('articlefile')->move($destinationPath, $fileName); // uploading file to given path
    }
    $CommonObj = new Common();
    $titleurl = $CommonObj->cleanURL($request->title);
    $dataArray = array('title'=>$request->title,
                       'description'=>$request->description,
                       'company_id'=>$request->company_id,
                       'news_image'=>$fileName,
                       'news_url'=>$titleurl,
                       'user_id'=>$user->id,
                       'created_at'=>date('Y-m-d H:i:s'));
    if($request->editid)
    {
        unset($dataArray['created_at']);
        if($fileName=='')
        {
            unset($dataArray['news_image']);
        }
        $article = $this->update($dataArray,array('id'=>$request->editid));
        $message='Update';

    }
    else
    {
        $article = $this->create($dataArray);
        $message='Create';
    }
    
    if($article)
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

  function model()
    {
        return 'App\Model\Post_news';
    }
   
	

              /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    


}
