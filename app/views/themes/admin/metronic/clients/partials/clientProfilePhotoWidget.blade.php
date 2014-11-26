<div class="modal fade socialProfile ajaxModal" tabindex="-1" role="dialog" aria-labelledby="socialProfile" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="ModalLabel">Select Profile Photo for {{$currentClient->displayCustomerName()}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-2 col-md-2 col-lg-2">
            <a href="#" class="thumbnail photo-select" data-photo-id="0">
              <img src="{{url('public/img/profile_images/profile.jpg')}}" title="" alt="" />
            </a>
          </div>
          @if(isset($customer))
            <?php $photo = \CustomerProfileImages\CustomerProfileImages::find($customer->id)->get(); ?>
            @foreach($photo as $pics)
            <div class="col-sm-2 col-md-2 col-lg-2">
              <a href="#" class="thumbnail photo-select" data-photo-id="{{$pics->id}}">
                <img src="{{$pics->image}}" title="" alt="" />
              </a>
            </div>
            @endforeach
          @endif
        </div>
        <hr >
        <div class="row">
          <div class="col-md-12">
            TODO: UPLOAD FROM COMPUTER
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
  <script>
  jQuery(function(e){
    jQuery("a.photo-select").on("click",function(e){
      var photo_id = jQuery(this).attr('data-photo-id');
      $.get("{{url('clientprofile/changephoto')}}",{ id: photo_id, accnt: '{{\Auth::id()}}' },function(response){
        $("#main-profile-pic").attr('src',response.profile_image);
        $(".img-circle").attr('src',response.profile_image);
      });
    });
  });
  </script>
@stop
