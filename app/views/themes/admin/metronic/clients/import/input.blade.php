{{Form::open(
		array(
			'action' => array('Clients\ClientsController@postImportClientPerson'),
			'method' => 'POST',
			'role'=>'form',
			'files' => true
		)
	)
}}
{{Form::file('importFile')}}
<p>{{Form::checkbox('headers',null,false,array('class'=>'form-group'))}} - Does the first row of the csv file contain headers (names of each column)? </p>
<p></p>
{{Form::submit('Import File',array('class'=>'btn btn-primary'))}}
{{Form::close()}}