<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse collapse" style="">
		<!-- BEGIN SIDEBAR MENU -->
		<ul data-slide-speed="200" data-auto-scroll="true" class="page-sidebar-menu page-sidebar-menu-light page-sidebar-menu-hover-submenu page-sidebar-menu-closed">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
			<li class="sidebar-toggler-wrapper">
				<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				<div class="sidebar-toggler">
				</div>
				<!-- END SIDEBAR TOGGLER BUTTON -->
			</li>
			<li class="start active open">
				@if(isset($customer))
				<a href="{{url('clients/client-summary/'.$customer->id)}}">
				@else	
				<a href="javascript:;">
				@endif
				<i class="icon-home"></i>
				<span class="title">Client Dashboard</span>
				<span class="selected"></span>
				<span class="arrow open"></span>
				</a>
			</li>
			<li>
				@if(isset($customer))
				<a href="{{url('file/client-file/'.$customer->id)}}">
				@else
				<a href="javascript:;">
				@endif
				<i class="icon-basket"></i>
				<span class="title">Files</span>
				<span class="arrow "></span>
				</a>
			</li>
			<li>
				@if(isset($customer))
				<a href="{{url('client-messages/'.$customer->id)}}">
				@else
				<a href="javascript:;">
				@endif
				<i class="icon-rocket"></i>
				<span class="title">Messages</span>
				<span class="arrow "></span>
				</a>
			</li>
			<!-- BEGIN FRONTEND THEME LINKS -->
			<li>
				@if(isset($customer))
				<a href="{{ url('clients/opportunities/'.$customer->id) }}">
				@else
				<a href="javascript:;">
				@endif
				<i class="icon-star"></i>
				<span class="title">Opportunities</span>
				<span class="arrow">
				</span>
				</a>
			</li>
			<!-- END FRONTEND THEME LINKS -->
			<li>
				<a href="javascript:;">
				<i class="icon-diamond"></i>
				<span class="title">Accounts</span>
				<span class="arrow "></span>
				</a>
			</li>
			<li>
				<a href="javascript:;">
				<i class="icon-puzzle"></i>
				<span class="title">Workflow/Tasks</span>
				<span class="arrow "></span>
				</a>
			</li>
			<li>
				<a href="javascript:;">
				<i class="icon-settings"></i>
				<span class="title">Live Documents</span>
				<span class="arrow "></span>
				</a>
			</li>
			@if(isset($customer))
			@foreach(Auth::user()->customtabs as $tab)
			<li>
				<a href="{{ url('clients/custom/'.$customer->id.'?custom='.$tab->id) }}">
				<i class="icon-logout"></i>
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
