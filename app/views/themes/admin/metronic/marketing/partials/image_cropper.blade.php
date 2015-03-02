<div class="modal fade" id="image-cropper" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crop Image</h4>
            </div>
            <div class="modal-body">
                <img class="hide" id="cropper-loader" src="{{$asset_path}}/global/img/spiffygif_88x88.gif"/>
                <img id="image-cropper-preview" width="565"/>
            </div>
            <div class="modal-footer">
                <button id="close-cropper" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="crop-image" type="button" class="btn btn-primary">Crop</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->