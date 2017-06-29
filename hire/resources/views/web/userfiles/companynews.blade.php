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
              <li class="tab col s6 m6 l6"><a class="waves-effect @if($currenttab=='') active @endif" href="#jobPosted">News</a></li>
              <li class="tab col s6 m6 l6"><a class="waves-effect @if($currenttab=='edittab') active @endif" href="#create-a-Job">Post News</a></li>
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
               @if(count($postnewslist)>0)
          @foreach($postnewslist as $postnews)
            <div class="article-box">
              <h5>{{ucwords($postnews->title)}}</h5>
              <p><?php echo substr($postnews->description,0,260);?>..</p>
              <a href="{{URL::to('makenews?editid='.$postnews->id)}}" class="waves-effect waves-light btn"><i class="material-icons dp48"><i class="material-icons dp48">mode_edit</i></i></a> 
              <a href="{{URL::to('deletearticle/'.$postnews->id)}}" class="waves-effect waves-light btn del"><i class="material-icons dp48"><i class="material-icons dp48">delete</i></i></a> 
              <a href="{{URL::to('articledetail/'.$postnews->article_url)}}" class="waves-effect waves-light btn">Read Article</a>
            </div>
             @endforeach()
            <?php echo $postnewslist->render();?>
            @else
            <div class="text-center">No article found......</div> 
           @endif
          </div>
          <div id="create-a-Job" class="col s12 tab-content"  @if($currenttab=='')  style="display: none;" @endif>
        
             <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-field">
          <input name="title" type="text" class="validate" value="{{@$newsdetail->title}}">
          <label>Title Of the Article</label>
          @if ($errors->has('title')) 
             <div class="alert alert-danger">{{ $errors->first('title') }}</div> 
             @endif
                  </div>
        <div class="input-field">
          <textarea class="materialize-textarea" name="description"><?php echo @$newsdetail->description;?></textarea>
          <label>Write here....</label>
           @if ($errors->has('description')) 
             <div class="alert alert-danger">{{ $errors->first('description') }}</div> 
             @endif
        </div>
        <div class="file-field input-field">
          <div class="btn">
            <span>File</span>
            <input name="articlefile" type="file">
             @if ($errors->has('articlefile')) 
             <div class="alert alert-danger">{{ $errors->first('articlefile') }}</div> 
             @endif
                       </div>
          <div class="file-path-wrapper">
            <input name="articles_image" class="file-path validate" type="text" placeholder="Add Cover To News">
          </div>
        </div>
       <!--  <p>
          <input name="group1" type="radio" id="timeline" />
          <label for="timeline">Publish on timeline</label>
        </p>
        <p>
          <input name="group1" type="radio" id="Request" />
          <label for="Request">Request To Publish Your Article</label>
        </p> -->
        <button type="submit" name="submitnews" class="waves-effect waves-light btn article-hire-button">Submit</button> 
        </form>
          </div>
          </div>
       
    </div>
  </div>
</div>
<script type="application/javascript"   src="{{ URL::asset('web/js/locationpicker.jquery.js')}}"></script>
 <script type="application/javascript"   src="{{ URL::asset('web/js/editevent.js')}}"></script>
 <script type="application/javascript"   src="{{ URL::asset('web/js/addevent.js')}}"></script>
 <script type="application/javascript"   src="{{ URL::asset('web/js/build/js/intlTelInput.js')}}"></script> 
 <script type="application/javascript"   src="{{ URL::asset('web/js/ckeditor/ckeditor.js')}}"></script>
 <script type="application/javascript"   src="{{ URL::asset('web/js/ckeditor/ckfinder.js')}}"></script>
 <script type="application/javascript"   src="{{ URL::asset('web/js/jquery.validate.min.js')}}"></script>

       <script type="text/javascript">


var editor = CKEDITOR.replace( 'description', {
    filebrowserBrowseUrl : '{!! url() !!}/web/js/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '{!! url() !!}/web/js/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '{!! url() !!}/web/js/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl : '{!! url() !!}/web/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '{!! url() !!}/web/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '{!! url() !!}/web/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
  toolbarGroups: [
  { name: 'document',    groups: [ 'mode', 'document' ] },
  
  { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },  
  { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
  { name: 'links' },
  { name: 'tools' },
  { name: 'insert' },
  { name: 'styles' },
  { name: 'colors' },
  { name: 'insert' }
  
  ]
});


CKFinder.setupCKEditor( editor, '../../../../' );


</script>
@stop
