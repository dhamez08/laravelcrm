<table class="table table-condensed file-list">
	<tbody>
	@if( count($sms_files) > 0 )
		@foreach($sms_files as $files)
		<tr>
			<td style="width:1%">{{ Form::checkbox('attach_file[]', $files->id, in_array($files->id, $checked_files) ? true : false) }}</td>
			<td style="width:1%">
				<a href="#" class="file-preview" data-thumb="{{ asset('public' . $files->thumbnail) }}">
					{{ $files->file }}
				</a>
			</td>
			<td><a href="{{ url('public/documents/' . $files->file) }}" target="_blank">View File</a></td>
		</tr>
		@endforeach
	@else
		<tr>
			<td>
				No files uploaded.
			</td>
		</tr>
	@endif		
	</tbody>
</table>