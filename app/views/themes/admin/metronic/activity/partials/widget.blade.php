<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-globe"></i>
			<span class="caption-subject bold uppercase">Activity </span>
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
