 <div class="col s12 m4 l6">
      <div class="col s12 m12 l12 middle-sec card user-profile">
          <h2>Basic Details</h2>
          <ul class="collection">
            <li class="collection-item">Name : {{$user->name}}</li>
            <li class="collection-item">Email : {{$user->email}}</li>
            <li class="collection-item">Mobile : {{$user->mobile}}</li>
            <li class="collection-item">Gender : 
            @if(@$userdetails->gender) 
             @if(@$userdetails->gender==2)
             Female
             @else
             Male
             @endif

             @endif </li>
             
            <li class="collection-item">Father Name : {{@$userdetails->mother_name}}</li>
            <li class="collection-item">Mother Name : {{@$userdetails->father_name}}</li>
            <li class="collection-item">Address : {{$user->address}}</li>
            <li class="collection-item">Pincode : {{$user->pincode}}</li>
          </ul>
          <a href="{{URL::to('editprofile')}}" class="waves-effect waves-light btn basicdetail-edit">Edit Profile</a>
          @if($user->looking_for_job==1)
          @if(count($usereducationArry)>0)
            <h2>Education Details</h2>
            <table>
           <tbody>
          @foreach($usereducationArry as $usereducationArry)
            <tr>
              <td><span>{{$usereducationArry['course_name']}} -</span> {{$usereducationArry['educate_from']}}</td>
              <td>{{$usereducationArry['passing_year']}} </td>
               <td>{{$usereducationArry['marks']}}</td>
            </tr>
            @endforeach()
            
          </tbody>
        </table>
         <a href="{{URL::to('editprofile/education')}}" class="waves-effect waves-light btn basicdetail-edit">Edit</a>
          @endif
           <h2>Previous Job Dtails</h2>
           @if($employmentdetails!='' && count($employmentdetails)>0)
           <table>
           <tbody>
          @foreach($employmentdetails as $employmentdetails)
            <tr>
              <td><span>{{$employmentdetails->designation}} -</span> {{$employmentdetails->company_name}}</td>
              <td>
              @if($employmentdetails->year) 
              {{$employmentdetails->year}}
              @if($employmentdetails->till==0)
              to Present
              @else
              to {{$employmentdetails->till}}
              @endif
              @endif
              </td>
               <td><a href="{{URL::to('editprofile/employment?edit='.$employmentdetails->id)}}"> Edit</a></td>
            </tr>
            @endforeach()
          </tbody>
        </table>
           @else
          <a href="{{URL::to('editprofile/employment')}}" class="waves-effect waves-light btn basicdetail-edit mt10">Add Employment</a> 
          @endif
          <!-- ////////////// project list////////////// -->
          <h2>All Projrct done list</h2>
           @if($projectlistarray!='' && count($projectlistarray)>0)
           <table>
           <tbody>
          @foreach($projectlistarray as $projectlistarray)
            <tr>
              <td><span>{{$projectlistarray['project_name']}} -</span> {{$projectlistarray['project_nature']}}</td>
              <td>{{date('jS M Y',strtotime($projectlistarray['worked_to']))}} @if($projectlistarray['worked_from']) - {{date('jS M Y',strtotime($projectlistarray['worked_from']))}} @endif </td>
               <td><a href="{{URL::to('editprofile/projectskills?editprojectid='.$projectlistarray['id'])}}">Edit</a></td>
            </tr>
            @endforeach()
            
          </tbody>
        </table>
           @else
          <a href="{{URL::to('editprofile/projectskills')}}" class="waves-effect waves-light btn basicdetail-edit mt10">Add Projects</a> 
          @endif
          <!-- /////////education array////// -->
            
          @endif
      </div>
    </div>

   