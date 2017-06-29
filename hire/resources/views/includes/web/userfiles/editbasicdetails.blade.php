       <h6>Personal Information</h6>
           <form method="post"  id="basicprofile" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="input-field col s4">
              <input placeholder="First Name"  name="first_name" id="first_name" type="text" class="validate" value="{{@$user->name}}">
              <label for="first_name" class="active">First Name</label>
               @if ($errors->has('first_name')) 
                     <div class="error">{{ $errors->first('first_name') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4">
              <input placeholder="Middle Name" name="middle_name" id="first_name" type="text" class="validate" value="{{@$user->middle_name}}">
              <label for="first_name" class="active">Middle Name</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Last Name" id="first_name" name="last_name" type="text" class="validate" value="{{@$user->last_name}}">
              <label for="first_name" class="active">Last Name</label>

            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
              <input  name="gender" type="radio" id="test1male"  value="1" @if(@$getuserdetails->gender==1) checked @endif>
              <label for="test1male">Male</label> 
              <input name="gender" type="radio" id="test1" value="2" @if(@$getuserdetails->gender==2) checked @endif>
              <label for="test1" >Female</label>
              <label for="first_name" class="active">Gender</label>
               @if ($errors->has('gender')) 
              <div class="error">{{ $errors->first('gender') }}</div> 
              @endif
            </div>
            <div class="input-field col s4">
              <input type="date" class="datepickerdob" name="dob" value="{{@$getuserdetails->dob}}">
              <label for="first_name" class="active">DOB</label>
               @if ($errors->has('dob')) 
              <div class="error">{{ $errors->first('dob') }}</div> 
              @endif
            </div>
            <div class="input-field col s4">
              <input placeholder="Mobile Number" id="mobile" name="mobile" type="text" required="required" value="{{@$user->mobile}}">
              <label for="mobile">Mobile Number</label>
              @if ($errors->has('mobile')) 
              <div class="error">{{ $errors->first('mobile') }}</div> 
              @endif
            </div>
          </div>
               <div class="row">
           <div class="input-field col s4">
              <input placeholder="Father Name"  id="father_name" name="fathername" type="text" class="validate" value="{{@$getuserdetails->father_name}}">
              <label for="first_name" class="active">Father Name </label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Mother Name" id="mother_name" name="mothername" type="text" class="validate" value="{{@$getuserdetails->mother_name}}">
              <label for="first_name" class="active">Mother Name</label>
            </div>
       
            <div class="col s4">
              <div class="file-field input-field">
                <div class="btn">
                  <span>Picture</span>
                  <input type="file" name="profileimage">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" value="Upload Profile">
                </div>
              </div>
               @if ($errors->has('profileimage')) 
              <div class="error">{{ $errors->first('profileimage') }}</div> 
              @endif
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
                 <select name="country" class="countrychange"> 
                        <option value="" >Choose your option</option>
                        @if(count($countryList)>0)
                        @foreach($countryList as $countryList)
                        <option value="{{$countryList->id}}" id="{{$countryList->id}}" @if($countryList->id==$user->country) selected @endif>{{$countryList->country}}</option>
                        @endforeach
                        @endif
                       
                      </select>
              <label>Country</label>
            </div>
            <div class="input-field col s4 statechangediv">
                <select name="state" class="statechange">
                        <option value="">Choose your option</option>
                        @if(count($statelist)>0)
                        @foreach($statelist as $statelist)
                        <option value="{{$statelist->id}}" id="{{$statelist->id}}" @if($statelist->id==$user->state) selected @endif>{{$statelist->state}}</option>
                        @endforeach
                        @endif
                </select>
              <label>State</label>
            </div>
            <div class="input-field col s4 citychangediv">
              <select name="city" class="citychange">
                        <option value="" disabled selected>Choose your option</option>
                       
                      </select>
              <label>City</label>
            </div>
          </div>
          <div class="row">
       
            <div class="input-field col s4">
              <input placeholder="Address" id="address" name="address" type="text" class="validate" value="{{@$user->address}}">
              <label for="first_name" class="active">Address</label>
            </div>
              <div class="input-field col s4">
              <input placeholder="Pincode" id="pincode" name="pincode" type="text" class="validate" value="{{@$user->pincode}}">
              <label for="first_name" class="active">Pincode </label>
            </div>
            @if($user->looking_for_job)
            <div class="input-field col s4">
              <input placeholder="Profile Title" id="pincode" name="profile_title" type="text" class="validate" value="{{@$user->profile_title}}">
              <label for="first_name" class="active">Profile Title </label>
            </div>
            @endif
           
          </div>
     
         
          <div class="col s12 center-align">
            <button type="submit" name="editbasicdetails" class="waves-effect waves-light btn">Save
          </div> 
        </form>



<script type="application/javascript"   src="{{URL::to('web/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    // $('select').material_select();
  });


  $("#basicprofile").validate({
      rules: {
                        "email": {                            
                            email: true
                        },
  
              "mobile": {                            
              minlength: 10,
              number:true
              }
                    },
                    messages: {
                        "email": {                           
                            email: "Please enter valid email address"
                        },
         
            "mobile": {       minlength:"Please enter valid mobile number"  ,
            // maxlength:"Please enter valid mobile number",
            number:"Please enter only numbers"                  
                            
                        }
                    }
                
    });
</script>