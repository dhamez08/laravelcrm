<div class="modal fade emailMessage" tabindex="-1" role="dialog" aria-labelledby="emailMessage" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="ModalLabel">Compose</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <!-- Start Email Compose -->
              @include($view_path . '.messages.partials.compose')
            <!-- End Email Compose -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>