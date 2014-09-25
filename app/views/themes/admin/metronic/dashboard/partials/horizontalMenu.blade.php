<!-- BEGIN HORIZANTAL MENU -->
<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
<!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) sidebar menu below. So the horizontal menu has 2 seperate versions -->
<div class="hor-menu hor-menu-light hidden-sm hidden-xs">
	<ul class="nav navbar-nav">
		<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
		<li class="classic-menu-dropdown active">
			<a href="index_3.html">
			<i class="fa fa-home"></i>  Dashboard <span class="selected">
			</span>
			</a>
		</li>
		<li class="classic-menu-dropdown">
			<a href="{{url('clients')}}">
			<i class="fa fa-users"></i>  Clients
			</a>
		</li>
		<li class="classic-menu-dropdown">
			<a href="index_3.html">
			<i class="fa fa-calendar"></i>  Calendar
			</a>
		</li>
		<li class="classic-menu-dropdown">
			<a href="index_3.html">
			<i class="fa fa-bar-chart-o"></i>  Sales Pipeline
			</a>
		</li>
		<li class="classic-menu-dropdown">
			<a href="{{url('document-library')}}">
			<i class="fa fa-briefcase"></i>  Document Library
			</a>
		</li>
		<li class="classic-menu-dropdown">
			<a href="index_3.html">
			<i class="fa fa-bullseye"></i>  Marketing
			</a>
		</li>
		<li class="classic-menu-dropdown">
			<a href="index_3.html">
			<i class="fa fa-file-text-o"></i>  Accounting
			</a>
		</li>
	</ul>
</div>
<!-- END HORIZANTAL MENU -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a data-target=".navbar-collapse" data-toggle="collapse" class="menu-toggler responsive-toggler" href="javascript:;">
</a>
<!-- END RESPONSIVE MENU TOGGLER -->
