@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1>See All Connections</h1>
      </div>
    </div>
  </div>
</section>
<div class="container user-profile">
  <div class="row">
    @include('includes.web.userleftbar')
    <div class="col s12 m8 l9">
      <div class="col s12 m12 l12 middle-sec card user-profile">

        
       @if(count($dataArray)>0)
    @foreach($dataArray as $userArray)
        <div class="col s6 m3 l3">
          <div class="card horizontal">
            <div class="card-image">
              <img src="{{$userArray['userimage']}}" alt="{{$userArray['username']}}">
            </div>
            <div class="card-stacked">
              <div class="card-action">
                {{$userArray['username']}}
              </div>
              <div class="card-content">
                <!-- <p>Web Designer</p> -->
                <a href="javascript::void();" class="unfollow" onclick="saveaction({{$userArray['userid']}},'connection')">Unfollow</a>
              </div>
            </div>
          </div>
          </div>
          @endforeach()
          @else
          <div class="text-center">No record found..</div>
          @endif
        </div>
    </div>
  </div>
</div>
@stop
