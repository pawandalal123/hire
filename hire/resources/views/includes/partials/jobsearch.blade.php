
            <div class="col s9">
            @if(count($data)>0)
              <ul class="collection">
                  @foreach($datalistArray as $key=>$joblist)
                 
                 <li class="collection-item avatar">
                 @if($joblist['loginrequired']=='yes')
                 <a href="#" onclick="loginbox()">
                 @else
                  <a href="{{URL::to('jobdetail/'.$key)}}">
                  @endif
                    <span class="title"><strong>{{$joblist['jobtitle']}}</strong></span>
                    @if($joblist['skill']) <p><strong>Key Skills:</strong>{{$joblist['skill']}}</p> @endif
                    @if($joblist['job_quality']) <p><strong>Supprting Skills:</strong> {{$joblist['job_quality']}}</p>@endif
                    <p>New Delhi, Posted on {{ date(' M j, Y',strtotime($joblist['created_at']))}}<br>
                     @if($joblist['job_description']) {{ substr($joblist['job_description'],0,150)}}.. @endif
                    </p>
                    </a><a href="" class="share-box" style="margin-right: 5px;">
                    <img src="{{URL::to('web/images/eye.png')}}" alt=""> 8</a>
                  
                   @if($joblist['loginrequired']=='yes')
                   <button class="share-box"  onclick="loginbox()" style="margin-right: 5px;"> Apply</button>
                   @else
                   @if($joblist['is_apply']=='no')
                   <button class="share-box" style="margin-right: 5px;" onclick="saveaction({{$key}},'applyjob')"> Apply</button>
                   @endif
                   @endif
                   <a href="{{URL::to('jobdetail/'.$key)}}" class="share-box" style="margin-right: 5px;"> Read More</a>
                </li>
                 @endforeach()
               
               
              </ul>
               <?php echo $data->appends(Input::except('page'))->render();?>
                @else
                <div class="text-center">No record found......</div> 
               @endif
             
            </div>
           
     
