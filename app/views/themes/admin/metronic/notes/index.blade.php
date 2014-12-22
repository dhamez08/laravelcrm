<div class="row">
	<div class="col-md-12">
		<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<ul class="feeds">
				@if( $notes->count() > 0 )
					@foreach($notes->get() as $note)
						<li>
							<div class="col1" style="width:50% !important">
								<div class="cont">
									<div class="cont-col1">
										<!-- TODO: Replace with dynamic user profile image -->
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

						<!--
						<div class="media">
						  <div class="media-body">
							<h5 class="media-heading">
								<i class="fa fa-comment"></i>
								{{\Carbon\Carbon::parse($note->created_at)->toFormattedDateString()}}
								by
								{{$note->user->title}} {{$note->user->first_name}} {{$note->user->last_name}}
								<a
									href="{{action('Notes\NotesController@getDeleteNote',array('id'=>$note->id,'customerid'=>$note->customer_id))}}"
									class="btn red btn-sm deleteNote"
								>
									<i class="fa fa-trash-o fa-5x"></i>
								</a>
							</h5>
							<p>{{$note->note}}
							@if( $note->file != '' )
								<a href="{{asset('public/documents/' . $note->file)}}" target="_blank">
									View attach file
								</a>
							@endif
							</p>
						  </div>
						</div>
						-->
					@endforeach
				@endif
			</ul>
		</div>
	</div>
</div>