@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">User</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>User Management</h1>
                </div>
                 @if(Session::has('message'))
                        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ Session::get('message') }}
                        </div>
                        {{ Session::forget('message') }}
                              @endif
                      <div class="row">
                       <div class="col-md-12">
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>Filter</h1>
                        </div>
                        <div class="block-fluid">                        

                            <div class="row-form clearfix">
                             <form action="" method="get" id="validation">
                                 <!-- <input type="hidden" name="_token" value="oOnTnGehJpV4r3tuwB6L4SFJYTp4NqPzFrxWgb8J"> -->
                                <div class="col-md-2"> 
                                <input class="form-control" maxlength="25" id="organizer_name" placeholder="name,email,mobile" name="keywords" type="text" value="">
                                  </div>
                                
                                
                               <div class="col-md-2"><select class="form-control xyz" name="type">
                                <option value="">Status</option>
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
                              </select></div>
                                
                               
                                <div class="col-md-2">
                                <input name="submit" type="submit" class="btn btn-default" value="Apply">
                                </div>
                                </form>                         
                            </div>                                                               
                        </div>
                    </div>
                    <div class="col-md-12">   

                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>All User List</h1>      
                        </div>
                        <div class="block-fluid">
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th><!-- <span>S.No</span> -->
                        Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Country</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Social Login</th>
                        <th>Registered Date</th>
                        <th>Current status</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    	@if(!empty($userarray))
                    	@foreach($userarray as $key=>$userarray)
                            {{--*/ $status='active' /*--}}
                            {{--*/ $textdisplay='Make Disable' /*--}}
                            @if($userarray['status']==0)
                            {{--*/ $status='deactive' /*--}}
                            {{--*/ $textdisplay='Make Active' /*--}}
                            @endif
	                      <tr>
	                        <td><!-- <span>{!! $counter++; !!}.</span> -->
	                        {!! $userarray['name']; !!}</td>                     
						    <td>{!! $userarray['email']; !!}</td>
						    <td>{!! $userarray['mobile']; !!}</td>
                            <td>{{$userarray['country']}}</td>
                            <td>{{$userarray['state']}}</td>
                            <td>{{$userarray['city']}}</td>
						    <td>@if($userarray['login_type']==1) Yes @else No @endif</td>
						    <td>{!! $userarray['created_at']; !!}</td>
                            <td>{{$status}}</td>
                            <td><a href="{{URL::to('updateuserstatus/'.$key.'/'.$status)}}">{{$textdisplay}}</a></td>
	                      </tr>
	                    @endforeach
	                    @endif                           
                    </tbody>
                  </table>
                <div class="text-center">
                <?php echo $dataUser->appends(Input::except('page')); ?>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     
@stop



