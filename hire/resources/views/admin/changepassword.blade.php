 @extends('layout.adminlayout')
 @section('content')
  <script type="text/javascript">
  $(document).ready(function()
  {
    $("#validation").validationEngine({promptPosition : "topLeft", scroll: true});  

  });
  </script>
        <div class="content">
          <div class="breadLine">
          <ul class="breadcrumb">
          <li><a href="#">Admin</a> <span class="divider">></span></li>                
          <li class="active">Password</li>
          </ul>
          </div>

            <div class="workplace">
                <div class="page-header">
                    <h1>Admin User Management</h1>
                </div> 
                <div class="row">
                @if(Session::has('message'))
                                <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{ Session::get('message') }}
                                </div>
                              @endif
                                   <div class="col-md-12">
                        <div class="head clearfix">
                            <div class="isw-grid"></div>
                            <h1>Change password</h1>
                        </div>
                        <div class="block-fluid">                        
        <div class="row-form clearfix">
          {!! Form::open(['url' => 'admin/postpassword', 'method' => 'post', 'role' => 'form','novalidate'=>'novalidate','id'=>'changepassword-form','enctype'=>'multipart/form-data']) !!}	
     
			<div class="col-sm-8 col-sm-offset-2 myorg">
				<div class="form-group myorgg">
					<label for="ogn">User Name/Email</label>
					<strong>{!! $user->email !!}</strong>
				</div>
				<div class="form-group">
					<label for="ogn">New Password</label>
					{!! Form::text('password',null,array('class' => 'form-control','maxlength'=>'25', 'placeholder'=>'New Password','id'=>'password')); !!}
           @if ($errors->has('password')) 
             <div style="color:red">{{ $errors->first('password') }}</div> 
             @endif

				</div>
				<div class="form-group">
					<label for="ogn">Confirm Password</label>
					{!! Form::text('confirmpassword',null,array('class' => 'form-control', 'placeholder'=>'Confirm Password','id'=>'')); !!}
@if ($errors->has('confirmpassword')) 
             <div style="color:red">{{ $errors->first('confirmpassword') }}</div> 
             @endif
				</div> 

				<div class="text-center">
					<!-- <input name="submit" type="submit" class="btn-primary btnsize" value="Save"> -->
          <input name="changepassword" type="submit" class="btn-primary btnsize" value="submit">
				</div>
            </div>
       {!! Form::close() !!}
      
      </div>
     </div>
    </div>
   </div>
  
</section>


 
<div class="mt45"></div> 


@stop

