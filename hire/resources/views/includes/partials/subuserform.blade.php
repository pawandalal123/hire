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
            <h2 style="margin-bottom: 10px;">@if($currenttab!='') Edit Sub user @else Make Subuser  @endif</h2>
             @if(Session::has('message'))
        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message') }}
        </div>
        @endif
<form action="" method="post">
             <div class="row">
             <div class="input-field col s4">
              <input placeholder="Name" id="first_name" name="username" type="text" class="validate" value="">
              <label>Name</label>
                 @if ($errors->has('username')) 
                     <div class="error">{{ $errors->first('username') }}</div> 
                     @endif
            </div>
             <div class="input-field col s4">
              <input placeholder="Email"  name="email" id="first_name" type="text"  value="" required="required"> 
              <label for="first_name" class="active">Email</label>
               @if ($errors->has('email')) 
                     <div class="error">{{ $errors->first('email') }}</div> 
                     @endif
            </div>
            
            <div class="input-field col s4">
              <input placeholder="Mobile" id="first_name" name="mobile" type="text" class="validate" value="">
              <label for="first_name" class="active">Mobile
</label>
              @if ($errors->has('mobile')) 
                     <div class="error">{{ $errors->first('mobile') }}</div> 
                     @endif

            </div>
            @if($currenttab=='')
            <div class="input-field col s4">
              <input placeholder="Password" name="password" id="compclient" type="text" class="validate" value="">
              <label for="first_name" class="active">Password
</label>
@if ($errors->has('password')) 
                     <div class="error">{{ $errors->first('password') }}</div> 
                     @endif
            </div>
            @endif
          </div>
         
      
          
           <button type="submit" name="makesubuser" class="waves-effect waves-light btn article-hire-button">Submit</button> 
           </form>
           @if(count($allsubuser)>0)
           <h6>Sub User List</h6>
           <table class="bordered responsive-table">
            <thead>
              <tr>
                  <th data-field="sr">Sr No.</th>
                  <th data-field="document-name">Name</th>
                  <th data-field="uploaded-date">Email</th>
                  <th data-field="detail">Mobile</th>
                  <th data-field="action">Status</th>
                  <th data-field="share">Action</th>
              </tr>
            </thead>

            <tbody>
            {{--*/ $i=1 /*--}}
                        @foreach($allsubuser as $allsubuser)
                           {{--*/ $status='active' /*--}}
                           {{--*/ $textdisplay='Make Disable' /*--}}
                         @if($allsubuser->status==0)
                           {{--*/ $status='deactive' /*--}}
                           {{--*/ $textdisplay='Make Active' /*--}}
                         @endif
                <tr class="document3">
                <td>{{$i}}</td>
                <td>{{$allsubuser->name}}</td>
                <td>{{$allsubuser->email}}</td>
                <td>{{$allsubuser->mobile}}</td>
                <td>{{$status}}</td>
                <td>
                <a>
               {{$textdisplay}}</a>
                 <a href="" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Edit" data-tooltip-id="2b1c81b8-54a8-035d-41fa-4ac9a80d0dfa">
                <i class="material-icons dp48">mode_edit</i></a>
                </td>
                
              </tr>
              @endforeach
                                          
            </tbody>
          </table>
          @endif
           </div>
       
    
      </div>
    </div>
  </div>
</div>
@stop