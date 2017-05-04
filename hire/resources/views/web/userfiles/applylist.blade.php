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
      <div class="col s12 m12 l12 middle-sec card user-profile company-page-tab">
          <div class="col s12">
            <ul class="tabs row">
              <li class="tab col s6 m6 l6">
              <a class="waves-effect active" href="#jobPosted">Recomded Users</a></li>
              <li class="tab col s6 m6 l6">
              <a class="waves-effect" href="#create-a-Job">All Apply List</a></li>
              <!-- <div class="indicator" style="right: 0.671875px; left: 214.328px;"></div>
            <div class="indicator" style="right: 0.671875px; left: 214.328px;"></div> -->
            <div class="indicator" style="right: 413px; left: 0px;"></div></ul>
          </div>
          <div id="jobPosted" class="col s12 tab-content" style="display: block;">
                                @if(count($recomendedArray)>0)
             <table class="bordered responsive-table">
              <thead>
                <tr>
                    <th data-field="sr">Sr No.</th>
                    
                    <th data-field="document-name">Name</th>
                    <th data-field="uploaded-date">Email</th>
                    <th data-field="detail">Skills</th>
                    <th data-field="detail">Extra skills</th>
                    <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
              {{--*/ $i=1  /*--}}
              @foreach($recomendedArray as $recomendedArray)
                <tr class="document3">
                  <td>{{$i}}</td>
                  <td>{{$recomendedArray['username']}}</td>
                  <td>{{$recomendedArray['useremail']}}</td>
                  <td>
                  {{$recomendedArray['skills']}}
                  </td>
                  <td>
                  {{$recomendedArray['extra_skills']}}
                  </td>
                  <td><a href="URL::to('userdetail/'.$recomendedArray['userid'])" target="_blank">View Profile</a></td>
                </tr>
                {{--*/ $i++ /*--}}
                @endforeach
                         <?php echo $getrecomndedlist->appends(Input::except('page'))->render();?>
                            
            </tbody>
          </table>
           @else
           <div align="center">No Record Found.</div>
          @endif 
                       
                                  </div>
          <div id="create-a-Job" class="col s12 tab-content" style="display: none;">
        
                          @if(count($allylistArray)>0)
             <table class="bordered responsive-table">
              <thead>
                <tr>
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
              {{--*/ $i=1  /*--}}
              @foreach($allylistArray as $allylistArray)
                <tr class="document3">
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
                         <?php echo $getapplyList->appends(Input::except('page'))->render();?>
                            
            </tbody>
          </table>
           @else
           <div align="center">No Record Found.</div>
          @endif 
                       </div>
          </div>
       
    </div>
   
  </div>
</div>
@stop
