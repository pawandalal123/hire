      @if(count($jobarray)>0)
          @foreach($jobarray as $jobarray)
          <div class="company-job-box">
              <div class="col s12 m12 l12">
                <span class="job-title"><a href="{{URL::to('jobdetail/'.$jobarray['jobid'])}}">{{ucwords($jobarray['jobtitle'])}}</a></span>
                <span>{{ucwords($jobarray['compnay_name'])}}</span>
                <span class="job-exp">{{$jobarray['experience']}}</span>
                <span class="job-loc">@if($jobarray['city']) {{$jobarray['city']}},  @endif @if($jobarray['state']) {{$jobarray['state']}} @endif</span>
                <table>
                  <tbody>
                    <tr>
                      <td>Keyskills :</td>
                      <td>{{ucwords($jobarray['skill'])}}</td>
                    </tr>
                    <tr>
                      <td>Supporting kills :</td>
                      <td>{{ucwords($jobarray['job_quality'])}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="company-list-footer">
                <span class="start-mark"><i class="material-icons dp48">star</i></span>
                <span class="exp-salary">@if($jobarray['salary']!='') <img src="{{URL::to('web/images/rupee.png')}}" alt=""> {{$jobarray['salary']}} Lakh P.A @endif</span>
                <!-- <span class="job-postby">Posted by Ms. Priyanka Tewary  , Today</span> -->
              </div>
          </div>
           @endforeach()
           <?php echo $getalljobs->appends(Input::except('page'))->render();?>
           @else
           <div align="center">No job found related to you.</div>
          @endif
         