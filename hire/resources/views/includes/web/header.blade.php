<div class="top-header">
  <div class="container">
   <div class="row">
   <div class="col s12 m6 6 header-search">
   <a href="{{URL::to('/')}}" class="brand-logo"><img src="{{URL::to('web/images/Logo_2.png')}}" alt="" style="width: 180px; height: 45px;"></a>
   </div>
  <div class="col s12 m4 header-search">  
      <nav>
        <div class="nav-wrapper">
           <form name="searchForm" action="" onsubmit="return CheckDataSearch(document.searchForm);" method="get" id="hdr_frm" autocomplete="off">
            <div class="input-field">

               <input type="search" class="form-control inputs" autocomplete="off"  name="keyword" placeholder="Search.." id="search"  aria-haspopup="true" aria-expanded="true" value="" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search ..'">
              <label for="search" class="active"><i class="material-icons">search</i></label>
               <!-- Dropdown Trigger -->
                <a class="dropdown-button searchCarIcon" href="#" data-activates="searchCarIcon"><i class="material-icons dp48">view_list</i></a>
                <ul id="searchCarIcon" class="dropdown-content" style="height: 333px !important">
                 <li><a href="#!"><input name="serachpage" type="radio" id="people" value="people" checked="checked"><label for="people">Users</label></a></li>
                  <li><a href="#!"><input name="serachpage" type="radio" id="company" value="company"><label for="company">Company</label></a></li>
                  <li><a href="#!"><input name="serachpage" type="radio" id="jobs" value="jobs"><label for="jobs">Jobs</label></a></li>
                  <li><a href="#!"><input name="serachpage" type="radio" id="article" value="article"><label for="article">Article</label></a></li>
                  <li><a href="#!"><input name="serachpage" type="radio" id="discussion" value="discussion"><label for="discussion">Discussion</label></a></li>
                  <li><a href="#!"><input name="serachpage" type="radio" id="news" value="news"><label for="news">News</label></a></li>
                </ul>

                <!-- Dropdown Structure -->
                
            </div>
          </form>
        </div>
      </nav>
    </div>
    <!-- <div class="col s12 m6 6 header-search"> 
      <nav>
        <div class="nav-wrapper">
          <form name="searchForm" action="" onsubmit="return CheckDataSearch(document.searchForm);" method="get" id="hdr_frm" autocomplete="off">
            <div class="input-field">
              <input id="search" type="search" placeholder="Search.." required>

            <input type="search" class="form-control inputs" autocomplete="off"  name="keyword" placeholder="Search.." id="search"  aria-haspopup="true" aria-expanded="true" value="" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search ..'">
              <label for="search"><i class="material-icons">search</i></label>
              <i class="material-icons">close</i>
            </div>
          </form>
        </div>
      </nav>
    </div> -->
  </div>
</div>
</div>

<nav class="main-nav">
  <div class="nav-wrapper container">
    
    <ul id="nav-mobile" class="hide-on-med-and-down">
         <li><a href="{{URL::to('/')}}">Home</a></li>
          @if (Auth::check())
          <?php 
          $user = Auth::user();
          ?>
          <li><a href="{{URL::to('/profile')}}">Profile</a></li>
          @if($user->become_job_owner==1)
          <li><a href="{{URL::to('/companyprofile')}}">Company Profile</a></li>
          @endif
          <li><a href="{{URL::to('/search/article')}}">Articles</a></li>
          <li><a href="{{URL::to('/search/discussion')}}">Discussions</a></li>
          <li><a href="{{URL::to('digital-locker')}}">Digital locker</a></li>
          @else
           <li><a href="{{URL::to('/search/article')}}">Articles</a></li>
           <li><a href="{{URL::to('/search/discussion')}}">Discussions</a></li>
          <li><a href="{{URL::to('auth/login')}}">Digital locker</a></li>
          @endif
          <li><a href="{{URL::to('/search/jobs')}}">Job search</a></li>
          <li><a href="{{URL::to('/contactus')}}">Help & Support </a></li>
          <li><a href="{{URL::to('/search/people')}}">Connect with users</a></li>
          @if (Auth::check())
          <li><a href="{{URL::to('/auth/logout')}}">Logout</a></li>
          @endif
    </ul>
  </div>
</nav>
<script type="text/javascript">
  function CheckDataSearch(Form,searcfrom)
    {     
      var radioValue = $("input[name='serachpage']:checked").val();
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
         var url = SITE_URL+'search/'+radioValue+'?keywords='+serachKeyword;
         window.location =url;
          return false;
   
      }
    }
</script>