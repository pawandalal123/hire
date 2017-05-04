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

        <h2>Basic Details <a href="{{URL::to('compnaydetail/'.$checkcompnay->id)}}">View</a></h2>
        <ul class="collection">
          <li class="collection-item">Company Name : {{$checkcompnay['compnay_name']}}</li>
          <li class="collection-item">Website : {{$checkcompnay['company_website']}}</li>
          <li class="collection-item">Mobile : {{$checkcompnay['contact']}}</li>
          <li class="collection-item">Address : {{$checkcompnay['address']}}</li>
           <li class="collection-item">City :@if($checkcompnay['city']) {{$checkcompnay['city']}} @else NA @endif</li>
          <li class="collection-item">state : @if($checkcompnay['state']) {{$checkcompnay['state']}} @else NA @endif</li>
          <li class="collection-item">country : @if($checkcompnay['country']) {{$checkcompnay['country']}} @else NA @endif</li>
          <li class="collection-item">Pincode : {{$checkcompnay['pincode']}}</li>
        </ul>
        @if($checkcompnay['about_company']!='')
         <h2>About company</h2>
         <p>{{$checkcompnay['about_company']}}</p>
         @endif
         @if($user->is_subuser!=1)
        <a href="{{URL::to('editcompany')}}" class="waves-effect waves-light btn basicdetail-edit">Edit Profile</a>
        @endif
        </div>
    </div>
  </div>
</div>
@stop
