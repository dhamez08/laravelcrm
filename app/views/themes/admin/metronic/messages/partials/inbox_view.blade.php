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
			<span>&#60;{{ $message->sender }}&#62;</span>
			to <span class="bold">
			me </span>
			on {{ date("h:iA d/m/Y",strtotime($message->added_date)) }}
		</div>
		<div class="col-md-5 inbox-info-btn">
			<div class="btn-group">
				<button class="btn blue reply-btn" onclick="window.location='{{ url('messages/reply?message_id='.$message->id) }}'">
				<i class="fa fa-reply"></i> Reply </button>
				<button class="btn blue dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-angle-down"></i>
				</button>
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="{{ url('messages/reply?message_id='.$message->id) }}" data-messageid="{{ $message->id }}">
						<i class="fa fa-reply reply-btn"></i> Reply </a>
					</li>
					<li>
						<a href="#">
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
						<a href="#">
						<i class="fa fa-trash-o"></i> Delete </a>
					</li>
					<li>
					</div>
				</div>
			</div>
		</div>
		<div class="inbox-view">
			{{ $message->body }}
		</div>
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