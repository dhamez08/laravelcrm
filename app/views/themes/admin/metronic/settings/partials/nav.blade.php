<ul class="nav nav-tabs" role="tablist">
  <li class="{{\Request::is('settings') ? 'active':''}}"><a href="{{url('settings')}}">Overview</a></li>
  <li class="{{\Request::is('settings/custom-fields*') ? 'active':\Request::is('settings/custom-forms*') ? 'active':''}}"><a href="{{url('settings/custom-fields')}}">Custom Fields</a></li>
  <li class="{{\Request::is('settings/tags*') ? 'active':''}}"><a href="{{url('settings/tags')}}">Tags</a></li>
  <li class="{{\Request::is('settings/screen*') ? 'active':''}}"><a href="{{url('settings/screen')}}">Screen Settings</a></li>
  <li class="{{\Request::is('settings/email*') ? 'active':''}}"><a href="{{url('settings/email')}}">Email Settings</a></li>
  <li class="{{\Request::is('settings/sms*') ? 'active':''}}"><a href="{{url('settings/sms')}}">SMS Settings</a></li>
  <li class="{{\Request::is('settings/users*') ? 'active':''}}"><a href="{{url('settings/users')}}">User Settings</a></li>
  <li class="{{\Request::is('settings/task-label*') ? 'active':''}}"><a href="{{url('settings/task-label')}}">Calendar Task Settings</a></li>
</ul>

