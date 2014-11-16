<div class="modal fade bs-modal-lg" id="modal-media-library" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Modal Title</h4>
			</div>
			<div class="modal-body">
				{{var_dump($options)}}
				<div role="tabpanel">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Upload</a></li>
					<li role="presentation"><a href="#listfiles" aria-controls="listfiles" role="tab" data-toggle="tab">Files</a></li>
					<li role="presentation"><a href="#dropbox" aria-controls="dropbox" role="tab" data-toggle="tab">Dropbox</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="upload">
						{{$upload}}
					</div>
					<div role="tabpanel" class="tab-pane" id="listfiles">
						Files (show if option -> show_files_tab = true )
					</div>
					<div role="tabpanel" class="tab-pane" id="dropbox">
						{{$dropbox}}
					</div>
				  </div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="button" class="btn blue">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
