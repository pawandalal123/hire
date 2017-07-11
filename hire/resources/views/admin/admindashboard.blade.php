@extends('layout.adminlayout')
@section('content')
<div class="content">
            <div class="breadLine">
                <ul class="breadcrumb">
                    <li><a href="#">Simple Admin</a> <span class="divider">></span></li>                
                    <li class="active">Dashboard</li>
                </ul>
                

            </div>

            <div class="workplace">

     

                <div class="row">

                    <div class="col-md-4">                    

                        <div class="wBlock red clearfix">                        
                            <div class="dSpace">
                                <h3>Invoices statistics</h3>
                                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--130,190,260,230,290,400,340,360,390--></span>
                                <span class="number">60%</span>                    
                            </div>
                            <div class="rSpace">
                                <span>$1,530 <b>amount paid</b></span>
                                <span>$2,102 <b>in queue</b></span>
                                <span>$11,100 <b>total taxes</b></span>
                            </div>                          
                        </div>                     

                    </div>                

                    <div class="col-md-4">                    

                        <div class="wBlock green clearfix">                        
                            <div class="dSpace">
                                <h3>Users</h3>
                                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--5,10,15,20,23,21,25,20,15,10,25,20,10--></span>
                                <span class="number">2,513</span>                    
                            </div>
                            <div class="rSpace">
                                <span>351 <b>active</b></span>
                                <span>2102 <b>passive</b></span>
                                <span>100 <b>removed</b></span>
                            </div>                          
                        </div>                                                            

                    </div>

                    <div class="col-md-4">                    

                        <div class="wBlock blue clearfix">
                            <div class="dSpace">
                                <h3>Last visits</h3>
                                <span class="mChartBar" sparkType="bar" sparkBarColor="white"><!--240,234,150,290,310,240,210,400,320,198,250,222,111,240,221,340,250,190--></span>
                                <span class="number">6,302</span>
                            </div>
                            <div class="rSpace">                                                                           
                                <span>65% <b>New</b></span>
                                <span>35% <b>Returning</b></span>
                                <span>00:05:12 <b>Average time on site</b></span>                                                        
                            </div>
                        </div>                      

                    </div>                
                </div>            

                <div class="dr"><span></span></div> 

                <div class="row">

                   <div class="col-md-4">
                        <div class="head clearfix">
                            <div class="isw-edit"></div>
                            <h1>Latest articles</h1>
                            <ul class="buttons">                            
                                <li>
                                    <a href="#" class="isw-text_document"></a>
                                </li>                            
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-list"></span> Show all</a></li>
                                        <li><a href="#"><span class="isw-edit"></span> Add new</a></li>
                                        <li><a href="#"><span class="isw-refresh"></span> Refresh</a></li>
                                    </ul>
                                </li>
                            </ul>                        
                        </div>
                        <div class="block news scrollBox">

                            <div class="scroll" style="height: 270px;">

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>                            

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>                            

                            </div>

                        </div>
                    </div>  

                    <div class="col-md-4">
                        <div class="head clearfix">
                            <div class="isw-edit"></div>
                            <h1>Latest news</h1>
                            <ul class="buttons">                            
                                <li>
                                    <a href="#" class="isw-text_document"></a>
                                </li>                            
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-list"></span> Show all</a></li>
                                        <li><a href="#"><span class="isw-edit"></span> Add new</a></li>
                                        <li><a href="#"><span class="isw-refresh"></span> Refresh</a></li>
                                    </ul>
                                </li>
                            </ul>                        
                        </div>
                        <div class="block news scrollBox">

                            <div class="scroll" style="height: 270px;">

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>                            

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>

                                <div class="item">
                                    <a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a>
                                    <p>Phasellus ut diam quis dolor mollis tristique. Suspendisse vestibulum convallis felis vitae facilisis. Praesent eu nisi vestibulum erat lacinia sollicitudin. Cras nec risus dolor, ut tristique neque. Donec mauris sapien, pellentesque at porta id, varius eu tellus.</p>
                                    <span class="date">02.11.2012 14:23</span>
                                    <div class="controls">                                    
                                        <a href="#" class="glyphicon glyphicon-pencil tip" title="Edit"></a>
                                        <a href="#" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>                                
                                </div>                            

                            </div>

                        </div>
                    </div>                               

                    <div class="col-md-4">
                        <div class="head clearfix">
                            <div class="isw-cloud"></div>
                            <h1>Registrations</h1>
                            <ul class="buttons">        
                                <li>
                                    <a href="#" class="isw-users"></a>
                                </li>
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="#"><span class="isw-list"></span> Show all</a></li>
                                        <li><a href="#"><span class="isw-mail"></span> Send mail</a></li>
                                        <li><a href="#"><span class="isw-refresh"></span> Refresh</a></li>
                                    </ul>
                                </li>
                                <li class="toggle"><a href="#"></a></li>
                            </ul> 
                        </div>
                        <div class="block users scrollBox">

                            <div class="scroll" style="height: 270px;">

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/aqvatarius_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Aqvatarius</a>                                                                    
                                        <div class="controls">                                    
                                            <a href="#" class="glyphicon glyphicon-ok"></a>
                                            <a href="#" class="glyphicon glyphicon-remove"></a>
                                        </div>                                                                    
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/olga_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Olga</a>                                                                
                                        <div class="controls">                                    
                                            <a href="#" class="glyphicon glyphicon-ok"></a>
                                            <a href="#" class="glyphicon glyphicon-remove"></a>
                                        </div>                                                            
                                    </div>
                                </div>                        

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexey</a>    
                                        <div class="controls">                                    
                                            <a href="#" class="glyphicon glyphicon-ok"></a>
                                            <a href="#" class="glyphicon glyphicon-remove"></a>
                                        </div>                                                            
                                    </div>
                                </div>                              

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/dmitry_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Dmitry</a>                                    
                                        <span>approved</span>
                                    </div>
                                </div>                         

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/helen_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Helen</a>                                                                        
                                        <span>approved</span>
                                    </div>                          
                                </div>                                  

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/alexander_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexander</a>                                                                        
                                        <span>approved</span>
                                    </div>
                                </div>                        

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/aqvatarius_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Aqvatarius</a>                                                                    
                                        <span>approved</span>
                                    </div>
                                </div>

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/olga_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Olga</a>                                                                
                                        <span>approved</span>
                                    </div>
                                </div>                        

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/alexey_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexey</a>
                                        <span>approved</span>
                                    </div>
                                </div>                              

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/dmitry_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Dmitry</a>                                    
                                        <span>approved</span>
                                    </div>
                                </div>                         

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/helen_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Helen</a>                                                                        
                                        <span>approved</span>
                                    </div>
                                </div>                                  

                                <div class="item clearfix">
                                    <div class="image"><a href="#"><img src="img/users/alexander_s.jpg" width="32"/></a></div>
                                    <div class="info">
                                        <a href="#" class="name">Alexander</a>                                                                        
                                        <span>approved</span>
                                    </div>
                                </div>                        

                            </div>

                        </div>
                    </div>                

                </div>

                <div class="dr"><span></span></div>

            </div>

        </div>   
    

@stop



