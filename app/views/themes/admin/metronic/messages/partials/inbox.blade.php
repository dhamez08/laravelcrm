<form action="{{ url('messages/inbox') }}" method="POST" id="inboxForm">
{{ Form::token() }}
<input type="hidden" name="action_type" id="action_type" value="" />
<table class="table table-striped table-advance table-hover">
<thead>
<tr>
	<th colspan="3">
		<input type="checkbox" class="mail-checkbox mail-group-checkbox">
		<div class="btn-group">
			<a class="btn btn-sm blue" href="#" data-toggle="dropdown">
			More <i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="#" id="message_read">
					<i class="fa fa-pencil"></i> Mark as Read </a>
				</li>
				<li>
					<a href="#" id="message_unread">
					<i class="fa fa-pencil"></i> Mark as Un-Read </a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="#" id="message_delete">
					<i class="fa fa-trash-o"></i> Move to Trash </a>
				</li>
			</ul>
		</div>
	</th>
	<th class="pagination-control" colspan="3">
		<!-- <span class="pagination-info">
		1-30 of 789 </span>
		<a class="btn btn-sm blue">
		<i class="fa fa-angle-left"></i>
		</a>
		<a class="btn btn-sm blue">
		<i class="fa fa-angle-right"></i>
		</a> -->
	</th>
</tr>
</thead>
<tbody>
@if(count($messages)>0)
	@foreach($messages as $message)
	<tr @if($message->read_status=='0') class="unread" @endif data-messageid="{{ $message->id }}">
		<td class="inbox-small-cells">
			<input type="checkbox" class="mail-checkbox" name="messageid[]" value="{{ $message->id }}">
		</td>
		<td class="inbox-small-cells">
			<i class="fa fa-star"></i>
		</td>
		<td class="view-message hidden-xs" style="width:300px;">
			 {{ $message->sender }}
		</td>
		<td class="view-message ">
			 {{ $message->subject }}
		</td>
		<td class="view-message inbox-small-cells">
		@if(count(\MessageAttachment\MessageAttachmentEntity::where('message_id',$message->id)->get())>0)
			<i class="fa fa-paperclip"></i>
		@endif
		</td>
		<td class="view-message text-right" style="min-width:200px;">
			{{ date('d/m/Y h:i A',strtotime($message->added_date)) }}
		</td>
	</tr>
	@endforeach
@else
	<tr>
		<td>No records yet!</td>
	</tr>
@endif
</tbody>
</table>
</form>