<div id="modal-share-file" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Share this file with client</h4>
      </div>
      {{ Form::open(array(
      		'action' => 'Clients\ClientsController@postViewMyDocumentsShare',
      	)) 
      }}
	      <div class="modal-body">
	      		<div class="form-group">
	      			<label for="name">Name of file</label>
	      			<input type="text" name="name" class="form-control" placeholder="Enter filename">
	      		</div>
	      		<div class="form-group">
	      			<label for="notes">Notes</label>
	      			<textarea name="notes" class="form-control" placeholder="Enter notes"></textarea>
	      		</div>	      		
	      		<div class="form-group">
	      			<label for="notification">Name of file</label>
	      			<select name="notification" class="form-control">
	      				<option value="no">No Notification</option>
	      				<option value="email">Email Notification</option>
	      			</select>
	      		</div>	

	      		<input type="hidden" name="client" value="{{ $clientId }}">
	      		<input type="hidden" name="file">
	      		<input type="hidden" name="filename">

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Share</button>
	      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>