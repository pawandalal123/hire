@extends('layout.default')
@section('content')
<section class="top-blue-sec">
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12">
        <h1>Company Profile</h1>
      </div>
    </div>
  </div>
</section>
<div class="container user-profile">
  <div class="row">
 @include('includes.web.companyleftbar')
    <div class="col s12 m8 l9">
      <div class="col s12 m12 l12 middle-sec card user-profile company-page-tab">

          <div class="col s12">
            <ul class="tabs row">
              <li class="tab col s6 m6 l6"><a class="waves-effect @if($currenttab=='') active @endif" href="#jobPosted">Add department</a></li>
              <li class="tab col s6 m6 l6"><a class="waves-effect @if($currenttab=='addemp') active @endif" href="#create-a-Job">Add Employee</a></li>
              <!-- <div class="indicator" style="right: 0.671875px; left: 214.328px;"></div>
            <div class="indicator" style="right: 0.671875px; left: 214.328px;"></div> -->
            </ul>
          </div>
           @if(Session::has('message'))
        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message') }}
        </div>
        @endif
          <div id="jobPosted" class="col s12 tab-content"  @if($currenttab!='')  style="display: none;" @endif>
               <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-field">
          <input name="departmentname" type="text" class="validate" value="{{@$newsdetail->title}}">
          <label>Department Name</label>
          @if ($errors->has('departmentname')) 
             <div class="alert alert-danger">{{ $errors->first('departmentname') }}</div> 
             @endif
                  </div>
     
        <button type="submit" name="submitdept" class="waves-effect waves-light btn article-hire-button">Submit</button> 
        </form>
        <h2>Departments List</h2>
        @if(count($getalldepartmetlist)>0)
        <table>
           <thead>
             <tr><th style="color: #000">Sr.NO</th>
             <th style="color: #000">Department Name</th>
             <th style="color: #000">Created on</th>
             <th style="color: #000">Status</th>
             <th>Actions</th>
           </tr></thead>
                                 <tbody>
                                 {{--*/ $i=1 /*--}}
            @foreach($getalldepartmetlist as $alldept)
            {{--*/ $status='active' /*--}}
                                   {{--*/ $textdisplay='Make Disable' /*--}}
                                 @if($alldept->status==0)
                                   {{--*/ $status='deactive' /*--}}
                                   {{--*/ $textdisplay='Make Active' /*--}}
                                 @endif

                                 <tr>
             <td>{{$i}}</td>
             <td>{{$alldept->name}}</td>
             <td>{{$alldept->created_at}}</td>
             <td>{{$status}}</td>
             <td><a href="{{URL::to('/companycredibility/'.$alldept->id)}}">Edit</a>  
              <a href="{{URL::to('categorystatus/'.$alldept->id)}}">{{$textdisplay}}</a></td>
           </tr>
            {{--*/ $i++ /*--}}
            @endforeach()
                               </tbody></table>
                               @endif
          </div>
          <div id="create-a-Job" class="col s12 tab-content"  @if($currenttab=='')  style="display: none;" @endif>
        
             <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-field col s4">
          <input name="employname" type="text" class="validate" value="{{@$newsdetail->title}}">
          <label>Employee name</label>
          @if ($errors->has('employname')) 
             <div class="alert alert-danger">{{ $errors->first('employname') }}</div> 
             @endif
                  </div>
            <div class="input-field col s4">
                 <select name="empdepartment" class="empdepartment"> 
                        <option value="" >Choose your option</option>
                        @if(count($getdepartmetlist)>0)
                        @foreach($getdepartmetlist as $getdepartmetlist)
                        <option value="{{$getdepartmetlist->id}}">{{$getdepartmetlist->name}}</option>
                        @endforeach
                        @endif
                      </select>
              <label>Department</label>
               @if ($errors->has('empdepartment')) 
             <div class="alert alert-danger">{{ $errors->first('empdepartment') }}</div> 
             @endif
            </div>
            @if(count($credibiltycatArray)>0)
            @foreach($credibiltycatArray as $key=>$values)
             <div class="input-field col s4">
                 <select name="factorapont[]" class="factorapont"> 
                        <option value="" >Choose your option</option>
                        @if(count($values['factorsvalues'])>0)
                        @foreach($values['factorsvalues'] as $factorskey=>$factor)
                        <option value="{{$factor['points']}}">{{$factor['name']}}</option>
                        @endforeach
                        @endif
                      </select>
              <label>{{$values['name']}}</label>
            </div>
            @endforeach
            @endif
   
 
        <button type="submit" name="saveemployee" class="waves-effect waves-light btn article-hire-button">Submit</button> 
        </form>
         <h2>ALL employee list</h2>
        <table>
           <thead>
             <tr><th style="color: #000">Sr.NO</th>
             <th style="color: #000">Name</th>
             <th style="color: #000">Email</th>
             <th style="color: #000">Send on</th>
           </tr></thead>
                                 <tbody><tr>
             <td>1</td>
             <td>pawan</td>
             <td>pawan.dalal123@gmail.com</td>
             <td>2017-01-20 17:35:50</td>
           </tr>
                               </tbody></table>
          </div>
          </div>
       
    </div>
  </div>
</div>

 <script type="application/javascript"   src="{{ URL::asset('web/js/jquery.validate.min.js')}}"></script>

@stop
