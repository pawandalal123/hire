@if (Auth::check())
 <?php
 $userDetails = Auth::user();
 $imagePatah = URL::asset('web/images/profilePic.png');
 if($userDetails->profile_image)
 {
   $imagePatah = URL::asset($_ENV['CF_LINK'].$userDetails->profile_image);
   if($userDetails->login_type==1)
   {
      if(strpos($userDetails->profile_image, 'https')!==false)
        {
           $imagePatah = $userDetails->profile_image;
        }
      // $imagePatah = $userDetails->profile_image;
   }
   
 }
 $name = substr(substr($userDetails->email,0,strpos($userDetails->email,'@')),0,10);
 if($userDetails->name)
 {
   $name = substr($userDetails->name,0,10);
 }

$requestsegment = Request::segment(1);
// $requestsegment = Request::segment(1);
// echo $requestsegment;
?>
<div class="col s12 m4 l3">
        <div class="sidebar card sidebar-profile">
          <div class="card horizontal">
            <div class="card-image">
              <img src="{{$imagePatah}}" alt="">
            </div>
            <div class="card-stacked">
              <div class="card-action">
                {{ucwords($name)}}
              </div>
              <div class="card-content">
                <!-- <p>Web Designer</p> -->
                <!-- <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i>-->
			<a href="{{URL::to('editprofile')}}" class="waves-effect waves-light btn">edit profile</a>

              </div>
            </div>
          </div>
        <div class="switch">
            <label>
              Deactivate
              <input class="makeprofileactive" type="checkbox" @if($user->profile_status==1) checked   @endif>
              <span class="lever"></span>
               Activate Profile
            </label>
          </div>
          @if($become_job_owner==1)
          <a class="waves-effect waves-light btn" href="{{URL::to('postjob')}}">Post a Job</a>
          @else
          <a class="waves-effect waves-light btn" href="{{URL::to('companyprofile')}}">Become a Job Owner</a>
          @endif
          <a class="waves-effect waves-light btn @if($requestsegment=='articles') active @endif" href="{{URL::to('profile/articles')}}">Write an Article</a>
           <a href="{{URL::to('/digital-locker')}}" class="waves-effect waves-light btn @if($requestsegment=='digital-locker') active @endif">Digital Locker</a>
          <a class="waves-effect waves-light btn @if($requestsegment=='discussions') active @endif" href="{{URL::to('profile/discussions')}}">Start Discussion Forum</a>
          <a class="waves-effect waves-light btn @if($requestsegment=='see-all-connections-page') active @endif" href="{{URL::to('see-all-connections-page')}}">See all connections</a>
              <a class="waves-effect waves-light btn @if($requestsegment=='all-appointment') active @endif" href="{{URL::to('profile/all-appointment')}}">See all appointments</a>
              <a class="waves-effect waves-light btn @if($requestsegment=='all-saves') active @endif" href="{{URL::to('profile/all-saves')}}">Jobs Applied/Bookmarked</a>
          <a class="waves-effect waves-light btn">Invite to Join Discussion Forum</a>
          <a class="waves-effect waves-light btn" href="javascript:void(0)" onclick="connectmailbox()">Connect Via Mail</a>
     <!--      <a class="waves-effect waves-light btn">Invite Friend on Social Media</a>
           <a title="Share on Facebook" onclick="window.open('https://www.facebook.com/sharer.php?u=http://hireme.slugcorner.com/', 'facebookShare', 'width=626,height=436'); return false;" href="#"><img src="{{URL::to('web/images/icons/Facbook-hover.svg')}}"></a>
          <a title="Share on linkedin" onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=http://hireme.slugcorner.com&summary=hireme', 'linkedinShare', 'width=750,height=350'); return false;" href="#" ><img src="{{URL::to('web/images/icons/Linkedin-hover.svg')}}"></a>
          <a title="Tweet This" onclick="window.open('https://twitter.com/share?url=http://hireme.slugcorner.com&text=hireme', 'twitterShare', 'width=626,height=436'); return false;" href="#"><img src="{{URL::to('web/images/icons/Twitter-hover.svg')}}"></a>
          <a target="_blank" title="Share on Google+" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=http://hireme.slugcorner.com&text=hireme', 'googleShare', 'width=626,height=436'); return false;" href="#"  ><img src="{{URL::to('web/images/icons/Google-hover.svg')}}"></a> -->
         
        
         <!--  Profile Status
          <div class="progress">
              <div class="determinate" style="width: 70%"></div>
          </div> -->
        </div>
    </div>
    @endif