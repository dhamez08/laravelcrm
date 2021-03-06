<div class="col-md-4">
	<div class="row">
		<div class="col-md-12 site-themes">
			<div class="portlet box blue tasks-widget">
				<div class="portlet-title">
					<div class="caption">
						Client Tabs
					</div>
				</div>
				<div class="portlet-body" style="padding:15px">
					<div class="row">
						<div class="col-md-12">
							Select the tabs you wish to appear in the client managment area.
							<br /><br />
							{{ Form::open(array('url' => 'settings/custom-fields/update-default-tabs')) }}
								@foreach($clientTabs as $key => $ct)
								<div>
	        						<label>
										<input type="checkbox" name="{{ $key }}" value="1" {{ ($clientTabRows) ? $clientTabRows->$key==1 ? 'checked':'':'checked' }}> {{ $ct }}
									</label>
								</div>
								@endforeach
								<button type="submit" class="btn blue">Save Tab Settings</button>
							{{ Form::close() }}
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>