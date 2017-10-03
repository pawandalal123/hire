
 <link rel="stylesheet" type="text/css" href="{{ URL::asset('web/css/jquery-ui.min.css')}}" >
 {{--*/ $postcourselist=$courselist /*--}}
  {{--*/ $xschoolboardlist=$schoolboardlist /*--}}
   {{--*/ $xschoolmedium=$schoolmedium /*--}}
    {{--*/ $allSubcourselist=$postSubcourselist /*--}}

     {{--*/ $ugflag=0 /*--}}
  {{--*/ $pgflag=0 /*--}}
   {{--*/ $xflag=0 /*--}}
    {{--*/ $xiiflag=0 /*--}}
         
        <form method="post"  id="education">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         @if(array_key_exists(1,$usereducationArry))
         {{--*/ $ugflag=1 /*--}}
          <div class="employment graduation">
           <h6>Fill your Graduation detail</h6>
            <div class="row">
            <div class="input-field col s4">
             <select class="initialized coursechange" name="ugcourse">
                <option value=""  selected="">Choose your option</option>
               @foreach($courselist as $courselist)
               @if($courselist->course_for==1)
               <option value="{{$courselist->id}}" @if($courselist->id==$usereducationArry[1]['course_name'])  selected @endif>{{$courselist->course_name}}</option>
               @endif
               @endforeach
              </select>
              <label>Qualification</label>
            </div>
            <div class="input-field col s4 coursechnagediv">
            <select class="initialized" class="subcourse" name="ugspec">
                <option value="" >Choose your option</option>
                @foreach($Subcourselist as $Subcourselist)
               <option value="{{$Subcourselist->id}}" @if($Subcourselist->id==$usereducationArry[1]['course_spec'])  selected @endif>{{$Subcourselist->sub_course_name}}</option>
               @endforeach
              </select>
              <label>Specialization</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="University/college" name="ugcollage" id="universirty_college" type="text" class="validate" value="{{@$usereducationArry[1]['educate_from']}}">
              <label for="universirty_college" class="active">University/college</label>
               @if ($errors->has('ugcollage')) 
                     <div class="error">{{ $errors->first('ugcollage') }}</div> 
                     @endif
            </div>
                 
          </div>
          <div class="row">
            <div class="input-field col s4">
              <input name="ugcoursemode" type="radio" id="ugfull" value="1"  @if($usereducationArry[1]['course_mode']==1)  checked @endif><label for="ugfull">Full Time</label> 
              <input name="ugcoursemode" type="radio" id="ugpart" value="2"  @if($usereducationArry[1]['course_mode']==2)  checked @endif><label for="ugpart">Part Time</label>
              <input name="ugcoursemode" type="radio" id="test1" value="3"  @if($usereducationArry[1]['course_mode']==3)  checked @endif><label for="test1">Correspondence</label>
              <label for="first_name" class="active">Course Type</label>
            </div>
     
            <div class="input-field col s4">
             <select class="initialized" name="ugpassingyear">
                <option value="" disabled="" selected="">Choose your option</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}" @if($i==$usereducationArry[1]['passing_year'])  selected @endif>{{$i}}</option>
               @endfor()
              </select>
              <label>Passing year</label>
            </div>
             <div class="input-field col s4">
              <input placeholder="Marks" name="ugmarks" id="first_name" type="text" class="validate" value="{{@$usereducationArry[1]['marks']}}">
              <label for="first_name" class="active">Marks</label>
              @if ($errors->has('ugmarks')) 
                     <div class="error">{{ $errors->first('ugmarks') }}</div> 
                     @endif
            </div>
          </div>
          </div>
          @else
          <div class="employment graduation">

           <h6>Fill your Graduation detail</h6>
            <div class="row">
            <div class="input-field col s4">
             <select class="initialized coursechange" name="ugcourse">
                <option value=""  selected="">Choose your option</option>
               @foreach($courselist as $courselist)
               @if($courselist->course_for==1)
               <option value="{{$courselist->id}}">{{$courselist->course_name}}</option>
               @endif
               @endforeach
              </select>
              <label>Qualification</label>
            </div>
            <div class="input-field col s4 coursechnagediv">
            <select class="initialized" name="ugspec">
                <option value="" >Choose your option</option>
                @foreach($Subcourselist as $Subcourselist)
               <option value="{{$Subcourselist->id}}">{{$Subcourselist->sub_course_name}}</option>
               @endforeach
              </select>
              <label>Specialization</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="University/college" name="ugcollage" id="universirty_college" type="text" class="validate">
              <label for="universirty_college" class="active">University/college</label>
              @if ($errors->has('ugcollage')) 
                     <div class="error">{{ $errors->first('ugcollage') }}</div> 
                     @endif
            </div>
                 
          </div>
          <div class="row">
            <div class="input-field col s4">
              <input name="ugcoursemode" type="radio" id="ugfull" value="1" checked><label for="ugfull">Full Time</label> 
              <input name="ugcoursemode" type="radio" id="ugpart" value="2"><label for="ugpart">Part Time</label>
              <input name="ugcoursemode" type="radio" id="test1" value="3"><label for="test1">Correspondence</label>
              <label for="first_name" class="active">Course Type</label>
            </div>
     
            <div class="input-field col s4">
             <select class="initialized" name="ugpassingyear">
                <option value="" disabled="" selected="">Choose your option</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}">{{$i}}</option>
               @endfor()
              </select>
              <label>Passing year</label>
            </div>
             <div class="input-field col s4">
              <input placeholder="Marks" name="ugmarks" id="first_name" type="text" class="validate">
              <label for="first_name" class="active">Marks</label>
              @if ($errors->has('ugmarks')) 
                     <div class="error">{{ $errors->first('ugmarks') }}</div> 
                     @endif
            </div>
          </div>
          </div>
          @endif
                   <!--  post graduation form -->
        @if(array_key_exists(2,$usereducationArry))
         {{--*/ $pgflag=1 /*--}}
           <div class="employment postgraduation">
           <h6>Post Graduation</h6>
            <div class="row">
            <div class="input-field col s4">
             <select class="initialized postchange" name="postcourse">
                <option value="" >Choose your option</option>
                @foreach($postcourselist as $postcourselist)
               @if($postcourselist->course_for==2)
               <option value="{{$postcourselist->id}}" @if($postcourselist->id==$usereducationArry[2]['course_name'])  selected @endif>{{$postcourselist->course_name}}</option>
               @endif
               @endforeach
              </select>
              <label>Qualification</label>
            </div>
               <div class="input-field col s4 postchangesubcourse">
               <select class="initialized pgsubcourse" name="pgspec">
                <option value="" >Choose your option</option>
                @foreach($allSubcourselist as $Subcourselist)
               <option value="{{$Subcourselist->id}}" @if($Subcourselist->id==$usereducationArry[2]['course_spec'])  selected @endif>{{$Subcourselist->sub_course_name}}</option>
               @endforeach
              </select>
              <label>Specialization</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="University/college" name="pgcollege" id="universirty_college" type="text" class="validate" value="{{@$usereducationArry[2]['educate_from']}}">
              <label for="universirty_college" class="active">University/college</label>
              @if ($errors->has('pgcollege')) 
                     <div class="error">{{ $errors->first('pgcollege') }}</div> 
                     @endif
            </div>
           
          </div>
          <div class="row">
            <div class="input-field col s4">
              <input name="pgcoursemode" type="radio" id="fulltime" value="1" @if($usereducationArry[2]['course_mode']==1)  checked @endif><label for="fulltime">Full Time</label> 
              <input name="pgcoursemode" type="radio" id="parttime" value="2" @if($usereducationArry[2]['course_mode']==2)  checked @endif><label for="parttime">Part Time</label>
              <input name="pgcoursemode" type="radio" id="pgcoursemode" value="3" @if($usereducationArry[2]['course_mode']==3)  checked @endif><label for="pgcoursemode">Correspondence</label>
              <label for="first_name" class="active">Course Type</label>
            </div>
         
            <div class="input-field col s4">
             <select class="initialized" name="pgpassingyear">
                <option value="" >Choose your option</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}" @if($i==$usereducationArry[2]['passing_year'])  selected @endif>{{$i}}</option>
               @endfor()
              </select>
              <label>Passing year</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Marks" name="pgmarks" id="first_name" type="text" class="validate" value="{{@$usereducationArry[2]['marks']}}">
              <label for="first_name" class="active">Marks</label>
              @if ($errors->has('pgmarks')) 
                     <div class="error">{{ $errors->first('pgmarks') }}</div> 
                     @endif
            </div>
          </div>
          </div>
          @else
           <div class="employment postgraduation" style="display: none;">
           <h6>Post Graduation</h6>
            <div class="row">
            <div class="input-field col s4">
             <select class="postchange" name="postcourse">
                <option value="" >Choose your option</option>
                @foreach($postcourselist as $postcourselist)
               @if($postcourselist->course_for==2)
               <option value="{{$postcourselist->id}}">{{$postcourselist->course_name}}</option>
               @endif
               @endforeach
              </select>
              <label>Qualification</label>
            </div>
               <div class="input-field col s4 postchangesubcourse">
               <select  name="pgspec" class="pgsubcourse">
                <option value="" >Choose your option</option>
                @foreach($allSubcourselist as $Subcourselist)
               <option value="{{$Subcourselist->id}}">{{$Subcourselist->sub_course_name}}</option>
               @endforeach
              </select>
              <label>Specialization</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="University/college" name="pgcollege" id="universirty_college" type="text" class="validate">
              <label for="universirty_college" class="active">University/college</label>
              @if ($errors->has('universirty_college')) 
                     <div class="error">{{ $errors->first('universirty_college') }}</div> 
                     @endif
            </div>
           
          </div>
          <div class="row">
            <div class="input-field col s4">
              <input name="pgcoursemode" type="radio" id="fulltime" value="1" checked><label for="fulltime">Full Time</label> 
              <input name="pgcoursemode" type="radio" id="parttime" value="2" ><label for="parttime">Part Time</label>
              <input name="pgcoursemode" type="radio" id="pgcoursemode" value="3"><label for="pgcoursemode">Correspondence</label>
              <label for="first_name" class="active">Course Type</label>
            </div>
         
            <div class="input-field col s4">
             <select class="initialized" name="pgpassingyear">
                <option value="" >Choose your option</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}">{{$i}}</option>
               @endfor()
              </select>
              <label>Passing year</label>
            </div>
            <div class="input-field col s4">
              <input placeholder="Marks" name="pgmarks" id="first_name" type="text" class="validate">
              <label for="first_name" class="active">Marks</label>
              @if ($errors->has('pgmarks')) 
                     <div class="error">{{ $errors->first('pgmarks') }}</div> 
                     @endif
            </div>
          </div>
          </div>
          @endif
          @if($pgflag==0)
          <div class="col s12">
          <span class="add waves-effect waves-light btn addpostgraduation">Add Post Graduation</span>
          </div>
          @endif

             <!-- xII education details -->
              @if(array_key_exists(3,$usereducationArry))
              {{--*/ $xiiflag=1 /*--}}
             <div class="employment postgraduation">
           <h6>XII education details</h6>
           <div class="row">
            <div class="input-field col s4">
             <select class="initialized" name="xiiboard">
                <option value=""  selected="">Class XII Board:</option>
               @foreach($xschoolboardlist as $xschoolboardlist)
               <option value="{{$xschoolboardlist->id}}" @if($xschoolboardlist->id==$usereducationArry[3]['borad'])  selected @endif>{{$xschoolboardlist->board_name}}</option>
                @if ($errors->has('xiiboard')) 
                     <div class="error">{{ $errors->first('xiiboard') }}</div> 
                     @endif
               @endforeach()
              </select>
              <label>Qualification</label>
            </div>
               <div class="input-field col s4">
            <select class="initialized" name="xiipassingyear">
                <option value="" >Year</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}" @if($i==$usereducationArry[3]['passing_year'])  selected @endif>{{$i}}</option>
               @endfor()
              </select>
              <label>Passing Year</label>
               <label>Marks</label>
              @if ($errors->has('xiipassingyear')) 
                     <div class="error">{{ $errors->first('xiipassingyear') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4">
             <select class="initialized" name="xiimedium">
                <option value="">Medium</option>
                @foreach($xschoolmedium as $xschoolmedium)
                <option value="{{$xschoolmedium->id}}" @if($xschoolmedium->id==$usereducationArry[3]['course_spec'])  selected @endif>{{$xschoolmedium->medium_name}}</option>
                @endforeach
              </select>
              <label>Medium</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
             <input placeholder="Marks" name="xiimarks" id="first_name" type="text" class="validate" value="{{@$usereducationArry[3]['marks']}}">
              <label>Marks</label>
              @if ($errors->has('xiimarks')) 
                     <div class="error">{{ $errors->first('xiimarks') }}</div> 
                     @endif
            </div>
         
          </div>
        
          </div>
          @else
          <div class="employment postgraduation">
           <h6>XII education details</h6>
           <div class="row">
            <div class="input-field col s4">
             <select class="initialized" name="xiiboard">
                <option value=""  selected="">Class XII Board:</option>
               @foreach($xschoolboardlist as $xschoolboardlist)
               <option value="{{$xschoolboardlist->id}}">{{$xschoolboardlist->board_name}}</option>
               @endforeach()
              </select>
              <label>Qualification</label>
              @if($errors->has('xiiboard')) 
                     <div class="error">{{ $errors->first('xiiboard') }}</div> 
                     @endif
              
            </div>
               <div class="input-field col s4">
            <select class="initialized" name="xiipassingyear">
                <option value="" >Year</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}">{{$i}}</option>
               @endfor()
              </select>
              <label>Passing Year</label>
              @if ($errors->has('xiipassingyear')) 
                     <div class="error">{{ $errors->first('xiipassingyear') }}</div> 
                     @endif
              
            </div>
            <div class="input-field col s4">
             <select class="initialized" name="xiimedium">
                <option value="">Medium</option>
                @foreach($xschoolmedium as $xschoolmedium)
                <option value="{{$xschoolmedium->id}}">{{$xschoolmedium->medium_name}}</option>
                @endforeach
              </select>
              <label>Medium</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
             <input placeholder="Marks" name="xiimarks" id="first_name" type="text" class="validate">
              <label>Marks</label>
               @if ($errors->has('xiimarks')) 
                     <div class="error">{{ $errors->first('xiimarks') }}</div> 
                     @endif
            </div>
         
          </div>
        
          </div>
          @endif
             <!-- X education details -->
              @if(array_key_exists(4,$usereducationArry))
              {{--*/ $xflag=1 /*--}}
             
             <div class="employment postgraduation">
           <h6>X education details</h6>
            <div class="row">
            <div class="input-field col s4">
             <select class="initialized" name="xboard">
                <option value=""  selected="">Class X Board:</option>
                @foreach($schoolboardlist as $schoolboardlist)
               <option value="{{$schoolboardlist->id}}" @if($schoolboardlist->id==$usereducationArry[4]['borad'])  selected @endif>{{$schoolboardlist->board_name}}</option>
               @endforeach()
              </select>
              <label>Qualification</label>
               @if ($errors->has('xboard')) 
                     <div class="error">{{ $errors->first('xboard') }}</div> 
                     @endif
            </div>
               <div class="input-field col s4">
            <select class="initialized" name="xpassingyear">
                <option value="" >Year</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}" @if($i==$usereducationArry[4]['passing_year'])  selected @endif>{{$i}}</option>
               @endfor()
              </select>
              <label>Passing Yesr</label>
               @if ($errors->has('xpassingyear')) 
                     <div class="error">{{ $errors->first('xpassingyear') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4">
             <select class="initialized" name="xmedium">
                <option value="" >Medium</option>
                @foreach($schoolmedium as $schoolmedium)
                <option value="{{$schoolmedium->id}}" @if($schoolmedium->id==$usereducationArry[4]['course_spec'])  selected @endif>{{$schoolmedium->medium_name}}</option>
                @endforeach
              </select>
              <label>Medium</label>
            </div>
          </div>
         <div class="row">
            <div class="input-field col s4">
             <input placeholder="Marks" name="xmarks" id="first_name" type="text" class="validate" value="{{@$usereducationArry[4]['marks']}}">
              <label>Marks</label>
               @if ($errors->has('xmarks')) 
                     <div class="error">{{ $errors->first('xmarks') }}</div> 
                     @endif
            </div>
         
          </div>
          </div>
          @else
           <div class="employment postgraduation">
           <h6>X education details</h6>
            <div class="row">
            <div class="input-field col s4">
             <select class="initialized" name="xboard">
                <option value=""  selected="">Class X Board:</option>
                @foreach($schoolboardlist as $schoolboardlist)
               <option value="{{$schoolboardlist->id}}">{{$schoolboardlist->board_name}}</option>
               @endforeach()
              </select>
              <label>Qualification</label>
              @if ($errors->has('xboard')) 
                     <div class="error">{{ $errors->first('xboard') }}</div> 
                     @endif
            </div>
               <div class="input-field col s4">
            <select class="initialized" name="xpassingyear">
                <option value="" >Year</option>
                 @for ($i = 1990; $i <= date('Y'); $i++)
               <option value="{{$i}}">{{$i}}</option>
               @endfor()
              </select>
              <label>Passing Yesr</label>
              @if ($errors->has('xpassingyear')) 
                     <div class="error">{{ $errors->first('xpassingyear') }}</div> 
                     @endif
            </div>
            <div class="input-field col s4">
             <select class="initialized" name="xmedium">
                <option value="" >Medium</option>
                @foreach($schoolmedium as $schoolmedium)
                <option value="{{$schoolmedium->id}}">{{$schoolmedium->medium_name}}</option>
                @endforeach
              </select>
              <label>Medium</label>
            </div>
          </div>
         <div class="row">
            <div class="input-field col s4">
             <input placeholder="Marks" name="xmarks" id="first_name" type="text" class="validate" >
              <label>Marks</label>
              @if ($errors->has('xmarks')) 
                     <div class="error">{{ $errors->first('xmarks') }}</div> 
                     @endif
            </div>
         
          </div>
          </div>
          @endif



         <!--  <div class="col s12">
          <span class="add waves-effect waves-light btn addmoreemp">add Graduation</span>
          <span class="add waves-effect waves-light btn addmoreemp">Add Post Graduation</span>
          <span class="add waves-effect waves-light btn addmoreemp">add X</span>
          <span class="add waves-effect waves-light btn addmoreemp">add XII</span>

          </div> -->
          <span id="spin">
          </span>
          <div class="col s12 center-align">
           
            <button type="submit" class="waves-effect waves-light btn" name="makeeducation">Submit</button>
          </div>
        </div>
        </form>
        <script type="application/javascript"   src="{{URL::to('web/js/jquery.validate.min.js')}}"></script>
        <script type="text/javascript">
$(document).ready(function() {
    $('select').material_select();

 

  $("#education").validate({
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
$('.addpostgraduation').click(function()
{
  $('.postgraduation').show();
  $('.addpostgraduation').hide();

});

   });

</script>