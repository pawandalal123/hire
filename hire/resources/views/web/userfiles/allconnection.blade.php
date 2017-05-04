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
    <div class="col s12 m12 l12">
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

  

<script type="application/javascript"   src="{{URL::to('web/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript">

jQuery.validator.addMethod("checkurl", function(value, element)
{
// now check if valid url
return /^(www\.)[A-Za-z0-9_-]+\.+[A-Za-z0-9.\/%&=\?_:;-]+$/.test(value);
}, "Please enter a valid URL."
);


  $("#contactUsForm").validate({
      rules: {
                        "email": {                            
                            email: true
                        },
  
              "mobile": {                            
              minlength: 10,
                            number:true
              }
                    },
                    messages: {
                        "email": {                           
                            email: "Please enter valid email address"
                        },
         
            "mobile": {       minlength:"Please enter valid mobile number"  ,
                              // maxlength:"Please enter valid mobile number",
                              number:"Please enter only numbers"                  
                            
                        }
                    }
                
    });
</script>
@stop