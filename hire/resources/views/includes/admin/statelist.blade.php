               
<script type="text/javascript">
  $(document).ready(function()
  {
    $("#validation").validationEngine({promptPosition : "topLeft", scroll: true});  

  });
  </script> <div class="row">
  @if(Session::has('message'))
                                <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ Session::get('message') }}
                                </div>
                               
                              @endif
                    <div class="col-md-12">
                        <div class="head clearfix">
                            <div class="isw-documents"></div>
                            <h1>Text fields</h1>
                        </div>
                       <form action='' method='post' id='validation' class="form-horizontal">
                        <div class="block-fluid">                        
                            <div class="row-form clearfix">
                                <div class="col-md-3">Select Country:</div>
                                <div class="col-md-9">
                                <select name="country" class="form-control validate[required]">
                                            <option value="">choose a option...</option>
                                            @if(count($dataCuntry)>0)
                                              @foreach($dataCuntry as $dataCuntry)
                                               {{--*/ $selected='' /*--}}
                                               @if(@$datatoedit->country_id==$dataCuntry->id)
                                               {{--*/ $selected='selected' /*--}}
                                               @endif()
                                               <option value="{{$dataCuntry->id}}" {{$selected}}>{{ucwords($dataCuntry->country)}}</option>
                                              @endforeach()
                                            @endif
                                    </select>
                                </div>
                                @if ($errors->has('country')) 
                                 <div style="color:red">{{ $errors->first('country') }}</div> 
                                 @endif
                            </div>  
                            <div class="row-form clearfix">
                                <div class="col-md-3">state:</div>
                                <div class="col-md-9">
                                <input type="text" name="state" class="form-control validate[required]" placeholder="placeholder..." value="{{@$datatoedit->state}}" /></div>
                                @if ($errors->has('state')) 
                                 <div style="color:red">{{ $errors->first('state') }}</div> 
                                 @endif
                            </div>                                                              

                            <div class="footer tar">
                             @if(@$datatoedit->state)
                              <input type="submit" name="updatestate" value="Update" class="btn btn-default">
                             @else
                                <input type="submit" name="submitstate" value="submit" class="btn btn-default">
                                @endif
                            </div>                            
                        </div>
                        </form>

                    </div>
                </div>
                @if(count($dataState)>0)
                  <div class="row">

                    <div class="col-md-12">                    
                       
                        <div class="block-fluid">
                            <table cellpadding="0" cellspacing="0" width="100%" class="table">
                                <thead>
                                    <tr>                                    
                                        <th width="25%">ID</th>
                                        <th width="25%">State</th>
                                        <th width="25%">Country</th>
                                        <th width="25%">Created On</th>
                                        <th width="25%">Current status</th>
                                        <th width="25%">Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                   {{--*/ $i=1 /*--}}
                                @foreach($dataState as $dataState)
                                   {{--*/ $status='active' /*--}}
                                   {{--*/ $textdisplay='Make Disable' /*--}}
                                 @if($dataState->status==0)
                                   {{--*/ $status='deactive' /*--}}
                                   {{--*/ $textdisplay='Make Active' /*--}}
                                 @endif
                                    <tr>                                    
                                        <td>{{$i}}</td>
                                         <td>{{$dataState->state}}</td>
                                        <td>{{$dataState->country}}</td>
                                        <td>{{$dataState->created_at}}</td>
                                        <td>{{$status}}</td> 
                                        <td><a href="{{URL::to('/admin/location/state/'.$dataState->id)}}">Edit</a>  
                                        <a href="{{URL::to('locationstatus/state/'.$dataState->id)}}">{{$textdisplay}}</a></td>                                   
                                    </tr>
                                     {{--*/ $i++ /*--}}
                                    @endforeach()
                                                               
                                </tbody>
                            </table>
                        </div>
                    </div>                                

                </div>
                @endif



           