<form action="" method="post">
             <div class="row">
             <div class="input-field col s4">
              <input placeholder="job title" id="first_name" name="jobtitle" type="text" class="validate" value="{{$jobdetails->jobtitle}}">
              <label>Joining title</label>
 @if ($errors->has('jobtitle')) 
                     <div class="error">{{ $errors->first('jobtitle') }}</div> 
                     @endif
            </div>
             <div class="input-field col s4">
              <input placeholder="Numbe of openings"  name="openings" id="first_name" type="text"  value="{{$jobdetails->openings}}" required="required"> 
              <label for="first_name" class="active">Numbe of openings</label>
               @if ($errors->has('openings')) 
                     <div class="error">{{ $errors->first('openings') }}</div> 
                     @endif
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Company Name - Hiring" id="first_name" name="comphiring" type="text" class="validate" value="{{$jobdetails->compnay_hiring}}">
              <label for="first_name" class="active">Company Name - Hiring
</label>
              @if ($errors->has('comphiring')) 
                     <div class="error">{{ $errors->first('comphiring') }}</div> 
                     @endif

            </div>
            <div class="input-field col s4">
              <input placeholder="Company Name - Client" name="compclient" id="compclient" type="text" class="validate" value="{{$jobdetails->company_client}}">
              <label for="first_name" class="active">Company Name - Client
</label>
            </div>
          </div>
          <div class="row">
             <div class="input-field col s4">
              <input placeholder="Company Website"  name="website" id="first_name" type="text"  value="{{$jobdetails->openings}}" required="required"> 
              <label for="first_name" class="active">Company Website
</label>
               
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Last Name" id="first_name" name="contactemail" type="text" class="validate" value="{{$jobdetails->company_email}}">
              <label for="first_name" class="active">Contact Email id
</label>
              @if ($errors->has('contactemail')) 
                     <div class="error">{{ $errors->first('contactemail') }}</div> 
                     @endif

            </div>
           <div class="input-field col s4">
              <input type="date" class="datepicker" name="jobvalid" value="{{$jobdetails->valid_till}}">
              <label for="jobvalid" class="active">Job Opening Valid Upto</label>
               @if ($errors->has('jobvalid')) 
              <div class="error">{{ $errors->first('jobvalid') }}</div> 
              @endif
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
                 <select name="country" class="countrychange"> 
                        <option value="" >Choose your option</option>
                        @if(count($countryList)>0)
                        @foreach($countryList as $countryList)
                        <option value="{{$countryList->id}}" id="{{$countryList->id}}" @if($countryList->id==$jobdetails->country) selected @endif>{{$countryList->country}}</option>
                        @endforeach
                        @endif
                       
                      </select>
              <label>Country</label>
              @if ($errors->has('country')) 
                     <div class="error">{{ $errors->first('country') }}</div> 
                     @endif
            </div>
           <div class="input-field col s4 statechangediv">
                <select name="state" class="statechange">
                        @if(count($statelist)>0)
                        @foreach($statelist as $statelist)
                        <option value="{{$statelist->id}}" id="{{$statelist->id}}" @if($statelist->id==$jobdetails->state) selected @endif>{{$statelist->state}}</option>
                        @endforeach
                        @endif
                </select>
              <label>State</label>
              @if ($errors->has('state')) 
                     <div class="error">{{ $errors->first('state') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4 citychangediv">
              <select name="city" class="citychange">
                        <option value="" disabled selected>Choose your option</option>
                       
                      </select>
              <label>City</label>
              @if ($errors->has('city')) 
                     <div class="error">{{ $errors->first('city') }}</div> 
                     @endif
            </div>
          </div>
          <div class="row">
             <div class="input-field col s4">
              <input placeholder="Landline"  name="contactlandline" id="first_name" type="text"  value="{{$jobdetails->contact_landline}}" required="required"> 
              <label for="first_name" class="active">Contact Number Landline
</label>
               
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Contact Number Mobile" id="first_name" name="contactmobile" type="text" class="validate" value="{{$jobdetails->contact_mobile}}">
              <label for="first_name" class="active">Contact Number Mobile
</label>
              @if ($errors->has('contactmobile')) 
                     <div class="error">{{ $errors->first('contactmobile') }}</div> 
                     @endif

            </div>
            
              <div class="input-field col s4">
              <select name="industry">
                        <option value="" disabled selected>Choose your option</option>
                         @foreach($industry as $industry)
                        <option value="{{$industry->id}}" @if($industry->id==$jobdetails->industry) selected @endif>{{$industry->name}}</option>
                        @endforeach()
                      </select>
              <label>Industry
</label>
@if ($errors->has('industry')) 
                     <div class="error">{{ $errors->first('industry') }}</div> 
                     @endif
           
            </div>
          </div>
          <div class="row">
             <div class="input-field col s4">
             <select name="functionalarea">
                        <option value="" disabled selected>Choose your option</option>
                       @foreach($functionalarea as $functionalarea)
                        <option value="{{$functionalarea->id}}" @if($industry->id==$jobdetails->functional_area) selected @endif>{{$functionalarea->name}}</option>
                        @endforeach()
                      </select>
              <label>Functional Area/Department Name
</label>
</div>
            
            <div class="input-field col s4">
              <input placeholder="Designation" id="first_name" name="designation" type="text" class="validate" value="{{$jobdetails->designation}}">
              <label for="first_name" class="active">Designation Name
</label>
              @if ($errors->has('designation')) 
              <div class="error">{{ $errors->first('designation') }}</div> 
              @endif

            </div>
               <div class="input-field col s4">
              <select name="emplevel">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1" @if($jobdetails->emp_level==1) selected @endif>Executive</option>
                        <option value="2" @if($jobdetails->emp_level==2) selected @endif>Middel</option>
                        <option value="3" @if($jobdetails->emp_level==3) selected @endif>Management</option>
                        <option value="4" @if($jobdetails->emp_level==4) selected @endif>Higher management</option>
                      </select>
              <label>Level of Employment
</label>
            </div>
            </div>
               <div class="row">
            <div class="input-field col s4">
              <select name="projectnature">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="implementing CRM applications">Implementing CRM applications</option>
                        <option value="handle multiple tasks">Handle multiple tasks</option>
                        <!-- <option value="3">Option 3</option> -->
                      </select>
              <label>Project Nature

</label>
            </div>


             <div class="input-field col s4">
              <input placeholder="First Name"  name="projectskills" id="first_name" type="text"  value="{{$jobdetails->skill}}" required="required"> 
              <label for="first_name" class="active">Project Skill Set</label>
               @if ($errors->has('projectskills')) 
                     <div class="error">{{ $errors->first('projectskills') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4">
              <input placeholder="First Name"  name="jobquality" id="first_name" type="text"  value="{{$jobdetails->job_quality}}" required="required"> 
              <label for="first_name" class="active">Job Qualities Required</label>
               @if ($errors->has('jobquality')) 
              <div class="error">{{ $errors->first('jobquality') }}</div> 
              @endif
               
            </div>
          </div>
           <div class="row">
           
            <div class="input-field col s4">
              <select name="job_education">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Graduaction</option>
                        <option value="2">Post graduaction</option>
                        <option value="3">xii</option>
                         <option value="4">x</option>
                      </select>
              <label>Education Required

</label>
            </div>
            <div class="input-field col s4">
              <select name="job_type">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Full time</option>
                        <option value="2">Part time</option>
                        <!-- <option value="3">Option 3</option> -->
                      </select>
              <label>Type Of Employment
</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Last Name" id="first_name" name="joingtime" type="text" class="validate" value="">
              <label>Joining time required

</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s2">
              <select name="expyear">

                        <option value="">Year</option>
                        @for($i=1;$i<=25; $i++)
                        <option value="{{$i}}" @if($i==$jobdetails->experience_year) selected @endif>{{$i}}</option>
                        @endfor
                      </select>
              <label>Experience
</label>
            </div>
            <div class="input-field col s2">
              <select name="expmonth">

                        <option value="">Month</option>
                       @for($i=1;$i<=11; $i++)
                        <option value="{{$i}}" @if($i==$jobdetails->experience_month) selected @endif>{{$i}}</option>
                        @endfor
                      </select>
              
            </div>
             <div class="input-field col s2">
              <select name="salaryto">

                        <option value="">To</option>
                        @for($i=1;$i<=25; $i+=.5)
                        <option value="{{$i}}" @if($i==$jobdetails->salary_min) selected @endif>{{$i}} Lakhs</option>
                        @endfor
                      </select>
              <label>Salary
</label>
            </div>
            <div class="input-field col s2">
              <select name="salaryfrom">

                        <option value="">From</option>
                       @for($i=1;$i<=30; $i+=.5)
                        <option value="{{$i}}" @if($i==$jobdetails->salary_max) selected @endif>{{$i}} Lakhs</option>
                        @endfor
                      </select>
              <!-- <label>Level of Employment -->
</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <textarea class="materialize-textarea" name="aboutcompnay"><?php echo $jobdetails->about_compnay;?></textarea>
              <label for="first_name" class="active">About Company</label>
               @if ($errors->has('dob')) 
              <div class="error">{{ $errors->first('dob') }}</div> 
              @endif
            </div>
            <div class="input-field col s6">
              <textarea class="materialize-textarea" name="description"><?php echo $jobdetails->job_description;?></textarea>
              <label for="first_name" class="active">Job Description</label>
               @if ($errors->has('description')) 
              <div class="error">{{ $errors->first('description') }}</div> 
              @endif
            </div>
          </div>
          
           <button type="submit" name="editjob" class="waves-effect waves-light btn article-hire-button">Submit</button> 
           </form>