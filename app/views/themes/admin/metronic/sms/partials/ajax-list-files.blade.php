@if( $customerFiles->count() )
	<select name="attach_file">
		<option value="0">Select File</option>
		@foreach($customerFiles->get() as $files)
			<option value="{{$files->id}}">{{$files->filename}}</option>
		@endforeach
	</select>
@endif
