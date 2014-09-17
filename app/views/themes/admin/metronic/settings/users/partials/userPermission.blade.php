<table class="table">
  <thead>
	<tr>
	  <th>Function</th>
	  <th>Read Only</th>
	  <th>Full Permission</th>
	</tr>
  </thead>
  <tbody>
	 @foreach( $permission as $key => $val )
	 	<tr>
		  <td><strong>{{$key}}</strong></td>
		  <td>{{Form::radio("permission[$val]", 0, true);}}</td>
		  <td>{{Form::radio("permission[$val]", 1);}}</td>
		</tr>
	 @endforeach
  </tbody>
</table>
