<div class="inbox-header inbox-view-header">
	<div class="pull-right">
		<i class="fa fa-print"></i>
	</div>
</div>
<div class="inbox-view-info">
	<div class="row">
		<div class="col-md-7">
			<img src="{{$asset_path}}/global/img/summary_person.png" height="40px">
			<span class="bold">{{ $message->first_name . " " . $message->last_name }}</span>
			@if($message->direction=='2')
				<span>&#60;{{ $message->sender }}&#62;</span>
				to <span class="bold">
				me </span>
			@endif
			on {{ date("h:iA d/m/Y",strtotime($message->added_date)) }}
		</div>
		<div class="col-md-5 inbox-info-btn">
			<div class="btn-group text-right">
				@if($message->direction=='2')
				<button class="btn blue reply-btn" onclick="window.location='{{ url('messages/reply?message_id='.$message->id) }}'">
				<i class="fa fa-reply"></i> Reply </button>
				@else
				<button class="btn blue reply-btn" onclick="window.location='{{ url('messages/resend?message_id='.$message->id) }}'">
				<i class="fa fa-refresh"></i> {{ $message->direction==1 ? 'Resend':'Send' }} </button>
				@endif
				<button class="btn blue dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-right">
				@if($message->direction=='2')
					<li>
						<a href="{{ url('messages/reply?message_id='.$message->id) }}" data-messageid="{{ $message->id }}">
						<i class="fa fa-reply reply-btn"></i> Reply </a>
					</li>
				@else
					<li>
						<a href="{{ url('messages/resend?message_id='.$message->id) }}" data-messageid="{{ $message->id }}">
						<i class="fa fa-refresh reply-btn"></i> {{ $message->direction==1 ? 'Resend':'Send' }}</a>
					</li>
				@endif
					<li>
						<a href="javascript:;" id="forwardEmailLink">
						<i class="fa fa-arrow-right reply-btn"></i> Forward </a>
					</li>
					<!-- <li>
						<a href="#">
						<i class="fa fa-print"></i> Print </a>
					</li> -->
					<li class="divider">
					</li>
					<!-- <li>
						<a href="#">
						<i class="fa fa-ban"></i> Spam </a>
					</li> -->
					<li>
						<a href="{{ url('messages/delete/'.$message->id) }}">
						<i class="fa fa-trash-o"></i> Move to Trash </a>
					</li>
					<li>
				</ul>
			</div>
		</div>
		<div class="col-md-12">
			<div class="inbox-view">
				{{ nl2br($message->body) }}
			</div>
			<?php $message_attachments = \MessageAttachment\MessageAttachment::where('message_id',$message->id)->get(); ?>
			@if(count($message_attachments)>0)
			<hr>
			<div class="inbox-attached">
				<div class="margin-bottom-15">
					<span>{{ count($message_attachments) }} attachment{{ count($message_attachments)>1 ? 's':'' }}</span>
				</div>
				@foreach($message_attachments as $attachment)
					<div class="margin-bottom-25">
						<div>
							<a href="{{ url('public/'.$attachment->file) }}" target="_blank"><strong><i class="fa fa-paperclip"></i> {{ str_replace("documents/","",str_replace("document/library/own/","",$attachment->file)) }}</strong></a>
						</div>
					</div>
				@endforeach
			</div>
			@endif
		</div>

		<div style="margin-top:30px;display:none" id="forwardEmailContainer">
			<div class="panel panel-default">
				<div class="panel-heading"><i class="glyphicon glyphicon-arrow-right"></i> Forward</div>
				<div class="panel-body">
				<form class="form-horizontal" action="" method="POST">
				{{ Form::token() }}
					<div class="inbox-form-group mail-to">
						<div class="controls controls-to">
							<select id="select2_user_forward" name="to[]" class="form-control select2" multiple>
							@foreach($customers->get() as $customer)
								<option value="{{ $customer->id }}">{{ $customer->first_name . " " . $customer->last_name }}</option>
							@endforeach
							</select>
						</div>
					</div>
					<div class="inbox-compose-btn">
						<button type="submit" name="btn_action" value="send" class="btn blue"><i class="fa fa-check"></i>Send</button>
						<button type="button" class="btn inbox-discard-btn" id="forwardEmailCancel">Cancel</button>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>