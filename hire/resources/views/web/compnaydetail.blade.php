@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m5 l5">
          <div class="card horizontal">
            <div class="card-image">
                @if(@$checkcompnay->compnay_logo)
                <img src="{{URL::asset($_ENV['CF_LINK'].$checkcompnay->compnay_logo)}}" alt="" style="height: 150px;">
                @else
                <img src="{{URl::to('web/images/org.jpg')}}" alt="">
                @endif
            </div>
            <div class="card-stacked">
              <div class="card-action">
                {{ucwords($checkcompnay->compnay_name)}}
              </div>
              <div class="card-content">
                <p>{{$checkcompnay->industry}}<br>
                  {{$checkcompnay->address}}<br>
                   @if($checkcompnay->state) {{$checkcompnay->state.', '}} @endif {{$checkcompnay->country}}
                </p>
                <span>Created at: {{date(' M j, D, Y',strtotime($checkcompnay->created_at))}} </span> 
              </div>
            </div>
          </div>
      </div>
      <div class="col s12 m6 l7 job-view-btn">
        <a class="waves-effect btn connect" onclick="saveaction({{$checkcompnay->id}},'company')">Connect</a>
        <!-- <a class="waves-effect waves-light btn">See all 406 employees </a> -->
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
            <div class="col s12 job-detail search-page">
            <h4>About us</h4>
            <article>
  
              <p>{{$checkcompnay->about_company}}</p>
             
            </article>
            </div>
          </div>
        </div>
      </div>
        
      </div>
    </div>
     @if(count($data)>0)
    <div class="col s12 m12 l12">
      <div class="job-detail card">
       <div class="row">
        <div class="col s12">
          <div class="row">
            <div class="col s12 job-detail search-page">
            <h4>Job Posted</h4>
           
              <ul class="collection">
              
                  @foreach($data as $key=>$valjob)
                  
                 <li class="collection-item avatar">
                  <a href="{{URL::to('jobdetail/'.$key)}}">
                    
                    <span class="title"><strong>{{$valjob['jobtitle']}}</strong></span>
                    @if($valjob['skill']) <p><strong>Key Skills:</strong>{{$valjob['skill']}}</p> @endif
                    @if($valjob['job_quality']) <p><strong>Supprting Skills:</strong> {{$valjob['job_quality']}}</p>@endif
                    <p>New Delhi, Posted on {{ date(' M j, D, Y',strtotime($valjob['created_at']))}}<br>
                     @if($valjob['job_description']) {{ substr($valjob['job_description'],0,150)}}.. @endif
                    </p>
                    </a><a href="{{URL::to('jobdetail/'.$key)}}">
                    <img src="{{URL::to('web/images/eye.png')}}" alt=""> 8</a>
                     @if($valjob['loginrequired']=='yes')
                     <button class="waves-effect waves-light btn connect" onclick="loginbox()">Apply</button>
                     @else
                     @if($valjob['is_apply']=='no')
                     <button class="waves-effect waves-light btn connect" onclick="saveaction({{$key}},'applyjob')">Apply</button>
                     @endif
                     @endif
                </li>
                 @endforeach()
               
              </ul>
               <?php echo $data->appends(Input::except('page'))->render();?>
                         
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    @endif
    @if(count($newslist)>0)
                 
    <div class="col s12 m12 l12">
      <div class="job-detail card">
       <div class="row">
        <div class="col s12">
          <div class="row">
            <div class="col s12 job-detail search-page">
            <h4>News</h4>
            @foreach($newslist as $newspost)
            <div class="article-box card">
                  <h5>{{$newspost->title}}</h5>
                  <p>{{ date(' M j, D, Y',strtotime($newspost->created_at))}}, <a href="{{URL::to('newsdetail/'.$newspost->news_url)}}">
                  <img src="{{URL::to('web/images/eye.png')}}" alt=""> 8</a> 
                  <br>
                  @if($newspost->news_image)
                  <img src="{{URL::to('uplode/articles/'.$newspost->news_image)}}" alt="" style="height: 144px;"> @endif
                  <!-- <img src="images/company-profile-about.jpg"> -->
                  {{$newspost->description}}</p>
                  <a href="" class="share-box">Share <img src="{{URL::to('web/images/social-normal.png')}}"" alt=""></a>
                  <!-- <span class="comment">Comment 2</span>  -->
                    <a href="{{URL::to('newsdetail/'.$newspost->news_url)}}" class="waves-effect waves-light btn">Read More</a>

                </div>
                @endforeach()
                <?php echo $newslist->appends(Input::except('page'))->render();?>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    @endif
  </div>
</div>
<script type="text/javascript">

  $(".readmore").on('click touchstart', function(event) {
        var txt = $(".more-content").is(':visible') ? 'Show more (+)' : 'Less (-)';
        $(this).parent().prev(".more-content").toggleClass("visible");
        $(this).html(txt);
        event.preventDefault();
    });
</script>
@stop