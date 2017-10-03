@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1>Company Profile</h1>
      </div>
    </div>
  </div>
</section>
<div class="container user-profile">
  <div class="row">
   @include('includes.web.companyleftbar')
    <div class="col s12 m8 l9">
      <div class="col s12 m12 l12 middle-sec card user-profile">
            <!-- <h2 style="margin-bottom: 10px;">Post JOb</h2> -->
            <h6>Edit Company Information</h6>
             @if(Session::has('message'))
        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message') }}
        </div>
        @endif
           <form method="post"  id="createcompnay" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="input-field col s4">
              <input   name="companyname" id="first_name" type="text"  value="{{@$checkcompnay->compnay_name}}" required="required"> 
              <label for="first_name" class="active">Company Name</label>
               @if ($errors->has('companyname')) 
                     <div class="error">{{ $errors->first('companyname') }}</div> 
                     @endif
            </div>
            
            <div class="input-field col s4">
              <input  id="first_name" name="contact" type="text" class="validate" value="{{@$checkcompnay->contact}}">
              <label for="first_name" class="active">Contact NUmber</label>
              @if ($errors->has('contact')) 
                     <div class="error">{{ $errors->first('contact') }}</div> 
                     @endif

            </div>
            <div class="input-field col s4">
              <input name="website" id="website" type="text" class="validate" value="{{@$checkcompnay->company_website}}">
              <label for="first_name" class="active">Company website</label>
            </div>
          </div>
   
          <div class="row">
            <div class="input-field col s4">
                 <select name="country" class="countrychange"> 
                        <option value="" >Choose your option</option>
                        @if(count($countryList)>0)
                        @foreach($countryList as $countryList)
                        <option value="{{$countryList->id}}" id="{{$countryList->id}}" @if($countryList->id==$checkcompnay->country) selected @endif>{{$countryList->country}}</option>
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
                        <option value="{{$statelist->id}}" id="{{$statelist->id}}" @if($statelist->id==$checkcompnay->state) selected @endif>{{$statelist->state}}</option>
                        @endforeach
                        @endif
                </select>
              <label>State</label>
            </div>
            <div class="input-field col citychangediv">
              <select name="city" class="citychange">
                        <option value="" disabled selected>Choose your option</option>
                        @if(count($citylist)>0)
                        @foreach($citylist as $citylist)
                        <option value="{{$citylist->id}}" id="{{$citylist->id}}" @if($citylist->id==$checkcompnay->city) selected @endif>{{$citylist->city}}</option>
                        @endforeach
                        @endif
                        
                      </select>
              <label>City</label>
            </div>
          </div>
          <div class="row">
       
            <div class="input-field col s4">
              <input  id="address" name="address" type="text" class="validate" value="{{@$checkcompnay->address}}">
              <label for="first_name" class="active">Address</label>
            </div>
              <div class="input-field col s4">
              <input  id="pincode" name="pincode" type="text" class="validate" value="{{@$checkcompnay->pincode}}">
              <label for="first_name" class="active">Pincode </label>
            </div>
             <div class="input-field col s4">
              <select name="industry">
                        <option value="" disabled selected>Choose your option</option>
                        @if(count($indusrtylist)>0)
                        @foreach($indusrtylist as $indusrtylist)
                        <option value="{{$indusrtylist->id}}" @if($checkcompnay->industry==$indusrtylist->id) selected @endif>{{$indusrtylist->name}}</option>
                        @endforeach()
                        @endif
                      </select>
              <label>Industry</label>
               @if ($errors->has('industry')) 
              <div class="error">{{ $errors->first('industry') }}</div> 
              @endif
            </div>
           
          </div>
     
               
          <div class="row">
           <div class="input-field col s8">
             
              <textarea   id="about" name="about" type="text" class="materialize-textarea validate">{{@$checkcompnay->about_company}}</textarea>
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
          <div class="col s12 center-align">
            <button type="submit" name="editcompany" class="waves-effect waves-light btn">Save
          </div> 
        </form>

          
          
           
          </div>
       
   
      </div>
    </div>
  </div>
</div>
@stop
