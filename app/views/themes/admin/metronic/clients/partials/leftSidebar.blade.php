<?php
	$request_url = Request::segment(1);
?>
<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="client-sidebar page-sidebar" style="">
		<!-- BEGIN SIDEBAR MENU -->
		<ul id="side-bar-page-nav" data-slide-speed="200" data-auto-scroll="true" class="client-sidebar-menu page-sidebar-menu page-sidebar-menu-light page-sidebar-menu-hover-submenu">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
			<li class="sidebar-toggler-wrapper">
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<div class="sidebar-toggler"></div>
				<!-- END SIDEBAR TOGGLER BUTTON -->
			</li>
			<li{{(Request::is('clients/client-summary/*')) ? '  class="start active open"': ''}}>
				@if(isset($customer))
				<a href="{{url('clients/client-summary/'.$customer->id)}}">
				@else
				<a href="javascript:;">
				@endif
				<i class="fa fa-home"></i>
				<span class="title">Client Dashboard</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
				</a>
			</li>
			<li{{(Request::is('file/client-file/*')) ? '  class="start active open"': ''}}>
				@if(isset($customer))
				<a href="{{url('file/client-file/'.$customer->id)}}">
				@else
				<a href="javascript:;">
				@endif
				<i class="fa fa-file-o"></i>
				<span class="title">Files</span>
				<span class="arrow "></span>
				</a>
			</li>
			<li{{(Request::is('client-messages/*')) ? '  class="start active open"': ''}}>
				@if(isset($customer))
				<a href="{{url('client-messages/'.$customer->id)}}">
				@else
				<a href="javascript:;">
				@endif
					<i class="fa fa-envelope-o"></i>
					<span class="title">Messages</span>
					<span class="arrow "></span>
				</a>
			</li>
			<!-- BEGIN FRONTEND THEME LINKS -->
			<li{{(Request::is('clients/opportunities/*')) ? '  class="start active open"': ''}}>
				@if(isset($customer))
				<a href="{{ url('clients/opportunities/'.$customer->id) }}">
				@else
				<a href="javascript:;">
				@endif
				<i class="fa fa-bar-chart-o"></i>
				<span class="title">Opportunities</span>
				<span class="arrow">
				</span>
				</a>
			</li>
			<!-- END FRONTEND THEME LINKS -->
			{{--
			<li>
				<a href="javascript:;">
				<i class="fa fa-euro"></i>
				<span class="title">Accounts</span>
				<span class="arrow "></span>
				</a>
			</li>
			<li>
				<a href="javascript:;">
				<i class="fa fa-check-square-o"></i>
				<span class="title">Workflow/Tasks</span>
				<span class="arrow "></span>
				</a>
			</li>
			--}}
			<li{{(Request::is('clients/live-documents/*')) ? '  class="start active open"': ''}}>
				@if(isset($customer))
					<a href="{{ url('clients/live-documents/' . $customer->id) }}">
				@else
					<a href="javascript:;">
				@endif
				<i class="fa fa-briefcase"></i>
				<span class="title">Live Documents</span>
				<span class="arrow "></span>
				</a>
			</li>
			@if(isset($customer))
				@foreach(Auth::user()->customtabs as $tab)
				<li{{(\Input::get('custom') == $tab->id) ? '  class="start active open"': ''}}>
					<a href="{{ url('clients/custom/'.$customer->id.'?custom='.$tab->id) }}">
					<i class="fa {{ empty($tab->icon) ? 'fa-question' : $tab->icon }}"></i>
					<span class="title">{{ $tab->name }}</span>
					<span class="arrow "></span>
					</a>
				</li>
				@endforeach
			@endif
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<script>
    if ($.cookie && $.cookie('sidebar_closed') === '1') {
        $('.page-sidebar-menu').addClass('page-sidebar-menu-closed');
    }
</script>
