@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <h1>Privacy Policy</h1>
      </div>
    </div>
  </div>
</section>
<div class="container mt45">
  <div class="row">
    <h1 class="mainheading">Privacy Policy</h1>
  </div>
</div>
<div class="container contact">
  <div class="row">
    <div class="col s12 m8 l8">
      <div class="row">
          <p> “Corporate Place” gets personal access of your data after your approval. We may share your data within the corporate place entities and related website. This will include only that data which is collected by us.</p>
<h2>Resume/CV Program Terms</h2>
<p>Use of the “Corporate Place” Resume Program by an individual who posts his or her resume on the Site (hereinafter, “Resume Owner”) or Employer on or through the Site is subject to all applicable “Corporate Place” best-practice guidelines, policies and other terms and conditions made available to you, including through the Site, which may be modified at any time.</p>
<p>Contacting Resume Owners, through Corporate Place, for purposes of filling your Job Listings, you will not use that data for any other purpose. Otherwise such act will result in your immediate termination from the Program.</p>
<p>Corporate Place may send emails to Job Seekers on your behalf indicating that your Job Listing is potentially a match for the Job Seeker’s resume.</p>
<p>Once you have requested that Corporate Place contact a Resume Owner, you may not revoke such request.
You represent and warrant that all information you provide to “Corporate Place” is correct and current. You represent to “Corporate Place” that you are an Employer interested in considering the Resume Owner as a potential employee.</p>
<h2> Prohibited Uses</h2>
<p>You shall not, and shall not authorize any party to: (a) generate automated, fraudulent or otherwise invalid impressions or clicks; or (b) advertise anything illegal or engage in any illegal or fraudulent business practice in any state or country where your advertisement is displayed. You represent and warrant that (x) all your information is correct and current; (y) you hold and grant “Corporate Place” and Partners all rights to copy, distribute and display Creative (“Use”); and (z) such Use and websites linked from your Jobs Ads (including Your Services therein) will not violate or encourage violation of any applicable laws. Violation of these policies may result in immediate termination of these IAP Terms or your account without notice, and may subject you to legal penalties and consequences. ”Corporate Place” or Partners may reject or remove any Job Ad, and “Corporate Place” may disable any Employer’s account, for any or no reason without notice. For examples of why “Corporate Place” may reject such Job Ads from Employers, refer to the Job Posting Guidelines. “Corporate Place” may require certain Job Ads to be sponsored in order to verify the legitimacy of the Job Ad and/or the Employer, and to prevent abuse of the free to post system. This may include limiting the number of Job Ads you are allowed to post at a given time without sponsoring, in “Corporate Place”’s sole discretion. This requirement may be made in “Corporate Place”’s sole discretion. For example, we may require you to sponsor the following types of Job Ads: identical jobs posted in multiple locations, jobs posted with a confidential or generic company name, jobs that are commission only, and any other jobs as determined by “Corporate Place”. Additionally, “Corporate Place” may choose not to accept an employer’s XML feed or any Job Ads in an XML feed for any or no reason. If you are a job board, “Corporate Place” reserves the right to include or reject any or all of your Job Ads. For examples of why “Corporate Place” may stop accepting such Job Ads from job boards, refer to the Job Board Inclusion Guidelines. As a job board, you may only post Job Ads on the Site for your own company; you may not post Job Ads on the Site for your clients and if you do or attempt to do so, “Corporate Place” reserves the right to disable your account. You acknowledge that inclusion of jobs in violation of these guidelines on the “Corporate Place” Site may harm “Corporate Place” and its users. When you create an “Corporate Place” account, “Corporate Place” may require that you verify your identity through a third party service.</p>
         
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