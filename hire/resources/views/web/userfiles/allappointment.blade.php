@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1>Company Profile</h1>
      </div>
    </div>
  </div>
</section>
<div class="container user-profile">
  <div class="row">
   @include('includes.web.companyleftbar')
    <div class="col s12 m8 l9">
      <div class="col s12 m12 l12 middle-sec card user-profile">
            <h2 style="margin-bottom: 10px;">All List</h2>
             @if(Session::has('message'))
                <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ Session::get('message') }}
                {{Session::forget('message')}}
                </div>
             @endif
             
           @if(count($allappointment)>0)
           
           <table class="bordered responsive-table">
            <thead>
              <tr>
                  <th data-field="sr">Sr No.</th>
                  <th data-field="document-name">Job title</th>
                  <th data-field="uploaded-date">Job owner</th>
                  <th data-field="detail">Contact</th>
                  <th data-field="detail">Date</th>
                  <th data-field="detail">Time</th>
                  <th data-field="action">Mode</th>
                  <th data-field="action">Round</th>
                  <th data-field="share">Action</th>
                  <th data-field="share">Status</th>
              </tr>
            </thead>

            <tbody>
            {{--*/ $i=1 /*--}}
                        @foreach($allappointment as $key=>$allappointment)
                           
                <tr class="document3">
                <td>{{$i}}</td>
                <td>{{$allappointment['jobtitle']}}</td>
                <td>{{$allappointment['job_owner']}}</td>
                <td>{{$allappointment['contact_number']}}</td>
                <td>{{$allappointment['appointment_date']}}</td>
                <td>{{$allappointment['appointment_time']}}</td>
                <td>{{$allappointment['appointment_mode']}}</td>
                <td>{{$allappointment['appointment_round']}}</td>
                <td>{{$allappointment['appointment_round']}}</td>
                <td><a href="{{URL::to('editappointment/'.$key)}}">Edit</a></td>

                <td>
                
               
                </td>
                
              </tr>
              @endforeach
                                          
            </tbody>
          </table>
          <?php echo $getlist->appends(Input::except('page'))->render();?>
           @else
           <div align="center">No job found related to you.</div>
          @endif
          
           </div>
       
    
      </div>
    </div>
  </div>
</div>
@stop