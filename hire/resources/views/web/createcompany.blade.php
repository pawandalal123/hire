@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12 center-align profile-tab">
          <ul>
            <li><a href="{{URL::to('editprofile')}}">Company Profile</a></li>
           
          </ul>
      </div>
    </div>
  </div>
</section>
<section class="">
  <div class="container">
      <div class="row">
        <div class="card-body col s12 m12 l12 card step">
           @if(Session::has('message'))
        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message') }}
        </div>
        @endif
              <h6>Company Information</h6>
           <form method="post"  id="createcompnay" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="input-field col s4">
              <input placeholder="First Name"  name="companyname" id="first_name" type="text"  value="" required="required"> 
              <label for="first_name" class="active">Compnay Name</label>
               @if ($errors->has('companyname')) 
                     <div class="error">{{ $errors->first('companyname') }}</div> 
                     @endif
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Last Name" id="first_name" name="contact" type="text" class="validate" value="">
              <label for="first_name" class="active">Contact NUmber</label>
              @if ($errors->has('contact')) 
                     <div class="error">{{ $errors->first('contact') }}</div> 
                     @endif

            </div>
            <div class="input-field col s4">
              <input placeholder="Middle Name" name="website" id="website" type="text" class="validate" value="">
              <label for="first_name" class="active">Compnay website</label>
            </div>
          </div>
         
          <div class="row">
           <div class="input-field col s8">
              <input placeholder="Father Name"  id="about" name="about" type="text" class="validate" value="">
              <label for="first_name" class="active">About company</label>
            </div>
          
       
            <div class="input-field col s4">
              <div class="file-field input-field">
                <div class="btn">
                  <span>Logo</span>
                  <input type="file" name="companylogo">
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text" value="Upload Profile">
                </div>
              </div>
               @if ($errors->has('companylogo')) 
              <div class="error">{{ $errors->first('companylogo') }}</div> 
              @endif
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
                 <select name="country" class="countrychangeall"> 
                  <option value="" >Choose your option</option>
                  @if(count($countryList)>0)
                  @foreach($countryList as $countryList)
                  <option value="{{$countryList->id}}" id="{{$countryList->id}}">{{$countryList->country}}</option>
                  @endforeach
                  @endif
                  </select>
              <label>Country</label>
            </div>
            <div class="input-field col s4">
                <select name="state" class="statechange">
                        <option value="">Choose your option</option>
                </select>
              <label>State</label>
            </div>
            <div class="input-field col s4">
              <select name="city">
                        <option value="" disabled selected>Choose your option</option>
                        <option value="1">Google</option>
                        <option value="2">Skype</option>
                        <option value="3">Option 3</option>
                      </select>
              <label>City</label>
            </div>
          </div>
          <div class="row">
       
            <div class="input-field col s4">
              <input placeholder="Address" id="address" name="address" type="text" class="validate" value="">
              <label for="first_name" class="active">Address</label>
            </div>
              <div class="input-field col s4">
              <input placeholder="Pincode" id="pincode" name="pincode" type="text" class="validate" value="">
              <label for="first_name" class="active">Pincode </label>
            </div>
             <div class="input-field col s4">
              
              <select name="industry">
                        <option value="" disabled selected>Choose your option</option>
                        @if(count($indusrtylist)>0)
                        @foreach($indusrtylist as $indusrtylist)
                        <option value="{{$indusrtylist->id}}">{{$indusrtylist->name}}</option>
                        @endforeach()
                        @endif
                      </select>
              <label>Industry</label>
               @if ($errors->has('industry')) 
              <div class="error">{{ $errors->first('industry') }}</div> 
              @endif
            </div>
    
           
          </div>
     
         
          <div class="col s12 center-align">
            <button type="submit" name="createcompnay" class="waves-effect waves-light btn">Save
          </div> 
        </form>



<script type="application/javascript"   src="{{URL::to('web/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
  });

</script>
        
      </div>  
    </div>
  </div>
</section>

@stop