@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Digital Locker</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Digital Locker Management</h1>
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
                            <h1>List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($docArray)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th>
                        Id</th>
                        <th>Uplode by</th>
                        <th>Documnet type</th>
                        <th>extension</th>
                        <th>Created at</th>
                        <th>Current status</th>
                        </tr>
                    </thead>
                    <tbody>

            	      
                       {{--*/ $i=1 /*--}}
                        @foreach($docArray as $key=>$docval)
                           {{--*/ $status='active' /*--}}
                         @if($docval['status']==0)
                           {{--*/ $status='deactive' /*--}}
                         @endif
                         <tr>
                           <td>{{$i}}</td>
                           <td>{{$docval['uplode_by']}}</td>
                           <td>{{$docval['doctype']}}</td>
                           <td>{{$docval['docextension']}}</td>
                           <td>{{$docval['created_at']}}</td>
                           <td>{{$docval['status']}}</td>

                         </tr>
                          {{--*/ $i++ /*--}}
                         @endforeach()
            
	                                            
                    </tbody>
                  </table>
                  <div class="text-center">
               <?php echo $getdocumentList->render(); ?>
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



