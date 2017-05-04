             <form action="" method="post" id="jobpostforn">
             <div class="row">
             <div class="input-field col s4">
              <input placeholder="job title" id="jobtitle" name="jobtitle" type="text" class="validate" value="" required="required">
              <label>Joining title</label>
                @if ($errors->has('jobtitle')) 
                     <div class="error">{{ $errors->first('jobtitle') }}</div> 
                     @endif
            </div>
             <div class="input-field col s4">
              <input placeholder="Numbe of openings"  name="openings" id="openings" type="text"  required="required"> 
              <label for="openings" class="active">Numbe of openings</label>
               @if ($errors->has('openings')) 
                     <div class="error">{{ $errors->first('openings') }}</div> 
                     @endif
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Company Name - Hiring" id="comphiring" name="comphiring" type="text" class="validate" value="" required="required">
              <label for="comphiring" class="active">Company Name - Hiring
</label>
              @if ($errors->has('comphiring')) 
                     <div class="error">{{ $errors->first('comphiring') }}</div> 
                     @endif

            </div>
            
          </div>
          <div class="row">
          <div class="input-field col s4">
              <input placeholder="Company Name - Client" name="compclient" id="compclient" type="text" class="validate" value="">
              <label for="compclient" class="active">Company Name - Client
</label>
            </div>
             <div class="input-field col s4">
              <input placeholder="Company Website"  name="website" id="website" type="text"  value="" required="required"> 
              <label for="website" class="active">Company Website
</label>
               
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Last Name" id="contactemail" name="contactemail" type="text" class="required" value="" required="required">
              <label for="contactemail" class="active">Contact Email id
</label>
              @if ($errors->has('contactemail')) 
                     <div class="error">{{ $errors->first('contactemail') }}</div> 
                     @endif

            </div>
          
          </div>
          <div class="row">
            <div class="input-field col s4">
                 <select name="country" class="countrychange"> 
                        <option value="" >Choose your option</option>
                        @if(count($countryList)>0)
                        @foreach($countryList as $countryList)
                        <option value="{{$countryList->id}}" id="{{$countryList->id}}">{{$countryList->country}}</option>
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
                        <option value="">Choose your option</option>
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
              <input placeholder="Landline"  name="contactlandline" id="first_name" type="text"  value="" required="required"> 
              <label for="first_name" class="active">Contact Number Landline
</label>
               
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Contact Number Mobile" id="contactmobile" name="contactmobile" type="text" class="validate" value="" required="required">
              <label for="contactmobile" class="active">Contact Number Mobile
</label>
              @if ($errors->has('contactmobile')) 
                     <div class="error">{{ $errors->first('contactmobile') }}</div> 
                     @endif

            </div>
            
              <div class="input-field col s4">
              <select name="industry" required="required">
                        <option value="" disabled selected>Choose your option</option>
                         @foreach($industry as $industry)
                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                        @endforeach()
                      </select>
              <label for="industry">Industry
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
                        <option value="{{$functionalarea->id}}">{{$functionalarea->name}}</option>
                        @endforeach()
                      </select>
              <label>Functional Area/Department Name
</label>
</div>
            
            <div class="input-field col s4">
              <input placeholder="Designation" id="designation" name="designation" type="text" class="validate" value="">
              <label for="designation" class="active">Designation Name
</label>
              @if ($errors->has('designation')) 
              <div class="error">{{ $errors->first('designation') }}</div> 
              @endif

            </div>
               <div class="input-field col s4">
              <select name="emplevel">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Executive</option>
                        <option value="2">Middel</option>
                        <option value="3">Management</option>
                        <option value="4">Higher management</option>
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
              <input placeholder="First Name"  name="projectskills" id="projectskills" type="text"  value="" required="required"> 
              <label for="projectskills" class="active">Project Skill Set</label>
               @if ($errors->has('projectskills')) 
                     <div class="error">{{ $errors->first('projectskills') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4">
              <input placeholder="First Name"  name="jobquality" id="jobquality" type="text"  value="" required="required"> 
              <label for="jobquality" class="active">Job Qualities Required</label>
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
              <input placeholder="Last Name" id="joingtime" name="joingtime" type="text" class="validate" value="">
              <label>Joining time required

</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s2">
              <select name="expyear">

                        <option value="">Year</option>
                        @for($i=1;$i<=25; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
              <label>Experience
</label>
            </div>
            <div class="input-field col s2">
              <select name="expmonth">

                        <option value="">Month</option>
                       @for($i=1;$i<=11; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
              
            </div>
             <div class="input-field col s2">
              <select name="salaryto">

                        <option value="">To</option>
                        @for($i=1;$i<=25; $i+=.5)
                        <option value="{{$i}}">{{$i}} Lakhs</option>
                        @endfor
                      </select>
              <label>Salary
</label>
            </div>
            <div class="input-field col s2">
              <select name="salaryfrom">

                        <option value="">From</option>
                       @for($i=1;$i<=30; $i+=.5)
                        <option value="{{$i}}">{{$i}} Lakhs</option>
                        @endfor
                      </select>
              <!-- <label>Level of Employment -->
</label>
            </div>
             <div class="input-field col s4">
              <input type="date" class="datepicker" name="jobvalid" value="">
              <label for="jobvalid" class="active">Job Opening Valid Upto</label>
               @if ($errors->has('jobvalid')) 
              <div class="error">{{ $errors->first('jobvalid') }}</div> 
              @endif
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <textarea class="materialize-textarea" name="aboutcompnay" id="aboutcompnay"></textarea>
              <label for="aboutcompnay" class="active">About Company</label>
               @if ($errors->has('dob')) 
              <div class="error">{{ $errors->first('dob') }}</div> 
              @endif
            </div>
            <div class="input-field col s6">
              <textarea class="materialize-textarea" name="description" id="description"></textarea>
              <label for="description" class="active">Job Description</label>
               @if ($errors->has('description')) 
              <div class="error">{{ $errors->first('description') }}</div> 
              @endif
            </div>
          </div>
          
           <button type="submit" name="savejob" class="waves-effect waves-light btn article-hire-button">Submit</button> 
           </form>
           <script type="application/javascript"   src="{{URL::to('web/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">

jQuery.validator.addMethod("checkurl", function(value, element)
{
// now check if valid url
return /^(www\.)[A-Za-z0-9_-]+\.+[A-Za-z0-9.\/%&=\?_:;-]+$/.test(value);
}, "Please enter a valid URL."
);


  $("#jobpostforn").validate({
      rules: {
                        "contactemail": {                            
                            email: true
                        },
  
              "contactmobile": {                            
              minlength: 10,
              number:true
              },
              "openings":{
                number:true

              }
                    },
                    messages: {
                        "contactemail": {                           
                            email: "Please enter valid email address"
                        },
         
            "contactmobile": {       minlength:"Please enter valid mobile number"  ,
                              // maxlength:"Please enter valid mobile number",
                              number:"Please enter only numbers"                  
                            
                        }
                    }
                
    });
</script>