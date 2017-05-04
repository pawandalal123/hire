@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m5 l5">
          <div class="card horizontal">
            <div class="card-image">
            @if($compnay->compnay_logo)
              <img src="{{$_ENV['CF_LINK'].$compnay->compnay_logo}}" alt="" style="height: 150px;">
              @endif
            </div>
            <div class="card-stacked">
              <div class="card-action">
                {{ ucwords($checkjob->jobtitle)}}
              </div>
              <div class="card-content">
                <p>{{ ucwords($checkjob->compnay_hiring)}} Location {{$details['city']}}, {{$details['country']}}</p>
                <span>Posted 2 weeks ago </span> 
              </div>
            </div>
          </div>
      </div>
      <div class="col s12 m6 l7 job-view-btn">
        <a class="waves-effect btn">{{$details['viewcount']}} Views</a>
         @if($details['loginrequired']=='yes')
        <a class="waves-effect waves-light btn userFollow" href="javascript:void(0)" onclick="loginbox()">Bookmark</a>
        @else
        @if($details['is_save']=='no')
        <a class="waves-effect waves-light btn savejob" href="javascript:void(0)" onclick="saveaction({{$checkjob->id}},'savejob')">Bookmark</a>
        @endif
         @endif
        
        @if($details['loginrequired']=='yes')
        <a class="waves-effect waves-light btn userFollow" href="javascript:void(0)" onclick="loginbox()">Apply</a>
        @else
        @if($details['is_apply']=='no')
        <a class="waves-effect waves-light btn jobapply" href="javascript:void(0)" onclick="saveaction({{$checkjob->id}},'applyjob')">Apply</a>
       
        @endif
        @endif
        <a class="waves-effect waves-light btn">Share</a>
        @if($details['loginrequired']=='yes')
        <a class="waves-effect waves-light btn userFollow" href="javascript:void(0)" onclick="loginbox()">Follow</a>
        @else
        @if($details['is_follow']=='no')
        <a class="waves-effect waves-light btn userFollow" href="javascript:void(0)" onclick="saveaction({{$compnay->id}},'company')">Follow</a>
        @else
        <a class="waves-effect waves-light btn userFollow" href="javascript:void(0)" onclick="saveaction({{$compnay->id}},'company')">Unfollow</a>
        @endif
        @endif
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row">
    <div class="col s12 m12 l12">
      <div class="job-detail card">
       <div class="row">
        <div class="col s12">
          <div class="row">
            <div class="col s8">
            <h4>Job Description</h4>
            <article>
            <p>Designation:{{$checkjob->designation}} </p>
              <p>SkillSet:{{$checkjob->skill}} </p>
              <p>Job Quality:{{ $checkjob->job_quality}}</p>
              <p> Salary:@if($checkjob->salary_max) {{ $checkjob->salary_min.'00000 , '.$checkjob->salary_max}}00000 @else {{$checkjob->salary_min}},00000 @endif PA</p>
              @if($checkjob->compnay_website)
              <?php 
              $url = $checkjob->compnay_website;
              if (!preg_match("~^(?:f|ht)tps?://~i", $checkjob->compnay_website))
              {
                  $url = "http://" . $checkjob->compnay_website;
              }
              ?>
              <p>Company Website: <a href="{{$url}}" target="_blank">Click Here</a></p>
              @endif
              <p>{{ $checkjob->job_description}}</p>
              <!-- <div class="more-content">
                <p>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.</p>
                <p>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</p>
              </div>
              <p><a class="readmore" href="#">Show more (+)</a></p> -->
            </article>
            </div>
            <div class="col s4">
              <p>
                <strong>Seniority Level</strong><br>
                {{$details['emp_type']}}
              </p>
              <p>
                <strong>Industry</strong><br>
                {{@$details['industry']}}
              </p>
              <p>
                <strong>Employment Type</strong><br>
                {{$details['job_type']}}
              </p>
              <p>
                <strong>Job Functions</strong><br>
                {{@$details['function']}}
              </p>
            </div>

            

          </div>
        </div>
      </div>
        
      </div>
    </div>
    <div class="col s12 m12 l12">
      <div class="job-detail card">
       <div class="row">
        <div class="col s12">
          <div class="row">
            <div class="col s12">
            <h4>Company Profile</h4>
            <article>
  
              <p>{{ $checkjob->about_compnay}}</p>
              <p>
              
              <!-- <div class="more-content">
                <p>Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis.</p>
                <p>Morbi in sem quis dui placerat ornare. Pellentesque odio nisi, euismod in, pharetra a, ultricies in, diam. Sed arcu. Cras consequat.</p>
                <a class="waves-effect waves-light btn">View Company Profile</a>
              </div>
              <p><a class="readmore" href="#">Show more (+)</a></p> -->
            </article>
            </div>
          </div>
        </div>
      </div>
        
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

  $(".readmore").on('click touchstart', function(event) {
        var txt = $(".more-content").is(':visible') ? 'Show more (+)' : 'Less (-)';
        $(this).parent().prev(".more-content").toggleClass("visible");
        $(this).html(txt);
        event.preventDefault();
    });
   $(function()
  {
    $(window).ready(function()
    {
      var geteventpram = '<?php echo $checkjob->id;?>';
      eventviews(geteventpram,'job');
      // eventviews(geteventpram[1],'recentview');
    });
  });
</script>
@stop