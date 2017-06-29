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
                <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i>
              </div>
            </div>
          </div>

          <div class="switch">
            <label>
              Deactivate
              <input class="makeprofileactive" type="checkbox" @if($userDetails->profile_status==1) checked   @endif>
              <span class="lever"></span>
               Activate Profile
            </label>
          </div>
          
          <!-- <div class="status-box">
            Profile Status
            <label class="status-percent">70%</label>
            <div class="progress">
                <div class="determinate" style="width: 70%"></div>
            </div>
          </div> -->
            @if($become_job_owner==1)
          <a class="waves-effect waves-light btn" href="{{URL::to('postjob')}}">Post a Job</a>
          @else
          <a class="waves-effect waves-light btn" href="{{URL::to('companyprofile')}}">Become a Job Owner</a>
          @endif
          <a href="{{URL::to('/profile')}}" class="waves-effect waves-light btn @if($requestsegment=='profile' && $pagename=='') active @endif">Basic Info</a>
          <a href="{{URL::to('/digital-locker')}}" class="waves-effect waves-light btn @if($requestsegment=='digital-locker') active @endif">Digital Locker</a>
           <a class="waves-effect waves-light btn @if($pagename=='articles') active @endif" href="{{URL::to('profile/articles')}}">Articles</a>
          <a class="waves-effect waves-light btn @if($pagename=='discussions') active @endif" href="{{URL::to('profile/discussions')}}">Discussion Forum</a>
          <a class="waves-effect waves-light btn @if($pagename=='see-all-connections-page') active @endif" href="{{URL::to('see-all-connections-page')}}">See all connections</a>
          <a class="waves-effect waves-light btn @if($pagename=='all-saves') active @endif" href="{{URL::to('profile/all-saves')}}">Jobs Applied/Bookmarked</a>
          <a class="waves-effect waves-light btn @if($pagename=='invitediscussion') active @endif" href="{{URL::to('profile/invitediscussion')}}">Invite to Join Discussion Forum</a>
          <a class="waves-effect waves-light btn" href="javascript:void(0)" onclick="connectmailbox()">Connect Via Mail</a>
            <!-- Modal Structure -->
           
        </div>
    </div>
    @endif
