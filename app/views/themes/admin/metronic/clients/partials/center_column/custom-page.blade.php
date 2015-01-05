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
				<div class="portlet-title" style="border-bottom:0px">
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
					<div class="actions">
						@if($customtab->$sec_name)
							@if($customtab->$sec_name==1)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#{{$sec_name}}notes-modal">
							@elseif($customtab->$sec_name==2)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#{{$sec_name}}files-modal">
							@elseif($customtab->$sec_name==3)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#{{$sec_name}}form-modal">
							@endif
							<i class="fa fa-plus"></i> Add </a>
						@else
							<a href="{{ url('settings/custom-fields/custom-tab/'.$customtab->id.'?backToClient='.$customer->id) }}" class="btn btn-circle btn-default btn-sm">
							<i class="fa fa-pencil"></i> Configure this section </a>
						@endif
						
					</div>
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

							@if(count($results)>0)
							<ul class="feeds">
								@foreach($results as $result)
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa {{ $icons[$result->file_type] }}"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														<a href="{{ $path.$result->file_name }}" target="_blank">{{ $result->name }}</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col2" style="margin-left:-95px">
											<a href="{{ url('custom-tab/delete-file/'.$result->id.'/'.$customer->id.'/'.$customtab->id) }}" class="btn btn-circle red-intense btn-sm" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Delete</a>
										</div>
									</li>
								@endforeach
							</ul>
							@else
								No data has been added.
							@endif
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