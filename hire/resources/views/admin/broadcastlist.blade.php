@extends('layout.adminlayout')
@section('content')
<link href="{{ URL::asset('web/css/jquery.datetimepicker.css')}}" rel="stylesheet" type="text/css" /> 
 <script type='text/javascript' src="{{ URL::asset('web/js/jquery.datetimepicker.js')}}"></script>
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Broadcast</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Broadcast Management</h1>
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
                            <h1>Manage Broadcast</h1>
                        </div>
                         <!-- {!! Form::open(['url' => 'postIndex', 'method' => 'post', 'role' => 'form','novalidate'=>'novalidate','id'=>'validation','class'=>'form-horizontal']) !!} -->
                         <form action='' method='post' id='validation' class="form-horizontal">
                        <div class="block-fluid">                        
                                       
                            <div class="row-form clearfix">
                                <div class="col-md-3">Message:</div>
                                <div class="col-md-9">
                                <input name="messagedisplay" type="text" class="form-control validate[required]" placeholder="placeholder..." value="{{@$datatoedit->message}}" />
                                </div>
                                @if ($errors->has('messagedisplay')) 
                                 <div style="color:red">{{ $errors->first('messagedisplay') }}</div> 
                                 @endif
                                </div> 
                                 <div class="row-form clearfix">
                                <div class="col-md-3">Valid till:</div>
                                <div class="col-md-9">
                                <input id="validtill" name="validtill" type="text" class="form-control validate[required]" placeholder="YYY-MM-DD" value="{{@$datatoedit->display_till}}" />
                                </div>
                                @if ($errors->has('validtill')) 
                                 <div style="color:red">{{ $errors->first('validtill') }}</div> 
                                 @endif
                                </div>
                                <div class="row-form clearfix">
                                <div class="col-md-3">Message for:</div>
                                <div class="col-md-9">
                                <select class="form-control validate[required]" name="type">
                                <option  value='1' @if(@$datatoedit->type==1) selected @endif >All</option>
                                <option  value='2' @if(@$datatoedit->type==2) selected @endif>Individual</option>
                                </select>
                                <!-- <input class="selectindividual" type="hidden" name="userid"> -->
                               
                                 @if ($errors->has('useremail')) 
                                   <input class="selectindividual " type="text" name="useremail" >
                                 <div style="color:red">{{ $errors->first('useremail') }}</div> 
                                 @else
                                  <input class="selectindividual " type="text" name="useremail" value="{{@$datatoedit->email_user}}" @if(@$datatoedit->type==1) style="display: none;" @endif>
                                 @endif
                                </div> 
                                </div>


                            <div class="footer tar">
                            @if(@$datatoedit!='')
                            <input class="btn btn-default" type="Submit" name="updatemassege" value="Update">
                            @else
                            <input class="btn btn-default" type="Submit" name="submitmessage" value="Submit">
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
                        @if(count($broadcastlist)>0)
                           <table cellpadding="0" cellspacing="0" width="100%" class="table">
                                <thead>
                                    <tr>                                    
                                        <th width="25%">ID</th>
                                        <th width="25%">Message</th>
                                         <th width="25%">Valid till</th>
                                        <th width="25%">Created On</th>
                                        <th width="25%">Current status</th>
                                        <th width="25%">Action</th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                {{--*/ $i=1 /*--}}
                                @foreach($broadcastlist as $broadcastlist)
                                   {{--*/ $status='active' /*--}}
                                   {{--*/ $textdisplay='Deactivate Broadcast' /*--}}
                                 @if($broadcastlist->status==0)
                                   {{--*/ $status='deactive' /*--}}
                                   {{--*/ $textdisplay='Activate Broadcast' /*--}}
                                 @endif
                                    <tr>                                    
                                        <td>{{$i}}</td>
                                        <td>{{$broadcastlist->message}}</td>
                                         <td>{{$broadcastlist->display_till}}</td>
                                        <td>{{$broadcastlist->created_at}}</td>
                                        <td>{{$status}}</td> 
                                        <td><a href="{{URL::to('/admin/broadcast/'.$broadcastlist->id)}}">Edit</a>  
                                        <a href="{{URL::to('changestatuscommon/'.$broadcastlist->id.'/broadcast')}}">{{$textdisplay}}</a></td>                                   
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
  $('select[name=type]').change(function()
  {
    if($(this).val()==2)
    {

      $('.selectindividual').show();

    }
    else
    {
       $('.selectindividual').hide();

    }

  })
  $( ".selectindividual" ).autocomplete({
      source: SITE_URL+'/getuserlist',
      minlength: 1,
      select: function( event, ui ){
        
       $('.selectfrom').val('dropdown');
      }
  });
    $('#validtill').datetimepicker({
          yearOffset:0,
          lang:'en',
          timepicker:false,
          changeMonth: true,
          format:'Y-m-d',
          formatDate:'Y-m-d',
          


        });
    $("#validation").validationEngine({promptPosition : "topLeft", scroll: true});  

  });
  </script>

                @stop



           