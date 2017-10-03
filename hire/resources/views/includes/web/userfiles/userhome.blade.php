 <div class="col s12 m8 l6">

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

             

            <li class="collection-item">Father Name : {{@$userdetails->father_name}}</li>

            <li class="collection-item">Mother Name : {{@$userdetails->mother_name}}</li>

            <li class="collection-item">Address : {{$user->address}}</li>

            <li class="collection-item">Pincode : {{$user->pincode}}</li>

          </ul>

          <a href="{{URL::to('editprofile')}}" class="waves-effect waves-light btn basicdetail-edit">Edit Profile</a>

          @if($user->looking_for_job==1)

          @if(count($usereducationArry)>0)

            <h2>Education Details</h2>

            <div class="scrollable"><table class="details">

           <tbody>
            <tr>

                <th>Course</th>

                <th>University</th>

                <th>Year of passing</th>

                <th>percentage</th>

            </tr>

          @foreach($usereducationArry as $usereducationArry)

            <tr>

              <td><span>{{$usereducationArry['course_name']}} <span></td>

              <td>{{$usereducationArry['educate_from']}}</td>

              <td>{{$usereducationArry['passing_year']}} </td>

               <td>{{$usereducationArry['marks']}}</td>

            </tr>

            @endforeach()

            

          </tbody>

        </table></div>

         <a href="{{URL::to('editprofile/education')}}" class="waves-effect waves-light btn basicdetail-edit">Edit</a>

          @endif

           <h2>Previous Job Details</h2>

           @if($employmentdetails!='' && count($employmentdetails)>0)

           <div class="scrollable"><table class="details">

           
				<tbody>
                <th>Job designation</th>

                <th>Company name</th>

                <th>work duration</th>

                <th>&nbsp;</th>

          @foreach($employmentdetails as $employmentdetails)

            <tr>

              <td><span>{{$employmentdetails->designation}} </span></td>
              <td>{{$employmentdetails->company_name}}</td>

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

        </table></div>

           @else

          <a href="{{URL::to('editprofile/employment')}}" class="waves-effect waves-light btn basicdetail-edit mt10">Add Employment</a> 

          @endif

          <!-- ////////////// project list////////////// -->

          <h2>All Projects Done</h2>

           @if($projectlistarray!='' && count($projectlistarray)>0)

           <table>
           <tbody>
           

                <th>Project Title/nature</th>

                <th>Duration</th>

                <th>Edit</th>
          @foreach($projectlistarray as $projectlistarray)
            <tr>

              <td><span>{{$projectlistarray['project_name']}} -</span> {{$projectlistarray['project_nature']}}</td>

              <td>
              @if($projectlistarray['worked_to'])
              {{date('jS M Y',strtotime($projectlistarray['worked_to']))}}
               @if($projectlistarray['worked_from']) - {{date('jS M Y',strtotime($projectlistarray['worked_from']))}} @endif 
               @else
               NA
                @endif</td>
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



   