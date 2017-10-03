
            <div class="col s12 m8 l9 ">
            @if(count($data)>0)
              <ul class="collection">
                  @foreach($datalistArray as $people)
                  {{--*/ $imagepath=URL::to('web/images/org.jpg') /*--}}
                  @if($people['profile_image'])
                  @if(strpos($people['profile_image'], 'https')!==false)
                  {{--*/ $imagepath=$people['profile_image'] /*--}}
                  @else
                  {{--*/ $imagepath=$_ENV['CF_LINK'].$people['profile_image'] /*--}}
                  @endif
                  @endif
                <li class="collection-item avatar">
                @if($people['loginrequired']=='yes')
                <a href="#" onclick="loginbox()">
                @else
                  <a href="{{URL::to('userdetail/'.$people['id'])}}">
                  @endif
                    <img src="{{$imagepath}}" alt="" class="circle responsive-img">
                    <span class="title">{{ucwords($people['name'])}}<br/>
                    <span class="title">{{ucwords($people['profile_title'])}}</span></span>
                    <p>@if($people['city'])  {{ucwords($people['city'])}}  @endif
                      @if($people['state']) , {{ucwords($people['state'])}} @endif
                      @if($people['country']) , {{ucwords($people['country'])}} @endif
                    </p>
                  </a>
                   @if($people['loginrequired']=='yes')
                   <button class="waves-effect waves-light btn connect connect{{$people['id']}}"  onclick="loginbox()"> Connect</button>
                   @else
                  <button class="waves-effect waves-light btn connect connect{{$people['id']}}" onclick="saveaction({{$people['id']}},'people')">@if($people['is_connect']=='yes') Unconnect @else Connect @endif</button>
                  @endif
                </li>
                 @endforeach()
              </ul>
               <?php echo $data->appends(Input::except('page'))->render();?>
                @else
                <div class="text-center">No record found......</div> 
               @endif
            </div>
         