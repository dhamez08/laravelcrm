@section('head-page-level-css')
@parent
	<link href="{{$asset_path}}/global/plugins/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet"/>
	<link href="{{$asset_path}}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" rel="stylesheet"/>
@stop

<div class="tab-pane{{(\Session::has('profile')) ? ((\Session::get('profile') == 'account-overview' ) ? ' active': '') : ' active' }}" id="tab_overview">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-unstyled profile-nav">
					<li>
						{{-- <img src="{{ \SocialMediaAccount\ProfileEntity::get_instance()->getPrimaryAvatar() }}" class="img-responsive" alt=""/> --}}
						@if($user->profile_image > 0)
			 				<img id="main-profile-pic" src="{{$user->profileImage()->where('id', $user->profile_image)->first()->image or url('public/img/profile_images/summary_person.png')}}" alt="profile pic" class="profilePic round-50 img-responsive"/>
						@else
							<img id="main-profile-pic" src="{{url('public/img/profile_images/summary_person.png')}}" alt="profile pic" class="profilePic round-50 img-responsive"/>
						@endif						
						<a href="#" data-toggle="modal" data-target=".userProfilePhoto" class="profile-edit">
						edit </a>
					</li>
					<li>
						<a href="#">
						Messages 
						</a>
					</li>
					<li>
						<a href="#" data-toggle="modal" data-target="#friendsModal">
						Friends (Group Users) <span>
						{{ count($sub_users) }} </span></a>
					</li>					
					<li>
						<a href="#">
						Workflows (disabled for now) </a>
					</li>

				</ul>
			</div>
			<div class="col-md-9">
				<div class="row">
					<div class="col-md-8 profile-info">
						<h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
						<p>
							 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam tincidunt erat volutpat.
						</p>
						<p>
							<a href="#">
							{{ $user->email }} </a>
						</p>
						<ul class="list-inline">
							<li>
								<i class="fa fa-map-marker"></i> {{ $user->address_town or 'N/A' }}
							</li>
							<li>
								<i class="fa fa-calendar"></i> {{ $user->birthdate or 'N/A' }}
							</li>
							<li>
								<i class="fa fa-briefcase"></i> {{ $user->occupation or 'N/A' }}
							</li>
							<li>
								<i class="fa fa-star"></i> {{ $user->company }}
							</li>
						</ul>
					</div>
					<!--end col-md-8-->
					<div class="col-md-4">
						<div class="portlet sale-summary">
							<div class="portlet-title">
								<div class="caption">
									 Sales Summary
								</div>
								<div class="tools">
									<a class="reload" href="javascript:;">
									</a>
								</div>
							</div>
							<div class="portlet-body">
								<ul class="list-unstyled">
									<li>
										<span class="sale-info">
										TODAY SOLD <i class="fa fa-img-up"></i>
										</span>
										<span class="sale-num">
										{{ $sales['count']['daily'] }} </span>
									</li>
									<li>
										<span class="sale-info">
										WEEKLY SALES <i class="fa fa-img-down"></i>
										</span>
										<span class="sale-num">
										{{ $sales['count']['weekly'] }} </span>
									</li>
									<li>
										<span class="sale-info">
										TOTAL SOLD THIS MONTH </span>
										<span class="sale-num">
										{{ $sales['count']['monthly'] }} </span>
									</li>
									<li>
										<span class="sale-info">
										SALES VALUE </span>
										<span class="sale-num">
										£{{ $sales['amount']['monthly'] }} </span>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<!--end col-md-4-->
				</div>
				<!--end row-->
				<div class="tabbable tabbable-custom tabbable-custom-profile">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_1_11" data-toggle="tab">
							Latest Customers </a>
						</li>
						<li>
							<a href="#tab_1_22" data-toggle="tab">
							Feeds </a>
						</li>
					</ul>
					<div class="tab-content">

						<div class="col-md-12">
							<div class="btn-group pull-right">
							<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
							</button>
							<ul class="dropdown-menu pull-right">
								<li>
									<a href="#">
									Print </a>
								</li>
								<li>
									<a href="#">
									Save as PDF </a>
								</li>
								<li>
									<a href="#">
									Export to Excel </a>
								</li>
							</ul>
							</div>
						</div>

						<div class="tab-pane active" id="tab_1_11">
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-advance table-hover table-scrollable">
								<thead>
								<tr>
									<th>
										<i class="fa fa-briefcase"></i> Client
									</th>
									<th class="hidden-xs">
										<i class="fa fa-question"></i> Description
									</th>
									<th>
										<i class="fa fa-bookmark"></i> Amount
									</th>
									<th>
										Status
									</th>
								</tr>
								</thead>
								<tbody class="tbody-scrollable">
								@foreach($opportunities as $opportunity)
								<?php $client = \Clients\Clients::find($opportunity->customer_id) ?>
								<tr>
									<td>
										<a href="{{ url('clients/client-summary/' . $client->id) }}">
										{{ $client->first_name }} {{ $client->last_name }} </a>
									</td>
									<td class="hidden-xs">
										 {{ $opportunity->name }}
									</td>
									<td>
										 £{{ $opportunity->value }}
									</td>
									<td>
										{{ $opportunity->status ? 'Closed' : 'Open' }} / {{ $opportunity->milestone }}
									</td>
								</tr>
								@endforeach
								</tbody>
								</table>
							</div>
						</div>
						<!--tab-pane-->
						<div class="tab-pane" id="tab_1_22">
							<div class="tab-pane active" id="tab_1_1_1">
								<div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
									<ul class="feeds">
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-success">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 You have 4 pending tasks. <span class="label label-danger label-sm">
															Take action <i class="fa fa-share"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 Just now
												</div>
											</div>
										</li>
										<li>
											<a href="#">
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-success">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New version v1.4 just lunched!
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 20 mins
												</div>
											</div>
											</a>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-danger">
															<i class="fa fa-bolt"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Database server #12 overloaded. Please fix the issue.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 24 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 30 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-success">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 40 mins
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-warning">
															<i class="fa fa-plus"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New user registered.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 1.5 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-success">
															<i class="fa fa-bell-o"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Web server hardware needs to be upgraded. <span class="label label-inverse label-sm">
															Overdue </span>
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 2 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 3 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-warning">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 5 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 18 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 22 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 22 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 22 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-default">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 21 hours
												</div>
											</div>
										</li>
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-info">
															<i class="fa fa-bullhorn"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 New order received. Please take care of it.
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 22 hours
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!--tab-pane-->
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

@include( \DashboardEntity::get_instance()->getView() . '.profile.modals.friends' )
@include( \DashboardEntity::get_instance()->getView() . '.profile.modals.uploadProfilePhoto' )

	@section('footer-custom-js')
		@parent
		<script src="{{$asset_path}}/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="{{$asset_path}}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.table-scrollable').dataTable({
					scrollY: '355px',
					paging: false,
					info: false,
					searching: false,
					ordering: false
				});
			});
		</script>
	@stop
