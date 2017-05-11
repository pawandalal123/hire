<div class="col s12 m4 l6">
      <div class="col s12 m12 l12 middle-sec card user-profile">
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6 m6 l6"><a class="waves-effect active" href="#test1">Job Apply</a></li>
              <li class="tab col s6 m6 l6"><a class="waves-effect " href="#test2">Bookmarks List</a></li>
            <div class="indicator" style="right: 270px; left: 0px;"></div><div class="indicator" style="right: 270px; left: 0px;"></div></ul>
          </div>
                       <div id="test1" class="col s12 tab-content" style="display: block;">
                                
                       @if(count($allylistArray)>0)
             <table class="bordered responsive-table">
              <thead>
                <tr>
                    <th data-field="sr">Sr No.</th>
                    
                    <th data-field="document-name">Job title</th>
                    <th data-field="detail">Skills</th>
                    <th data-field="detail">Extra skills</th>
                    <th data-field="detail">Date</th>
                    <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
              {{--*/ $i=1  /*--}}
              @foreach($allylistArray as $allylistArray)
                <tr class="document3">
                  <td>{{$i}}</td>
                  <td>{{$allylistArray['jobtitle']}}</td>
                  <td>{{$allylistArray['skills']}}</td>
                  <td>
                  {{$allylistArray['extra_skills']}}
                  </td>
                  <td>
                  {{$allylistArray['date']}}
                  </td>
                  <td><a href="{{URL::to('jobdetail/'.$allylistArray['jobid'])}}" target="_blank">View</a></td>
                </tr>
                {{--*/ $i++ /*--}}
                @endforeach
                         <?php echo $getapplyList->appends(Input::except('page'))->render();?>
                            
            </tbody>
          </table>
           @else
           <div align="center">No Record Found.</div>
          @endif                            
           </div>
          <div id="test2" class="col s12 tab-content" style="display: none;">
            @if(count($allbooklistArray)>0)
             <table class="bordered responsive-table">
              <thead>
                <tr>
                    <th data-field="sr">Sr No.</th>
                    
                    <th data-field="document-name">Job title</th>
                    <th data-field="detail">Skills</th>
                    <th data-field="detail">Extra skills</th>
                    <th data-field="detail">Date</th>
                    <th data-field="action">Action</th>
                </tr>
              </thead>
              <tbody>
              {{--*/ $i=1  /*--}}
              @foreach($allbooklistArray as $allylistArray)
                <tr class="document3">
                  <td>{{$i}}</td>
                  <td>{{$allylistArray['jobtitle']}}</td>
                  <td>{{$allylistArray['skills']}}</td>
                  <td>
                  {{$allylistArray['extra_skills']}}
                  </td>
                  <td>
                  {{$allylistArray['date']}}
                  </td>
                  <td><a href="{{URL::to('jobdetail/'.$allylistArray['jobid'])}}" target="_blank">View</a></td>
                </tr>
                {{--*/ $i++ /*--}}
                @endforeach
                         <?php echo $getbookList->appends(Input::except('page'))->render();?>
                            
            </tbody>
          </table>
           @else
           <div align="center">No Record Found.</div>
          @endif 
          </div>
        </div>  
      </div>
    </div>