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
				<img src="{{url('public/img/profile_images/profile.jpg')}}" alt="Avatar" class="img-circle round-50" style="width:50px"/>
				<span><strong>{{ $added_by }}</strong></span>
			</div>

			<div class="form-group">
				@if(in_array($form_type, array('create')))
				<label>Subject</label>
				@endif
				{{ Form::text(
						'subject', 
						(isset($note->subject) ? $note->subject : null), 
						$input_attr
					) 
				}}
			</div>
			<div class="form-group">
				@if(in_array($form_type, array('create')))
				<label>Please enter a note to be added to the client account</label>
				@endif
					{{ Form::textarea(
					   		'note',
					   		(isset($note->note) ? $note->note : null), 
					   		$input_attr
				   		)
				   	}}
			</div>

			@if(in_array($form_type, array('create')))
			<div class="form-group">
				<a 
					data-toggle="modal" 
					data-target=".ajaxModalStacked" 
					href="{{action(
						'Clients\ClientsController@getCreateClientTask',
						array(
							'customerid'=>isset($customerId) ? $customerId:''
							)
						)
					}}" 
					class="btn btn-sm btn-success"
				>
					Set Reminder
				</a>
			</div>
			@endif

			@if(in_array($form_type, array('create')))
			<div class="form-group">
				<label>Upload File (Optional)</label>
				{{Form::file('notefile')}}
			</div>
			<button type="submit" class="btn btn-primary" id="createNote">Create</button>
			@else
			<div class="form-group">
				@if(empty($note->file))
					<div class="alert alert-info">No File.</div>
				@else
					<a href="{{ url('public/documents/' . $note->file) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file"></i> View/Download File</a>
				@endif				
			</div>			
			@endif
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
