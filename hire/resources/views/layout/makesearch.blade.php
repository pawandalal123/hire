@extends('layout.default')
@section('content')
 <?php 
$url=$_SERVER['REQUEST_URI'];
$parsed=[];
if( strpos($url, '?')!==false)
{
  parse_str(substr($url, strpos($url, '?') + 1), $parsed);

}
print_r($parsed);
?>

<link type="text/css" rel="stylesheet" href="{{ URL::asset('web/site/css/bootstrap.css')}}"  media="screen,projection"/>
<script type="text/javascript" src="{{ URL::asset('web/site/js/bootstrap.min.js')}}"></script>
<section class="user-listing">
  <div class="container user-profile search-page">
  <div class="row">
  <form name="searchFormweb" action="" onsubmit="return CheckDataSearch(document.searchFormweb);" method="get" id="hdr_frm" autocomplete="off">
  <div class="col s12 m10 l10"><input name="keyword" placeholder="Search.." id="search"   value="{{@$_GET['keywords']}}" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search ..'"></div>
  <div class="col s12 m2 l2"><button class="waves-effect waves-light btn search-btn">Search</button></div>
    
    </form>
   
 <div class="col s12 m4 l3">
                <div class="sidebar">
                  <p><strong>Refine Results</strong></p>
                  <ul class="collapsible" data-collapsible="accordion">
                    <li class="">
                      <div class="collapsible-header">Keyword</div>
                      <div class="collapsible-body" style="display: none;">
                        <input type="search" placeholder="Enter Keyword" name="keywords" value="@if(array_key_exists('keywords',$parsed)) {{$parsed['keywords']}} @endif">
                        <p><button class="waves-effect waves-light btn search-btn" onclick="makesearch('keywords')">Search</button></p>
                      </div>
                    </li>
                    @if($pagename=='people' || $pagename=='jobs' || $pagename=='company')
                    <li>
                      <div class="collapsible-header">Location</div>
                      <div class="collapsible-body">
                        <p>
                          <select class="browser-default countrychangeall" >
                            <option value="" >Country</option>
                             @if(count($countrylist)>0)
                              @foreach($countrylist as $id=>$name)
                              <option value="{{$id}}" id="{{$id}}">{{$name}}</option>
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
                    </li>
                   <!--  <li>
                      <div class="collapsible-header">Company</div>
                      <div class="collapsible-body">
                        <p>
                          <input type="checkbox" id="test5">
                          <label for="test5">Swaransoft</label>
                        </p>
                        <p>
                          <input type="checkbox" id="test6">
                          <label for="test6">YE</label>
                        </p>
                        <p>
                          <input type="checkbox" id="test7">
                          <label for="test7">TCS</label>
                        </p>
                      </div>
                    </li> -->
                    
                    <li>
                      <div class="collapsible-header">Industries</div>
                      <div class="collapsible-body">
                      @if(count($industrylist)>0)
                      @foreach($industrylist as $industrylist=>$name)
                        <p>
                          <input name="industryfilter" value="{{$industrylist}}" type="checkbox" id="indistry{{$industrylist}}" onclick="makesearch('industry')">
                          <label for="indistry{{$industrylist}}">{{$name}}</label>
                        </p>
                        @endforeach()
                        @endif
                      </div>
                    </li>
                    @if($pagename=='jobs')
                    <li>
                      <div class="collapsible-header">Functional Area</div>
                      <div class="collapsible-body">
                      @if(count($functionarea)>0)
                      @foreach($functionarea as $functionarea)
                        <p>
                          <input name="functionalfilter" value="{{$functionarea->id}}" type="checkbox" id="function{{$functionarea->id}}" onclick="makesearch('functional')">
                          <label for="function{{$functionarea->id}}">{{$functionarea->name}}</label>
                        </p>
                        @endforeach()
                        @endif
                      </div>
                    </li>
                    <li>
                    <div class="collapsible-header">Salary</div>
                      <div class="collapsible-body">
                        <p>
                         <select class="browser-default salaryto" name="salaryto">
                          <option value="">To</option>
                         @for($i=1;$i<=25; $i+=1)
                         <option value="{{$i}}">{{$i}} Lakhs</option>
                         @endfor
                        </select>
                        </p>
                         <p>
                         <select class="browser-default salaryfrom" name="salaryfrom">
                          <option value="">From</option>
                         @for($i=1;$i<=25; $i+=1)
                         <option value="{{$i}}">{{$i}} Lakhs</option>
                         @endfor
                        </select>
                        </p>
                        <p><button class="waves-effect waves-light btn search-btn" onclick="makesearch('salary')">Search</button></p>
                        </div>
                    </li>
                    <li>
                   <div class="collapsible-header">Job Type</div>
                      <div class="collapsible-body">
                        <p>
                      <select class="browser-default" name="sort">
                      <option value="" disabled="" selected="">Select</option>
                      <option value="1">Full Time</option>
                      <option value="2">Part Time</option>
                      <!-- <option value="3">Option 3</option> -->
                    </select>
                  </p>
                  </div>
               
                  </li>
                    @endif
                    @endif
                     @if($pagename=='article')
                  {{--*/ $categorylist=$catlist /*--}}
                   <li>
                   <div class="collapsible-header">Sort By</div>
                      <div class="collapsible-body">
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
               
                  </li>
                  <li>
                   <div class="collapsible-header">Category</div>
                      <div class="collapsible-body">
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
                  </li>
                  @endif
                  </ul>
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
                </div>
            </div>
    <div class="col s12 m8 l9">
      <div class="col s12 m12 l12 middle-sec">
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
