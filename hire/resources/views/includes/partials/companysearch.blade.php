
            <div class="col s9">
            @if(count($data)>0)
              <ul class="collection">
                  @foreach($datalistArray as $key=>$company)
                  {{--*/ $imagepath='http://localhost/testold/web/images/org.jpg' /*--}}
                  @if($company['compnay_logo'])
                  {{--*/ $imagepath=$_ENV['CF_LINK'].$company['compnay_logo'] /*--}}
                  @endif
                <li class="collection-item avatar">
                 
                  @if($company['loginrequired']=='yes')
                   <a href="javascript::void();" onclick="loginbox()">
                  @else
                   <a href="{{URL::to('compnaydetail/'.$key)}}">
                  @endif
                    <img src="{{$imagepath}}" alt="" class="circle responsive-img">
                    <span class="title">{{ucwords($company['compnay_name']  )}}</span>
                    <p>@if($company['industry']) {{$company['industry']}},  @endif
                    @if($company['cityname']) {{$company['cityname']}} @endif</p>
                  </a>
                   @if($company['loginrequired']=='yes')
                   <button class="waves-effect waves-light btn connect"  onclick="loginbox()"> Connect</button>
                   @else
                  <button class="waves-effect waves-light btn connect" onclick="saveaction({{$key}},'company')">@if($company['is_connect']=='yes') Unconnect @else Connect @endif</button>
                  @endif
                </li>
                 @endforeach()
              </ul>
               <?php echo $data->appends(Input::except('page'))->render();?>
                @else
                <div class="text-center">No article found......</div> 
               @endif
             
            </div>
           
         