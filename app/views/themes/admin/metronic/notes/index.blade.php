<h4>Note</h4>
<div style="margin-bottom:20px;">
	<a
		class="btn btn-default btn-sm openModal"
		data-toggle="modal"
		data-target=".ajaxModal"
		href="{{action('Notes\NotesController@getAjaxCreateInput', array('customerid'=>$customerId))}}">
	<i class="fa fa-plus"></i> Add </a>

</div>
<div class="row">
	<div class="col-md-12">
		@if( $notes->count() > 0 )
			@foreach($notes->get() as $note)
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
			@endforeach
		@endif
	</div>
</div>
