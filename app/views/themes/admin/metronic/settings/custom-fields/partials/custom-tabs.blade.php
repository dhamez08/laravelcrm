<div class="col-md-4">
	<div class="row">
		<div class="col-md-12 site-themes">
			<div class="portlet box blue tasks-widget">
				<div class="portlet-title">
					<div class="caption">
						Custom Tabs
					</div>
				</div>
				<div class="portlet-body" style="padding:15px">
					@if(count($customTabs)==0)
					<div class="row">
						<div class="col-md-12">
							No custom tabs have been created.
						</div>
					</div>
					<br />
					@else
						<ul class="list-group">
						@foreach($customTabs as $tab)
							<li class="list-group-item">
								<div class="row">
									<div class="col-md-9">
										{{ $tab->name }}
									</div>
									<div class="col-md-3 text-right">
										<button class="btn btn-sm blue" title="Edit"><i class="fa fa-edit"></i></button>
										<button class="btn btn-sm red" title="Delete"><i class="fa fa-times"></i></button>
									</div>
								</div>
							</li>
						@endforeach
						</ul>
					@endif
					
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-sm blue" data-toggle="modal" data-target=".bs-tab-modal-md"><div class="caption"><i class="fa fa-plus"></i>&nbsp;Add custom tabs</div></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.modals.add-custom-tabs' )