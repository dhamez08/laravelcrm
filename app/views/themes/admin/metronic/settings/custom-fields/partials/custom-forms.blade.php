<div class="col-md-12 site-themes">
	<div class="portlet box blue tasks-widget">
		<div class="portlet-title">
			<div class="caption">
				Custom Forms
			</div>
		</div>
		<div class="portlet-body" style="padding:15px">
			@if(true)
			<div class="row">
				<div class="col-md-12">
					No custom tabs have been created.
				</div>
			</div>
			<br>
			@endif
			@if(true)
			<table class="table">
				<tbody>
					@foreach(range(1,10) as $i)
					<tr>
						<td>
							Custom Form No. {{$i}}
						</td>
						<td class="text-right">
							 <a href="{{ url('settings/custom-fields/edit-custom-form') }}" class="btn btn-sm blue"><i class="fa fa-edit"></i> Edit</a>
							 <a href="#" class="btn btn-sm red"><i class="fa fa-times"></i> Remove</a>
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

{{ $add_custom_form_modal }}