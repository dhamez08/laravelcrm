<div class="page-sidebar-wrapper">
	<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
	<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
	<div class="page-sidebar navbar-collapse main-navbar-collapse collapse" style="">
		<!-- BEGIN SIDEBAR MENU -->
		<ul data-slide-speed="200" data-auto-scroll="true" class="page-sidebar-menu page-sidebar-menu-light page-sidebar-menu-hover-submenu">
			<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="classic-menu-dropdown {{\Request::is('dashboard') ? 'active':''}}">
                <a href="{{url('dashboard')}}">
                    <i class="fa fa-home"></i>  Dashboard
                    @if( \Request::is('dashboard') )
				<span class="selected">
				</span>
                    @endif
                </a>
            </li>
            <li class="classic-menu-dropdown {{\Request::is('clients*') ? 'active':''}}">
                <a href="{{url('clients')}}">
                    <i class="fa fa-users"></i>  Clients
                    @if( \Request::is('clients*') )
				<span class="selected">
				</span>
                    @endif
                </a>
            </li>
            <li class="classic-menu-dropdown {{\Request::is('calendar*') || \Request::is('task*') ? 'active':''}}">
                <a href="{{url('calendar')}}">
                    <i class="fa fa-calendar"></i>  Calendar
                    @if( \Request::is('calendar*') || \Request::is('task*') )
				<span class="selected">
				</span>
                    @endif
                </a>
            </li>
            <li class="classic-menu-dropdown {{\Request::is('pipeline*') ? 'active':''}}">
                <a href="{{url('pipeline')}}">
                    <i class="fa fa-bar-chart-o"></i>  Sales Pipeline
                    @if( \Request::is('pipeline*') )
				<span class="selected">
				</span>
                    @endif
                </a>
            </li>
            <li class="classic-menu-dropdown {{\Request::is('document-library*') ? 'active':''}}">
                <a href="{{url('document-library')}}">
                    <i class="fa fa-briefcase"></i>  Document Library
                    @if( \Request::is('document-library*') )
				<span class="selected">
				</span>
                    @endif
                </a>
            </li>
            <li class="classic-menu-dropdown">
                <a href="{{url('marketing')}}">
                    <i class="fa fa-bullseye"></i>  Marketing
                    @if( \Request::is('marketing*') )
					<span class="selected">
					</span>
                    @endif
                </a>
            </li>
            <li class="classic-menu-dropdown">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>  Accounting
                </a>
            </li>
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
