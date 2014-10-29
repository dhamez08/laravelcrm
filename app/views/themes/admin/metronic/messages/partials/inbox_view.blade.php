<div class="inbox-header inbox-view-header">
	<div class="pull-right">
		<i class="fa fa-print"></i>
	</div>
</div>
<div class="inbox-view-info">
	<div class="row">
		<div class="col-md-7">
			<img src="{{$asset_path}}/layout/img/avatar1_small.jpg">
			<span class="bold">{{ $message->first_name . " " . $message->last_name }}</span>
			@if($message->direction=='2')
				<span>&#60;{{ $message->sender }}&#62;</span>
				to <span class="bold">
				me </span>
			@endif
			on {{ date("h:iA d/m/Y",strtotime($message->added_date)) }}
		</div>
		<div class="col-md-5 inbox-info-btn">
			<div class="btn-group">
				@if($message->direction=='2')
				<button class="btn blue reply-btn" onclick="window.location='{{ url('messages/reply?message_id='.$message->id) }}'">
				<i class="fa fa-reply"></i> Reply </button>
				@else
				<button class="btn blue reply-btn" onclick="window.location='{{ url('messages/resend?message_id='.$message->id) }}'">
				<i class="fa fa-refresh"></i> Resend </button>
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
						<i class="fa fa-refresh reply-btn"></i> Resend </a>
					</li>
				@endif
					<!-- <li>
						<a href="#">
						<i class="fa fa-arrow-right reply-btn"></i> Forward </a>
					</li> -->
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
					</div>
				</div>
			</div>
		</div>
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
		<!-- <hr>
		<div class="inbox-attached">
			<div class="margin-bottom-15">
				<span>
				3 attachments — </span>
				<a href="#">
				Download all attachments </a>
				<a href="#">
				View all images </a>
			</div>
			<div class="margin-bottom-25">
				<img src="../../assets/admin/pages/media/gallery/image4.jpg">
				<div>
					<strong>image4.jpg</strong>
					<span>
					173K </span>
					<a href="#">
					View </a>
					<a href="#">
					Download </a>
				</div>
			</div>
			<div class="margin-bottom-25">
				<img src="../../assets/admin/pages/media/gallery/image3.jpg">
				<div>
					<strong>IMAG0705.jpg</strong>
					<span>
					14K </span>
					<a href="#">
					View </a>
					<a href="#">
					Download </a>
				</div>
			</div>
			<div class="margin-bottom-25">
				<img src="../../assets/admin/pages/media/gallery/image5.jpg">
				<div>
					<strong>test.jpg</strong>
					<span>
					132K </span>
					<a href="#">
					View </a>
					<a href="#">
					Download </a>
				</div>
			</div>
		</div> -->