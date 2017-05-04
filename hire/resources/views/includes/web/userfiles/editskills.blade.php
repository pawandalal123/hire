 <div class="col s12 m4 l6">
      <div class="col s12 m12 l12 middle-sec card user-profile">
          <h2>EDit Skills</h2>
           <form  action='' method="post" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="input-field">
            <input name="title" type="text" class="validate" value="{{@$articledetail->title}}">
            <label>Skiils</label>
            @if ($errors->has('title')) 
               <div class="alert alert-danger">{{ $errors->first('title') }}</div> 
               @endif
          </div>

        <button type="submit" name="submitarticle" class="waves-effect waves-light btn article-hire-button">Submit</button> 
        </form>
      </div>
    </div>

   