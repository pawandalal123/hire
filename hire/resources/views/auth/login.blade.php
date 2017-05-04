@extends('layout.default')
@section('content')
<section class="top-blue-sec signup-header">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <div class="col s6 offset-s6">
            <div class="row">
				<!-- 	@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif -->
 <?php
         $reffer=$_SERVER['REQUEST_URI'];
        if(isset($_SERVER['HTTP_REFERER']))
        {
          $reffer = $_SERVER['HTTP_REFERER'];
        } 
        ?>
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
          <input name="refferurl" type="hidden" value="{{$reffer}}"> 
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

					
<div class="input-field col s5">
                <input name="email" id="Email-or-Phone" type="text" class="validate" value="{{ old('email') }}">
                <label for="Email-or-Phone">Email or Phone</label>
                 @if ($errors->has('email')) 
             <div class="alert alert-danger">{{ $errors->first('email') }}</div> 
             @endif
              </div>

			   <div class="input-field col s5">
                <input type="password" class="form-control" name='password' class="validate">
                <label for="login-Password">Password</label>
                @if ($errors->has('password')) 
              <div class="alert alert-danger">{{ $errors->first('password') }}</div> 
              @endif
              </div>

					

						 <div class="input-field col s2">
								<button type="submit" class="btn btn-primary" >Login</button>
                <a href="{{URL::to('password/email')}}" class="pull-right" style="color: #243344;">Forget Password?</a>

								<!--<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>-->
							
						</div>
					</form>
          
				</div>
          </div>
      </div>
    </div>
  </div>
</section>
<section class="signup">
<div class="container">
  <div class="row">
    <div class="col s12 m8 l8 center-align">
      <div class="row">
        <img src="{{URL::to('web/site/images/signup.jpg')}}" alt="">
      </div>
    </div>
    
  </div>
</div>
</section>
@endsection
