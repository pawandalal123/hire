@extends('layout.default')
@section('content')
@include('includes.web.userstrip')
<div class="container">
  <div class="row">
  <style type="text/css">
    a.anchorart
    {
      background-color: transparent !important;
      color:#060606 !important;
      float: none!important;
      font-size:18px!important;

    }
  </style>
   @include('includes.web.userleftbar')
    <div class="col s12 m4 l6">
      <div class="middle-sec">
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6 m6 l6"><a class="active waves-effect" href="#test1">Read Articles</a></li>
              <li class="tab col s6 m6 l6"><a class="waves-effect" href="#test2">Apply For Jobs</a></li>
            </ul>
          </div>
          <div id="test1" class="col s12 tab-content">
          @if(count($articlelist)>0)
           @foreach($articleArrary as $article)
           <div class="article-box card">
              <h5><a class="anchorart" href="{{URL::to('articledetail/'.$article['article_url'])}}">{{ucwords($article['title'])}}</a></h5>
              <p>{{ date(' M j, D, Y',strtotime($article['created_at']))}}, <a href="#" style="color: #7c7ee2!important;background-color:#ffffff"><img src="{{URL::to('web/images/eye.png')}}" alt="" >{{$article['view_count']}}</a> <br />
              @if($article['articles_image'])
            <img src="{{URL::to('uplode/articles/'.$article['articles_image'])}}" alt="" style="height: 80px; width: 100px;"> @endif
              <?php echo substr($article['description'],0,189);?> </p>
              <div class="row">
                <div class="col s12 m12 l12">
                <div class="fixed-action-btn">
                <a class="share-box">
                  Share
                </a>
                <ul>
                  <li><a onclick="window.open('https://www.facebook.com/sharer.php?u={{URL::to('articledetail/'.$article['article_url'])}}', 'facebookShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/facebook-logo.png')}}"></a></li>
                  <li><a onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url={{URL::to('articledetail/'.$article['article_url'])}}', 'googleShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/google-plus.png')}}"></a></li>
                  <li><a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url={{URL::to('articledetail/'.$article['article_url'])}}&summary={{$article['title']}}', 'linkedinShare', 'width=750,height=350'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/linkedin-logo.png')}}"></a></li>
                  <li><a onclick="window.open('https://twitter.com/share?url={{URL::to('articledetail/'.$article['article_url'])}}&text={{$article['title']}}', 'twitterShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/twitter.png')}}"></a></li>
                </ul>
              </div>
                
                <a href="{{URL::to('articledetail/'.$article['article_url'])}}" class="share-box">Read More</a>

                <a href="" class="share-box">Comment {{$article['totalcount']}}</a> 
                </div>
              </div>
              </div>
   
            @endforeach()
            <?php echo $articlelist->render();?>
            @else
            <div class="text-center">No article found......</div> 
           @endif
          </div>
          <div id="test2" class="col s12 tab-content">
            <div id="create-a-Job" class="col s12 tab-content" style="">
             @include('includes.partials.jobboxlist')
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col s12 m4 l3">
      <div class="company-feedback-sidebanner waves-effect waves-block waves-light">
        <a href=""><img src="{{URL::to('web/site/images/compay-feedback-banner.jpg')}}" class="" alt=""></a>
      </div>
      <div class="sidebar-box">
        <h6>Appointment History & Schedule</h6>
        <p>Comming soon.</p>
      </div>

      <div class="sidebar-box">
        <h6>Explore </h6>
        <p>Comming soon.</p>
      </div>
    </div>
  </div>
</div>

@stop