<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title tabbable-line">
		<div class="caption font-green-sharp">
			<i class="fa fa-list font-green-sharp"></i>
			<span class="caption-subject bold uppercase">Activity </span>
		</div>
		<div class="actions pull-left" style="margin-left: 5px;">
			<a
				class="btn btn-circle btn-sm green-meadow openModal"
				data-toggle="modal"
				data-target=".ajaxModal"
				href="{{action('Notes\NotesController@getAjaxCreateInput', array('customerid'=>$customerId))}}">
			<i class="fa fa-plus"></i> Add Note </a>
		</div>
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#notes" data-toggle="tab">Notes </a>
			</li>
			<li class="">
				<a href="#messages" data-toggle="tab">Messages </a>
			</li>
			<li class="">
				<a href="#invoices" data-toggle="tab">Invoices </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body tabbable-line">
		<div class="tab-content">
			<div class="tab-pane active" id="notes">
				<div class="scroller" style="height:366px">
					{{\Notes\NotesController::get_instance()->getIndex($customerId,'')}}
				</div>
			</div>
			<div class="tab-pane" id="messages">
				<div class="scroller" style="height:366px">
					{{\Messages\MessagesController::get_instance()->getMessagesByCustomer($customerId)}}
				</div>
			</div>
			<div class="tab-pane" id="recent-activity">
				<div class="scroller" style="height:366px">
					<ul class="feeds">
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-shopping-cart"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc">
											 New order received with <span class="label label-sm label-success">
												Reference Number: DR23923 </span>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date">
									 30 min
								</div>
							</div>
						</li>
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-bar-chart-o"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc">
											 Finance Report for year 2013 has been released.
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date">
									 3 min
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="tab-pane" id="invoices">
				<div class="scroller" style="height:366px">
					<ul class="feeds">
						<li>
							<div class="col1">
								<div class="cont">
									<div class="cont-col1">
										<div class="label label-sm label-info">
											<i class="fa fa-shopping-cart"></i>
										</div>
									</div>
									<div class="cont-col2">
										<div class="desc">
											 <a href="#" title="Open Invoice">1000000001</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col2">
								<div class="date">
									 30 min
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
