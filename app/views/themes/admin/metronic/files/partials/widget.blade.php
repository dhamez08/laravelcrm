<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-pin font-yellow-lemon"></i>
			<span class="caption-subject bold font-yellow-lemon uppercase">
			{{$title}} </span>
		</div>
		<ul class="nav nav-tabs">
			<li  class="active">
				<a href=".list_files{{$id}}" data-toggle="tab">
				Files </a>
			</li>
			<li>
				<a href=".add_new{{$id}}" data-toggle="tab">
				Add New </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body tabbable-line">
		<div class="tab-content">
			<div class="tab-pane active list_files{{$id}}" id="">
				<h4>List Files</h4>
				{{\MediaLibrary\MediaLibraryController::get_instance()->getDisplay($customer->id);}}
				@foreach($customerFiles->get()	as $files)
					@if($files->type == $id)
						<p>
							<a href="{{asset('public/documents/' . $files->filename)}}" target="_blank">{{$files->filename}}</a>
							<a 	class="btn red btn-xs deleteFile"
								href="{{
									action(
										'File\ClientFileController@getDeleteFile',
										array(
											'id'=>$files->id,
											'customerid'=>$files->customer_id
										)
									)
								}}"
							>
								<i class="fa fa-trash-o fa-5x"></i>
							</a>
						</p>
					@endif
				@endforeach
			</div>
			<div class="tab-pane add_new{{$id}}" id="">
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<blockquote>
								<p style="font-size:16px">
									 File Upload widget with multiple file selection.<br>
									 The maximum file size for uploads is 5 MB<br>
								</p>
							</blockquote>
							<br>
							{{
								Form::open(
									array(
										'action' => array(
											'File\ClientFileController@postAjaxUploadFile',
											'file_id'=>$id,
											'customer_id'=>$customer->id
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
								<div class="well">
									<h3>You can Drop files here or Click "Add Files"..</h3>
									<!-- The table listing the files available for upload/download -->
									<table role="presentation" style="width:auto !important;" class="table table-striped table-responsive clearfix">
										<tbody class="files">
										</tbody>
									</table>
								</div>
							{{Form::close()}}
						</div>
					</div>
					<!-- END PAGE CONTENT-->
			</div>
		</div>
	</div>
</div>

