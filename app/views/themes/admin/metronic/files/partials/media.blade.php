<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title tabbable-line">
	</div>
	<div class="portlet-body tabbable-line">
		<div class="row">
			<div class="col-md-12">
				<blockquote>
					<p style="font-size:16px">
						 Upload the file first, and you can choose files in the "Files" tab<br>
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
							<button type="submit" class="btn btn-primary" id="sendIndividualSMS">Upload File</button>
							<div class="ajax-container-msg hide" >
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
