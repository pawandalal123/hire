<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--Import materialize.css-->

<link type="text/css" rel="stylesheet" href="{{ URL::asset('web/site/css/bootstrap.css')}}"  media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="{{ URL::asset('web/site/css/materialize.css')}}"  media="screen,projection"/>
<!--Let browser know website is optimized for mobile-->
<link href="{{ URL::asset('web/site/css/hiremestyle.css')}}" rel="stylesheet">

 <link rel="stylesheet" type="text/css" href="{{ URL::asset('web/css/sweetalert2.css')}}" >
<script type="text/javascript" src="{{ URL::asset('web/site/js/jquery-latest.js')}}"></script>
 <script type="application/javascript"   src="{{ URL::asset('web/js/sweetalert2.min.js')}}"></script>
 <script type="text/javascript" src="{{ URL::asset('web/admin/js/plugins/jquery/jquery-ui-1.10.1.custom.min.js')}}"></script>
</head>
<style>

.modal{ 
  position: fixed; 
  top: 0; 
  right: 0; 
  bottom: 0; 

  left: 0; 
  z-index: 1040; 
  overflow-y: auto; background: rgba(0, 0, 0, 0.7); -webkit-transition: opacity .15s linear; transition: opacity .15s linear; } 
/* Model */

 </style>
   <script type="text/javascript">
  var SITE_URL = {!! json_encode(url('/')) !!}+'/';
  </script>
<body>
@include('includes.web.header')
@yield('content')
@include('includes.web.footer')
 <script type="application/javascript"   src="{{URL::to('web/js/common.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('web/site/js/materialize.js')}}"></script>
<!-- <script type="text/javascript" src="{{ URL::asset('web/site/js/bootstrap.min.js')}}"></script> -->
<script type="text/javascript" src="{{ URL::asset('web/site/js/custom.js')}}"></script>
<script type="text/javascript" src="http://amsul.ca/pickadate.js/vendor/pickadate/lib/picker.time.js"></script>
<script type="text/javascript">

 $('.datepickerdob').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100 ,// Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd',
    min: [1968,3,20],
    max: [<?php echo date('Y')-18;?>,7,14]
  });
  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100 ,// Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });
  $('.timepicker').pickatime({
  // Escape any “rule” characters with an exclamation mark (!).
  // format: 'T!ime selected: h:i a',
  // formatLabel: '<b>h</b>:i <!i>a</!i>',
  formatSubmit: 'HH:i',
  hiddenPrefix: 'prefix__',
  hiddenSuffix: '__suffix'
})
   $(document).ready(function() {
    $('select').material_select();
  });
</script>
</body>
</html>