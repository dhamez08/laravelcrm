@if(count($tasks) > 0)
    @for($counter = 0; $counter < 3; $counter++)
        {{--*/ $task = $tasks[$counter] /*--}}
        @if(!$task->is_reminded)
            <li class="task-item" data-task-id="{{$task->id}}">
                <a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
                    <span class="task">
                        <span class="desc">
                            {{$task->displayHtmlTaskDue()}}
                            {{$task->displayHtmlLabelIcon()}}
                            <br />
                            {{$task->displayName()}}
                            <br />
                            {{$task->displayTaskFullName()}}
                        </span>
                    </span>
                </a>
            </li>
        @endif
    @endfor
@endif