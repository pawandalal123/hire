@if($editempdata!='' & isset($_GET['edit']))
<form method="post"  id="employment">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="employment">
          <div class="row">
            <div class="input-field col s4">
              <input placeholder="Current Designation" name="Designation" type="text" class="validate" required="required" value="{{@$editempdata->designation}}">
              <label for="Designation" class="active">Designation</label>
              @if ($errors->has('Designation')) 
                     <div class="error">{{ $errors->first('Designation') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4">
              <input placeholder="Company Name" id="company" name="company" type="text" class="validate" required="required" value="{{@$editempdata->company_name}}">
              <label for="first_name" class="active">Company</label>
              @if ($errors->has('company')) 
                     <div class="error">{{ $errors->first('company') }}</div> 
                     @endif
            </div>
          </div>
             <div class="row">
            <div class="input-field col s4">
              <input placeholder="Company Website" value="{{@$editempdata->company_website}}" name="website" id="website" type="text" class="required">
              <label for="website" class="active">Company Website</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Name Company Website" value="{{@$editempdata->company_name_website}}" name="company_name_website" id="company_name_website" type="text" class="required" required="required">
              <label for="company_name_website" class="active">Name Company Website</label>
            </div>
          </div>
         
          <div class="row">
            <div class="input-field col s2">
              <select class="initialized" name="year">
                <option value="" disabled="" selected="">Year</option>
               @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}">{{$i}}</option>
               @endfor()
              </select>
              <label>Working Since</label>
            </div>
            <div class="input-field col s2">
             <select class="initialized" name="month">
                <option value="" disabled="" selected="">Month</option>
                @for ($month = 1; $month <= 12; $month++)
               <option value="{{$month}}">{{$month}}</option>
               @endfor()
              </select>
              <label></label>
            </div>
            <div class="input-field col s2">
              <div class="to">To</div>
              <select class="float-left initialized" name="till">
                <option value="0" selected="">Present</option>
                @for ($till = 1990; $till <= date('Y'); $till++)
               <option value="{{$till}}">{{$till}}</option>
               @endfor()
              </select>
            </div>
          </div>
      
          <div class="row">
            <div class="input-field col s6">
             <input  type="text" value="{{@$editempdata->job_profile}}" class="input" placeholder="" name="job_profile">
              <label >Job Profile</label>
              @if ($errors->has('job_profile')) 
                     <div class="error">{{ $errors->first('job_profile') }}</div> 
                     @endif
            </div>
          </div>
          </div>

         
          <span id="spin">
            
          </span>
          <div class="col s12 center-align">
            <button type="submit" name="updateemployment" class="waves-effect waves-light btn">Update</button>
          </div>
         
          </form>


@else         <form method="post"  id="employment">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="employment">
          <div class="row">
            <div class="input-field col s4">
              <input placeholder="Current Designation" name="Designation[]" type="text" class="validate" required="required">
              <label for="Designation" class="active">Designation</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Company Name" id="company" name="company[]" type="text" class="validate" required="required">
              <label for="first_name" class="active">Company</label>
            </div>
          </div>
             <div class="row">
            <div class="input-field col s4">
              <input placeholder="Company Website" name="website[]" id="first_name" type="text" class="required">
              <label for="first_name" class="active">Company Website</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Name Company Website" name="company_name_website[]" id="company_name_website" type="text" class="required" required="required">
              <label for="first_name" class="active">Name Company Website</label>
            </div>
          </div>
         
          <div class="row">
            <div class="input-field col s2">
              <select class="initialized" name="year[]">
                <option value="" disabled="" selected="">Year</option>
               @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}">{{$i}}</option>
               @endfor()
              </select>
              <label>Working Since</label>
            </div>
            <div class="input-field col s2">
             <select class="initialized" name="month[]">
                <option value="" disabled="" selected="">Month</option>
                @for ($month = 1; $month <= 12; $month++)
               <option value="{{$month}}">{{$month}}</option>
               @endfor()
              </select>
              <label></label>
            </div>
            <div class="input-field col s2">
              <div class="to">To</div>
              <select class="float-left initialized" name="till[]">
                <option value="0" selected="">Present</option>
                @for ($till = 1990; $till <= date('Y'); $till++)
               <option value="{{$till}}">{{$till}}</option>
               @endfor()
              </select>
            </div>
          </div>
      
          <div class="row">
            <div class="input-field col s6">
             <input  type="text" class="input" placeholder="" name="job_profile[]">
              <label >Job Profile</label>
            </div>
          </div>
          </div>

          <div class="col s12">
          <span class="add waves-effect waves-light btn addmoreemp">Add More Job Experience</span>
          </div>
          <span id="spin">
            
          </span>
          <div class="col s12 center-align">
            <button type="submit" name="makeemployment" class="waves-effect waves-light btn">Save</button>
          </div>
         
          </form>
     
<input type="hidden" name="countervalue" value="1">
<script type="application/javascript"   src="{{URL::to('web/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();
$(document).on('click','.addmoreemp',function()
{
  var counter = $('input[name=countervalue]').val();
  var html = '       <div class="employment">          <div class="row">            <div class="input-field col s4">              <input placeholder="Current Designation" name="Designation[]" type="text" class="required" required="required">              <label for="Designation" class="active">Designation</label>            </div>            <div class="input-field col s4">              <input placeholder="Company Name" id="company'+counter+'" name="company[]" type="text" class="validate" required="required"><label for="first_name" class="active">Company</label>            </div>          </div>             <div class="row">            <div class="input-field col s4"><input placeholder="Company Website" name="website[]" id="first_name'+counter+'" type="text" class="required">              <label for="first_name" class="active">Company Website</label>            </div>            <div class="input-field col s4">              <input placeholder="Name Company Website" name="company_name_website[]" id="company_name_website'+counter+'" type="text" class="required">              <label for="first_name" class="active">Name Company Website</label>            </div>          </div>          <div class="row">            <div class="input-field col s2">              <select class="selectbox selectboxnew'+counter+' initialized" name="year[]">                <option value="" disabled="" selected="">Year</option>';

               @for ($i = 1990; $i <= date('Y'); $i++)
               html+='<option value="{{$i}}">{{$i}}</option>';
               @endfor()
               html+='</select>              <label>Working Since</label>            </div>            <div class="input-field col s2">             <select class="selectbox selectboxnew'+counter+' initialized" name="month[]">                <option value="" disabled="" selected="">Month</option>';
               @for ($month = 1; $month <= 12; $month++)         
                     html+='<option value="{{$month}}">{{$month}}</option>';   
                          @endfor()             
                            html+='</select>              <label></label>            </div>            <div class="input-field col s2">              <div class="to">To</div>              <select class="selectbox selectboxnew'+counter+' float-left initialized" name="till[]">                <option value="0" selected="">Present</option>';
                               @for ($till = 1990; $till <= date('Y'); $till++)       
                                       html+='<option value="{{$till}}">{{$till}}</option>';
                                       @endfor()               html+='</select>            </div>          </div>          <div class="row">            <div class="input-field col s6">             <input  type="text" class="input" placeholder="" name="job_profile[]">              <label >Job Profile</label>            </div>          </div>          </div>';

  var LastDiv = $(".employment:last");
  LastDiv.after(html);
   $('.selectboxnew'+counter).material_select();

  counter++;
  $('input[name=countervalue]').val(counter);
});
  });

  $("#employment").validate({
      rules: {
          Designation: "required",
          company: "required",
          "website": {                            
                            url: true
                        },
                        messages: {
                        
            "website": {                           
                            url: "Please enter valid url"
                        }
                    }
                
        }
    });

</script>
@endif
