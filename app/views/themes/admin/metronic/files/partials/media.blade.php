<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title tabbable-line">
	</div>
	<div class="portlet-body tabbable-line">
		<div class="row">
			<div class="col-md-12">
				<blockquote>
					<p style="font-size:16px">
						Add file here for quick upload, incase your file was not in the "file attach" select<br>
						After that you can choose files in the "Attach File"<br>
					</p>
				</blockquote>
				<br>
				{{Form::open(
						array(
							'action' => array(
								'SMSFiles\SMSFilesController@postMediaAjaxUploadFile'
							),
							'role'=>'form',
							'files'=> true,
							'class'=>'form-horizontal',
							'id'=>'sms-file-upload'
						)
					)
				}}
					<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
					<div class="row media-fileupload-buttonbar">
						<div class="col-md-12">
							{{Form::file('files')}}
							<button type="submit" data-loading-text="Please wait file is uploading..." autocomplete="off" class="btn btn-primary btn-xs file-attach">Upload File</button>
							<div class="alert alert-success success-file-attach alert-dismissible hide" role="alert">
							  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							  <strong>Success!</strong> <p class="success-msg"></p>
							</div>
							<div class="ajax-container-msg-file-attach hide" >
								<ul class="list-group ajax-error-msg">
								</ul>
							</div>
						</div>
					</div>
				{{Form::close()}}
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
