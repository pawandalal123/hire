@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
          <h1>Corporate Connections</h1>
      </div>
    </div>
  </div>
</section>
<div class="container mt45">
  <div class="row">
    <h1 class="mainheading">Corporate Connections</h1>
  </div>
</div>
<div class="container contact">
  <div class="row">
    <div class="col s12 m8 l8">
      <div class="row">
          <p>The recruitment firm and consultants can bring a significant level of expertise the task of
discovering the best individuals for the vacancy place. These companies can aid in
impressing candidates, either by utilizing their previous databases of the personnel otherwise
by simply advertising below their banner in a region for where they concentrated. The
recruiting region can be relieved of simply understanding a determinable amount of the
administrative/organization job since recruitment firm will aid resources to focus on the
recruitment assignments. The responsibility for creating the final selection suggest will
always be along with the selection committee as well as decision to appoint will also stay
along with the University hand over authority. At corporate connections consultants, we
offer creative, relevant, practical as well as reasonable solutions and also possibilities for our
consumer. We function along with our customer as well as their representative to form the
cooperative professional team which aids implements these kinds of practical solutions as
well as develop new profits streams. Our service is provided to the restricted amount of
business at any a period. Unlike consulting functions, this model of activity permits us to
work nearly and also personally along with customer to aid them to operate as well as
develop their companies.</p>
<h2 class="mainheading">For Hunters</h2>
<p>The majority of the jobs are not advertised, rather than they are placed straightforward along
with our recruitment agencies which are trusted for this filed sector experiences, sensitivity as
well as an understanding of the employment marketplace as well as connections along with
the exact job for the candidate. Therefore, you need to register your talents along with our
recruitment agency. We will aid you to identify well proper permanent roles quickly. Our
capabilities are even much more worth to those looking contracts or else temporary roles
since we have a stable supply of medium, short and also long term positions. We are highly

specializing in the consultancy service, as well as offer efficient service to our esteemed
customer in this sector. Our consultancy is extremely regarded by our valuable customer as it
aid in the smooth functioning of different functions of the business. Our highly experienced
professional have several years of experiences in this field. Our corporate consultant is
growing and also technologically oriented firms. We every time strive for the further level in
our personal and also corporate life when aiding our valuable customer do the identical. Just
visit our official website to gain more latest new job updates.</p>
         
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