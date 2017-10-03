@extends('layout.default')
@section('content')
<div class="container article-hire">
  <div class="row">
    <div class="col s12 m8 l8">
      <div class="row">
          <div class="article-box">
            <h5>{{ucwords($articledetail->title)}}</h5>
            <p> @if($articledetail->articles_image)
            <img src="{{URL::to('uplode/articles/'.$articledetail->articles_image)}}" alt="" style="height: 144px;> @endif <?php echo $articledetail->description?> </p>
            <div class="row">
              <div class="col s12 m6 l6">
              <a href="" class="share-box">view 0</a>
              <div class="fixed-action-btn">
                <a class="share-box">
                  Share
                </a>
                <ul>
                  <li><a onclick="window.open('https://www.facebook.com/sharer.php?u={{URL::to('articledetail/'.$articledetail->article_url)}}', 'facebookShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/facebook-logo.png')}}"></a></li>
                  <li><a onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url={{URL::to('articledetail/'.$articledetail->article_url)}}', 'googleShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/google-plus.png')}}"></a></li>
                  <li><a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url={{URL::to('articledetail/'.$articledetail->article_url)}}&summary={{$articledetail->title}}', 'linkedinShare', 'width=750,height=350'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/linkedin-logo.png')}}"></a></li>
                  <li><a onclick="window.open('https://twitter.com/share?url={{URL::to('articledetail/'.$articledetail->article_url)}}&text={{$articledetail->title}}', 'twitterShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/twitter.png')}}"></a></li>
                </ul>
              
              </div>
              <!-- <a href="" class="share-box">Share</a> --></div>
              @if(count($commentArray)>0)
              <div class="col s12 m6 l6"><a class="waves-effect waves-light btn">Comment {{count($commentArray)}}</a></div>
              @endif
            </div>
          </div>
          @if(count($commentArray)>0)
          <ul class="collection">
          @foreach($commentArray as $key=>$commentArray)
            <li class="collection-item avatar">
              <img src="{{$commentArray['image']}}" alt="" class="circle responsive-img">
              <span class="title">{{$commentArray['name']}}</span>
              <p>{{date('d M Y',strtotime($commentArray['commnetdate']))}} ,<strong class="reportincorrect" id="{{$key}}" onclick="reportincorrect('{{$key}}','article_comment')">Report</strong><br>{{$commentArray['comment']}}
              </p>
               <!-- <div class="reportincorrect" id="{{$key}}" onclick="reportincorrect('{{$key}}','article_comment')">Report</div> -->
            </li>
            @endforeach()
          </ul>
          @endif
          <div class="card col s12 m12 l12">
          @if($login==1)
            <div class="input-field">
              <textarea class="materialize-textarea" name="comment" ></textarea>
              <label>Write Comment</label>
            </div>
            <a class="waves-effect waves-light btn article-hire-button cooment-butt" href="#comment-login" onclick="savecomment('{{$articledetail->id}}','article')" rel="article">Comment</a>
            <!-- Modal Structure -->
            @else
            <div class="input-field">
            To write comment you have to <a href="javascript:void(0)" onclick="loginbox()">login first</a>.
            </div>
            @endif
            
          </div>
        </div>
    </div>
    <div class="col s12 m4 l4 left-link">
    @if(count($articlaCatlist)>0)
      <div class="article-hire-sidebar card">
        <h5>Top Category</h5>
        @foreach($articlaCatlist as $articlaCatlist)
        <div class="blog-sec-box">
        <a href=""><p><strong>{{$articlaCatlist->name}}</strong></p></a>
        </div>
        @endforeach
        </div>
   @endif
      
@if(count($getsimilararticle)>0)
      <div class="article-hire-sidebar card">
        <h5>Featured Article</h5>
        @foreach($getsimilararticle as $getsimilararticle)
        <div class="blog-sec-box">
        <a href="{{URL::to('articledetail/'.$getsimilararticle->article_url)}}"><p><strong>{{ucwords($getsimilararticle->title)}}</strong></p></a>
        </div>
        @endforeach
      
        
      </div>
      @endif
    </div>
  </div>
</div>
<script type="text/javascript">
   $(function()
  {
    $(window).ready(function()
    {
      var geteventpram = '<?php echo $articledetail->id;?>';
      eventviews(geteventpram,'article');
      // eventviews(geteventpram[1],'recentview');
    });
  });
</script>
@stop