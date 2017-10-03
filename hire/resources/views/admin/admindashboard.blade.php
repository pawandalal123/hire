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
                                        <li><a href="{{URL::to('articlelist')}}"><span class="isw-list"></span> Show all</a></li>
                                        <li><a href="{{URL::to('profile/articles')}}">><span class="isw-edit"></span> Add new</a></li>
                                        <!-- <li><a href="#"><span class="isw-refresh"></span> Refresh</a></li> -->
                                    </ul>
                                </li>
                            </ul>                        
                        </div>
                        <div class="block news scrollBox">

                            <div class="scroll" style="height: 270px;">
                            @if(count($articlelist)>0)
                            @foreach($articlelist as $articlelist)
                                <div class="item">
                                    <a href="{{URL::to('articledetail/'.$articlelist->article_url)}}">{{ucwords($articlelist->title)}}</a>
                                    <p><?php echo substr($articlelist->description,0,300);?></p>
                                    <span class="date">{{ucwords($articlelist->created_at)}}</span>
                                     <div class="controls">                                    
                                        <a href="{{URL::to('deletearticle/'.$articlelist->id)}}" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>

                        </div>
                    </div>  
  <div class="col-md-4">
                        <div class="head clearfix">
                            <div class="isw-edit"></div>
                            <h1>Latest Discussions</h1>
                            <ul class="buttons">                            
                                <li>
                                    <a href="#" class="isw-text_document"></a>
                                </li>                            
                                <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="{{URL::to('discussionlist')}}"><span class="isw-list"></span> Show all</a></li>
                                        <li><a href="{{URL::to('profile/discussions')}}"><span class="isw-edit"></span> Add new</a></li>
                                        <!-- <li><a href="#"><span class="isw-refresh"></span> Refresh</a></li> -->
                                    </ul>
                                </li>
                            </ul>                        
                        </div>
                        <div class="block news scrollBox">

                            <div class="scroll" style="height: 270px;">

                               @if(count($discussionlist)>0)
                                 @foreach($discussionlist as $discussionlist)
                                <div class="item">
                                    <a href="{{URL::to('discussiondetail/'.$discussionlist->discussion_url)}}">{{ucwords($discussionlist->title)}}</a>
                                    <p><?php echo substr($discussionlist->description,0,300);?></p>
                                    <span class="date">{{ucwords($discussionlist->created_at)}}</span>
                                    <div class="controls">                                    
                                        <a href="{{URL::to('deletediscussion/'.$discussionlist->id)}}" class="glyphicon glyphicon-trash tip" title="Remove"></a>
                                    </div>
                                </div>
                                @endforeach
                                @endif                        
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
                               <!--  <li>
                                    <a href="#" class="isw-settings"></a>
                                    <ul class="dd-list">
                                        <li><a href="{{URL::to('admin/newslist')}}"><span class="isw-list"></span> Show all</a></li>
                                        <li><a href="#"><span class="isw-edit"></span> Add new</a></li>
                                        <li><a href="#"><span class="isw-refresh"></span> Refresh</a></li>
                                    </ul>
                                </li> -->
                            </ul>                        
                        </div>
                        <div class="block news scrollBox">

                            <div class="scroll" style="height: 270px;">

                                @if(count($getnewslist)>0)
                                 @foreach($getnewslist as $getnewslist)
                                <div class="item">
                                    <a href="{{URL::to('newsdetail/'.$getnewslist->news_url)}}">{{ucwords($getnewslist->title)}}</a>
                                    <p><?php echo substr($getnewslist->description,0,300);?></p>
                                    <span class="date">{{ucwords($getnewslist->created_at)}}</span>
                                    <div class="controls">                                    
                                        
                                    </div>
                                </div>
                                @endforeach
                                @endif                            

                            </div>

                        </div>
                    </div>  
                                                

                              

                </div>

                <div class="dr"><span></span></div>

            </div>

        </div>   
    

@stop



