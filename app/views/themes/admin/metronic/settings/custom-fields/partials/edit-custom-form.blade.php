@extends( $settings_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
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
										{{ Form::open() }}
											<div>
				        						<div class="form-group ">
									              {{ Form::label('custom_form_name', 'Name') }}
									              {{ 
									                Form::text
									                (
									                  'custom_form_name', '', array('class' => 'form-control', 'required' => 'required')
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
									                  'custom_form_desc', '', array('class' => 'form-control', 'required' => 'required')
									                ) 
									              }}
												</div>
											</div>
											<hr/>
											@foreach(range(1,5) as $i)
											<div class="panel panel-default">
											  <div class="panel-body">
												<div>
					        						<div class="form-group ">
										              {{ Form::label('item_type_'.$i, 'Item Type') }}
										              {{ 
										                Form::select
										                (
										                  'item_type_'.$i, $item_type, null, array('class' => 'form-control', 'required' => 'required')
										                ) 
										              }}
													</div>
												</div>
												<div>
					        						<div class="form-group ">
										              {{ Form::label('item_name_'.$i, 'Item Name') }}
										              {{ 
										                Form::text
										                (
										                  'item_name_'.$i, '', array('class' => 'form-control', 'required' => 'required')
										                ) 
										              }}
													</div>
												</div>
												<div>
					        						<div class="form-group ">
										              {{ Form::label('item_placeholder_'.$i, 'Item Name') }}
										              {{ 
										                Form::text
										                (
										                  'item_placeholder_'.$i, '', array('class' => 'form-control', 'required' => 'required')
										                ) 
										              }}
													</div>
												</div>												
											  </div>
											</div>
											@endforeach
											<a href="{{ url('settings/custom-fields') }}" class="btn blue"><i class="fa fa-chevron-left"></i> Back</a>
											<button type="button" class="btn blue"><i class="fa fa-plus"></i> Add Form Item</button>
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
	@stop
@stop
