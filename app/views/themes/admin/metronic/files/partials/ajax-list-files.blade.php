@if( $sms_files->count() > 0 )
	<select name="attach_file[]" multiple>
		@foreach($sms_files->get() as $files)
			<option value="{{$files->id}}">
				{{$files->file}}
			</option>
		@endforeach
	</select>
@else
		<h4>Upload file first click "Add new"</h4>
@endif
