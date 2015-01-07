@if(count($tasks) > 0)
    @foreach($tasks as $task)
        <li>
            <a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="">
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
    @endforeach
@endif