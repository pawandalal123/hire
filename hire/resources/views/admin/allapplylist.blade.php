@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Apply</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Apply List Management</h1>
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
                            <h1>Apply List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($allylistArray)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                    <th data-field="sr">Sr No.</th>
                    <th data-field="share">Job Title</th>
                    <th data-field="document-name">Name</th>
                    <th data-field="uploaded-date">Email</th>
                    <th data-field="detail">Ipaddress</th>
                    <th data-field="detail">Date</th>
                    <th data-field="action">Action</th>
              
                       
                        </tr>
                    </thead>
                    <tbody>
                       {{--*/ $i=1 /*--}}
                        @foreach($allylistArray as $allylistArray)
                            <tr >
                              <td>{{$i}}</td>
                              <td>{{$allylistArray['jobtitle']}}</td>
                              <td>{{$allylistArray['username']}}</td>
                              <td>{{$allylistArray['useremail']}}</td>
                              <td>
                              {{$allylistArray['ipaddress']}}
                              </td>
                              <td>
                              {{$allylistArray['date']}}
                              </td>
                              <td><a href="{{URL::to('userdetail/'.$allylistArray['userid'])}}" target="_blank">View Profile</a></td>
                            </tr>
                            {{--*/ $i++ /*--}}
                @endforeach
                         
                                                
                    </tbody>
                  </table>
                  <div class="text-center">
                <?php echo $getapplyList->appends(Input::except('page'))->render();?>
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



