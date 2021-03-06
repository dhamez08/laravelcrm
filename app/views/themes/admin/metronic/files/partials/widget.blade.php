<div class="portlet portlet-sortable light bordered" style="min-height:500px;">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			@if(trim($title) !== '')
			<i class="icon-pin font-yellow-lemon"></i>
			<span class="caption-subject bold font-yellow-lemon uppercase">
			{{$title}} </span>
			@else
			<a href="{{ url('settings/custom-fields?backToClientFiles='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
				<i class="fa fa-pencil"></i> Configure name 
			</a>
			@endif
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
			<div class="tab-pane active list_files{{$id}}" style="max-height:400px;" id="">
				{{ 
					Form::open(
						array(
							'action' =>	array(
								'File\ClientFileController@postBulkDeleteFile',
								'customer_id'=>$customer->id
							),
							'role' => 'form',
						)
					) 
				}}
				<?php
					$customerFilesCount = \CustomerFiles\CustomerFiles::customerFile($customer->id)->where('type', $id)->count();
				?>
				@if($customerFilesCount > 0)
					@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'file_'.$id.'_check_all', 'table_target' => '#table-file-'.$id.'-list'))
				@endif
				<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">					
					<table class="table table-condensed" id="table-file-{{ $id }}-list">
						<tbody>
							@foreach($customerFiles->get()	as $files)
								@if($files->type == $id)
									<tr>
										<td style="width:1%">
											{{ Form::checkbox('files_to_delete[]', $files->id) }}
										</td>
										<td>
											<span class="label label-sm label-info">
												<?php
												$ext = explode(".",$files->filename);
												$ext = strtolower(trim(end($ext)));
												$file_type = "file";
												switch($ext){
													case "pdf":
														$file_type = "file-pdf";
														break;
													case "doc":
													case "docx":
														$file_type = "file-word";
														break;
													case "png":
													case "jpg":
													case "jpeg":
													case "bmp":
													case "gif":
													case "tif":
														$file_type = "file-image";
														break;
													case "ppt":
													case "pptx":
														$file_type = "file-powerpoint";
														break;
													case "xls":
													case "xlsx":
														$file_type = "file-excel";
														break;
													case "php":
													case "js":
													case "py":
													case "rb":
													case "cpp":
													case "c":
													case "sh":
													case "html":
													case "css":
													case "sass":
													case "less":
														$file_type = "file-code";
														break;
													case "mp3":
													case "mp4":
													case "acc":
													case "ogg":
														$file_type = "file-sound";
														break;
													case "mkv":
													case "flv":
													case "avi":
													case "wmv":
														$file_type = "file-video";
														break;
													case "zip":
													case "rar":
													case "bz":
													case "gz":
														$file_type = "file-zip";
														break;
													default:
														$file_type = "file";
												}
												?>
												<i class="fa fa-{{$file_type}}-o"></i>
											</span>																					
											&nbsp;&nbsp;<a download href="{{asset('public/documents/' . $files->filename)}}" class="file-preview" data-thumb="{{asset('public' . $files->thumbnail)}}" title="Download File {{$files->filename}}">{{$files->filename}}</a>
											
										</td>
										<td>
											<a href="#" class="share-file pull-right" style="padding: 0px 5px" data-toggle="modal" data-target="#modal-share-file" data-filename="{{ $files->filename }}"><i class="fa fa-share"></i></a>
											<a href="{{
														action(
															'File\ClientFileController@getDeleteFile',
															array(
																'id'=>$files->id,
																'customerid'=>$files->customer_id
															)
														)
													}}"
												class="pull-right" title="Delete File {{$files->filename}}">
													<i class="icon-trash"></i> 
											</a>
										</td>
									</tr>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
				{{ Form::close() }}
			</div>
			<div class="tab-pane add_new{{$id}}" id="">
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<!-- BEGIN PAGE CONTENT-->
							<div class="row">
								<div class="col-md-12">
									<a class="btn dropbox_file btn-primary" href="#" data-file-type='{{$id}}' data-customer-id='{{$customer->id}}'>
									<span class="fa fa-dropbox">Add File from Dropbox</span>
									</a>
								</div>
							</div>
							<!-- END PAGE CONTENT-->
							<blockquote>
								<p style="font-size:14px">
									 File Upload widget with multiple file selection.<br>
									 The maximum file size for uploads is 10 MB<br>
								</p>
                                <input type="hidden" id="redirect-url" />
							</blockquote>
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
									<p>You can Drop files here or Click "Add Files"..</p>
									<!-- The table listing the files available for upload/download -->
									<div class="file_upload_container">
										<table role="presentation" style="width:auto !important;" class="table table-striped table-responsive clearfix">
											<tbody class="files">
											</tbody>
										</table>
									</div>
								</div>
							{{Form::close()}}
						</div>
					</div>
					<!-- END PAGE CONTENT-->
			</div>
		</div>
	</div>
</div>
