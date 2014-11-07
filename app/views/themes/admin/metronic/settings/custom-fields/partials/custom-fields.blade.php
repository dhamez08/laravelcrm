<div class="col-md-12 site-themes">
	<div class="portlet box blue tasks-widget">
		<div class="portlet-title">
			<div class="caption">
				Custom Fields
			</div>
		</div>
		<div class="portlet-body" style="padding:15px">
			@if(count($clientFields)==0)
			<div class="row">
				<div class="col-md-12">
					No custom fields have been created.
				</div>
			</div>
			<br>
			@else
			<table class="table table-striped table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Label</th>
						<th>Placeholder</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($clientFields as $field)
					<tr>
						<td class="highlight">
							<div class="info"></div>
							<a href="#" class="edit-field" field-id="{{ $field->id }}">
								{{ $field->name }}
							</a>
							<input type="hidden" value="{{ $field->name }}" id="hidden_field_name-{{ $field->id }}" />
							<input type="hidden" value="{{ $field->label }}" id="hidden_field_label-{{ $field->id }}" />
							<input type="hidden" value="{{ $field->placeholder }}" id="hidden_field_placeholder-{{ $field->id }}" />
						</td>
						<td>{{ $field->label }}</td>
						<td>{{ $field->placeholder }}</td>
						<td class="text-right">
							 <a href="#" class="btn default btn-xs purple edit-field" field-id="{{ $field->id }}"><i class="fa fa-edit"></i> Edit</a>
							 <a href="{{ url('settings/user-custom-fields/delete/'.$field->id) }}" class="btn default btn-xs black" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash-o"></i> Remove</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@endif
			<div class="row">
				<div class="col-md-12">
					<button class="btn btn-sm blue" data-toggle="modal" data-target="#add-custom-field-modal"><div class="caption"><i class="fa fa-plus"></i>&nbsp;Add custom field</div></button>
				</div>
			</div>
		</div>
	</div>
</div>

@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.modals.add-custom-field' )
@include( \DashboardEntity::get_instance()->getView() . '.settings.custom-fields.partials.modals.edit-custom-field' )

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	<script>
	$(document).ready(function() {
		$("a.edit-field").on("click", function(e) {
			e.preventDefault();
			var field_id = $(this).attr("field-id");

			$("#edit-custom-field-modal input#field_id").val(field_id);
			$("#edit-custom-field-modal input#field-name").val($("#hidden_field_name-"+field_id).val());
			$("#edit-custom-field-modal input#field-label").val($("#hidden_field_label-"+field_id).val());
			$("#edit-custom-field-modal input#field-placeholder").val($("#hidden_field_placeholder-"+field_id).val());

			$("#edit-custom-field-modal").modal("show");
		});
	});
	</script>
	@stop
@stop
