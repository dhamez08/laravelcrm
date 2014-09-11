<ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
	<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
	<li class="sidebar-toggler-wrapper">
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		<div class="sidebar-toggler">
		</div>
		<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
	</li>
	<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
	<li><p></p></li>
	<li class="start">
		<a href="{{url('dashboard')}}">
			<i class="fa fa-home"></i>
			<span class="title">Dashboard</span>
			<span class="selected"></span>
		</a>
	</li>
	<li>
		<a href="javascript:;">
			<i class="fa fa-cogs"></i>
			<span class="title">Website</span>
			<span class="arrow "></span>
		</a>
		<ul class="sub-menu">
			<li>
				<a href="{{url('dashboard/website/create')}}">Create Website</a>
			</li>
			<li>
				<a href="{{url('dashboard/website')}}">View All Website</a>
			</li>
		</ul>
	</li>
</ul>
