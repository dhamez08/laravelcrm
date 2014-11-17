<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<blockquote>
			<p style="font-size:16px">
				 File Upload widget with multiple file selection.<br>
				 The maximum file size for uploads is 10 MB<br>
			</p>
		</blockquote>
		<br>
		{{
			Form::open(
				array(
					'action' => array(
						'File\ClientFileController@postAjaxUploadFile',
						'customer_id' => (isset($customer_id)) ? $customer_id:0
					),
					'role'=>'form',
					'files'=> true,
					'class'=>'fileupload form-horizontal'
				)
			)
		}}
			<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
			<div class="row fileupload-buttonbar">
				<div class="col-md-12">
					<!-- The fileinput-button span is used to style the file input field as button -->
					<span class="btn green fileinput-button">
					<i class="fa fa-plus"></i>
					<span>
					Add files... </span>
					{{Form::file('files[]',array('multiple'=>true))}}
					</span>
					<button type="submit" class="btn blue start">
					<i class="fa fa-upload"></i>
					<span>
					Start upload </span>
					</button>
					<button type="reset" class="btn warning cancel">
					<i class="fa fa-ban-circle"></i>
					<span>
					Cancel upload </span>
					</button>
					<!-- The global file processing state -->
					<span class="fileupload-process">
					</span>
				</div>
				<!-- The global progress information -->
				<div class="col-md-12 fileupload-progress fade">
					<!-- The global progress bar -->
					<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
						<div class="progress-bar progress-bar-success" style="width:0%;">
						</div>
					</div>
					<!-- The extended global progress information -->
					<div class="progress-extended">
						 &nbsp;
					</div>
				</div>
			</div>
			<div class="well" style="height: 200px;overflow: auto;">
				<h3>You can Drop files here or Click "Add Files"..</h3>
				<!-- The table listing the files available for upload/download -->
				<table role="presentation" style="width:auto !important;" class="table table-striped table-responsive clearfix">
					<tbody class="files">
					</tbody>
				</table>
			</div>
			{{Form::hidden('file_type',null,array('id'=>'file_type'))}}
		{{Form::close()}}
	</div>
</div>
<!-- END PAGE CONTENT-->
