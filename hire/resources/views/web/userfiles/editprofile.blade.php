@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12 center-align profile-tab">
          <ul>
            <li><a href="{{URL::to('editprofile')}}" @if($pagename=='') class="active" @endif>Basic Info</a></li>
            @if($user->looking_for_job==1)
            <li><a href="{{URL::to('editprofile/employment')}}"  @if($pagename=='employment') class="active" @endif>Employment</a></li>
            <li><a href="{{URL::to('editprofile/education')}}"  @if($pagename=='education') class="active" @endif>Education</a></li>
             <li><a href="{{URL::to('editprofile/otherinfo')}}"  @if($pagename=='otherinfo') class="active" @endif>Other information</a></li>
             <li><a href="{{URL::to('editprofile/projectskills')}}"  @if($pagename=='projectskills') class="active" @endif>Project Skills</a></li>
            @endif
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
               @if($pagename=='projectskills')
                 @include('includes.web.userfiles.editprojectskills')
               @elseif($pagename=='education')
                @include('includes.web.userfiles.editeducation')
                @elseif($pagename=='employment')
                @include('includes.web.userfiles.editemployment')
                 @elseif($pagename=='otherinfo')
                @include('includes.web.userfiles.otherinfo')
               @else
               @include('includes.web.userfiles.editbasicdetails')
               @endif
        
      </div>  
    </div>
  </div>
</section>

@stop