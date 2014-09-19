<div class="col-md-12">
	<ul class="nav nav-tabs" role="tablist">
	  <li class="{{\Request::is('settings') ? 'active':''}}"><a href="{{url('settings')}}">Overview</a></li>
	  <li><a href="#">Custom Fields</a></li>
	  <li class="{{\Request::is('settings/tags*') ? 'active':''}}"><a href="{{url('settings/tags')}}">Tags</a></li>
	  <li><a href="#">Screen Settings</a></li>
	  <li><a href="#">Email Settings</a></li>
	  <li class="{{\Request::is('settings/users*') ? 'active':''}}"><a href="{{url('settings/users')}}">User Settings</a></li>
	  <li class="{{\Request::is('settings/task-label*') ? 'active':''}}"><a href="{{url('settings/task-label')}}">Calendar Task Settings</a></li>
	</ul>
</div>
