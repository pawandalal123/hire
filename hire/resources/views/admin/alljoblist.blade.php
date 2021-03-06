@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Job</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Job Management</h1>
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
                            <h1>Job List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($alljoblist)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th>
                        Id</th>
                        <th>Company Hiring</th>
                        <th>Openings</th>
                       
                        <th>Created By</th>
                        <th>Created at</th>
                       
                        </tr>
                    </thead>
                    <tbody>
            	       {{--*/ $i=1 /*--}}
                        @foreach($alljoblist as $key=>$alljobval)
                     
	                      <tr>
	                        <td>{{$i}}</td>                     
						    <td>{{$alljobval['compnay_hiring']}}</td>
						    <td>{{$alljobval['openings']}}</td>
						    
                            <td>{{$alljobval['created_by']}}</td>
                            <td>{{$alljobval['created_at']}}</td>
                            
                                        
	                      </tr>
                          {{--*/ $i++ /*--}}
                          @endforeach()
	                                            
                    </tbody>
                  </table>
                  <div class="text-center">
                <?php echo $getjoblist->render(); ?>
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



