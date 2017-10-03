@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Report Incorrect</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Report Incorrect Management</h1>
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
                            <h1>Report Incorrect List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($reportincorrectlist)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th>
                        Id</th>
                        <th>Name</th>
                        <th>Email</th>
                     
                        <th>Message</th>
                        <th>Report Type</th>
                        <th>Created at</th>
                        
                        </tr>
                    </thead>
                    <tbody>
            	       {{--*/ $i=1 /*--}}
                        @foreach($reportincorrectlist as $key=>$reportincorrecval)
                          
	                      <tr>
          	                        <td>{{$i}}</td>                     
          						    <td>{{$reportincorrecval['email']}}</td>
          						    <td>{{$reportincorrecval['mobile']}}</td>
                            <td>{{$reportincorrecval['message']}}</td>
                             <td>{{$reportincorrecval['type']}}</td>
                              <td>{{$reportincorrecval['reportfor']}}</td>
                            <td>{{$reportincorrecval['created_at']}}</td>
                            
	                      </tr>
                          {{--*/ $i++ /*--}}
                          @endforeach()
	                                            
                    </tbody>
                  </table>
                  <div class="text-center">
                <?php echo $allreportlist->render(); ?>
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



