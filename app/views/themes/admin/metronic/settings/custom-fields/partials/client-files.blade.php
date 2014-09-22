<div class="col-md-4">
	<div class="row">
		<div class="col-md-12 site-themes">
			<div class="portlet box blue tasks-widget">
				<div class="portlet-title">
					<div class="caption">
						Client Files
					</div>
				</div>
				<div class="portlet-body" style="padding:15px">
					<div class="row">
						<div class="col-md-12">
							Customise client file sections.
							<br /><br />
							{{ Form::open(array('url' => 'settings/custom-fields/save-custom-files')) }}
								@foreach($clientFiles as $key => $file)
								<div>
	        						<div class="form-group {{ $file['field_name'] }}">
									    <label for="{{ $file['form_name'] }}">{{ $file['label_name'] }}</label>
									    <input type="text" class="form-control" value="{{ $clientFileRows->$file['field_name'] }}" id="{{ $file['form_name'] }}" name="{{ $file['form_name'] }}" placeholder="{{ $file['placeholder'] }}" {{ $file['readonly'] ? 'readonly':'' }}>
									</div>
								</div>
								@endforeach
								<button type="submit" class="btn blue">Save Changes</button>
							{{ Form::close() }}
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>