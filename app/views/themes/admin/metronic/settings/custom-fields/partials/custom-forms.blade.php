<div class="col-md-12 site-themes">
	<div class="portlet box blue tasks-widget">
		<div class="portlet-title">
			<div class="caption">
				Custom Forms
			</div>
		</div>
		<div class="portlet-body" style="padding:15px">
			@if(count($clientForms)==0)
			<div class="row">
				<div class="col-md-12">
					No custom forms have been created.
				</div>
			</div>
			<br>
			@else
			<table class="table">
				<tbody>
					@foreach($clientForms as $form)
					<tr>
						<td>
							{{ $form->name }}
						</td>
						<td class="text-right">
							 <a href="{{ url('settings/custom-forms/edit/'.$form->id) }}" class="btn btn-sm blue"><i class="fa fa-edit"></i> Edit</a>
							 <a href="{{ url('settings/custom-forms/delete/'.$form->id) }}" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Remove</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-sm blue" data-toggle="modal" data-target="#add-custom-form-modal"><div class="caption"><i class="fa fa-plus"></i>&nbsp;Add custom forms</div></button>
				</div>
			</div>
		</div>
	</div>
</div>

@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.modals.add-custom-form' )