@if(count($reminders) > 0)
    @foreach($reminders as $reminder)
    <tr data-task-id="{{$reminder->id}}">
        <td>{{$reminder->displayHtmlTaskDue()}}</td>
        <td>{{$reminder->displayHtmlLabelIcon()}}</td>
        <td>{{$reminder->displayName()}}</td>
        <td>{{$reminder->displayTaskFullName()}}</td>
    </tr>
    @endforeach
@endif