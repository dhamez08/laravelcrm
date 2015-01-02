<div class="row">
	<div class="col-md-12">
		<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<!--
			<ul class="feeds">
				@if( $notes->count() > 0 )
					@foreach($notes->get() as $note)
						<li>
							<div class="col1" style="width:50% !important">
								<div class="cont">
									<div class="cont-col1">
										TODO: Replace with dynamic user profile image
										<img src="{{url('public/img/profile_images/profile.jpg')}}" alt="Avatar" class="img-circle round-50" style="width:30px"/>
									</div>
									<div class="cont-col2">
										<div class="desc">
											 <a 
											 	data-toggle="modal" 
											 	data-target=".ajaxModal" 
											 	href="{{ action('Notes\NotesController@getAjaxViewInput', array('note_id'=>$note->id)) }}" 
											 	title="Note Subject">
											 	{{ empty($note->subject) ? "<NO SUBJECT>" : $note->subject }}
											 </a>
										</div>
									</div>
								</div>
							</div>
							<div class="col2" style="width:50% !important">
								<div class="cont">
									<div class="cont-col1">
										<small class="muted">Created By {{ $note->user->first_name }} {{ $note->user->last_name }} on {{ \Carbon\Carbon::parse($note->created_at)->format('m/d/Y') }} at {{ \Carbon\Carbon::parse($note->created_at)->format('H:i') }}</small>
									</div>
									<div class="cont-col2">
										<a href="{{ action('Notes\NotesController@getDeleteNote',array('id'=>$note->id,'customerid'=>$note->customer_id)) }}" class="pull-right" title="Delete File"><i class="icon-trash"></i> </a>
									</div>
								</div>
							</div>
						</li>						
					@endforeach
				@endif
			</ul>
			-->
			<table class="table table-condensed table-feeds">
				<tbody>
				@if( $notes->count() > 0 )
					@foreach($notes->get() as $note)
						<tr>
							<td class="text-center">
								<img src="{{url('public/img/profile_images/profile.jpg')}}" alt="Avatar" class="img-circle round-50" style="width:30px"/>
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
									Form::radio(
										'note', 
										$note->id,
										isset($selectedNoteId) && $selectedNoteId == $note->id ? true : false
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
	</div>
</div>