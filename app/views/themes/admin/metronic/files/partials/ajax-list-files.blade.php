<table class="table table-condensed file-list">
	<tbody>
	@if( count($sms_files) > 0 )
		@foreach($sms_files as $files)
		<tr>
			<td style="width:1%">{{ Form::checkbox('attach_file[]', $files->id) }}</td>
			<td style="width:1%">{{ $files->file }}</td>
			<td><a href="{{ url('public/documents/' . $files->file) }}" target="_blank">View File</a></td>
		</tr>
		@endforeach
	@endif		
	</tbody>
</table>