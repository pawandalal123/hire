@extends('layout.adminlayout')
@section('content')

  <div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Location</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Sub course Management</h1>
                </div> 
<script type="text/javascript">
  $(document).ready(function()
  {
    $("#validation").validationEngine({promptPosition : "topLeft", scroll: true});  

  });
  </script> <div class="row">
  @if(Session::has('message'))
                                <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ Session::get('message') }}
                                </div>
                               
                              @endif
                    <div class="col-md-12">
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Text fields</h1>
                        </div>
                       <form action='' method='post' id='validation' class="form-horizontal">
                        <div class="block-fluid">                        
                            <div class="row-form clearfix">
                                <div class="col-md-3">Select Course:</div>
                                <div class="col-md-9">
                                <select name="course_id" class="form-control validate[required]">
                                            <option value="">choose a option...</option>
                                            @if(count($couselitarray)>0)
                                              @foreach($couselitarray as $key=>$val)
                                               {{--*/ $selected='' /*--}}
                                               @if(@$datatoedit->course_id==$key)
                                               {{--*/ $selected='selected' /*--}}
                                               @endif()
                                               <option value="{{$key}}" {{$selected}}>{{ucwords($val)}}</option>
                                              @endforeach()
                                            @endif
                                    </select>
                                </div>
                                @if ($errors->has('course_id')) 
                                 <div style="color:red">{{ $errors->first('course_id') }}</div> 
                                 @endif
                            </div>  
                            <div class="row-form clearfix">
                                <div class="col-md-3">Sub course:</div>
                                <div class="col-md-9">
                                <input type="text" name="subcourse" class="form-control validate[required]" placeholder="placeholder..." value="{{@$datatoedit->sub_course_name}}" /></div>
                                @if ($errors->has('subcourse')) 
                                 <div style="color:red">{{ $errors->first('subcourse') }}</div> 
                                 @endif
                            </div>                                                              

                            <div class="footer tar">
                             @if(@$datatoedit->state)
                              <input type="submit" name="updatestate" value="Update" class="btn btn-default">
                             @else
                                <input type="submit" name="submitsubcourse" value="submit" class="btn btn-default">
                                @endif
                            </div>                            
                        </div>
                        </form>

                    </div>
                </div>
                @if(count($datasubcourse)>0)
                  <div class="row">

                    <div class="col-md-12">                    
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>Simple table</h1>      
                            <ul class="buttons">
                                <li><a href="#" class="isw-download"></a></li>                                                        
                                <li><a href="#" class="isw-attachment"></a></li>
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-plus"></span> New document</a></li>
                                        <li><a href="#"><span class="isw-edit"></span> Edit</a></li>
                                        <li><a href="#"><span class="isw-delete"></span> Delete</a></li>
                                    </ul>
                                </li>
                            </ul>                        
                        </div>
                        <div class="block-fluid">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table">
                                <thead>
                                    <tr>                                    
                                        <th width="25%">ID</th>
                                        <th width="25%">Sub course</th>
                                        <th width="25%">Course</th>
                                        <th width="25%">Created On</th>
                                        <th width="25%">Current status</th>
                                        <th width="25%">Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                   {{--*/ $i=1 /*--}}
                                @foreach($datasubcourse as $datasubcourse)
                                   {{--*/ $status='active' /*--}}
                                   {{--*/ $textdisplay='Make Disable' /*--}}
                                 @if($datasubcourse->status==0)
                                   {{--*/ $status='deactive' /*--}}
                                   {{--*/ $textdisplay='Make Active' /*--}}
                                 @endif
                                    <tr>                                    
                                        <td>{{$i}}</td>
                                         <td>{{$datasubcourse->sub_course_name}}</td>
                                        <td>{{$datasubcourse->forcourse}}</td>
                                        <td>{{$datasubcourse->created_at}}</td>
                                        <td>{{$status}}</td> 
                                        <td><a href="{{URL::to('/admin/subcourselist/'.$datasubcourse->id)}}">Edit</a>  
                                        <a href="{{URL::to('changestatuscommon/'.$datasubcourse->id.'/subcourse')}}">{{$textdisplay}}</a></td>                                   
                                    </tr>
                                     {{--*/ $i++ /*--}}
                                    @endforeach()
                                                               
                                </tbody>
                            </table>
                        </div>
                    </div>                                

                </div>
                @endif

                 </div>
</div> 
@stop



           