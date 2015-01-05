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
							<div class="actions">
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#{{$sec_name}}notes-modal">
									<i class="fa fa-plus"></i> Add 
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
							<div class="actions">
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#{{$sec_name}}form-modal">
									<i class="fa fa-plus"></i> Add 
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
					<div class="scroller" style="height: 200px;">
					@if($customtab->$sec_name)
						@if($customtab->$sec_name==1)
							<?php
							$results = \CustomTabNotesData\CustomTabNotesDataEntity::get_instance()->getNotesBySection_Custom_Customer($sec_key, $customtab->id, $customer->id);
							?>

							@if(count($results)>0)
							<table class="table">
								@foreach($results as $result)
									<tr>
										<td>Added - {{ date("d/m/Y H:i",strtotime($result->created_at)) }}<br />{{ $result->entry }}</td>
										<td align="right">
										<a href="{{ url('custom-tab/delete-note/'.$result->id.'/'.$customer->id.'/'.$customtab->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-circle red-intense btn-sm"><i class="fa fa-times"></i> Delete</a>
										</td>
									</tr>
								@endforeach
							</table>
							@else
								No data has been added.
							@endif
						@elseif($customtab->$sec_name==2)
							<?php
							$results = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->getFilesBySection_Custom_Customer($sec_key, $customtab->id, $customer->id);
							$icons	 = \Config::get('crm.document_file_type_class');
							$path = url() . "/public/document/";
							?>

							<div class="tab-content">
								<div class="tab-pane active list_files{{$sec_key}}" style="max-height:400px;" id="">
									@if(count($results)>0)
									<div class="list_files_widget">
										@foreach($results as $result)
											<p>
												<a href="{{ $path.$result->file_name }}" target="_blank">{{$result->file_name}}</a>
												<a 	class="btn red btn-xs deleteFile"
													href="{{
														action(
															'File\ClientFileController@getDeleteFile',
															array(
																'id'=>$result->id,
																'customerid'=>$result->customer_id
															)
														)
													}}"
												>
													<i class="fa fa-trash-o fa-5x"></i>
												</a>
											</p>
										@endforeach
									</div>
									@else
										No data has been added.
									@endif
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
							<?php
							$results = \CustomFormData\CustomFormDataEntity::get_instance()->getData($customtab->$section_forms[$sec_key], $customer->id);
							?>

							@if(count($results)>0)
							<table class="table">
								@foreach($results as $result)
									<tr>
										<td>
											{{ $result->name }} - {{ date("d/m/Y H:i",strtotime($result->created_at)) }}
										</td>
										<td align="right">
										<a href="#" class="btn btn-circle blue-madison btn-sm view-data-form" data-ref-id="{{ $result->ref_id }}" data-form-name="{{ $result->name }}">View</a>
										<a href="{{ url('settings/custom-forms/delete-form-data/'.$result->ref_id) }}" class="btn btn-circle red-intense btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Delete</a>
										</td>
									</tr>
								@endforeach
							</table>
							@else
								No data has been added.
							@endif
						@endif
					@endif
					</div>
				</div>
			</div>

		</div>
		@include($view_path.'.clients.partials.modals.customtabs.'.$sec_name.'-modals')
		@endforeach
	</div>
@include($view_path.'.clients.partials.modals.customtabs.formdata-modal')
</div>