<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Common;
use Appfiles\Repo\UsersInterface;
use Appfiles\Repo\DocumentsInterface;
use Appfiles\Repo\DocumentstypeInterface;
use Appfiles\Repo\DocumentsshareInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Appfiles\Common\Functions;
use Validator;
use Auth;
use URL;
use View;

class DigitallockerController extends Controller
{

	public function  __construct(UsersInterface $usersInterface,DocumentsInterface $documents,DocumentstypeInterface $documenttype,DocumentsshareInterface $docshare)
    {
        
        $this->usersInterface = $usersInterface;
        $this->documents = $documents;
        $this->documenttype = $documenttype;
        $this->docshare = $docshare;
       

    }
    /////////////////article form validation//////
       protected function validator(array $data)
    {
        $messsages = [
       
        'documettype.required'=>'Please select documettype',
        'documentfile.mimes'=>'Please select valid file'];
       

    $rules = [
        
        'documettype'=>'required|not_in:0',
        'documentfile' => 'required|mimes:jpeg,png,bmp,gif,jpg'
    ];

    return Validator::make($data, $rules,$messsages);
       
    }

    //////////////////// 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            if(isset($request->uplodedocument))
            {
                
                $validator = $this->validator($request->all());
                if ($validator->fails())
                {
                    $this->throwValidationException(
                        $request, $validator
                    );
                }
                $user = Auth::user();
                $fileName='';
                if($request->file('documentfile'))
                {
                    $image = $request->file('documentfile');
                    $destinationPath = 'uplode/documents/'; // upload path
                    $extension = $request->file('documentfile')->getClientOriginalExtension(); // getting image extension
                    $fileName = 'documentfile_'.time().'.'.$extension; // renameing image
                    $image->move($destinationPath, $fileName); // uploading file to given path
               
                    $dataArray = array('type'=>$request->documettype,
                                       'file_name'=>$fileName,
                                       'user_id'=>$user->id,
                                       'created_at'=>date('Y-m-d H:i:s'));
                    $create = $this->documents->create($dataArray);
                    if($create)
                    {
                        Session::flash('message','Documen Uplode Successfully.'); 
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
                else
                {
                    Session::flash('message','Please select a valid file to uplode.'); 
                    Session::flash('alert-class', 'danger'); 
                    Session::flash('alert-title', 'error');   

                }
            }
            ////////// get all documetns type////////
            $documenttypeArray = array();
            $doctypelist = $this->documenttype->getallBy(array('status'=>1),array('id','name'));
            foreach($doctypelist as $doctype)
            {
                $documenttypeArray[$doctype->id] = $doctype->name;

            }
            $docArray = array();
            $getdocumentList = $this->documents->getallBy(array('user_id'=>$user->id));
            if(count($getdocumentList)>0)
            {
              foreach($getdocumentList as $getdocument)
              {
                $docextension = explode('.', $getdocument->file_name);
                $docArray[$getdocument->id]  =array('id'=>$getdocument->id,
                                                    'doctype'=>'',
                                                    'docextension'=>$docextension[1],
                                                    'type'=>$getdocument->type,
                                                    'created_at'=>$getdocument->created_at);

              }


              array_walk($docArray, function(&$value, $key, $sourceArray)
              {
                 
                  if(array_key_exists($value['type'], $sourceArray))
                  {
                       $value['doctype'] = $sourceArray[$value['type']];
                  }

              },$documenttypeArray);
            }

            //////////////get share document list///////////////
            $sharelistArray = array();
            $getsharelist = $this->docshare->getallBy(array('created_by'=>$user->id));
            if($getsharelist)
            {
                foreach($getsharelist as $getsharelist)
                {
                    $docname='';
                    $getdoctype = $this->documents->getBy(array('id'=>$getsharelist->document_id),array('type','file_name'));
                    if($getdoctype)
                    {
                        $extension = explode('.', $getdoctype->file_name);
                        if(array_key_exists($getdoctype->type, $documenttypeArray))
                        {
                             $docname= $documenttypeArray[$getdoctype->type];
                        }
                        $sharelistArray[$getsharelist->id] = array('docname'=>$docname,
                                                               'extension'=>$extension[1],
                                                               'file_name'=>$getdoctype->file_name,
                                                               'sharename'=>$getsharelist->name,
                                                               'shareemail'=>$getsharelist->email,
                                                               'shared_on'=>$getsharelist->created_at);
                    }

                }
            }

            // dd($sharelistArray);
            
           
          return \View::make('web.digitallocker',compact('doctypelist','getdocumentList','sharelistArray','docArray','user'));

        }
        else
        {
            return redirect('auth/login');
        }
        
    }

public function sharedocument(Request $request)
  {
    if($request->ajax())
      {
       
        if(Auth::check())
        {
          $userlogin = Auth::user();
          ?>
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <div class="input-field">
                <label for='first_name' >Name</label>
                <input type="text" class="form-control" name='name' id='name'  value=''>
              </div>
             
              <div class="input-field">
                <label for='first_name' >Email</label>
                <input type="text" class="form-control" name='email' id='email'  value=''>
              </div>           
               <div class="text-right">
              <a  class="btn btn-success" onClick="submitsharebox

              ('<?php echo $request->id;?>');">Submit</a>
              </div>
            <?php  
            
      }

  }
}
public function deletedocument(Request $request)
{
    if($request->ajax())
    {
        $delete = $this->documents->delete($request->documentid);
        if($delete)
        {
            echo 1;

        }
        else
        {
            echo 0;
        }
    }

}

public function makesharedocument(Request $request)
{
    if($request->ajax())
    {
        $commonObj = new Common();
        $user = Auth::user();
        $dataArray = array('name'=>$request->name,
                           'email'=>$request->email,
                           'document_id'=>$request->documentid,
                           'created_by'=>$user->id,
                           'created_at'=>date('Y-m-d H:i:s'));
        $create = $this->docshare->create($dataArray);
        if($create)
        {
            $docdetails = $this->docshare->getBy(array('id'=>$request->documentid));
            $subject = 'Share document';
            $mailArray= array('to'=>$request->name,
                              'name'=>$request->email,
                              'subject'=>$subject);
            $link=URL::to('uplode/documents/'.$docdetails->file_name);
            $mailmessage='<p>Dear '.ucwords($request->name).'.</p><br/>
                          <p>Please <a href='.$link.'>check the link</a> to view the document</p>';
           
            if (filter_var($request->email, FILTER_VALIDATE_EMAIL))
            {
              try 
              {
                
                $commonObj->sendmail($mailmessage,$mailArray);
              }
              catch (\Exception $e) 
              {
                
              }
            }
            echo 1;

        }
        else
        {
            echo 0;
        }
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
}
