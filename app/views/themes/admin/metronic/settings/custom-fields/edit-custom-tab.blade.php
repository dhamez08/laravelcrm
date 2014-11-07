@extends( $settings_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/pages/css/custom-fields.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
		<div class="col-md-12">
			<div class="tabbable tabbable-custom tabbable-full-width">
				<ul class="nav nav-tabs">
					<li>
						<a href="{{ url('settings/custom-fields') }}">
						Custom Tabs </a>
					</li>
					<li>
						<a href="{{ url('settings/custom-forms') }}">
						Custom Forms </a>
					</li>
					<li>
						<a href="{{ url('settings/user-custom-fields') }}">
						Custom Fields </a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_custom_tabs">
					@if(\Input::get('backToClient'))
						{{ Form::open(array('url' => 'settings/custom-fields/custom-tab/'.$tab->id.'?backToClient='.\Input::get('backToClient'))) }}
					@else
						{{ Form::open(array('url' => 'settings/custom-fields/custom-tab/'.$tab->id)) }}
					@endif
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-4">
									<label for="tab_name" class="control-label">Tab Name:</label>
									<input type="text" name="tab_name" value="{{ $tab->name }}" class="form-control" />
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											Section 1:
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12">
													<input type="text" name="section1_name" value="{{ $tab->section1_name }}" placeholder="Section 1 name" class="form-control" />
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="tab_name" class="control-label">Use:</label>
													<select class="form-control" name="section1">
														<option value="generic_0" {{ $tab->section1==0 ? 'selected="selected"':'' }}>Empty</option>
											            <option value="generic_1" {{ $tab->section1==1 ? 'selected="selected"':'' }}>Notes</option>
											            <option value="generic_2" {{ $tab->section1==2 ? 'selected="selected"':'' }}>Files</option>
											        @if(count($customForms)>0)
											        	<optgroup label="Custom Forms">
											        	@foreach ($customForms as $form) {
															<?php 
																echo '<option value="form_'. $form->id .'"';
																if ($tab->section1_form==$form->id) {
																	echo ' selected="selected" ';
																}
																echo '>'. $form->name .' - '. $form->desc .'</option>';
															?>
														@endforeach
														</optgroup>
											        @endif
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											Section 2:
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12">
													<input type="text" name="section2_name" value="{{ $tab->section2_name }}" placeholder="Section 2 name" class="form-control" />
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="tab_name" class="control-label">Use:</label>
													<select class="form-control" name="section2">
														<option value="generic_0" {{ $tab->section2==0 ? 'selected="selected"':'' }}>Empty</option>
											            <option value="generic_1" {{ $tab->section2==1 ? 'selected="selected"':'' }}>Notes</option>
											            <option value="generic_2" {{ $tab->section2==2 ? 'selected="selected"':'' }}>Files</option>
											        @if(count($customForms)>0)
											        	<optgroup label="Custom Forms">
											        	@foreach ($customForms as $form) {
															<?php 
																echo '<option value="form_'. $form->id .'"';
																if ($tab->section2_form==$form->id) {
																	echo ' selected="selected" ';
																}
																echo '>'. $form->name .' - '. $form->desc .'</option>';
															?>
														@endforeach
														</optgroup>
											        @endif
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											Section 3:
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12">
													<input type="text" name="section3_name" value="{{ $tab->section3_name }}" placeholder="Section 3 name" class="form-control" />
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="tab_name" class="control-label">Use:</label>
													<select class="form-control" name="section3">
														<option value="generic_0" {{ $tab->section3==0 ? 'selected="selected"':'' }}>Empty</option>
											            <option value="generic_1" {{ $tab->section3==1 ? 'selected="selected"':'' }}>Notes</option>
											            <option value="generic_2" {{ $tab->section3==2 ? 'selected="selected"':'' }}>Files</option>
											        @if(count($customForms)>0)
											        	<optgroup label="Custom Forms">
											        	@foreach ($customForms as $form) {
															<?php 
																echo '<option value="form_'. $form->id .'"';
																if ($tab->section3_form==$form->id) {
																	echo ' selected="selected" ';
																}
																echo '>'. $form->name .' - '. $form->desc .'</option>';
															?>
														@endforeach
														</optgroup>
											        @endif
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-6">
									<div class="panel panel-default">
										<div class="panel-heading">
											Section 4:
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-12">
													<input type="text" name="section4_name" value="{{ $tab->section4_name }}" placeholder="Section 4 name" class="form-control" />
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<label for="tab_name" class="control-label">Use:</label>
													<select class="form-control" name="section4">
														<option value="generic_0" {{ $tab->section4==0 ? 'selected="selected"':'' }}>Empty</option>
											            <option value="generic_1" {{ $tab->section4==1 ? 'selected="selected"':'' }}>Notes</option>
											            <option value="generic_2" {{ $tab->section4==2 ? 'selected="selected"':'' }}>Files</option>
											        @if(count($customForms)>0)
											        	<optgroup label="Custom Forms">
											        	@foreach ($customForms as $form) {
															<?php 
																echo '<option value="form_'. $form->id .'"';
																if ($tab->section4_form==$form->id) {
																	echo ' selected="selected" ';
																}
																echo '>'. $form->name .' - '. $form->desc .'</option>';
															?>
														@endforeach
														</optgroup>
											        @endif
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-12">
									<button class="btn blue" type="submit">Save changes</button>
								</div>
							</div>
						</div>
						{{ Form::close() }}
					</div>

				</div>
			</div>
		</div>
		@stop
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	@stop
@stop
