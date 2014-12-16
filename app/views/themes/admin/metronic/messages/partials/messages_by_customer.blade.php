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