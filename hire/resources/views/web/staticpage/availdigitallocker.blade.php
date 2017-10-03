@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <h1>Avail Digital Locker To Keep Safe Credential And Grab Dream Job</h1>
      </div>
    </div>
  </div>
</section>
<div class="container mt45">
  <div class="row">
    <h1 class="mainheading">Avail Digital Locker To Keep Safe Credential And Grab Dream Job</h1>
  </div>
</div>
<div class="container contact">
  <div class="row">
    <div class="col s12 m8 l8">
      <div class="row">
          <p>Nowadays, getting a job isn’t easier task many people who completed their studies next task to
enroll any of the applicable jobs. Some people search jobs own related to their qualification, and
some others do business own, and some others hire recruitment firm. We are the leading, and
reliable recruitment firm offers right way to begin the new career in your life with an excellent
job opportunity. If you have long daydream to get placement in the dream job don’t bother about
you can make use of our digital locker to get safe resume and others. We give the confidentiality
and priority to all the candidates who need our assistance. Already, many candidates got success
in their life with our recruitment offers to the appropriate one. We realize the candidate crucial
situation still not placed in any of the firms, and we give guarantee for the safe job position. We
have a wide range of network in the recruitment as well as selection services to several
companies. Our experts dedicate their complete effort for the possible clients with strategic HR
services. We like to expand the client relationship in a satisfactory manner and fetch business
into the next level. Our trustworthy recruitment assistance will express the value of the client
success and best solutions. We delivered everything instantly and gained a positive reputation
with an efficient worldwide executive search company and reliable one. We are with you so not
even a single client worry about the upcoming lifestyle.
</p>
<h2>Why client hire our experts?</h2>
<p>We know how to satisfy and deal with all the clients with service quality and positive approach
towards managing comprehensive research to achieve innovative solutions. Now, the majority of
the candidates focuses on utilizing digital locker and receives several benefits. We try to connect
with you for a long-term with job success and hire the team of professionals for great digital
locker maintenance of the client documents. You don’t need to waste time anymore after you get
in touch with us and focus on different methodologies. Our professional consultant’s keep the

credentials highly specialized along with experience in the industry. We equipped well with the
modern technology and strategies to keep the trustworthy quality assurance. Our leading HR firm
realizes the responsibility to alter the function from time to time. So we maintain pace with
adjusting HR firm and acquire timely demand with unparallel quality service to the clients.</p>
         
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