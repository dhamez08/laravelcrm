<!--
<div class="table-scrollable">
	<table class="table table-striped table-bordered table-advance table-hover">
		<thead>
			<tr>
				<th>
					<i class="fa fa-briefcase"></i> Subject
				</th>
				<th class="hidden-xs">
					<i class="fa fa-question"></i> Message
				</th>
				<th>
					<i class="fa fa-bookmark"></i> Status
				</th>
				<th>
				</th>
			</tr>
		</thead>
		<tbody>
		@foreach($recent_messages as $message)
			<tr>
				<td>
					<a href="{{ url('messages/view?message_id='.$message->id) }}">{{ $message->subject }}</a>
				</td>
				<td class="hidden-xs">
					 {{ str_limit(strip_tags($message->body),40) }}
				</td>
				<td>
					@if($message->direction=='1')
						<span class="label label-sm label-success label-mini">Sent</span>
					@elseif($message->direction=='2')
						<span class="label label-sm label-warning label-mini">Received</span>
					@endif
					 on {{ date("d/m/y H:i",strtotime($message->added_date)) }}
				</td>
				<td><a href="{{ url('messages/view?message_id='.$message->id) }}" class="client-message-view btn default btn-xs green-stripe">View</a></td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
-->
<div style="overflow-y:auto;height:350px;min-height:350px;max-height:350px;" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
    <ul class="feeds">
        @foreach($recent_messages as $message)
        <li>
            <div class="col1">
                <div class="cont">
                    <div class="cont-col1">
                        <div class="label label-sm label-info">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                    </div>
                    <div class="cont-col2">
                        <div class="desc">
                             <a href="#" class="client-message-view" data-subject="{{$message->subject}}" data-url="{{ url('messages/view?message_id='.$message->id) }}">{{ $message->subject }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col2">
                <div class="date">
                     {{ date("d/m/y H:i",strtotime($message->added_date)) }}
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>

@include($view_path.'.clients.partials.clientMessageWidget')