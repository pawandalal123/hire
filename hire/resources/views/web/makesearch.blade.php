@extends('layout.default')
@section('content')
<?php
$url=$_SERVER['REQUEST_URI'];
$parsed=[];
if( strpos($url, '?')!==false)
{
  parse_str(substr($url, strpos($url, '?') + 1), $parsed);

}
// print_r($parsed);
$indusArray = array();
$functionArray = array();
if(array_key_exists('industry', $parsed))
{
  $indusArray = explode('-', $parsed['industry']);
}

if(array_key_exists('functional', $parsed))
{
  $functionArray = explode('-', $parsed['functional']);
}
?>
<script type="text/javascript" src="{{ URL::asset('web/site/js/bootstrap.min.js')}}"></script>
<section class="user-listing">
  <div class="container user-profile search-page">
  <div class="row">

        <form name="searchFormweb" action="" onsubmit="return CheckDataSearch(document.searchFormweb);" method="get" id="hdr_frm" autocomplete="off">
  <div class="col s12 m10 l10"><input name="keyword" placeholder="Search.." id="search"   value="{{@$_GET['keywords']}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search ..'"></div>
  <div class="col s12 m2 l2"><button class="waves-effect waves-light btn search-btn">Search</button></div>
    
    </form>
        </form>

    <div class="col s12 m12 l12">
              <section class="top-blue-sec">
                  <ul>
                    <li><a href="{{URL::to('search/people/')}}" @if($pagename=='people') class="active" @endif>Users</a></li>
                    <li><a href="{{URL::to('search/jobs/')}}" @if($pagename=='jobs') class="active" @endif>Jobs</a></li>
                    <li><a href="{{URL::to('search/company/')}}" @if($pagename=='company') class="active" @endif>Company</a></li>
                    <li><a href="{{URL::to('search/article/')}}" @if($pagename=='article') class="active" @endif>Article</a></li>
                     <li><a href="{{URL::to('search/discussion/')}}" @if($pagename=='discussion') class="active" @endif>Discussion Forums</a></li>
                     <li><a href="{{URL::to('search/news/')}}"  @if($pagename=='news') class="active" @endif>News</a></li>
                              </ul>
             
        </section>
        </div>
      <div class="col s12 m12 l12">
          <div id="Users" class="row">
          <div class="col s12 m4 l3">
                <div class="sidebar">
                  <p><strong>Refine Results</strong></p>
                    <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Keyword
                        </a>
                      </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                           <input type="search" placeholder="Enter Keyword" name="keywords" value="@if(array_key_exists('keywords',$parsed)) {{$parsed['keywords']}} @endif">
                        <p><button class="waves-effect waves-light btn search-btn" onclick="makesearch('keywords')">Search</button></p>
                          </div>
                        </div>
                      </div>
                      <!-- end of panel -->
                     @if($pagename=='people' || $pagename=='jobs' || $pagename=='company')
                      <div class="panel">
                        <div class="panel-heading" role="tab" id="headingTwo">
                          <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Location
                        </a>
                      </h4>
                        </div>

                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <p>
                          <select class="browser-default countrychangeall" >
                            <option value="" >Country</option>
                             @if(count($countrylist)>0)
                              @foreach($countrylist as $id=>$name)
                              <option value="{{$id}}" id="{{$id}}" @if(array_key_exists('country',$parsed)) @if($parsed['country']==$id) selected @endif @endif>{{$name}}</option>
                              @endforeach
                              @endif
                          </select>
                        </p>
                        <p>
                          <select class="browser-default stateall" name="state">
                          <option value="" disabled="" selected="" >State</option>
                        </select>
                        </p>
                        <p>
                          <select class="browser-default citychangediv" >
                          <option value="" disabled="" selected="">City</option>
                           </select>
                        </p>
                        <p><button class="waves-effect waves-light btn search-btn" onclick="makesearch('location')">Search</button></p>
                          </div>
                        </div>
                      </div>
                        <div class="panel">
                        <div class="panel-heading" role="tab" id="headingThree">
                          <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Industries
                        </a>
                      </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                           @if(count($industrylist)>0)
                              @foreach($industrylist as $industrylist=>$name)
                                <p>
                                  <input name="industryfilter" value="{{$industrylist}}" type="checkbox" id="indistry{{$industrylist}}" onclick="makesearch('industry')" @if(in_array($industrylist,$indusArray)) checked @endif>
                                  <label for="indistry{{$industrylist}}">{{$name}}</label>
                                </p>
                                @endforeach()
                                @endif
                          </div>
                        </div>
                      </div>
                      @if($pagename=='jobs')
                          <div class="panel">
                        <div class="panel-heading" role="tab" id="headingFour">
                          <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Functional Area
                        </a>
                      </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                          <div class="panel-body">
                            @if(count($functionarea)>0)
                      @foreach($functionarea as $functionarea)
                        <p>
                          <input name="functionalfilter" value="{{$functionarea->id}}" type="checkbox" id="function{{$functionarea->id}}" onclick="makesearch('functional')" @if(in_array($functionarea->id,$functionArray)) checked @endif>
                          <label for="function{{$functionarea->id}}">{{$functionarea->name}}</label>
                        </p>
                        @endforeach()
                        @endif
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <div class="panel-heading" role="tab" id="headingFive">
                          <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFour">
                          Salary
                        </a>
                      </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                          <div class="panel-body">
                            <p>
                         <select class="browser-default salaryto" name="salaryto">
                          <option value="">To</option>
                         @for($i=1;$i<=25; $i+=1)
                         <option value="{{$i}}" @if(array_key_exists('salaryto',$parsed)) @if($parsed['salaryto']==$i) selected @endif @endif>{{$i}} Lakhs</option>
                         @endfor
                        </select>
                        </p>
                         <p>
                         <select class="browser-default salaryfrom" name="salaryfrom">
                          <option value="">From</option>
                         @for($i=1;$i<=25; $i+=1)
                         <option value="{{$i}}" @if(array_key_exists('salaryfrom',$parsed)) @if($parsed['salaryfrom']==$i) selected @endif @endif>{{$i}} Lakhs</option>
                         @endfor
                        </select>
                        </p>
                        <p><button class="waves-effect waves-light btn search-btn" onclick="makesearch('salary')">Search</button></p>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <div class="panel-heading" role="tab" id="headingFour">
                          <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                          Job Type
                        </a>
                      </h4>
                        </div>
                        <div id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                          <div class="panel-body">
                            <p>
                                <select class="browser-default jobtype" name="jobtype" onchange="makesearch('jobtype')">
                                <option value="" disabled="">Select</option>
                                <option value="1" @if(array_key_exists('jobtype',$parsed)) @if($parsed['jobtype']==1) selected @endif @endif>Full Time</option>
                                <option value="2" @if(array_key_exists('jobtype',$parsed)) @if($parsed['jobtype']==2) selected @endif @endif>Part Time</option>
                                <!-- <option value="3">Option 3</option> -->
                              </select>
                            </p>
                          </div>
                        </div>
                      </div>
                      @endif
                      @endif
                      <!-- end of panel -->
                      @if($pagename=='article')
                      {{--*/ $categorylist=$catlist /*--}}
                      <div class="panel">
                        <div class="panel-heading" role="tab" id="headingThree">
                          <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                         Sort By
                        </a>
                      </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">
                            <p>
                        <form id="sortbyform">
                            <select class="browser-default" name="sort">
                            <option value="" disabled="" selected="">Sort by: Date</option>
                            <option value="asc">Date Asc</option>
                            <option value="desc">Date Desc</option>
                            <!-- <option value="3">Option 3</option> -->
                          </select>
                          </form>
                            </p>
                          </div>
                        </div>
                      </div>
                         <div class="panel">
                        <div class="panel-heading" role="tab" id="headingFour">
                          <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          Category
                        </a>
                      </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                          <div class="panel-body">
                           <p>
                            <select class="browser-default catlistchange">
                              <option value="" rel=''>Select</option>
                             @if(count($categorylist)>0)
                              @foreach($categorylist as $categorylist)
                                <option value="{{str_replace(' ','-',$categorylist->name)}}" rel="{{$categorylist->id}}">{{$categorylist->name}}</option>
                              @endforeach()
                              @endif
                            </select>
                            </p>
                            <p>
                            <select class="browser-default subcatlist">
                              <option value="">Select</option>
                             
                            </select>
                            </p>
                            <p><button class="waves-effect waves-light btn articlesearch">Search</button></p>
                          </div>
                        </div>
                      </div>
                      @endif
                       @if($pagename=='article')
               
                    @if(Auth::check())
                    @include('includes.partials.articleform')
                    @else
                     <div class="sidebar">
                    @include('includes.partials.loginbox')
                    </div>
                    @endif
                  @endif
                  @if($pagename=='discussion')
                  @if(Auth::check())
                  <div>Start Discussion</div>
                  @include('includes.partials.discussionform')
                  @else
                  @include('includes.partials.loginbox')
                  @endif
                  @endif
                      
                      <!-- end of panel -->

                
                      <!-- end of panel -->

                    </div>

                </div>
            </div>
             @if($pagename=='news')
          @include('includes.partials.discussionsearch')
          @elseif($pagename=='jobs')
          @include('includes.partials.jobsearch')
          @elseif($pagename=='company')
          @include('includes.partials.companysearch')
          @elseif($pagename=='article' || $pagename=='discussion')
          @include('includes.partials.discussionsearch')
          @else
          @include('includes.partials.peoplesearch')
          @endif
          </div>


    
    
  </div>
</div>
</section>


<script type="text/javascript">
   $(document).ready(function() {
    $('select').material_select();
    $("#sortbyform").change(function()
  {
    $( "#sortbyform" ).submit();
  });

  });
   $(document).ready(function() {
  $('.collapse.in').prev('.panel-heading').addClass('active');
  $('#accordion, #bs-collapse')
    .on('show.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').addClass('active');
    })
    .on('hide.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').removeClass('active');
    });
});
</script>

<script type="text/javascript">
function makesearch(searchfor)
{

    var url = window.location.href;
    paramName ='keywords';
    if(searchfor=='keywords')
    {
      paramName ='keywords';
      var getpram = $('input[name=keywords]').val();
      var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
      var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + getpram;
      if(url.search(pattern)>=0)
      {
          var newurl =  url.replace(pattern,'$1' + getpram + '$2');
      }
      var filterUrl =newurl;
      window.location.href=filterUrl;
    }
    if(searchfor=='location')
    {
      var country = $('.countrychangeall').val();
      var state = $('.stateall').val();
      var city = $('.citychangediv').val();
      // if(country!='')
      // {
          paramName='country';
          var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
          var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + country;
          if(url.search(pattern)>=0)
          {
              var newurl =  url.replace(pattern,'$1' + country + '$2');
          }

      // }
      // if(state!='')
      // {
          paramName='state';
          var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
          var newurl = newurl + (newurl.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + state;
          if(url.search(pattern)>=0)
          {
              var newurl =  newurl.replace(pattern,'$1' + state + '$2');
          }

      //}
      // if(city!='')
      // {
          paramName='city';
          var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
          var newurl = newurl + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + city;
          if(url.search(pattern)>=0)
          {
              var newurl =  newurl.replace(pattern,'$1' + city + '$2');
          }

      //}
      var filterUrl =newurl;
      window.location.href=filterUrl;

    }
    if(searchfor=='industry')
    {
       var industrydata=[];
       $('input[name=industryfilter]:checked').each(function(i)
        {
            industrydata[i]=$(this).val();
        });
       var industryvalue=industrydata+'-';  
       industryvalue=industryvalue.replace(/\,+/g, "-");
       if(industryvalue!='')
       {
          paramName='industry';
          var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
          var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + industryvalue;
          if(url.search(pattern)>=0)
          {
              var newurl =  url.replace(pattern,'$1' + industryvalue + '$2');
          }
          
       }
       else
       {
          var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + industryvalue;
          if(url.search(pattern)>=0)
          {
              var newurl =  url.replace(pattern,'$1' + industryvalue + '$2');
          }

       }
          var filterUrl =newurl;
          window.location.href=filterUrl;
    }
    if(searchfor=='functional')
    {
       var industrydata=[];
       $('input[name=functionalfilter]:checked').each(function(i)
        {
            industrydata[i]=$(this).val();
        });
       var industryvalue=industrydata+'-';  
       industryvalue=industryvalue.replace(/\,+/g, "-");
       if(industryvalue!='')
       {
          paramName='functional';
          var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
          var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + industryvalue;
          if(url.search(pattern)>=0)
          {
              var newurl =  url.replace(pattern,'$1' + industryvalue + '$2');
          }
          
       }
       else
       {
          var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + industryvalue;
          if(url.search(pattern)>=0)
          {
              var newurl =  url.replace(pattern,'$1' + industryvalue + '$2');
          }

       }
          var filterUrl =newurl;
          window.location.href=filterUrl;
    }
    if(searchfor=='salary')
    {
      var salaryto = $('.salaryto').val();
      var salaryfrom = $('.salaryfrom').val();
      paramName='salaryto';
      var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
      var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + salaryto;
      if(url.search(pattern)>=0)
      {
          var newurl =  url.replace(pattern,'$1' + salaryto + '$2');
      }


      paramName='salaryfrom';
      var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
      var newurl = newurl + (newurl.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + salaryfrom;
      if(url.search(pattern)>=0)
      {
          var newurl =  newurl.replace(pattern,'$1' + salaryfrom + '$2');
      }
      var filterUrl =newurl;
      window.location.href=filterUrl;

    }
      if(searchfor=='jobtype')
    {
      var jobtype = $('.jobtype').val();
      paramName='jobtype';
      var pattern = new RegExp('\\b('+paramName+'=).*?(&|$)');
      var newurl = url + (url.indexOf('?')>0 ? '&' : '?')+paramName+ '=' + jobtype;
      if(url.search(pattern)>=0)
      {
          var newurl =  url.replace(pattern,'$1' + jobtype + '$2');
      }

      var filterUrl =newurl;
      window.location.href=filterUrl;

    }
    
}

  function CheckDataSearchweb(Form,searcfrom)
    {     
      var serachKeyword=Form.keyword.value.replace(/\s/g, '-').toLowerCase();
      
      if(serachKeyword=='')
      {
        alert("Please enter keyword");
        Form.keyword.focus();
        return false;
      }
      
      else if (Form.keyword.value.replace(/\s/g, '-').length > 119)
      {
          alert("Enter less than 120 characters for search.");
          Form.keyword.focus();
          return false;
      }
    
      else 
      {
         var url = SITE_URL+'search/'+serachKeyword;
         window.location =url;
          return false;
   
      }
    }
</script>

@stop
<script type="text/javascript">
   var slider = document.getElementById('test5');
    noUiSlider.create(slider, {
     start: [20, 80],
     connect: true,
     step: 1,
     range: {
       'min': 0,
       'max': 100
     },
     format: wNumb({
       decimals: 0
     })
    });
</script>
