<table class="table table-condensed bulk-delete-toolbar" style="margin-bottom:0px">
	<tbody>
		<tr>
			<td style="width:1%">
				{{ Form::checkbox($checkbox_name, 1, false, array('table-target' => $table_target)) }}
			</td>
			<td>
				<button type="submit" class="btn btn-xs btn-danger pull-right"><i class="fa fa-trash"></i> Delete</button>
			</td>
		</tr>
	</tbody>
</table>