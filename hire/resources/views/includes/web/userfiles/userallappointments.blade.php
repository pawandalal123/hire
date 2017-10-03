<div class="col s12 m4 l6">
      <div class="col s12 m12 l12 middle-sec card user-profile">
        <div class="row">
          <div class="col s12">
            
          </div>
                       <div id="test1" class="col s12 tab-content" style="display: block;">
                                
                       @if(count($allappointment)>0)
           
           <table class="bordered responsive-table">
            <thead>
              <tr>
                  <th data-field="sr">Sr No.</th>
                  <th data-field="document-name">Job title</th>
                  <th data-field="uploaded-date">Job owner</th>
                  <th data-field="detail">Contact</th>
                  <th data-field="detail">Date</th>
                  <th data-field="action">Mode</th>
                  <th data-field="action">Round</th>
                  <th data-field="share">Action</th>
              </tr>
            </thead>

            <tbody>
            {{--*/ $i=1 /*--}}
                        @foreach($allappointment as $key=>$allappointment)
                           
                <tr class="document3">
                <td>{{$i}}</td>
                <td>{{$allappointment['jobtitle']}}</td>
                <td>{{$allappointment['job_owner']}}</td>
                <td>{{$allappointment['contact_number']}}</td>
                <td>{{$allappointment['appointment_date']}}</td>
                <td>{{$allappointment['appointment_mode']}}</td>
                <td>{{$allappointment['appointment_round']}}</td>
                <td>@if($allappointment['Currentstatus']==0) 
                <div class="actiononappoinment">
                <a onclick="saveaction({{$key}},'acceptappointment')">Accept</a>
                <a onclick="saveaction({{$key}},'declineppointment')">Decline</a>
                </div>
                 @else $allappointment['status'] @endif<a></a></td>
                

                <td>
                
               
                </td>
                
              </tr>
              @endforeach
                                          
            </tbody>
          </table>
          <?php echo $getappoitmentlist->appends(Input::except('page'))->render();?>
           @else
           <div align="center">No job found related to you.</div>
          @endif                          
           </div>
        
        </div>  
      </div>
    </div>