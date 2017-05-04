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
              <a class="waves-effect active" href="#jobPosted">Current Jobs</a></li>
              <li class="tab col s6 m6 l6">
              <a class="waves-effect " href="#create-a-Job">Past Jobs</a></li>
              <!-- <div class="indicator" style="right: 0.671875px; left: 214.328px;"></div>
            <div class="indicator" style="right: 0.671875px; left: 214.328px;"></div> -->
            </ul>
          </div>
          <div id="jobPosted" class="col s12 tab-content" style="display: block;">
          @if(count($activejobarray)>0)
          @foreach($activejobarray as $jobs)
            <div class="company-job-box article-box">
              <div class="col s12 m12 l12"> <span class="job-title">{{substr(ucwords($jobs['jobtitle']),0,30)}}</span> <!-- <span>Secure Meters Ltd.</span> --> <span class="job-exp">{{$jobs['experience']}}</span> <span class="job-loc">@if($jobs['city']!='') {{$jobs['city']}},   @endif @if($jobs['state']!='') {{$jobs['state']}},   @endif @if($jobs['country']!='') {{$jobs['country']}} @endif</span>
                <table>
                  <tbody>
                    <tr>
                      <td>Keyskills :</td>
                      <td>{{$jobs['skill']}}</td>
                    </tr>
                    <tr>
                      <td>Supporting kills :</td>
                      <td>{{$jobs['job_quality']}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="company-list-footer"> <span class="start-mark"><i class="material-icons dp48">star</i></span> <span class="exp-salary"><img src="{{URL::to('web/images/rupee.png')}}" alt="">
               @if($jobs['salary']) 
               {{$jobs['salary']}} P.A
               @endif
             </span> <span class="job-postby"><a href="{{URL::to('postjob?editid='.$jobs['jobid'])}}" class="waves-effect waves-light btn"><i class="material-icons dp48"><i class="material-icons dp48">mode_edit</i></i></a> 
              <a href="{{URL::to('deletejob/'.$jobs['jobid'])}}" class="waves-effect waves-light btn del"><i class="material-icons dp48"><i class="material-icons dp48">delete</i></i></a> 
              <a href="{{URL::to('jobdetail/'.$jobs['jobid'])}}" class="waves-effect waves-light btn">View</a>
              <a href="{{URL::to('applylist/'.$jobs['jobid'])}}" class="waves-effect waves-light btn">Recomnded</a></span> </div>
            </div>
            @endforeach()
           
            <?php echo $joblist->render();?>
            @else
            <div class="text-center">No active jobW found......</div> 
             @endif
          </div>
          <div id="create-a-Job" class="col s12 tab-content" style="display: none;" >
        
             @if(count($pastjobarray)>0)
          @foreach($pastjobarray as $jobs)
                  <div class="company-job-box article-box">
              <div class="col s12 m12 l12"> <span class="job-title">{{substr(ucwords($jobs['jobtitle']),0,30)}}</span> <!-- <span>Secure Meters Ltd.</span> --> <span class="job-exp">{{$jobs['experience']}}</span> <span class="job-loc">@if($jobs['city']!='') {{$jobs['city']}},   @endif @if($jobs['state']!='') {{$jobs['state']}},   @endif @if($jobs['country']!='') {{$jobs['country']}} @endif</span>
                <table>
                  <tbody>
                    <tr>
                      <td>Keyskills :</td>
                      <td>{{$jobs['skill']}}</td>
                    </tr>
                    <tr>
                      <td>Supporting kills :</td>
                      <td>{{$jobs['job_quality']}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="company-list-footer"> <span class="start-mark"><i class="material-icons dp48">star</i></span> <span class="exp-salary"><img src="{{URL::to('web/images/rupee.png')}}" alt="">
               @if($jobs['salary']) 
               {{$jobs['salary']}} P.A
               @endif
             </span> <span class="job-postby"><a href="{{URL::to('postjob?editid='.$jobs['jobid'])}}" class="waves-effect waves-light btn"><i class="material-icons dp48"><i class="material-icons dp48">mode_edit</i></i></a> 
              <a href="{{URL::to('deletejob/'.$jobs['jobid'])}}" class="waves-effect waves-light btn del"><i class="material-icons dp48"><i class="material-icons dp48">delete</i></i></a> 
              <a href="{{URL::to('jobdetail/'.$jobs['jobid'])}}" class="waves-effect waves-light btn">View</a>
              <a href="{{URL::to('applylist/'.$jobs['jobid'])}}" class="waves-effect waves-light btn">Recomnded</a></span> </div>
            </div>
            @endforeach()
           
            <?php echo $pastjoblist->render();?>
            @else
            <div class="text-center">No past job found......</div> 
             @endif
          </div>
          </div>
       
    </div>
  </div>
</div>
@stop
