<div class="col-md-4">
	<div class="row">
		<div class="col-md-12 site-themes">
			<div class="portlet box green-haze tasks-widget">
				<div class="portlet-title">
					<div class="caption">
						Client Files
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							Customise client file sections.
							<br /><br />
							<form role="form">
								@foreach($clientFiles as $key => $file)
								<div>
	        						<div class="form-group">
									    <label for="{{ $file['form_name'] }}">{{ $file['label_name'] }}</label>
									    <input type="text" class="form-control" value="{{ $file['default_value'] }}" id="{{ $file['form_name'] }}" placeholder="{{ $file['placeholder'] }}" {{ $file['readonly'] ? 'readonly':'' }}>
									</div>
								</div>
								@endforeach
								<button type="submit" class="btn btn-primary">Save Changes</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>