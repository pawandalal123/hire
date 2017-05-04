@extends('layout.default')
@section('content')

<div class="container center-align">
<form action="">
    <div class="row">
      <div class="company-search-box">
        <div class="input-field col s4">
          <input name="keyword" placeholder="ui designer" type="text" class="browser-default">
        </div>
       <!--  <div class="input-field col s2">
          <input placeholder="Location (km)" type="text" class="browser-default">
        </div> -->
        <div class="input-field col s2">
          <select class="browser-default" name="exp">
            <option value="" disabled="" selected="">Experience</option>
            @for($i=1; $i<=25; $i++)
            <option value="{{$i}}">{{$i}}</option>
            @endfor()
          </select>
        </div>
        <div class="input-field col s2">
          <select class="browser-default" name="salary">
            <option value="" disabled="" selected="">Salary</option>
             @for($i=1;$i<=30; $i+=.5)
            <option value="{{$i}}">{{$i}} Lakhs</option>
            @endfor
          </select>
        </div>
        <div class="input-field col s2">
         <button class="waves-effect waves-light btn" type="submit">Search</button>
        </div>
      </div>
    </div>
    </form>
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
              <div class="collapsible-header">Top Companies</div>
              <div class="collapsible-body"><p>Companies.</p></div>
            </li>
            <li>
              <div class="collapsible-header">Location</div>
              <div class="collapsible-body">
                sfsa
              </div>
            </li>
            <li>
              <div class="collapsible-header">Industry</div>
              <div class="collapsible-body"><p>Industry Lorem ipsum dolor sit amet.</p></div>
            </li>
            <li>
              <div class="collapsible-header">Salary</div>
              <div class="collapsible-body">
                <form action="#">
                  <p class="range-field">
                    <input type="range" id="test5" min="0" max="100" />
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
    
             @include('includes.partials.jobboxlist')

        </div>
      </div>
    </div>
  </div>
</div>
</section>
@stop