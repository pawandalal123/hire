@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <h1>User Profile</h1>
      </div>
    </div>
  </div>
</section>
<div class="container user-profile">
  <div class="row">
   @include('includes.web.userprofileleftbar')
   @if($pagename=='articles')
    @include('includes.web.userfiles.userarticle')
    @elseif($pagename=='discussions')
    @include('includes.web.userfiles.userdiscussion')
    @elseif($pagename=='invitediscussion')
    @include('includes.web.userfiles.discussionjoin')
     @elseif($pagename=='editskills')
    @include('includes.web.userfiles.editskills')
     @elseif($pagename=='all-saves')
    @include('includes.web.userfiles.allsaves')
    @elseif($pagename=='all-appointment')
    @include('includes.web.userfiles.userallappointments')
   @else
   @include('includes.web.userfiles.userhome')
   @endif
    <div class="col s12 m4 l3">
      <div class="sidebar-box">
      @if(!empty($jobprefrence) && $jobprefrence->skills!='')
         {{--*/ $skills=explode(',',$jobprefrence->skills) /*--}}
        <div class="user-gray-box">
          <h6>Skill</h6>
          <p>
          {{--*/ $i=1 /*--}}
            @foreach($skills as $skills)
             {{$skills}},
             @if($i>3)
             {{--*/ $i=1 /*--}}
             </p><p>
             @endif 
            {{--*/ $i++ /*--}}
            @endforeach()
          </p>
          <a href="{{URL::to('profile/editskills')}}" class="waves-effect waves-light btn basicdetail-edit-right-side">Edit</a>
        </div>
        @endif
        <div class="user-gray-box">
          <h6>Academic Credentials </h6>
          @if(count($usereducationArry)>0)
           <table class="bordered responsive-table">
            <tbody>
            @foreach($usereducationArry as $usereducationArry)
              <tr>
                <th>{{$usereducationArry['course_name']}}</th>
                <td>{{$usereducationArry['marks']}}%</td>
                <td>{{$usereducationArry['educate_from']}}</td>
                <td>{{$usereducationArry['passing_year']}}</td>
              </tr>
              @endforeach
             
            </tbody>
          </table>
          <a href="{{URL::to('editprofile/education')}}" class="waves-effect waves-light btn basicdetail-edit-right-side">Edit</a>
          @else
           update your education details.
           <a href="{{URL::to('editprofile/education')}}"  class="waves-effect waves-light btn basicdetail-edit-right-side">Edit</a>
          @endif
        </div>
      
      </div>
    </div>
  </div>
</div>
@stop
