@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Appointment</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Appointment Management</h1>
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
                            <div class="isw-grid"></div>
                            <h1>Appointment List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($allappointment)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th>
                        Id</th>
                        <th>Job title</th>
                        <th>Job owner</th>
                     
                        <th>Appointment date</th>
                        <th>Created at</th>
                        
                        </tr>
                    </thead>
                    <tbody>
            	       {{--*/ $i=1 /*--}}
                        @foreach($allappointment as $allappointment)
                          
	                      <tr>
          	                        <td>{{$i}}</td>                     
          						    <td>{{$allappointment['jobtitle']}}</td>
          						    <td>{{$allappointment['job_owner']}}</td>
                            <td>{{$allappointment['appointment_date']}}</td>
                            <td>{{$allappointment['created_at']}}</td>
                            
	                      </tr>
                          {{--*/ $i++ /*--}}
                          @endforeach()
	                                            
                    </tbody>
                  </table>
                  <div class="text-center">
                <?php echo $getlist->render(); ?>
                </div>
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
     
@stop



