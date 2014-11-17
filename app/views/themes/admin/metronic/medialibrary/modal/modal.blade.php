<div class="modal fade media-library" id="modal-media-library" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Media Library</h4>
			</div>
			<div class="modal-body">
				<div role="tabpanel">

				  <!-- Nav tabs -->
				  <ul class="nav nav-tabs" role="tablist">
					@if( $options->show_files_tab )
					<li role="presentation"><a href="#listfiles" aria-controls="listfiles" role="tab" data-toggle="tab">Files</a></li>
					@endif
					<li role="presentation" class="active"><a href="#upload" aria-controls="upload" role="tab" data-toggle="tab">Upload from Computer</a></li>
					<li role="presentation"><a href="#dropbox" aria-controls="dropbox" role="tab" data-toggle="tab">Dropbox</a></li>
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
					@if( $options->show_files_tab )
					<div role="tabpanel" class="tab-pane" id="listfiles">
						Files (show if option -> show_files_tab = true )
					</div>
					@endif
					<div role="tabpanel" class="tab-pane active" id="upload">
						{{$upload}}
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
