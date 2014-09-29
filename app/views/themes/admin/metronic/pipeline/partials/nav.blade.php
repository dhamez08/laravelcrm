<ul class="nav nav-tabs" role="tablist">
  <li class="{{\Request::is('pipeline') ? 'active':''}}"><a href="{{url('pipeline')}}">Chart / Stats View</a></li>
  <li class="{{\Request::is('pipeline/list-view*') ? 'active':''}}"><a href="{{url('pipeline/list-view')}}">List View</a></li>
</ul>