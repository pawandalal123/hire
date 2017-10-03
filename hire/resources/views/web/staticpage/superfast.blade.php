@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <h1>SUPER-FAST &amp; ACCURATE RECRUITING</h1>
      </div>
    </div>
  </div>
</section>
<div class="container mt45">
  <div class="row">
    <h1 class="mainheading">SUPER-FAST &amp; ACCURATE RECRUITING</h1>
  </div>
</div>
<div class="container contact">
  <div class="row">
    <div class="col s12 m8 l8">
      <div class="row">
          <p>When it comes to updating your resume and documents, the job seekers must look for full re-
design and re-development website for recruitment. In fact, this provides cloud based file
selection for job applications, responsive design, and others. It has advanced job search and
email alert functions to keep track of best file documents. Of course, this new site is ideally
suited for both desktop and mobile, so users can update their recruitment skills by meeting online
presence at the cutting edge. When applying for jobs, candidates could not match their CV, so
this recruitment firm will take you this opportunity for recruiting in corporate companies.
However, the candidates may connect via cloud service and update your resumes directly to the
firm. These revolutionary tools help you to validate the recruitment skills and apply from any
device at any time. It can save resumes automatically when you apply for jobs via online
recruitment firm. So if you are looking for a new recruitment site, then this offers an authentic
platform for applications from a trusted specialist. Of course, it is not surprising that initial
searches for job vacancies and you could get attention on the device installed for desktops PC
and laptops as well as mobile platform.</p>
<p>Our super fast and accurate recruitment help the applicants once a vacancy appears, then get
notifications to their registered device. So, this is very easy for the aspirants to seek best job and
candidates cited convenience as the main reason. The speed is also a benefit in this firm where
applicants may search jobs as their need. They offer integrated service with social media
platform with buddy features that appears to be requisite today’s job hunters. According to the
Indeed web based recruitment, the traffic levels to the job seekers increase 30% and thus you
will find a good job as per the requirement. Your professional recruitment skills should update
regularly, and candidates expect to search a job that offers from this professional firm. This

recruitment firm officially gave the findings of research recently released to the job seekers. If
there are job openings, you may re-direct to this firm and get a recruitment process from them.
Obviously, this super fast and accurate recruitment opens for 24 hours and candidates can find
the jobs regarding the qualification. Therefore, there is no denying flexible working and become
ingrained in the society by picking this recruitment firm.</p>
         
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