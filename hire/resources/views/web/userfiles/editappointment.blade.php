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
            <h6>Set</h6>
            @if(Session::has('message'))
            <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ Session::get('message') }}
            </div>
            @endif
                        <form method="post" id="createcompnay" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="row">
            <div class="input-field col s4">
              <input  name="jobtitle" id="first_name" type="text" value="Quail tech" required="required" readonly value="{{$checkjob->jobtitle}}">  
              <label for="first_name" class="active">Job title</label>
                           </div>
            
            <div class="input-field col s4">
              <input  id="first_name" name="jobowner" type="text" class="validate" value="{{$checkjob->company_client}}" readonly>
              <label for="first_name" class="active">Job Owner Name</label>
              
            </div>
            <div class="input-field col s4">
              <input  name="ownernumber" id="website" type="text" class="validate" value="{{$checkjob->contact_mobile}}" readonly>
              <label for="first_name" class="active">Job Owner Number</label>
            </div>
          </div>
   
         
          <div class="row">
       
           
           
             <div class="input-field col s4">
             <select name="appintround" class="initialized">
                        <option value="0" >Choose your option</option>
                        <option value="1" >Normal Understanding</option>
                        <option value="2">HR First Round</option>
                        <option value="3">Techinichal Round</option>
                                                
                        </select>
              <label>Job Interview Rounds Decided</label>
              @if ($errors->has('appintround')) 
              <div class="error">{{ $errors->first('appintround') }}</div> 
              @endif
                           </div>
                            <div class="input-field col s8">
              <input  name="appointmode" type="radio" id="test1male"  value="1" @if($checkappointment->appointment_mode==1)  checked @endif>
              <label for="test1male">Voice Calling</label> 
              <input name="appointmode" type="radio" id="test1" value="2" @if($checkappointment->appointment_mode==2)  checked @endif>
              <label for="test1" >Video Caling</label>
              <input name="appointmode" type="radio" id="test2" value="3" @if($checkappointment->appointment_mode==3)  checked @endif>
              <label for="test2" >Office Visit</label>
              <!-- <input name="appointmode" type="radio" id="test3" value="4"> -->
              <!-- <label for="test3" >Office Address</label> -->
              <label for="first_name" class="active">Mode</label>
            </div>
           
          </div>
     
               
          <div class="row">
          <div class="input-field col s4 officeaddress" @if ($errors->has('officeaddress') || $checkappointment->appointment_mode==3) @else style="display: none;" @endif>
              <input  name="officeaddress" id="officeaddress" type="text" class="validate" value="{{$checkappointment->officeaddress}}" placeholder="Office address">
              <!-- <label for="officeaddress" class="active">Office address</label> -->
               @if ($errors->has('officeaddress')) 
              <div class="error">{{ $errors->first('officeaddress') }}</div> 
              @endif
            </div>
          <div class="input-field col s4">
              <input type="date" class="datepicker" name="appointdate" value="{{$checkappointment->appointment_date}}">
              <label for="first_name" class="active">Date</label>
               @if ($errors->has('appointdate')) 
              <div class="error">{{ $errors->first('appointdate') }}</div> 
              @endif
            </div>
            <div class="input-field col s4">
              <input type="date" class="timepicker" name="appointime" value="{{$checkappointment->appointment_time}}">
              <label for="appointime" class="active">Time</label>
               @if ($errors->has('appointime')) 
              <div class="error">{{ $errors->first('appointime') }}</div> 
              @endif
            </div>
           <div class="input-field col s8">
             
              <textarea  id="about" name="about" type="text" class="materialize-textarea validate" style="height: 54px;">{{$checkjob->job_description}}</textarea>
              <label for="first_name" class="active">Job Desciption</label>
            </div>
          
       
            
          </div>
          <div class="col s12 center-align">
            <button type="submit" name="editappointment" class="waves-effect waves-light btn">Save
          </button></div> 
        </form>

          
          
           
          </div>
       
   
      </div>
   
  </div>
</div>
@stop
