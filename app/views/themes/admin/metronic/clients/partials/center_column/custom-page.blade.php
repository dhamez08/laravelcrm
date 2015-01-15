<?php
	$sections = array(
		1 => 'section1',
		2 => 'section2',
		3 => 'section3',
		4 => 'section4',
	);
	$section_names = array(
		1 => 'section1_name',
		2 => 'section2_name',
		3 => 'section3_name',
		4 => 'section4_name',
	);
	$section_forms = array(
		1 => 'section1_form',
		2 => 'section2_form',
		3 => 'section3_form',
		4 => 'section4_form',
	);
?>
<div class="col-md-12">
	<!--section 1-->

	<div class="row">
		@foreach($sections as $sec_key => $sec_name)
		<div class="col-lg-6">

			<div class="portlet light bordered">
				<div class="portlet-title {{ $customtab->$sec_name == 2 ? 'tabbable-line' : '' }}" style="border-bottom:0px">
					@if($customtab->$sec_name)
						<div class="caption font-green-sharp">
							<i class="icon-speech font-green-sharp"></i>
							@if(!empty($customtab->$section_names[$sec_key]))
							<span class="caption-subject bold uppercase"> {{ $customtab->$section_names[$sec_key] }}</span>
							@else
							<a href="{{ url('settings/custom-fields/custom-tab/'.$customtab->id.'?backToClient='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
								<i class="fa fa-pencil"></i> Configure name
							</a>
							@endif
						</div>
					@endif
					@if($customtab->$sec_name)					
							@if($customtab->$sec_name==1)
							<div class="actions pull-left" style="margin-left: 5px">
								<a href="#" class="btn btn-icon-only btn-circle btn-sm green-meadow" data-toggle="modal" data-target="#{{$sec_name}}notes-modal">
									<i class="fa fa-plus"></i>
								</a>
							</div>									
							@elseif($customtab->$sec_name==2)
							<ul class="nav nav-tabs">
								<li  class="active">
									<a href=".list_files{{$sec_key}}" data-toggle="tab">
									Files </a>
								</li>
								<li>
									<a href=".add_new{{$sec_key}}" data-toggle="tab">
									{{-- <a href="#" data-toggle="modal" data-target="#{{$sec_name}}files-modal"> --}}
									Add New </a>
								</li>
							</ul>
							@elseif($customtab->$sec_name==3)
							<div class="actions pull-left" style="margin-left: 5px">
								<a href="#" class="btn btn-icon-only btn-circle btn-sm green-meadow" data-toggle="modal" data-target="#{{$sec_name}}form-modal">
									<i class="fa fa-plus"></i> 
								</a>
							</div>									
							@endif
					@else
							<div class="actions">
								<a href="{{ url('settings/custom-fields/custom-tab/'.$customtab->id.'?backToClient='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
								<i class="fa fa-pencil"></i> Configure this section </a>
							</div>					
					@endif
				</div>
				<div class="portlet-body">
					@if($customtab->$sec_name)
						@if($customtab->$sec_name==1)
							{{
								Form::open(
									array(
										'action' => array(
											'CustomTab\CustomTabController@postBulkDeleteNote',
											'customer_id' => $customer->id,
											'custom_id' => $customtab->id
										),
										'role' => 'form',
									)
								)
							}}
							<?php
							$results = \CustomTabNotesData\CustomTabNotesDataEntity::get_instance()->getNotesBySection_Custom_Customer($sec_key, $customtab->id, $customer->id);
							?>
							@if(count($results) > 0)
								@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'custom_'.$sec_name.'_check_all', 'table_target' => '#table-custom-'.$sec_name.'-list'))
							@endif
							<div class="scroller" style="height: 350px;">
								@if(count($results)>0)
								<table class="table table-condensed" id="table-custom-{{ $sec_name }}-list">
									@foreach($results as $result)
										<tr>
											<td style="width:1%">
												{{ Form::checkbox('notes_to_delete[]', $result->id) }}
											</td>
											<td>{{ $result->entry }}</td>
											<td><small class="muted">Created on {{ date("d/m/Y H:i",strtotime($result->created_at)) }}</small></td>
											<td>
												<a href="{{ url('custom-tab/delete-note/'.$result->id.'/'.$customer->id.'/'.$customtab->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="pull-right delete-task"><i class="icon-trash"></i></a>
											</td>
										</tr>
									@endforeach
								</table>
								@else
									No data has been added.
								@endif
							</div>
							{{ Form::close() }}
						@elseif($customtab->$sec_name==2)
							<?php
								$results = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->getFilesBySection_Custom_Customer($sec_key, $customtab->id, $customer->id);
								$icons	 = \Config::get('crm.document_file_type_class');
								$path = url() . "/public/document/";
							?>																		
							<div class="tab-content">
								<div class="tab-pane active list_files{{$sec_key}}" style="max-height:400px;" id="">
									{{
										Form::open(
											array(
												'action' => array(
													'CustomTab\CustomTabController@postBulkDeleteFile',
													'customer_id' => $customer->id,
													'custom_id' => $customtab->id
												),
											)
										)									
									}}
									@if(count($results) > 0)
										@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'custom_'.$sec_name.'_check_all', 'table_target' => '#table-custom-'.$sec_name.'-list'))
									@endif
									<div class="scroller" style="height: 350px;">										
										@if(count($results)>0)
										<table class="table table-condensed" id="table-custom-{{ $sec_name }}-list">
											<tbody>
												@foreach($results as $files)
													<tr>
														<td style="width:1%">
															{{ Form::checkbox('files_to_delete[]', $files->id) }}
														</td>
														<td>
															<span class="label label-sm label-info">
																<?php
																$ext = explode(".",$files->file_name);
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
															&nbsp;&nbsp;<a download href="{{ $path.$files->file_name }}" title="Download File {{$files->file_name}}">{{$files->file_name}}</a>
														</td>
														<td>
															<a href="{{
																		action(
																			'CustomTab\CustomTabController@getDeleteFile',
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
												@endforeach
											</tbody>
										</table>
										@else
											No data has been added.
										@endif
									</div>
									{{ Form::close() }}
								</div>
								<div class="tab-pane add_new{{$sec_key}}" id="">
									<!-- BEGIN PAGE CONTENT-->
									<div class="row">
										<div class="col-md-12">
											<!-- BEGIN PAGE CONTENT-->
											<div class="row">
												<div class="col-md-12">
													<a class="btn dropbox_file btn-primary" href="#" data-file-type='{{$sec_key}}' data-customer-id='{{$customer->id}}'>
													<span class="fa fa-dropbox">Add File from Dropbox</span>
													</a>
												</div>
											</div>
											<!-- END PAGE CONTENT-->
											<blockquote>
												<p style="font-size:14px">
													 File Upload widget with multiple file selection.<br>
													 The maximum file size for uploads is 5 MB<br>
												</p>
											</blockquote>
											{{
												Form::open(
													array(
														'action' => array(
															'CustomTab\CustomTabController@postAjaxUploadFile',
															'file_id'=>$sec_key,
															'customer_id'=>$customer->id
														),
														'role'=>'form',
														'files'=> true,
														'class'=>'fileupload form-horizontal'
													)
												)
											}}
												{{ Form::hidden('custom_id', \Input::get('custom')) }}
												{{ Form::hidden('section', $sec_key) }}
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
						@elseif($customtab->$sec_name==3)
							{{
								Form::open(
									array(
										'action' => array(
											'CustomForms\CustomFormsController@postBulkDeleteFormData'
										),
										'role' => 'form'
									)
								)
							}}
							<?php
								$results = \CustomFormData\CustomFormDataEntity::get_instance()->getData($customtab->$section_forms[$sec_key], $customer->id);
							?>						
							@if(count($results) > 0)
								@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'custom_'.$sec_name.'_check_all', 'table_target' => '#table-custom-'.$sec_name.'-list'))
							@endif							
							<div class="scroller" style="height: 350px;">
								@if(count($results)>0)
								<table class="table table-condensed" id="table-custom-{{ $sec_name }}-list">
									@foreach($results as $result)
										<tr>
											<td style="width:1%">
												{{ Form::checkbox('forms_to_delete[]', $result->ref_id) }}
											</td>
											<td>
												<a href="#" class="blue-madison view-data-form" data-ref-id="{{ $result->ref_id }}" data-form-name="{{ $result->name }}">
													{{ $result->name }}
												</a>
											</td>
											<td>
												<small class="muted">Created on {{ date("d/m/Y H:i",strtotime($result->created_at)) }}</small>
											</td>
											<td>
												<a href="{{ url('settings/custom-forms/delete-form-data/'.$result->ref_id) }}" class="pull-right delete-task" onclick="return confirm('Are you sure you want to delete?')"><i class="icon-trash"></i></a>
											</td>
										</tr>
									@endforeach
								</table>
								@else
									No data has been added.
								@endif
							</div>
							{{ Form::close() }}
						@endif
					@endif
				</div>
			</div>

		</div>
		@include($view_path.'.clients.partials.modals.customtabs.'.$sec_name.'-modals')
		@endforeach
	</div>
@include($view_path.'.clients.partials.modals.customtabs.formdata-modal')
</div>