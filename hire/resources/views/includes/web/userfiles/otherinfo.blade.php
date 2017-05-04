 <h6>Other Information</h6>
 <form method="post" enctype="multipart/form-data">
  <div class="row">
      <div class="input-field col s2">
        <select class="initialized" name="expyear">
          <option value="" >Year</option>
           @for($i=1; $i<=20; $i++)
          <option value="{{$i}}" @if(@$jobprefrence->exp_year==$i) selected @endif> {{$i}}</option>
          @endfor
        </select>
        <label>Total experience</label>
      </div>
      <div class="input-field col s2">
        <select class="initialized" name="expmonth">
          <option value="" >Month</option>
           @for($i=1; $i<=12; $i++)
          <option value="{{$i}}" @if(@$jobprefrence->exp_month==$i) selected @endif> {{$i}}</option>
          @endfor
        </select>
        <label></label>
      </div>


      <div class="input-field col s2">
        <select class="initialized" name="annaulaysalary">
          <option value="" >Lakhs</option>
           @for($i=1; $i<=15; $i++)
          <option value="{{$i}}" @if(@$jobprefrence->annually_lakh==$i) selected @endif> {{$i}} lakh</option>
          @endfor
        </select>
        <label>Annual Sallary</label>
      </div>
      <div class="input-field col s2">
        <select class="initialized" name="annaulaysalaryth">
          <option value="" >Thousand</option>
          @for($i=10; $i<=90; $i+=10)
          <option value="{{$i}}" @if(@$jobprefrence->annually_thousand==$i) selected @endif> {{$i}} thousand</option>
          @endfor
        </select>
        <label></label>
      </div>

      <div class="input-field col s2">
        <select class="initialized" name="expectedsalary">
          <option value="" >Lakhs</option>
          @for($i=1; $i<=15; $i++)
          <option value="{{$i}}" @if(@$jobprefrence->expected_lakh==$i) selected @endif> {{$i}} lakh</option>
          @endfor
        </select>
        <label>Expected Sallary</label>
      </div>
      <div class="input-field col s2">
        <select class="initialized" name="expectedsalaryth">
          <option value="" >Thousand</option>
          @for($i=10; $i<=90; $i+=10)
          <option value="{{$i}}" @if(@$jobprefrence->expected_thousand==$i) selected @endif> {{$i}} thousand</option>
          @endfor
        
        </select>
        <label></label>
      </div>
           
    </div>
        <!-- <div class="row">
            <div class="input-field col s4">
              <input name="group1" type="radio" id="test1"><label for="test1">Full Time</label> 
              <input name="group1" type="radio" id="test1"><label for="test1">Part Time</label>
              <label for="first_name" class="active">Notice Period Status</label>
            </div>
            <div class="input-field col s4">
            <input name="group1" type="radio" id="test1"><label for="test1">Full Time</label> 
              <input name="group1" type="radio" id="test1"><label for="test1">Part Time</label>
              <input name="group1" type="radio" id="test1"><label for="test1">Correspondence</label>
              <label for="first_name" class="active">Can Company buy Notice Period</label>
            
            </div>
            <div class="input-field col s4">
            <input placeholder="Amout" type="text" name="noticeamount">
              <label>Amout to be paid for Notice epriod</label>
            </div>
          </div> -->
    
            <div class="row">
            <div class="input-field col s4">
              <input name="emp_type" type="radio" id="fulltime" value="1" @if(@$jobprefrence->job_type==1) checked @endif><label for="fulltime">Full Time</label> 
              <input name="emp_type" type="radio" id="parttime" value="2" @if(@$jobprefrence->job_type==2) checked @endif><label for="parttime">Part Time</label>
              <!-- <input name="emp_type" type="radio" id="test1"><label for="test1">Correspondence</label> -->
              <label for="emp_type" class="active">Type Of Employment</label>
            </div>
            <div class="input-field col s4">
            <select class="initialized" name="industry">
                <option value="" >Choose your option</option>
                @if(count($indusrtylist)>0)
                        @foreach($indusrtylist as $indusrtylist)
                        <option value="{{$indusrtylist->id}}" @if($indusrtylist->id==@$jobprefrence->industry) selected @endif>{{$indusrtylist->name}}</option>
                        @endforeach()
                        @endif
              </select>
              <label>Industry</label>
              @if ($errors->has('industry')) 
              <div class="error">{{ $errors->first('industry') }}</div> 
              @endif
            </div>
            <div class="input-field col s4">
             <select class="initialized" name="jobcategory">
                <option value="" >Choose your option</option>
               @if(count($functionalarea)>0)
                        @foreach($functionalarea as $functionalarea)
                        <option value="{{$functionalarea->id}}" @if($functionalarea->id==@$jobprefrence->functional_area) selected @endif>{{$functionalarea->name}}</option>
                        @endforeach()
                        @endif
              </select>
              <label>Functional Area</label>
              @if ($errors->has('jobcategory')) 
              <div class="error">{{ $errors->first('jobcategory') }}</div> 
              @endif
            </div>
          </div>
           <div class="row">
            <div class="input-field col s6">
              

              <input id="bb8d0281-a637-a980-09eb-1a1e8f3d0983" class="input" placeholder="skills" type="text" name="skills" value="{{@$jobprefrence->skills}}">
              <label for="bb8d0281-a637-a980-09eb-1a1e8f3d0983" class="active">Skills(comma seprated)</label>
              @if ($errors->has('skills')) 
              <div class="error">{{ $errors->first('skills') }}</div> 
              @endif
            </div>
             <div class="input-field col s6">
             
              <input id="bb8d0281-a637-a980-09eb-1a1e8f3d0983" class="input" placeholder="" name="extra_skills" value="{{@$jobprefrence->extra_skills}}">
              <label for="bb8d0281-a637-a980-09eb-1a1e8f3d0983" class="active">Supported Skills</label>
            </div>
             </div>
               <div class="row">
                <div class="input-field col s4">
              <select class="initialized" name="noticetime">
                <option value="" >Choose your option</option>
                 @for($i=10; $i<=90; $i+=10)
                <option value="{{$i}}" @if(@$jobprefrence->notice_days==$i) selected @endif> {{$i}} Days</option>
                @endfor
              </select>
              <label>Duration of Notice Period</label>
            </div>
            <div class="input-field col s4">
             <select multiple="" class="initialized" name="langaugesknow[]">
                <option value="" disabled="">Choose your option</option>
                <option value="Hindi">Hindi</option>
                <option value="English">English</option>
                <option value="Panjabi">Panjabi</option>
              </select><label> Languages known</label>
            </div>
            <div class="input-field col s4">
              <div class="file-field input-field">
                <div class="btn">
                  <span>File</span>
                  <input type="file" name="resumefile">
                </div>
                
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" value="add CV">
                </div>
              </div>
               @if ($errors->has('resumefile')) 
              <div class="error">{{ $errors->first('resumefile') }}</div> 
              @endif
            </div>

          </div>
           <span id="spin">
          </span>
          <div class="col s12 center-align">
           
            <button type="submit" class="waves-effect waves-light btn" name="makejobprefremce">Submit</button>
          </div>
          </form>

        