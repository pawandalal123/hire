@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Discussion</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Discussion Management</h1>
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
                            <h1>Discussion Comment List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($commentsArray)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th>
                        Sr No</th>
                        <th>Comment</th>
                        <th>Comment On</th>
                        <th>Comment By</th>
                        <th>Date</th>
<th>Current status</th>
                        <th>Action</th>
                        
                        </tr>
                    </thead>
                    <tbody>
            	       {{--*/ $i=1 /*--}}
                        @foreach($commentsArray as $key=>$commentsArrayval)
                           {{--*/ $status='active' /*--}}
                           {{--*/ $textdisplay='Make Disable' /*--}}
                         @if($commentsArrayval['status']==0)
                           {{--*/ $status='deactive' /*--}}
                           {{--*/ $textdisplay='Make Active' /*--}}
                         @endif
	                      <tr>
          	                        <td>{{$i}}</td>                     
          						    <td>{{$commentsArrayval['comment']}}</td>
          						    <td>{{$commentsArrayval['commented_id']}}</td>
                            <td>{{$commentsArrayval['created_by']}}</td>
                            <td>{{$commentsArrayval['created_at']}}</td>
<td>{{$status}}</td> 
                                        <td><a href="{{URL::to('/deletecomment/'.$key)}}">Delete</a>  
                                        <a href="{{URL::to('commentstatus/'.$key)}}">{{$textdisplay}}</a></td>
                            
	                      </tr>
                          {{--*/ $i++ /*--}}
                          @endforeach()
	                                            
                    </tbody>
                  </table>
                  <div class="text-center">
                <?php echo $commentlist->render(); ?>
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



