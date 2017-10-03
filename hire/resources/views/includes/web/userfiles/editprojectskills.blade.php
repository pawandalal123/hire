         @if($editempdata!='' & isset($_GET['editprojectid']))
         <form method="post"  id="projectskillsedit">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="projectskills">
         <div class="row">
            <div class="input-field col l4 m6  s12">
              <select class="initialized" name="projectcmp">
                <option value="" disabled="">Select Company</option>
                @if(count($companywork)>0)
               @foreach($companywork as $companywork=>$valcmp)
               <option value="{{$companywork}}" @if(@$editempdata->company_id==$companywork) selected @endif>{{$valcmp}}</option>
               @endforeach()
               @endif
              </select>
              <label>Select Company</label>
               @if ($errors->has('company')) 
                     <div class="error">{{ $errors->first('company') }}</div> 
                     @endif
            </div>
               <div class="input-field col l4 m6  s12">
              <select class="initialized" name="industry">
                <option value="" disabled="" >Industry</option>
                @if(count($indusrtylist)>0)
                @foreach($indusrtylist as $induskey=>$indutryval)
               <option value="{{$induskey}}" @if(@$editempdata->industry==$induskey) selected @endif>{{$indutryval}}</option>
               @endforeach()
               @endif
              </select>
              <label>Select Industry</label>
               @if ($errors->has('industry')) 
                     <div class="error">{{ $errors->first('industry') }}</div> 
                     @endif
            </div>
          </div>
            
          <div class="row">
          <div class="input-field col l4 m6  s12">
              <input placeholder="Name Company Website" name="projectname" id="company_name_website" type="text" class="required" required="required" value="{{@$editempdata->project_name}}">
              <label for="first_name" class="active">Project Name</label>
               @if ($errors->has('company')) 
                     <div class="error">{{ $errors->first('company') }}</div> 
                     @endif
            </div>
          
            <div class="input-field col l4 m6  s12">
              <input placeholder="Project location" name="projectloc" type="text" class="validate" required="required" id="projectloc" value="{{@$editempdata->project_location}}">
              <label for="projectloc" class="active">Project Location</label>
               @if ($errors->has('company')) 
                     <div class="error">{{ $errors->first('company') }}</div> 
                     @endif
            </div>
            <div class="input-field col l4 m6  s12">
              <input placeholder="Company Name" id="projectnature" name="projectnature" type="text" class="validate" required="required" value="{{@$editempdata->project_nature}}">
              <label for="projectnature" class="active">Project Nature</label>
               @if ($errors->has('company')) 
                     <div class="error">{{ $errors->first('company') }}</div> 
                     @endif
         
            
          </div>

          </div>
             <div class="row">
             <div class="input-field col l4 m6  s12">
              <input placeholder="Name Company Website" name="projectskill" id="company_name_website" type="text" class="required" required="required" value="{{@$editempdata->project_skill}}">
              <label for="company_name_website" class="active">Project Skill Set</label>
            </div>
           <?php
           $workform = '';
            $workto = '';
           if($editempdata->worked_from!='0000-00-00')
           {
            $workform=$editempdata->worked_from;

           } 
           if($editempdata->worked_to!='0000-00-00')
           {
            $workto=$editempdata->worked_to;

           } 
           ?>
             <div class="input-field col l4 m6  s12">
              <input type="date" class="datepicker" name="workedfromproject" value="{{@$workform}}" id="workedfromproject">
              <label for="workedfromproject" class="active" >Company Worked From</label>
            </div>
            <div class="input-field col l4 m6  s12">
             <input type="date" class="datepicker" name="workedtoproject" value="{{@$workto}}" id="workedtoproject">
              <label for="workedtoproject" class="active">Company Worked To</label>
            </div>
           
            
          </div>
         
      
       
          </div>

         
          <span id="spin">
            
          </span>
          <div class="col s12 center-align">
            <button type="submit" name="editproject" class="waves-effect waves-light btn">Update</button>
          </div>
         
          </form>
         @else
         <form method="post"  id="projectskills">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="projectskills">
         <div class="row">
            <div class="input-field col l4 m6  s12">
              <select class="initialized" name="projectcmp[]">
                <option value="" disabled="" selected="">Select Company</option>
                @if(count($companywork)>0)
               @foreach($companywork as $companywork=>$valcmp)
               <option value="{{$companywork}}">{{$valcmp}}</option>
               @endforeach()
               @endif
              </select>
              <label>Select Company</label>
            </div>
              <div class="input-field col l4 m6  s12">
              <select class="initialized" name="industry[]">
                <option value="" disabled="" selected="">Industry</option>

                @if(count($indusrtylist)>0 && $indusrtylist!='')
               @foreach($indusrtylist as $induskey=>$indutryval)
               <option value="{{$induskey}}">{{$indutryval}}</option>
               @endforeach()
               @endif
              </select>
              <label>Select Industry</label>
               
            </div>
          
          </div>

        
          <div class="row">
          <div class="input-field col l4 m6  s12">
              <input placeholder="Name Company Website" name="projectname[]" id="company_name_website" type="text" class="required" required="required">
              <label for="first_name" class="active">Project Name</label>
            </div>
          
            <div class="input-field col l4 m6  s12">
              <input placeholder="Current Designation" name="projectloc[]" type="text" class="validate" required="required">
              <label for="Designation" class="active">Project Location</label>
            </div>
            <div class="input-field col l4 m6  s12">
              <input placeholder="Company Name" id="company" name="projectnature[]" type="text" class="validate" required="required">
              <label for="first_name" class="active">Project Nature</label>
         
            
          </div>

          </div>
             <div class="row">
             <div class="input-field col l4 m6  s12">
              <input placeholder="Name Company Website" name="projectskill[]" id="company_name_website" type="text" class="required" required="required">
              <label for="first_name" class="active">Project Skill Set</label>
            </div>
           
             <div class="input-field col l4 m6  s12">
              <input type="date" class="datepicker" name="workedfromproject[]" value="">
              <label for="first_name" class="active">Company Worked From</label>
            </div>
            <div class="input-field col l4 m6  s12">
             <input type="date" class="datepicker" name="workedtoproject[]" value="">
              <label for="first_name" class="active">Company Worked To</label>
            </div>
           
            
          </div>
         
      
       
          </div>

          <div class="col s12 space1">
          <span class="add waves-effect waves-light btn addmoreemp">add more project</span>
          </div>
          <span id="spin">
            
          </span>
          <div class="col s12 center-align">
            <button type="submit" name="makeproject" class="waves-effect waves-light btn">Save</button>
          </div>
         
          </form>
     
<input type="hidden" name="countervalue" value="1">
<script type="application/javascript"   src="{{URL::to('web/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() 
{
  var industrylist = <?php echo json_encode($indusrtylist);?>;
    $('select').material_select();
    var companyworklist = {!!$companyworklist!!};
$(document).on('click','.addmoreemp',function()
{
  var counter = $('input[name=countervalue]').val();
  var html = '<div class="projectskills"> <div class="row">            <div class="input-field col s2">              <select class="selectboxnew'+counter+'" name="projectcmp[]">                <option value="" disabled="" selected="">Select Company</option>';
                $.each(companyworklist, function(k, v)
  {
         html+='<option value="'+k+'">'+v+'</option>';  
     });
              html+='</select></div>                     </div>          <div class="row"><div class="input-field col l4 m6  s12"><input placeholder="Name Company Website" name="projectname[]" id="company_name_website" type="text" class="required" required="required">              <label for="first_name" class="active">Project Name</label></div><div class="input-field col l4 m6  s12">              <input placeholder="Current Designation" name="projectloc[]" type="text" class="validate" required="required">              <label for="Designation" class="active">Project Location</label>            </div>            <div class="input-field col l4 m6  s12">              <input placeholder="Company Name" id="company" name="projectnature[]" type="text" class="validate" required="required">              <label for="first_name" class="active">Project Nature</label>            </div>                     </div>             <div class="row">            <div class="input-field col l4 m6  s12">              <input placeholder="Name Company Website" name="projectskill[]" id="company_name_website" type="text" class="required" required="required">              <label for="first_name" class="active">Project Skill Set</label>            </div> <div class="input-field col l4 m6  s12"><input type="date" class="datepicker" name="workedfromproject[]" value=""><label for="first_name" class="active">Company Worked From</label>            </div><div class="input-field col l4 m6  s12">             <input type="date" class="datepicker" name="workedtoproject[]" value="">              <label for="first_name" class="active">Company Worked To</label>            </div>          </div>';

  var LastDiv = $(".projectskills:last");
  LastDiv.after(html);
   $('.selectboxnew'+counter).material_select();
   $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100 ,// Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });

  counter++;
  $('input[name=countervalue]').val(counter);
});
  });

  $("#projectskills").validate({
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
