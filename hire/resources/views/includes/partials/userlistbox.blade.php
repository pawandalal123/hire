 @if(count($userlistArray)>0)
        @foreach($userlistArray as $userlist)
          <div class="company-job-box">
              <div class="col s12 m8 l8">
                <!-- <span class="job-title">
                <input type="checkbox" id="tick"><label for="tick">UX/ui Designer - lit(idc) / NID / Symbiosis MIT ID</label>
                </span> -->
                <span>{{ucwords($userlist['name'])}}</span>
                <!-- <span class="job-exp">2-7 yrs</span> -->
                <span class="job-loc">@if($userlist['cityname']) {{$userlist['cityname']}}, @endif @if($userlist['statename']) {{$userlist['statename']}} @endif</span>
                <table>
                  <tbody>
                    <tr>
                      <td>Current:</td>
                      <td>Android Developer at The App Science</td>
                    </tr>
                    <tr>
                      <td>Education:</td>
                      <td>{{$userlist['education']}}</td>
                    </tr>
                    <tr>
                      <td>Current:</td>
                      <td>B.Com Veer Bahadur Singh Poorvanchal University (VBSP) 2009 </td>
                    </tr>
                    <!-- <tr>
                      <td>Pref Loc:</td>
                      <td>Delhi/NCR</td>
                    </tr> -->
                    <tr>
                      <td>Key Skills:</td>
                      <td>{{$userlist['skills']}}</td>
                    </tr>
                    <tr>
                      <td>Supprting  Skills:</td>
                      <td>{{$userlist['extra_skills']}}</td>
                    </tr>
                    <!-- <tr>
                      <td><a href="" class="share-box-job">Share <img src="images/social-normal.png" alt=""></a></td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
              <div class="col s12 m4 l4 center-align">
              <div class="user-profile-box">
              <a href="{{URL::to('userdetails/'.$userlist['userid'])}}">
                <img class="circle responsive-img" src="{{$userlist['image']}}">
                </a>
                <p>{{ ucwords($userlist['profile_title'])}}</p>
                <a href="#" class="waves-effect waves-light btn connect" onclick="saveaction({{$userlist['userid']}},'user')">@if($userlist['is_connect']=='yes') Unconnect @else Connect @endif</a>
                <!-- <p><img src="{{URL::to('web/images/blue-tick.png')}}"> Verified: <a href="">Phone</a>, Verified: <a href="">Email</a></p> -->
                
              </div>
              </div>
              <div class="company-list-footer">
                <span class="exp-salary"><!-- <img src="images/rupee.png" alt=""> Contacted -->
                  <a href=""><img src="{{URL::to('web/images/eye.png')}}" alt="">{{$userlist['view_count']}}</a> <!-- | -->
                <!-- <a href=""><img src="images/attach.png" alt=""> CV</a> -->
                </span>
                <span class="job-postby">
                <a href="">Active: 08 Dec 2016</a> |
                <a href="">Modified: 07 Dec 2016</a></span>
              </div>
          </div>
          @endforeach
          <div class="text-center">
                <?php echo $getuserlist->appends(Input::except('page'))->render(); ?>
                </div>
          @endif