@extends( $settings_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
		<div class="col-md-12">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="portlet box blue tasks-widget">
							<div class="portlet-title">
								<div class="caption">
									Edit Custom Form
								</div>
							</div>
							<div class="portlet-body" style="padding:15px">
								<div class="row">
									<div class="col-md-12">
										{{ Form::open(array('url' => 'settings/custom-forms/update-form/'.$form->id)) }}
											<div>
				        						<div class="form-group ">
									              {{ Form::label('custom_form_name', 'Name') }}
									              {{ 
									                Form::text
									                (
									                  'custom_form_name', $form->name, array('class' => 'form-control', 'required' => 'required')
									                ) 
									              }}
												</div>
											</div>
											<div>
				        						<div class="form-group ">
									              {{ Form::label('custom_form_desc', 'Description') }}
									              {{ 
									                Form::text
									                (
									                  'custom_form_desc', $form->desc, array('class' => 'form-control', 'required' => 'required')
									                ) 
									              }}
												</div>
											</div>
											<hr/>
											<div class="formContainer">
												@if(count($builds)>0)
													@foreach($builds as $build)
													<?php
													$opt_values = "";
													$values = json_decode($build->value,true);
													if ($values) {
														foreach($values as $opt_value) {
															$opt_values .= $opt_value .';';
														}
														$opt_values = rtrim($opt_values, ';');
													}
													?>
														<div class="panel panel-default">
															<div class="panel-body formBody">
																<div>
																	<div class="form-group">
																		<label>Item Type</label>
																		{{ Form::select('item_type[]', $item_type, $build->type, array('class' => 'form-control itemType', 'required' => 'required')) }}
																	</div>
																</div>
																<div>
																	<div class="form-group">
																		<label>Item Name</label>
																		<input type="text" class="form-control" name="item_name[]" placeholder="Enter name for this item" value="{{ $build->label }}">
																	</div>
																</div>
																<div>
																	<div class="form-group hasPlaceholder" style="display:{{ ($build->type==1 || $build->type==4 || $build->type==5) ? 'block':'none' }}">
																		<label>Item Placeholder</label>
																		<input type="text" class="form-control" name="item_placeholder[]" placeholder="Enter placeholder text" value="{{ $build->placeholder }}">
																	</div>
																	<div class="form-group dropdownOption" style="display:{{ $build->type==2 ? 'block':'none' }}">
																		<label>Item Values (separate values with semicolon):</label>
																		<input type="text" class="form-control" name="item_values[]" value="{{ $opt_values }}" placeholder="Enter dropdown values">
																	</div>
																</div>
															</div>
														</div>
													@endforeach
												@endif
											</div>
											<a href="{{ url('settings/custom-fields') }}" class="btn blue"><i class="fa fa-chevron-left"></i> Back</a>
											<button type="button" class="btn blue" id="addForm"><i class="fa fa-plus"></i> Add Form Item</button>
											<button type="submit" class="btn blue"><i class="fa fa-save"></i> Save</button>
											
										{{ Form::close() }}
									</div>

								</div>
							</div>
						</div>						
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
	<script src="{{$asset_path}}/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script>
		var selectoption = '{{ Form::select('item_type[]', $item_type, null, array('class' => 'form-control itemType', 'required' => 'required')) }}';
		$('.formContainer').sortable();
	</script>	
	<script src="{{$asset_path}}/pages/scripts/custom-fields.js" type="text/javascript"></script>

	
	@stop
@stop
