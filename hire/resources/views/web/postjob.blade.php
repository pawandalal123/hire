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
            <h2 style="margin-bottom: 10px;">@if($currenttab!='') Edit Job @else Post Job @endif</h2>
             @if(Session::has('message'))
        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message') }}
        </div>
        @endif
            @if($currenttab=='')
            @include('includes.partials.jobpostform')
            @else
            @include('includes.partials.editjobpostform')
            @endif
          </div>
       
   
      </div>
    </div>
  </div>
</div>
@stop
