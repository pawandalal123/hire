<?php 
$requestsegment = Request::segment(1);
// echo $requestsegment;
?>
 <div class="col s12 m4 l3">
      <div class="sidebar card sidebar-profile">
        <div class="card horizontal">
          <div class="card-image">
          
          @if(@$checkcompnay->compnay_logo)
          <img src="{{URL::asset($_ENV['CF_LINK'].$checkcompnay->compnay_logo)}}" alt="">
          @else
          <img src="{{URl::to('web/images/org.jpg')}}" alt="">
          @endif
           <!-- <input type="file" class="upload" title="Upload" placeholder="Upload"> -->
           </div>
          <div class="card-stacked">
            <div class="card-action"> {{ucwords($checkcompnay->compnay_name)}}</div>
           <!--  <div class="card-content"> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> </div> -->
          </div>
        </div>
            <a href="{{URL::to('companyprofile')}}" class="waves-effect waves-light btn @if($requestsegment=='companyprofile') active @endif">Company Info</a> 
            <a href="{{URL::to('postjob')}}" class="waves-effect waves-light btn @if($requestsegment=='postjob') active @endif">Post Job</a> 
            <a href="{{URL::to('joblist')}}" class="waves-effect waves-light btn @if($requestsegment=='joblist') active @endif">All Jobs</a>
             <!-- <a href="{{URL::to('applylist')}}" class="waves-effect waves-light btn @if($requestsegment=='applylist') active @endif">User Apply</a>  -->
            <a href="{{URL::to('makenews')}}" class="waves-effect waves-light btn @if($requestsegment=='makenews') active @endif">News</a>
            <a href="{{URL::to('createsubuser')}}" class="waves-effect waves-light btn @if($requestsegment=='createsubuser') active @endif">Make Subuser</a> 
            <a href="appointment.html" class="waves-effect waves-light btn">Appointment</a> 
        <!-- Modal Structure -->
        
      </div>
    </div>