 
@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Industry</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Industry Management</h1>
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
                            <h1>Manage Industry</h1>
                        </div>
                         <!-- {!! Form::open(['url' => 'postIndex', 'method' => 'post', 'role' => 'form','novalidate'=>'novalidate','id'=>'validation','class'=>'form-horizontal']) !!} -->
                         <form action='' method='post' id='validation' class="form-horizontal">
                        <div class="block-fluid">                        
                                       
                            <div class="row-form clearfix">
                                <div class="col-md-3">Industry Name:</div>
                                <div class="col-md-9">
                                <input name="industryname" type="text" class="form-control validate[required]" placeholder="placeholder..." value="{{@$datatoedit->name}}" />
                                </div>
                                @if ($errors->has('industryname')) 
                                 <div style="color:red">{{ $errors->first('industryname') }}</div> 
                                 @endif
                                </div>                                                               

                            <div class="footer tar">
                            @if(@$datatoedit->board_name)
                            <input class="btn btn-default" type="Submit" name="updateboard" value="Update">
                            @else
                            <input class="btn btn-default" type="Submit" name="submitboard" value="Submit">
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
                        @if(count($industrylist)>0)
                           <table cellpadding="0" cellspacing="0" width="100%" class="table">
                                <thead>
                                    <tr>                                    
                                        <th width="25%">ID</th>
                                        <th width="25%">Industry Name</th>
                                        <th width="25%">Created On</th>
                                        <th width="25%">Current status</th>
                                        <th width="25%">Action</th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                {{--*/ $i=1 /*--}}
                                @foreach($industrylist as $industrylist)
                                   {{--*/ $status='active' /*--}}
                                   {{--*/ $textdisplay='Make Disable' /*--}}
                                 @if($industrylist->status==0)
                                   {{--*/ $status='deactive' /*--}}
                                   {{--*/ $textdisplay='Make Active' /*--}}
                                 @endif
                                    <tr>                                    
                                        <td>{{$i}}</td>
                                        <td>{{$industrylist->name}}</td>
                                        <td>{{$industrylist->created_at}}</td>
                                        <td>{{$status}}</td> 
                                        <td><a href="{{URL::to('/admin/industrylist/'.$industrylist->id)}}">Edit</a>  
                                        <a href="{{URL::to('changestatuscommon/'.$industrylist->id.'/industry')}}">{{$textdisplay}}</a></td>                                   
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



           