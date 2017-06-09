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
                      <div class="row">

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
                        </tr>
                    </thead>
                    <tbody>
                    	@if(!empty($userarray))
                    	@foreach($userarray as $userarray)
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
	                      </tr>
	                    @endforeach
	                    @endif                           
                    </tbody>
                  </table>
                <div class="text-center">
                <?php echo $dataUser->render(); ?>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
     
@stop



