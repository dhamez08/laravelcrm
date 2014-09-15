<div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			@include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.taskPortlet' )
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<!-- BEGIN PORTLET-->

			<!-- END PORTLET-->
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12">
			<!-- BEGIN PORTLET-->

			<!-- END PORTLET-->
			</div>
		</div>
	</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat blue-madison">
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat red-intense">

			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat green-haze">

			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="dashboard-stat purple-plum">

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12">

		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<!-- BEGIN PORTLET-->
			<div class="portlet box blue-madison calendar">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-calendar"></i>Calendar
					</div>
				</div>
				<div class="portlet-body light-grey">
					<div id="calendar"></div>
					</div>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>
</div>
