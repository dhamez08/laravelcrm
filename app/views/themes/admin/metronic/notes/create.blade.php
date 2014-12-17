<div class="modal-header">
	<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
	<h4 class="modal-title">{{$pageTitle}}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<div class="col-md-12">
			{{ Form::open(
				array(
						'action' => array('Notes\NotesController@postAjaxCreateNote','customerid'=>$customerId),
						'method' => 'POST',
						'role'=>'form',
						'files' => true,
						'id'=>'createNote'
					)
				)
			}}
			<div class="form-group">
				<label>Subject</label>
				{{ Form::text('subject', null, array('class' => 'form-control')) }}
			</div>
			<div class="form-group">
				<label>Please enter a note to be added to the client account</label>
				   {{Form::textarea('note',null,array('class'=>'form-control'))}}
			</div>
			<div class="form-group">
				<label>Upload File</label>
				{{Form::file('notefile')}}
			</div>
			<button type="submit" class="btn btn-primary" id="createNote">Create</button>
			<div class="ajax-container-msg hide" >
			  	<ul class="list-group ajax-error-msg">
			  	</ul>
			</div>
			{{Form::hidden('customerid',$customerId,array('id'=>'customerid'))}}
			{{Form::hidden('redirect',null,array('id'=>'redirect'))}}
			{{Form::close()}}
		</div>
	</div>
</div>
<div class="modal-footer">
	<button data-dismiss="modal" class="btn default" type="button">Close</button>
</div>
