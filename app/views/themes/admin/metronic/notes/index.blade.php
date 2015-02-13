<div class="row">
	<div class="col-md-12">
		@if(!in_array($viewType, array('task-create')))
			{{ 
				Form::open(
					array(
						'action' => array(
							'Notes\NotesController@postBulkDeleteNote',
						),
						'role' => 'form'
					)
				) 
			}}
			@if($notes->count() > 0)
				@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'notes_check_all', 'table_target' => '#table-note-list'))
			@endif
		@endif
		<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<table class="table table-condensed table-feeds" id="table-note-list">
				<tbody>
				@if( $notes->count() > 0 )
					@foreach($notes->get() as $note)
						<tr>
							@if(!in_array($viewType, array('task-create')))
							<td style="width:1%">
								{{ Form::checkbox('notes_to_delete[]', $note->id) }}
							</td>
							@endif
							<td class="text-center">
								<img src="{{url('public/img/profile_images/summary_person.png')}}" alt="Avatar" class="img-circle round-50" style="width:30px"/>
							</td>
							<td>
								 <a 
								 	data-toggle="modal" 
								 	data-target=".ajaxModalStacked" 
								 	href="{{ action('Notes\NotesController@getAjaxViewInput', array('note_id'=>$note->id)) }}" 
								 	title="Note Subject">
								 	{{ empty($note->subject) ? "<NO SUBJECT>" : $note->subject }}
								 </a>
							</td>
							<td>
								@if(!in_array($viewType, array('task-create')))
									@if(empty($note->task_id))
									<a href="{{action(
												'Clients\ClientsController@getCreateClientTask',
												array(
													'customerid'=>isset($customerId) ? $customerId:'')
												)
											}}?note_id={{ $note->id }}"
										data-target=".createTask"
										data-toggle="modal"
										class="btn btn-xs btn-info openModal">								
										Set Reminder
									</a>
									@else
									<a class="btn btn-xs btn-warning openModal" 
										data-toggle="modal" 
										data-target=".ajaxModal" 
										href="{{action(
													'Task\TaskController@getEditClientTask',
													array(
														'id'=>$note->task_id,
														'customerid'=>\CustomerTasks\CustomerTasks::find($note->task_id)->customer_id,
														'redirect'=>'task'
													)
												)
											}}?note_id={{ $note->id }}">
										Edit Reminder
									</a>
									@endif
								@endif
							</td>
							<td>
								<small class="muted">Created By {{ $note->user->first_name }} {{ $note->user->last_name }} on {{ \Carbon\Carbon::parse($note->created_at)->format('d/m/Y') }} at {{ \Carbon\Carbon::parse($note->created_at)->format('H:i') }}</small>
							</td>
							<td>
								@if(!in_array($viewType, array('task-create')))
								<a href="{{ action('Notes\NotesController@getDeleteNote',array('id'=>$note->id,'customerid'=>$note->customer_id)) }}" class="pull-right" title="Delete File"><i class="icon-trash"></i> </a>
								@else
								{{ 
									Form::checkbox(
										'note[]', 
										$note->id,
										in_array($note->id, (!is_array($selectedNoteId) ? array($selectedNoteId) : $selectedNoteId)) ? true : false
									) 
								}}								
								@endif
							</td>
						</tr>
					@endforeach
				@endif					
				</tbody>
			</table>

		</div>
		@if(!in_array($viewType, array('task-create')))
			{{ Form::close() }}
		@endif
	</div>
</div>