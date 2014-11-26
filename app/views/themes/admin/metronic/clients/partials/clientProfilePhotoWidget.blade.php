<div class="modal fade socialProfile ajaxModal" tabindex="-1" role="dialog" aria-labelledby="socialProfile" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="ModalLabel">{{$currentClient->displayCustomerName()}}</h4>
      </div>
      <div class="modal-body">
        TODO://Client Could Select Which Profile Picture he want to use
        <div class="row">
          @for($pic=0;$pic<10;$pic++)
          <div class="col-sm-1 col-md-1 col-lg-1">
            <a href="#" class="thumbnail">
              <img src="" title="" alt="" style="height:50px;" />
            </a>
          </div>
          @endfor
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
