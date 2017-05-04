@extends('layout.default')
@section('content')
{{--*/ $imagepath='http://localhost/testold/web/images/org.jpg' /*--}}
                  @if($userdata->profile_image)
                  {{--*/ $imagepath=$_ENV['CF_LINK'].$userdata->profile_image /*--}}
                  @endif
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m4 l3">
          <div class="card horizontal">
            <div class="card-image">
              <img src="{{$imagepath}}" alt="">
            </div>
            <div class="card-stacked">
              <div class="card-action">
                {{ucwords($userdata->name)}} {{ucwords($userdata->last_name)}}
              </div>
              <div class="card-content">
                <p>Web Designer</p>
                <!-- <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> <i class="material-icons dp48">star</i> -->
              </div>
            </div>
          </div>
      </div>
      <div class="col s12 m4 l3">
        
      </div>
      <div class="col s12 m3 l3 profile1">
        <h6>Profile Status</h6>
    <!--     <div class="switch">
            <label>
              Deactivate
              <input type="checkbox" checked="">
              <span class="lever"></span>
               Activate Profile
            </label>
          </div> -->
          <div class="status-box">
            Profile Status
            <label class="status-percent">70%</label>
            <div class="progress">
                <div class="determinate" style="width: 70%"></div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>
<div class="container user-profile user-profile-1">
  <div class="row">
    <div class="col s12 m12 l12">
      <div class="middle-sec card">
        <div class="row">
          <div class="col s12">
            <div class="col s12">
              <h2>Basic Info</h2>
              <ul class="collection">
              @if($userdata->profile_title)
              <li class="collection-item">Profile Title : {{ucwords($userdata->profile_title)}}</li>
              @endif
                <li class="collection-item">Name : {{ucwords($userdata->name)}} {{$userdata->last_name}}</li>
                <li class="collection-item">Gender : avinash@abc.com</li>
                <li class="collection-item">Mother Name : 6598785465</li>
                <li class="collection-item">Father Name : </li>
                <li class="collection-item">Address : {{ucwords($userdata->address)}}</li>
                <li class="collection-item">Pincode : {{ucwords($userdata->pincode)}}</li>
              </ul>
              @if(count($usereducationArry)>0)
            <h2>Education Details</h2>
            <table>
            <th>Course Name</th>
            <th>Passing Year</th>
            <th>Marks%</th>
           <tbody>
          @foreach($usereducationArry as $usereducationArry)
            <tr>
              <td><span>{{$usereducationArry['course_name']}} -</span> {{$usereducationArry['educate_from']}}</td>
              <td>{{$usereducationArry['passing_year']}} </td>
               <td>{{$usereducationArry['marks']}}</td>
            </tr>
            @endforeach()
            
          </tbody>
        </table>
        @endif
             @if(count($articlelist)>0)
              <h2>Articles Posted</h2>
              @foreach($articlelist as $articlelist)
                <div class="article-box">
                  <h5>{{ucwords($articlelist->title)}}</h5>
                  <p>{{substr($articlelist->description,0,200)}}</p>
                  <a class="waves-effect waves-light btn" href="{{URL::to('articledetail/'.$articlelist->article_url)}}">Read Article</a>
                </div>
                @endforeach()
                @endif
               @if(count($discussion)>0)
              <h2>Discussion </h2>
              @foreach($discussion as $discussion)
              <div class="article-box">
                <h5>{{ucwords($discussion->title)}}</h5>
                <p>{{substr($discussion->description,0,200)}} </p>
                <div class="row">
                  <div class="col s12 m6 l6"><a href="{{URL::to('discussiondetail/'.$discussion->discussion_url)}}" class="share-box">Read</a></div>
                  <div class="col s12 m6 l6 comment-view">
                  <!-- <span class="comment">Comment 2</span> -->
                  <span class="comment">{{date('j, M, Y',strtotime($discussion->created_at))}}</span> 
                  </div>
                </div>
              </div>
              @endforeach()
              @endif
         
              <!-- <h2>Connection</h2>
              <ul class="collection">
                <li class="collection-item avatar">
                  <img src="images/profile-image.jpg" alt="" class="circle responsive-img">
                  <span class="title">Avinash Kumar</span>
                  <p>01, Jan, 2017 <br>
                     consultant who helped me find the right position and identified the key criteria I was looking for in "I highly recommend. "I highly recommend agency as a professional and extremely competent consultant who helped me find the right position and identified the key criteria I was looking for in "I highly recommend. "I highly recommend agency as a professional and extremely competent consultant who helped
                  </p>
                </li>
                <li class="collection-item avatar">
                  <img src="images/profile-image.jpg" alt="" class="circle responsive-img">
                  <span class="title">Title</span>
                  <p>01, Jan, 2017  <br>
                     consultant who helped me find the right position and identified the key criteria I was looking for in "I highly recommend. "I highly recommend agency as a professional and extremely competent consultant who helped me find the right position and identified the key criteria I was looking for in "I highly recommend. "I highly recommend agency as a professional and extremely competent consultant who helped
                  </p>
                </li>
              </ul> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(function()
  {
    $(window).ready(function()
    {
      var geteventpram = '<?php echo $userdata->id;?>';
      eventviews(geteventpram,'user');
      // eventviews(geteventpram[1],'recentview');
    });
  });
</script>
@stop