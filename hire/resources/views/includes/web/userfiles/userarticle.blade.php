@if(!empty($errors) && count($errors)>0)

 {{--*/ $currenttab='edittab' /*--}}
@endif
<div class="col s12 m4 l6">
      <div class="col s12 m12 l12 middle-sec card user-profile">
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6 m6 l6"><a class="waves-effect @if($currenttab=='') active @endif" href="#test1">Read Articles</a></li>
              <li class="tab col s6 m6 l6"><a class="waves-effect @if($currenttab=='edittab') active @endif" href="#test2">Write Articles</a></li>
            <div class="indicator" style="right: 276px; left: 0px;"></div></ul>
          </div>
             @if(Session::has('message'))
        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message') }}
        </div>
        @endif
          <div id="test1" class="col s12 tab-content" @if($currenttab!='')  style="display: none;" @endif>
          @if(count($articlelist)>0)
         @foreach($articleArrary as $key=>$article)
            <div class="article-box">
              <h5>{{ucwords($article['title'])}}</h5>
              <p>{{ date(' M j, D, Y',strtotime($article['created_at']))}}, <a href="#" style="color: #7c7ee2!important; float: none; background-color:#ffffff"><img src="{{URL::to('web/images/eye.png')}}" style="float: none; margin-right: 10px;" alt="" >{{$article['view_count']}}</a> <br /><?php echo substr($article['description'],0,260);?>..</p>

              <a href="{{URL::to('profile/articles?editid='.$key)}}" class="waves-effect waves-light btn"><i class="material-icons dp48"><i class="material-icons dp48">mode_edit</i></i></a> 
              <a href="{{URL::to('makedeletearticle/'.$key)}}" class="waves-effect waves-light btn del"><i class="material-icons dp48"><i class="material-icons dp48">delete</i></i></a> 
              <a href="{{URL::to('articledetail/'.$article['article_url'])}}" class="waves-effect waves-light btn">Read Article</a>
              <a href="{{URL::to('articledetail/'.$article['article_url'])}}" class="waves-effect waves-light btn">Comment {{$article['totalcount']}}</a>
            </div>
             @endforeach()
            <?php echo $articlelist->render();?>
            @else
            <div class="text-center">No article found......</div> 
           @endif
                 
           </div>
          <div id="test2" class="col s12 tab-content" @if($currenttab=='')  style="display: none;" @endif>
            <div class="card tab-form">
         <form  action='' method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-field">
          <select name="category">
            <option value="" disabled>Select Category</option>
            @if(count($catlist)>0)
            @foreach($catlist as $catlist)
              <option value="{{$catlist->name}}" @if(@$articledetail->category==$catlist->name) 'selected' @endif>{{$catlist->name}}</option>
            @endforeach()
            @endif
          </select>
          @if ($errors->has('category')) 
             <div class="alert alert-danger">{{ $errors->first('category') }}</div> 
             @endif
        </div>
        <div class="input-field">
          <select name="subcategory">
            <option value="" disabled >Sub Category</option>
            @if(count($subcatlist)>0)
            @foreach($subcatlist as $subcatlist)

              <option value="{{$subcatlist->name}}" @if(@$articledetail->subcategory==$subcatlist->name) 'selected' @endif>{{$subcatlist->name}}</option>
            @endforeach()
            @endif
          </select>
          @if ($errors->has('subcategory')) 
             <div class="alert alert-danger">{{ $errors->first('subcategory') }}</div> 
             @endif
        </div>
        <div class="input-field">
          <input name="title" type="text" class="validate" value="{{@$articledetail->title}}">
          <label>Title Of the Article</label>
          @if ($errors->has('title')) 
             <div class="alert alert-danger">{{ $errors->first('title') }}</div> 
             @endif
        </div>
        <div class="input-field">
  
          <textarea class="materialize-textarea ckeditor"  name="description"><?php echo @$articledetail->description;?></textarea>
          <!-- <label>Write here....</label> -->
        </div>
        <div class="file-field input-field">
          <div class="btn">
            <span>File</span>
            <input name="articlefile" type="file" multiple>
             @if ($errors->has('articlefile')) 
             <div class="alert alert-danger">{{ $errors->first('articlefile') }}</div> 
             @endif
          </div>
         
          <div class="file-path-wrapper">
            <input name="articles_image"  class="file-path validate" type="text" placeholder="Add Cover To Article">
          </div>
           @if(@$articledetail->articles_image!='')
           <img src="{{URL::to('uplode/articles/'.$articledetail->articles_image)}}" alt="" style="height: 100px; width: 100px;">
          @endif
        </div>
       <!--  <p>
          <input name="group1" type="radio" id="timeline" />
          <label for="timeline">Publish on timeline</label>
        </p>
        <p>
          <input name="group1" type="radio" id="Request" />
          <label for="Request">Request To Publish Your Article</label>
        </p> -->
        <button type="submit" name="submitarticle" class="waves-effect waves-light btn article-hire-button">Submit</button> 
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

CKEDITOR.on( 'instanceReady', function( ev ) {
    $('iframe.cke_wysiwyg_frame', ev.editor.container.$).contents().on('click', function() {
        ev.editor.focus();
    });
}); 
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