@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">News</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>News Management</h1>
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
                            <h1>News List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($allnewslist)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th>
                        Id</th>
                        <th>Title</th>
                        <th>Description</th>
                       
                        <th>Created By</th>
                        <th>Created at</th>
                        <th>Current status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            	       {{--*/ $i=1 /*--}}
                        @foreach($allnewslist as $key=>$allnewsval)
                           {{--*/ $status='active' /*--}}
                           {{--*/ $textdisplay='Make Disable' /*--}}
                         @if($allnewsval['status']==0)
                           {{--*/ $status='deactive' /*--}}
                           {{--*/ $textdisplay='Make Active' /*--}}
                         @endif
	                      <tr>
	                        <td>{{$i}}</td>                     
						    <td>{{$allnewsval['title']}}</td>
						    <td>{{$allnewsval['description']}}</td>
						    
                            <td>{{$allnewsval['created_by']}}</td>
                            <td>{{$allnewsval['created_at']}}</td>
                            <td>{{$status}}</td> 
                                        <td><a href="{{URL::to('/deletenews/'.$key)}}">Delete</a>  
                                        <a href="{{URL::to('newsstatus/'.$key)}}">{{$textdisplay}}</a></td>
	                      </tr>
                          {{--*/ $i++ /*--}}
                          @endforeach()
	                                            
                    </tbody>
                  </table>
                  <div class="text-center">
                <?php echo $getnewslist->render(); ?>
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



