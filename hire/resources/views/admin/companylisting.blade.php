@extends('layout.adminlayout')
@section('content')
<div class="content">
            
            <div class="breadLine">

                <ul class="breadcrumb">
                    <li><a href="#">Admin</a> <span class="divider">></span></li>                
                    <li class="active">Company</li>
                </ul>
            </div>
            <div class="workplace">
                <div class="page-header">
                    <h1>Company Management</h1>
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
                            <h1>Company List</h1>      
                        </div>
                        <div class="block-fluid">
                        @if(count($companylist)>0)
                  <table class="table table-bordered">
                    <thead>
                        <tr class="active">
                        <th>
                        Id</th>
                        <th>Name</th>
                        <th>Website</th>
                     
                        <th>Contact</th>
                        <th>Created at</th>
                        
                        </tr>
                    </thead>
                    <tbody>
            	       {{--*/ $i=1 /*--}}
                        @foreach($companylist as $key=>$companylist)
                          
	                      <tr>
          	                        <td>{{$i}}</td>                     
          						    <td>{{$companylist['compnay_name']}}</td>
          						    <td>{{$companylist['company_website']}}</td>
                            <td>{{$companylist['contact']}}</td>
                            <td>{{$companylist['created_at']}}</td>
                            
	                      </tr>
                          {{--*/ $i++ /*--}}
                          @endforeach()
	                                            
                    </tbody>
                  </table>
                  <div class="text-center">
                <?php echo $getallcompany->render(); ?>
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



