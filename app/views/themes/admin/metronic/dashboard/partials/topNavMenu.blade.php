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
			@if(\CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser(((isset($clientId))? $clientId :NULL),\Auth::id())['due']->today > 0)
			 	<span class="badge badge-default">
			 		{{\CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser()['due']->today}}
				</span>
			@endif
			</a>
			<ul class="dropdown-menu extended tasks">
				<li>
					<p>
						@if(\CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser(((isset($clientId))? $clientId :NULL),\Auth::id())['due']->today > 0)
						 You have {{\CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser(((isset($clientId))? $clientId :NULL),\Auth::id())['due']->today}} tasks reminder
						@else
						 You dont have a pending tasks.
						@endif
					</p>
				</li>
				<li>
					<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;"><ul style="overflow: hidden; width: auto; height: auto;" class="dropdown-menu-list scroller" data-initialized="1">
						@if(\CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser(((isset($clientId))? $clientId :NULL),\Auth::id())['due']->today > 0)
							@foreach(\CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser(((isset($clientId))? $clientId :NULL),\Auth::id())['data'] as $dueTasks)
								@if($dueTasks->isReminded())
									<li>
										<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$dueTasks->id,'customerid'=>$dueTasks->customer_id,'redirect'=>'task'))}}">
										<span class="task">
											<span class="desc">
												{{$dueTasks->displayHtmlTaskDue()}}
												{{$dueTasks->displayHtmlLabelIcon()}}
												<br />
												{{$dueTasks->displayName()}}
												<br />
												{{$dueTasks->displayTaskFullName()}}
											</span>
										</span>
										</a>
									</li>
								@endif
							@endforeach
						@endif
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

			@if(isset($customer) && $customer->profile_image > 0)
				<img src="{{\CustomerProfileImages\CustomerProfileImages::where('id',$customer->profile_image)->first()->image}}" alt="Avatar" class="img-circle round-50"/>
			@else
				<img src="{{url('public/img/profile_images/profile.jpg')}}" alt="Avatar" class="img-circle round-50"/>
			@endif

			<span class="username username-hide-on-mobile">
				{{isset($currentClient) ? $currentClient->displayCustomerName(): 'Guest'}}
			</span>
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
