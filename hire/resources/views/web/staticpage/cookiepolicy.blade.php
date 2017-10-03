@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <h1>Cookie Policy</h1>
      </div>
    </div>
  </div>
</section>
<div class="container mt45">
  <div class="row">
    <h1 class="mainheading">Cookie Policy</h1>
  </div>
</div>
<div class="container contact">
  <div class="row">
    <div class="col s12 m8 l8">
      <div class="row">
          <p>Cookies is must to use for the online websites to enhance the efficiency for doing their marketing and understanding.

</p>
<p>Purposes: We can use such analysis to understand how to improve the functionality and experience of the Website.</p>
<p>We may store the searches user performed in a Cookie so that to easily re-execute those searches when user return to Website. We c
Cookies for Google and Facebook for marketing purposes. We may use this to display promotional material to user on other sites you visit across the Internet. 
</p>
<p>
We may share information about user behavior on the Site with third parties in order to show user appropriate advertisements and content that has been designed for user.</p><p>
But we do not share your personal information or information activities with other parties and entities. To know more about the cookies you may contact us and we will guide you in detail.
</p>
         
        </div>
    </div>
    <div class="col s12 m4 l4 left-link">
      <div class="sidebar-box">
        <h5>Quick Contact</h5>
        <p>Duis ullamcorper urna diam, sed convallis erat pellentesque sagittis. Duis faucibus leo sit amet ornare scelerisque. Proin vel mattis libero, et malesuada ante. Aliquam et justo finibus, aliquam lacus sit amet, maximus enim. Cras a placerat enim, id vehicula risus. Aliquam porttitor mollis est, vitae malesuada massa rhoncus suscipit.</p>
        <p><strong>Email: You@company.com </strong></p>
        <p><strong>Contact: 000-000000 </strong></p>
        <div class="socail">
          <a class="btn-floating btn-large waves-effect waves-light red"><img src="{{URL::to('web/site/images/facebook-logo.png')}}"></a>
          <a class="btn-floating btn-large waves-effect waves-light red"><img src="{{URL::to('web/site/images/twitter.png')}}"></a>
          <a class="btn-floating btn-large waves-effect waves-light red"><img src="{{URL::to('web/site/images/google-plus.png')}}"></a>
          <a class="btn-floating btn-large waves-effect waves-light red"><img src="{{URL::to('web/site/images/linkedin-logo.png')}}"></a>
        </div>
      </div>
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