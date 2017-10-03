@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <h1>Improve Your Professional Skill</h1>
      </div>
    </div>
  </div>
</section>
<div class="container mt45">
  <div class="row">
    <h1 class="mainheading">Improve Your Professional Skill</h1>
  </div>
</div>
<div class="container contact">
  <div class="row">
    <div class="col s12 m8 l8">
      <div class="row">
          <p>In general, the major motive of the recruitment firm is to create a job opportunity for the candidates who are seeking for a job. On that basis, we are the professional recruitment firm, who are ready to give assurance to our users of getting their suitable job according to their resume. Usually, nowadays, it is not much as easy as to search for a vacancy in companies without the help of recruitment agencies. Also, there may be also possible of choosing a wrong company which does not fit for your position. So, at the time we are there for you. We will always update you the vacancies from different companies suitable to your educational qualification and skills. The company we are choosing for you will only be a professional MNC company where you can able to improve your professional skills.  
</p>
<h2>Dealing With MNCs:</h2>
<p>We are also having direct contact with the MNC companies, who will give access to us to recruit best candidates for their company. The main reason for that is, due to a lot of competition for same designation and job; a number of candidates are attending the interviews. This process creates hectic for HR, whose duty is to hire a deserved candidate. In order to avoid these issues, many MNC company will update their company status to us and with that, we will create a job opportunity that is perfect to work in their company.</p>
<h2>Creating Profile:</h2>
<p>In order to use our site regularly, at first you must become a member by submitting your resume for your job. We will provide you the valid username and password to get access to our site for further process. Every day we will suggest you unique jobs which are matching to your profile. We will provide you companies list which are recruiting candidates and on that list, you can find the best job which fits for your career. You can also able to search for a job separately in our site based on various categories like job location, area to work, designation, salary and much more.</p>
<h2>Regular Resume Update:</h2>
<p>We will also ask for regular updating of your profile. The update requirement is must because, during some day’s gap, you will do any course or work anywhere. By updating those details, we will suggest you job based on your qualification. With the details we are providing, you can attend the interview directly and improve your professional skill to build up your career.  </p>
         
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