@extends('layout.adminlayout')
@section('content')

  <div class="content">
            
    <div class="breadLine">

    <ul class="breadcrumb">
    <li><a href="#">Admin</a> <span class="divider">></span></li>                
    <li class="active">Cerdibilty</li>
    </ul>
    </div>
    <div class="workplace">
    <div class="page-header">
    <h1>{{$type=='' ? 'Category' :ucwords($type)}} Management</h1>
    </div> 
@if($type=='factors')
@include('includes.admin.credibiltysubcat')
@else
@include('includes.admin.credibiltycat')
@endif
 </div>
</div> 
@stop



