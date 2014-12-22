<div class="col-md-12">
	<!--section 1-->

	<div class="row">
		<div class="col-lg-6">

			<div class="portlet light bordered">
				<div class="portlet-title" style="border-bottom:0px">
					@if($customtab->section1)
						<div class="caption font-green-sharp">
							<i class="icon-speech font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> {{ $customtab->section1_name }}</span>
						</div>
					@endif
					<div class="actions">
						@if($customtab->section1)
							@if($customtab->section1==1)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section1notes-modal">
							@elseif($customtab->section1==2)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section1files-modal">
							@elseif($customtab->section1==3)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section1form-modal">
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
					@if($customtab->section1)
						@if($customtab->section1==1)
							<?php
							$results = \CustomTabNotesData\CustomTabNotesDataEntity::get_instance()->getNotesBySection_Custom_Customer(1, $customtab->id, $customer->id);
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
						@elseif($customtab->section1==2)
							<?php
							$results = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->getFilesBySection_Custom_Customer(1, $customtab->id, $customer->id);
							$icons	 = \Config::get('crm.document_file_type_class');
							$path = "/public/document/";
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
						@elseif($customtab->section1==3)
							<?php
							$results = \CustomFormData\CustomFormDataEntity::get_instance()->getData($customtab->section1_form, $customer->id);
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
@include($view_path.'.clients.partials.modals.customtabs.section1-modals')
		<div class="col-lg-6">

				<div class="portlet light bordered">
					<div class="portlet-title" style="border-bottom:0px">
						@if($customtab->section2)
							<div class="caption font-green-sharp">
								<i class="icon-speech font-green-sharp"></i>
								<span class="caption-subject bold uppercase"> {{ $customtab->section2_name }}</span>
							</div>
						@endif
						<div class="actions">
							@if($customtab->section2)
								@if($customtab->section2==1)
									<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section2notes-modal">
								@elseif($customtab->section2==2)
									<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section2files-modal">
								@elseif($customtab->section2==3)
									<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section2form-modal">
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
						@if($customtab->section2)
							@if($customtab->section2==1)
								<?php
								$results = \CustomTabNotesData\CustomTabNotesDataEntity::get_instance()->getNotesBySection_Custom_Customer(2, $customtab->id, $customer->id);
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
							@elseif($customtab->section2==2)
								<?php
								$results = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->getFilesBySection_Custom_Customer(2, $customtab->id, $customer->id);
								$icons	 = \Config::get('crm.document_file_type_class');
								$path = "/public/document/";
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
							@elseif($customtab->section2==3)
								<?php
								$results = \CustomFormData\CustomFormDataEntity::get_instance()->getData($customtab->section2_form, $customer->id);
								?>

								@if(count($results)>0)
								<table class="table">
									@foreach($results as $result)
										<tr>
											<td>{{ $result->name }} - {{ date("d/m/Y H:i",strtotime($result->created_at)) }}</td>
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
	</div>

@include($view_path.'.clients.partials.modals.customtabs.section2-modals')

	<div class="row">
		<div class="col-lg-6">
			<div class="portlet light bordered">
				<div class="portlet-title" style="border-bottom:0px">
					@if($customtab->section3)
						<div class="caption font-green-sharp">
							<i class="icon-speech font-green-sharp"></i>
							<span class="caption-subject bold uppercase"> {{ $customtab->section3_name }}</span>
						</div>
					@endif
					<div class="actions">
						@if($customtab->section3)
							@if($customtab->section3==1)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section3notes-modal">
							@elseif($customtab->section3==2)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section3files-modal">
							@elseif($customtab->section3==3)
								<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section3form-modal">
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
					@if($customtab->section3)
						@if($customtab->section3==1)
							<?php
							$results = \CustomTabNotesData\CustomTabNotesDataEntity::get_instance()->getNotesBySection_Custom_Customer(3, $customtab->id, $customer->id);
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
						@elseif($customtab->section3==2)
							<?php
							$results = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->getFilesBySection_Custom_Customer(3, $customtab->id, $customer->id);
							$icons	 = \Config::get('crm.document_file_type_class');
							$path = "/public/document/";
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
						@elseif($customtab->section3==3)
							<?php
							$results = \CustomFormData\CustomFormDataEntity::get_instance()->getData($customtab->section3_form, $customer->id);
							?>

							@if(count($results)>0)
							<table class="table">
								@foreach($results as $result)
									<tr>
										<td>{{ $result->name }} - {{ date("d/m/Y H:i",strtotime($result->created_at)) }}</td>
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
@include($view_path.'.clients.partials.modals.customtabs.section3-modals')
		<div class="col-lg-6">

				<div class="portlet light bordered">
					<div class="portlet-title" style="border-bottom:0px">
						@if($customtab->section4)
							<div class="caption font-green-sharp">
								<i class="icon-speech font-green-sharp"></i>
								<span class="caption-subject bold uppercase"> {{ $customtab->section4_name }}</span>
							</div>
						@endif
						<div class="actions">
							@if($customtab->section4)
								@if($customtab->section4==1)
									<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section4notes-modal">
								@elseif($customtab->section4==2)
									<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section4files-modal">
								@elseif($customtab->section4==3)
									<a href="#" class="btn btn-circle btn-default btn-sm" data-toggle="modal" data-target="#section4form-modal">
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
						@if($customtab->section4)
							@if($customtab->section4==1)
								<?php
								$results = \CustomTabNotesData\CustomTabNotesDataEntity::get_instance()->getNotesBySection_Custom_Customer(4, $customtab->id, $customer->id);
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
							@elseif($customtab->section4==2)
								<?php
								$results = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->getFilesBySection_Custom_Customer(4, $customtab->id, $customer->id);
								$icons	 = \Config::get('crm.document_file_type_class');
								$path = "/public/document/";
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
							@elseif($customtab->section4==3)
								<?php
								$results = \CustomFormData\CustomFormDataEntity::get_instance()->getData($customtab->section4_form, $customer->id);
								?>

								@if(count($results)>0)
								<table class="table">
									@foreach($results as $result)
										<tr>
											<td>{{ $result->name }} - {{ date("d/m/Y H:i",strtotime($result->created_at)) }}</td>
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
	</div>

@include($view_path.'.clients.partials.modals.customtabs.section4-modals')

@include($view_path.'.clients.partials.modals.customtabs.formdata-modal')
</div>