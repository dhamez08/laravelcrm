<div class="portlet light bordered">
	<div class="portlet-title">

		<div class="caption font-green-sharp">
			<i class="icon-speech font-green-sharp"></i>
			<span class="caption-subject bold uppercase"> Message Centre</span>
		</div>
	</div>
	<div class="portlet-body">
		<div class="row">
			<div class="col-md-12">
			@if(count($messages)>0)
				<table class="table table-striped table-bordered table-hover dataTable no-footer">
					<tbody>
					@foreach($messages as $message)
						<tr>
							<td>
								@if($message->method==1)
									<i class="fa fa-envelope-o"></i>
								@else
									<i class="fa fa-mobile"></i>
								@endif
								{{ $message->sender }}
							</td>
							<td>{{ $message->to }}</td>
							<td><a href="{{ url('messages/view?show=modal_complete&message_id='.$message->id) }}" data-toggle="modal" data-target=".ajaxModalStacked">{{ $message->subject }}</a></td>
							<td>
								@if($message->direction=='1')
									<span class="label label-sm label-success label-mini">Sent</span>
								@elseif($message->direction=='2')
									<span class="label label-sm label-warning label-mini">Received</span>
								@endif
								 on {{ date("d/m/y H:i",strtotime($message->added_date)) }}
							</td>
							<td>
								<a href="{{ url('messages/view?show=modal_complete&message_id='.$message->id) }}" data-toggle="modal" data-target=".ajaxModalStacked" class="btn default btn-xs green-stripe">View</a>
								<a href="{{ url('messages/delete/'.$message->id.'?back=yes') }}" class="btn default btn-xs red-stripe">Delete</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			@else
				<div style="padding:15px">
					The message centre is currently empty.
				</div>
			@endif
			</div>
		</div>
	</div>
</div>