<!-- BEGIN TOP NAVIGATION MENU -->
<div class="top-menu">
	<ul class="nav navbar-nav pull-right">
		<!-- BEGIN NOTIFICATION DROPDOWN -->
		<li id="header_notification_bar" class="dropdown dropdown-extended dropdown-notification">
			<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
			<i class="icon-bell"></i>
			<span class="badge badge-default">
			7 </span>
			</a>
			<ul class="dropdown-menu">
				<li>
					<p>
						 You have 14 new notifications
					</p>
				</li>
				<li>
					<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="overflow: hidden; width: auto; height: 250px;" class="dropdown-menu-list scroller" data-initialized="1">
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-success">
							<i class="fa fa-plus"></i>
							</span>
							New user registered. <span class="time">
							Just now </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-danger">
							<i class="fa fa-bolt"></i>
							</span>
							Server #12 overloaded. <span class="time">
							15 mins </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-warning">
							<i class="fa fa-bell-o"></i>
							</span>
							Server #2 not responding. <span class="time">
							22 mins </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-info">
							<i class="fa fa-bullhorn"></i>
							</span>
							Application error. <span class="time">
							40 mins </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-danger">
							<i class="fa fa-bolt"></i>
							</span>
							Database overloaded 68%. <span class="time">
							2 hrs </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-danger">
							<i class="fa fa-bolt"></i>
							</span>
							2 user IP blocked. <span class="time">
							5 hrs </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-warning">
							<i class="fa fa-bell-o"></i>
							</span>
							Storage Server #4 not responding. <span class="time">
							45 mins </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-info">
							<i class="fa fa-bullhorn"></i>
							</span>
							System Error. <span class="time">
							55 mins </span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="label label-sm label-icon label-danger">
							<i class="fa fa-bolt"></i>
							</span>
							Database overloaded 68%. <span class="time">
							2 hrs </span>
							</a>
						</li>
					</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
				</li>
				<li class="external">
					<a href="#">
					See all notifications <i class="m-icon-swapright"></i>
					</a>
				</li>
			</ul>
		</li>
		<!-- END NOTIFICATION DROPDOWN -->
		<!-- BEGIN INBOX DROPDOWN -->
		<li id="header_inbox_bar" class="dropdown dropdown-extended dropdown-inbox">
			<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" onclick="window.location='{{ url('messages/inbox') }}'">
			<i class="icon-envelope-open"></i>
			@if(\Message\MessageEntity::get_instance()->getUnreadMessagesCount())
			<span class="badge badge-default">{{ \Message\MessageEntity::get_instance()->getUnreadMessagesCount() }}</span>
			@endif
			</a>
			<ul class="dropdown-menu">
				@if(\Message\MessageEntity::get_instance()->getUnreadMessagesCount())
				<li>
					<p>
						 You have {{ \Message\MessageEntity::get_instance()->getUnreadMessagesCount() }} new messages
					</p>
				</li>
				@elseif(count(\Message\MessageEntity::get_instance()->listAllMessages())>0)
				<li>
					<p>
						 You have {{ count(\Message\MessageEntity::get_instance()->listAllMessages()) }} messages
					</p>
				</li>
				@else
				<li>
					<p>
						 You have no message yet
					</p>
				</li>
				@endif
				@if(count(\Message\MessageEntity::get_instance()->listAllMessages())>0)
				<li>
					<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto; max-height:250px"><ul style="overflow: hidden; width: auto; height: auto;" class="dropdown-menu-list scroller" data-initialized="1">
					@foreach(\Message\MessageEntity::get_instance()->listAllMessages() as $message)
						<li>
							<a href="{{ url('messages/view?message_id='.$message->id) }}">
							<span class="photo">
							<img alt="" src="{{$asset_path}}/global/img/summary_person.png">
							</span>
							<span class="subject">
							<span class="from">{{ $message->sender }}</span>
							<span class="time">{{ date('d/m/Y h:i A', strtotime($message->added_date)) }}</span>
							</span>
							<span class="message">{{ \Str::words($message->body,10) }}</span>
							</a>
						</li>
					@endforeach
					</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
				</li>
				@endif
				<li class="external">
					<a href="{{ url('messages/inbox') }}">
					See all messages <i class="m-icon-swapright"></i>
					</a>
				</li>
			</ul>
		</li>
		<!-- END INBOX DROPDOWN -->
		<!-- BEGIN TODO DROPDOWN -->
		<li id="header_task_bar" class="dropdown dropdown-extended dropdown-tasks">
			<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
			<i class="icon-calendar"></i>
			<span class="badge badge-default">
			3 </span>
			</a>
			<ul class="dropdown-menu extended tasks">
				<li>
					<p>
						 You have 12 pending tasks
						 <button class="btn btn-info btn-xs pull-right"><i class="fa fa-plus"></i></button>
					</p>
				</li>
				<li>
					<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><ul style="overflow: hidden; width: auto; height: 250px;" class="dropdown-menu-list scroller" data-initialized="1">
						<li>
							<a href="#">
							<span class="task">
							<span class="desc">
							New release v1.2 </span>
							<span class="percent">
							30% </span>
							</span>
							<span class="progress">
							<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" class="progress-bar progress-bar-success" style="width: 40%;">
							<span class="sr-only">
							40% Complete </span>
							</span>
							</span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="task">
							<span class="desc">
							Application deployment </span>
							<span class="percent">
							65% </span>
							</span>
							<span class="progress progress-striped">
							<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" class="progress-bar progress-bar-danger" style="width: 65%;">
							<span class="sr-only">
							65% Complete </span>
							</span>
							</span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="task">
							<span class="desc">
							Mobile app release </span>
							<span class="percent">
							98% </span>
							</span>
							<span class="progress">
							<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="98" class="progress-bar progress-bar-success" style="width: 98%;">
							<span class="sr-only">
							98% Complete </span>
							</span>
							</span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="task">
							<span class="desc">
							Database migration </span>
							<span class="percent">
							10% </span>
							</span>
							<span class="progress progress-striped">
							<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="10" class="progress-bar progress-bar-warning" style="width: 10%;">
							<span class="sr-only">
							10% Complete </span>
							</span>
							</span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="task">
							<span class="desc">
							Web server upgrade </span>
							<span class="percent">
							58% </span>
							</span>
							<span class="progress progress-striped">
							<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="58" class="progress-bar progress-bar-info" style="width: 58%;">
							<span class="sr-only">
							58% Complete </span>
							</span>
							</span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="task">
							<span class="desc">
							Mobile development </span>
							<span class="percent">
							85% </span>
							</span>
							<span class="progress progress-striped">
							<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="85" class="progress-bar progress-bar-success" style="width: 85%;">
							<span class="sr-only">
							85% Complete </span>
							</span>
							</span>
							</a>
						</li>
						<li>
							<a href="#">
							<span class="task">
							<span class="desc">
							New UI release </span>
							<span class="percent">
							18% </span>
							</span>
							<span class="progress progress-striped">
							<span aria-valuemax="100" aria-valuemin="0" aria-valuenow="18" class="progress-bar progress-bar-important" style="width: 18%;">
							<span class="sr-only">
							18% Complete </span>
							</span>
							</span>
							</a>
						</li>
					</ul><div class="slimScrollBar" style="background: none repeat scroll 0% 0% rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; border-radius: 7px; z-index: 99; right: 1px; display: block;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: none repeat scroll 0% 0% rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
				</li>
				<li class="external">
					<a href="#">
					See all tasks <i class="m-icon-swapright"></i>
					</a>
				</li>
			</ul>
		</li>
		<!-- END TODO DROPDOWN -->
		<!-- BEGIN USER LOGIN DROPDOWN -->
		<li class="dropdown dropdown-user">
			<a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
			<img src="../../assets/admin/layout/img/avatar3_small.jpg" class="img-circle" alt="">
			<span class="username username-hide-on-mobile">
			Bob </span>
			<i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="{{url('profile')}}">
					<i class="icon-user"></i> My Profile </a>
				</li>
				<li>
					<a href="{{url('settings')}}">
					<i class="fa fa-gear"></i> Settings
					</a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="{{url('logout')}}">
					<i class="icon-key"></i> Log Out </a>
				</li>
			</ul>
		</li>
		<!-- END USER LOGIN DROPDOWN -->
		<!-- BEGIN QUICK SIDEBAR TOGGLER -->
		<li style="display:none" class="dropdown dropdown-quick-sidebar-toggler">
			<a class="dropdown-toggle" href="javascript:;">
			<i class="icon-logout"></i>
			</a>
		</li>
		<!-- END QUICK SIDEBAR TOGGLER -->
	</ul>
</div>
<!-- END TOP NAVIGATION MENU -->
