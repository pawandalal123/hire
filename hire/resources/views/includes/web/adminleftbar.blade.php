       @if (Auth::check())
             <?php
             $userDetails = Auth::user();
             $imagePatah = URL::asset('web/images/profilePic.png');
             if(@$userDetails->profile_image)
             {
               $imagePatah = URL::asset($_ENV['CF_LINK'].'/'.$userDetails->profile_image);
               if($userDetails->login_type==1)
               {
                  $imagePatah = $userDetails->profile_image;
               }
             }

             $name = substr(substr($userDetails->email,0,strpos($userDetails->email,'@')),0,10);

             if($userDetails->name)
             {
               $name = substr($userDetails->name,0,10);
             }
           ?>
           @endif
  <div class="menu">                

            <div class="breadLine">            
                <div class="arrow"></div>
                <div class="adminControl active">
                    Hi, {{ ucwords($name)}}
                </div>
            </div>

            <div class="admin">
                <div class="image">
                    <img src="{{$imagePatah}}" class="img-thumbnail"/>                
                </div>
                <ul class="control">                
                    
                    <li><span class="glyphicon glyphicon-cog"></span> <a href="{{URL::to('/admin/changepassword')}}">Change Password</a></li>
                    <li><span class="glyphicon glyphicon-share-alt"></span> <a href="{{URL::to('/admin/logout')}}">Logout</a></li>
                </ul>
              
            </div>

            <ul class="navigation">            
                <li class="active">
                    <a href="{{URL::to('/admin/dashboard')}}">
                        <span class="isw-grid"></span><span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="openable">
                    <a href="#">
                        <span class="isw-list"></span><span class="text">User Management</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{URL::to('/admin/makeuser')}}">
                                <span class="glyphicon glyphicon-th"></span>
                                <span class="text">Make Admin User</span>
                            </a>                  
                        </li>          
                        <li>
                            <a href="{{URL::to('admin/user/manage')}}">
                                <span class="glyphicon glyphicon-th-large"></span>
                                <span class="text">View All Uers</span>
                            </a>                  
                        </li>                     
                                             
                    </ul>                
                </li>          

                <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Location</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{URL::to('admin/location')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Country</span></a>
                        </li> 
                          <li>
                            <a href="{{URL::to('admin/location/state')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">State</span></a>
                        </li>  
                          <li>
                            <a href="{{URL::to('admin/location/city')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">City</span></a>
                        </li>                                         
                    </ul>                
                </li>  
                  <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Common Masters</span>
                    </a>
                    <ul>
                    <li>
                            <a href="{{URL::to('admin/broadcast')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Broadcast Message</span></a>
                        </li> 
                        <li>
                            <a href="{{URL::to('admin/schooboardlist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">School Boards</span></a>
                        </li> 
                        
                          <li>
                            <a href="{{URL::to('admin/mediumlist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">School Mediums</span></a>
                        </li>  
                          <li>
                            <a href="{{URL::to('admin/courselist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Course type</span></a>
                        </li>  
                          <li>
                            <a href="{{URL::to('admin/subcourselist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Subcourse type</span></a>
                        </li> 
                        <li>
                            <a href="{{URL::to('admin/industrylist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Industry</span></a>
                        </li>                                        
                    </ul>                
                </li> 
                     <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Articles</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{URL::to('admin/articles')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Articles Category</span></a>
                        </li> 
                          <li>
                            <a href="{{URL::to('admin/articles/subcategory')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Articles Subcategory</span></a>
                        </li>  
                          <li>
                            <a href="{{URL::to('/articlelist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Articles List</span></a>
                        </li> 
                        <li>
                            <a href="{{URL::to('/article-comment-list')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Articles Comments List</span></a>
                        </li>                                       
                    </ul>                
                </li>       
                    <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Discussion</span>
                    </a>
                    <ul>
                   
                      <li>
                            <a href="{{URL::to('/discussionlist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Discussion List</span></a>
                        </li> 
                        <li>
                            <a href="{{URL::to('/discussion-comment-list')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Discussion Comments List</span></a>
                        </li>    
                        <li>
                            <a href="{{URL::to('/invitationlisting')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Invite for discussion</span></a>
                        </li>                                        
                    </ul>                
                </li>  
                <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Digital locker</span>
                    </a>
                    <ul>
                   
                      <li>
                            <a href="{{URL::to('/digitallocker')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">All data</span></a>
                        </li> 
                                                               
                    </ul>                
                </li>
                <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Compnay Master</span>
                    </a>
                    <ul>
                   
                      <li>
                            <a href="{{URL::to('/admin/companylist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Company List</span></a>
                        </li> 
                      <!--    <li>
                            <a href="{{URL::to('/digitallocker')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Block Company</span></a>
                        </li>  -->
                        <li>
                            <a href="{{URL::to('/admin/newslist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Company News List</span></a>
                        </li>
                                                               
                    </ul>                
                </li>
                 <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Job Master</span>
                    </a>
                    <ul>
                   
                      <li>
                            <a href="{{URL::to('/admin/joblist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Active Jobs</span></a>
                        </li> 
                        <li>
                            <a href="{{URL::to('/admin/joblist/pastlist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Past Job</span></a>
                        </li>  
                         <li>
                            <a href="{{URL::to('/admin/applylist')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Apply for JObs</span></a>
                        </li>    
                                                               
                    </ul>                
                </li>        
                <li class="openable">
                    <a href="#">
                        <span class="isw-chat"></span><span class="text">Credibilty</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{URL::to('admin/credibiltycategory')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Add Category</span></a>
                        </li> 
                          <li>
                            <a href="{{URL::to('admin/credibiltycategory/factors')}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                <span class="text">Credibilty Factors</span></a>
                        </li>  
                                                              
                    </ul>                
                </li>                

            </ul>

            <div class="dr"><span></span></div>


        </div>

	