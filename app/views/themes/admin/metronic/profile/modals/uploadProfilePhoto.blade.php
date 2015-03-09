@section('head-custom-css')
  @parent
  <link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
@stop
<div class="modal fade userProfilePhoto" tabindex="-1" role="dialog" aria-labelledby="userProfilePhoto" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="ModalLabel">Select Your Profile Photo</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div style="width:100px;height:100px;min-width:100px;min-height:100px;max-width:100px;max-height:100px;float:left;">
              <a href="#" class="thumbnail photo-select" data-photo-id="0">
                <img src="{{url('public/img/profile_images/summary_person.png')}}" title="" alt="" />
              </a>
            </div>
            @if(isset($user))
              @if($user->profileImage->count() > 0)
                @foreach($user->profileImage()->get() as $pics)
                  <div style="width:100px;height:100px;min-width:100px;min-height:100px;max-width:100px;max-height:100px;float:left;">
                    <a href="#" class="thumbnail photo-select" data-photo-id="{{$pics->id}}">
                      <img src="{{$pics->image}}" title="" alt="" />
                    </a>
                  </div>
                @endforeach
              @endif
            @endif
          </div>
        </div>
        <hr >
        <div class="row">
          <div class="col-md-12">
            <form action="{{url('userprofile/upload')}}" method="POST" enctype="multipart/form-data">
              {{Form::token()}}
              <input type="hidden" name="url" value="{{\Request::url()}}" />
              <input type="hidden" name="user_id" value="{{isset($user) ? $user->id : \Auth::id()}}" />
              <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;">
                  <img src="http://www.placehold.it/100x100/EFEFEF/AAAAAA&amp;text=no+image" alt=""/>
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 100px; max-height: 100px;">
                </div>
                <div>
                  <span class="btn small default btn-file">
                    <span class="fileinput-new">Select image</span>
                    <span class="fileinput-exists">Change</span>
                    <input type="file" name="profile-photo-upload-file">
                  </span>
                  <a href="#" class="small btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
                  <input type="submit" class="small btn green fileinput-exists" name="save" value="Save Profile Picture">
                </div>
              </div>
              <div class="clearfix margin-top-10">
                <span class="label label-danger">NOTE!</span>
                  Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead.
              </div>
            </form>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@section('footer-custom-js')
  @parent
  <script type="text/javascript" src="{{$asset_path}}/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
  <script>
  jQuery(function(e){
    jQuery("a.photo-select").on("click",function(e){
      var photo_id = jQuery(this).attr('data-photo-id');
      $.get("{{url('userprofile/changephoto')}}",{ id: photo_id, accnt: '{{$user->id}}' },function(response){
        $("#main-profile-pic").attr('src',response.profile_image);
        $(".img-avatar-top").attr('src',response.profile_image);
      });
    });
  });
  </script>
@stop
