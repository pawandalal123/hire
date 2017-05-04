 
@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Courselist</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Course Management</h1>
                </div>
                      <div class="row">
                   @if(Session::has('message'))
                    <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ Session::get('message') }}
                    </div>

                    @endif

                     
                    <div class="col-md-12">
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Manage Course List</h1>
                        </div>
                         <!-- {!! Form::open(['url' => 'postIndex', 'method' => 'post', 'role' => 'form','novalidate'=>'novalidate','id'=>'validation','class'=>'form-horizontal']) !!} -->
                         <form action='' method='post' id='validation' class="form-horizontal">
                        <div class="block-fluid">                        
                                       
                            <div class="row-form clearfix">
                                <div class="col-md-3">Course Name:</div>
                                <div class="col-md-9">
                                <input name="course_name" type="text" class="form-control validate[required]" placeholder="placeholder..." value="{{@$datatoedit->course_name}}" />
                                </div>
                                @if ($errors->has('course_name')) 
                                 <div style="color:red">{{ $errors->first('course_name') }}</div> 
                                 @endif
                                </div> 
                                 <div class="row-form clearfix">
                                <div class="col-md-3">Course for:</div>
                                <div class="col-md-9">
                                <select name="coursefor">
                                  <option value="1" @if(@$datatoedit->course_for==1) selected @endif>Graduation</option>
                                  <option value="2" @if(@$datatoedit->course_for==2) selected @endif>Post Graduation</option>
                                </select>
                               
                              
                                </div>                                                               

                            <div class="footer tar">
                            @if(@$datatoedit->course_name)
                            <input class="btn btn-default" type="Submit" name="updatecourse" value="Update">
                            @else
                            <input class="btn btn-default" type="Submit" name="submitcourse" value="Submit">
                            @endif

                            </div>                            
                        </div>
                        </form>

                    </div>

                    <div class="col-md-12">                    
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($getcourselist)>0)
                           <table cellpadding="0" cellspacing="0" width="100%" class="table">
                                <thead>
                                    <tr>                                    
                                        <th width="25%">ID</th>
                                        <th width="25%">Course Name</th>
                                        <th width="25%">Course For</th>
                                        <th width="25%">Created On</th>
                                        <th width="25%">Current status</th>
                                        <th width="25%">Action</th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                {{--*/ $i=1 /*--}}
                                 {{--*/ $cousefor='graduate' /*--}}
                                @foreach($getcourselist as $getcourselist)
                                   {{--*/ $status='active' /*--}}
                                   {{--*/ $textdisplay='Make Disable' /*--}}
                                 @if($getcourselist->status==0)
                                   {{--*/ $status='deactive' /*--}}
                                   {{--*/ $textdisplay='Make Active' /*--}}
                                 @endif
                                 @if($getcourselist->course_for==2)
                                    {{--*/ $cousefor='postgraduate' /*--}}
                                 @endif
                                    <tr>                                    
                                        <td>{{$i}}</td>
                                        <td>{{$getcourselist->course_name}}</td>
                                        <td>{{$cousefor}}</td>
                                        <td>{{$getcourselist->created_at}}</td>
                                        <td>{{$status}}</td> 
                                        <td><a href="{{URL::to('/admin/courselist/'.$getcourselist->id)}}">Edit</a>  
                                        <a href="{{URL::to('changestatuscommon/'.$getcourselist->id.'/course')}}">{{$textdisplay}}</a></td>                                   
                                    </tr>
                                     {{--*/ $i++ /*--}}
                                    @endforeach()

                                </tbody>
                
                    @else
                <div class="text-center">
                  NO record found..
                </div>
                @endif
                
                </div>
              </div>
            </div>
          </div>
        </div>
 <script type="text/javascript">
  $(document).ready(function()
  {
    $("#validation").validationEngine({promptPosition : "topLeft", scroll: true});  

  });
  </script>

                @stop



           