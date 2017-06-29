<div class="col s12 m4 l6">
      <div class="col s12 m12 l12 middle-sec card user-profile">
        <div class="row">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6 m6 l6"><a class="@if($currenttab=='') active @endif waves-effect" href="#test1">Discussion Forum</a></li>
              <li class="tab col s6 m6 l6"><a class="waves-effect @if($currenttab!='') active @endif" href="#test2">Write Discussion Forum</a></li>
            <div class="indicator" style="right: 276px; left: 0px;"></div></ul>
          </div>
         @if(Session::has('message'))
        <div class="alert alert-dismissible alert-{{ Session::get('alert-class', 'alert-info') }} mt10    ">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('message') }}
        </div>
        @endif
          <div id="test1" class="col s12 tab-content" @if($currenttab!='')  style="display: none;" @endif>
          @if(count($duscussionlist)>0)
          @foreach($duscussionlist as $duscussion)
            <div class="article-box">
              <h5>{{ucwords($duscussion->title)}}</h5>
              <p><?php echo substr($duscussion->description,0,260);?>..</p>
              <a href="{{URL::to('profile/discussions?editid='.$duscussion->id)}}" class="waves-effect waves-light btn"><i class="material-icons dp48"><i class="material-icons dp48">mode_edit</i></i></a> 
              <a href="{{URL::to('deletediscussion/'.$duscussion->id)}}" class="waves-effect waves-light btn del"><i class="material-icons dp48"><i class="material-icons dp48">delete</i></i></a> 
              <a href="{{URL::to('articledetail/'.$duscussion->discussion_url)}}" class="waves-effect waves-light btn">Read Article</a>
            </div>
             @endforeach()
            <?php echo $duscussionlist->render();?>
            @else
            <div class="text-center">No discussion found......</div> 
           @endif
           </div>
          <div id="test2" class="col s12 tab-content" @if($currenttab=='')  style="display: none;" @endif>
            <form  action='' method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-field">
              <input name="title" type="text" class="validate" value="{{@$duscussiondetail->title}}">
              <label>Discussion Heading</label>
              @if ($errors->has('title')) 
                 <div class="alert alert-danger">{{ $errors->first('title') }}</div> 
                 @endif
            </div>
         
            <div class="input-field">
              <input name="short_desc" type="text" class="validate" value="{{@$duscussiondetail->short_desc}}">
              <label>Your Views on the Subject</label>
            </div>
            <div class="input-field">
              <input name="tags" type="text" class="validate" value="{{@$duscussiondetail->tags}}">
              <label>Tags(comma seprated)</label>
            </div>
               <div class="input-field">
              <textarea class="materialize-textarea" name="description"><?php echo @$duscussiondetail->description?></textarea>
              <!-- <label>Discussion Question/Subject Matter</label> -->
              @if ($errors->has('description')) 
                 <div class="alert alert-danger">{{ $errors->first('description') }}</div> 
                 @endif
            </div>
            
              <div class="row">
              <div class="col s6 m6 l6">
                <!-- <button class="waves-effect waves-light btn article-hire-button">Invite People</button> -->
              </div>
              <div class="col s6 m6 l6">
               <button type="submit" name="submitdiscussion" class="waves-effect waves-light btn article-hire-button">Start Disscussion</button> 
              </div>
           
            
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