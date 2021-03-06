@extends('layout.default')
@section('content')
<div class="container center-align">
        <div class="card company-search-box">
        <div class="row">
        <form>
        <div class="input-field col s2">
          <input  type="text" class="browser-default" name="commonfeild" value="">
        </div>
        <div class="input-field col s2" name="country">
          <select class="browser-default countrychangeall" >
            <option value="" >Country</option>
             @if(count($countryList)>0)
                        @foreach($countryList as $countryList)
                        <option value="{{$countryList->id}}" id="{{$countryList->id}}">{{$countryList->country}}</option>
                        @endforeach
                        @endif
          </select>
        </div>
        <div class="input-field col s2">
          <select class="browser-default stateall" name="state">
            <option value="" disabled="" selected="" >State</option>
          </select>
        </div>
        <div class="input-field col s2" name="city">
          <select class="browser-default" >
            <option value="" disabled="" selected="">City</option>
           
          </select>
        </div>
        <div class="input-field col s2">
          <select class="browser-default" name="exp">
            <option value="" disabled="" selected="">Experience</option>
            @for($i=1;$i<=25; $i++)
                        <option value="{{$i}}">{{$i}} Year</option>
                        @endfor
          </select>
        </div>
        <div class="input-field col s2">
          <select class="browser-default" name="salary">
            <option value="" disabled="" selected="">Salary</option>
           @for($i=1;$i<=25; $i+=.5)
                        <option value="{{$i}}">{{$i}} Lakhs</option>
                        @endfor
          </select>
        </div>
        <div class="col s12 right-align">
         <button class="waves-effect waves-light btn" type="submit">Search</button>
        </div>
        </form>
        </div>
        </div>
</div>
<section class="user-listing">
  <div class="container user-profile">
  <div class="row">
    <div class="col s12 m4 l3">
        <div class="sidebar">
          <p><strong>Refine Results</strong></p>
          <label>Freshness</label>
          <select class="browser-default">
            <option value="" disabled="" selected="">Last 30 Days</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
          </select>

          <ul class="collapsible" data-collapsible="accordion">
     
            <li>
              <div class="collapsible-header">Industry</div>
              <div class="collapsible-body">
                @if(count($indusrtylist)>0)
                @foreach($indusrtylist as $indusrtylist)
                <input type="checkbox" name="industrycheck">{{$indusrtylist->name}}
                @endforeach

                @endif
              </div>
            </li>
            <li>
              <div class="collapsible-header">Salary</div>
              <div class="collapsible-body">
                <form action="#">
                  <p class="range-field">
                    <input type="range" id="test5" min="0" max="5000000"><span class="thumb"><span class="value"></span></span>
                  </p>
                </form>
              </div>
            </li>
            <li>
              <div class="collapsible-header">Education</div>
              <div class="collapsible-body"><p>Education Lorem ipsum dolor sit amet.</p></div>
            </li>
            <li>
              <div class="collapsible-header">Job Type</div>
              <div class="collapsible-body"><p>Job Lorem ipsum dolor sit amet.</p></div>
            </li>
          </ul>

        </div>
    </div>
    <div class="col s12 m8 l9">
      <div class="col s12 m12 l12 middle-sec">
        <div class="row">
          <div class="job-viewby-number">
            <div class="row">
              <!-- <div class="col s6 m6 l6"><span>1-50 of 9893 Ui Designer Jobs</span></div> -->
              <div class="col s12 m12 l12 right-align">
                <select class="browser-default">
                  <option value="" disabled="" selected="">Sort by: Personalized</option>
                  <option value="1">Option 1</option>
                  <option value="2">Option 2</option>
                  <option value="3">Option 3</option>
                </select>
              </div>
            </div>
          </div>

       @include('includes.partials.userlistbox');

        </div>
      </div>
    </div>
  </div>
</div>
</section>
@stop