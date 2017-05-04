<?php
$pageredirect='discussiondetail';
if($pagename=='news')
{
  $pageredirect='newsdetail';

} 
elseif($pagename=='article')
{
  
  $pageredirect='articledetail';

}
?>
<div id="test4" class="col s9">
            <div class="row">
             @if(count($data)>0)
            @foreach($datalistArray as $article)
            <div class="article-box card">
              <h5>{{ucwords($article['title'])}}</h5>
              <p>{{ date(' M j, D, Y',strtotime($article['created_at']))}}, <a href=""><img src="{{URL::to('web/images/eye.png')}}" alt="">{{$article['view_count']}}</a> <br />
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
                  <li><a onclick="window.open('https://www.facebook.com/sharer.php?u={{URL::to($pageredirect.'/'.$article['article_url'])}}', 'facebookShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/facebook-logo.png')}}"></a></li>
                  <li><a onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url={{URL::to($pageredirect.'/'.$article['article_url'])}}', 'googleShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/google-plus.png')}}"></a></li>
                  <li><a onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url={{URL::to($pageredirect.'/'.$article['article_url'])}}&summary={{$article['title']}}', 'linkedinShare', 'width=750,height=350'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/linkedin-logo.png')}}"></a></li>
                  <li><a onclick="window.open('https://twitter.com/share?url={{URL::to($pageredirect.'/'.$article['article_url'])}}&text={{$article['title']}}', 'twitterShare', 'width=626,height=436'); return false;" class="btn-floating blue" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px) translateX(0px); opacity: 0;"><img src="{{URL::to('web/images/twitter.png')}}"></a></li>
                </ul>
              </div>
                
                @if($article['loginrequired']=='yes')
                <a href="#" class="share-box" onclick="loginbox()">Read More</a>
                @else
                @if($pagename=='news')
                 <a href="{{URL::to('newsdetail/'.$article['article_url'])}}" class="share-box">Read More</a>
                @elseif($pagename=='article')
                <a href="{{URL::to('articledetail/'.$article['article_url'])}}" class="share-box">Read More</a>
                @else
                <a href="{{URL::to('discussiondetail/'.$article['article_url'])}}" class="share-box">Read More</a>
                @endif
                @endif

                <a href="" class="share-box">Comment {{$article['totalcount']}}</a> 
                </div>
              </div>
              </div>
          @endforeach()
          <?php echo $data->appends(Input::except('page'))->render();?>
          @else
          <div class="text-center">No article found......</div> 
          @endif
          
            </div>
          </div>