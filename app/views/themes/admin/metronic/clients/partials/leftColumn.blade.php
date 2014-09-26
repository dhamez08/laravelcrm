<div class="panel panel-default">
	<!--
	<div class="panel-heading">
		 Panel heading without title
	</div>
	-->
	<div class="panel-body">
		 <div class="row">
		 	<div class="col-md-3"><img src="../../assets/admin/layout/img/avatar.png" /></div>
		 	<div class="col-md-9">
		 		<p>{{$currentClient->displayCustomerName()}}</p>
		 		<ul class="client-social-icons">
		 			<li><i class="fa fa-twitter"></i></li>
		 		</ul>
		 	</div>
		 </div>
		 <div class="clearfix"></div>
		 <div class="row">
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
		 			<div class="form-group">
						<p class="form-control-static">steve.warden1@btopenworld.com <span class="label label-success">Home</span></p>
						<p class="form-control-static">steve.warden@finleyjacobs.co.uk <span class="label label-info">Work</span></p>
						<p class="form-control-static">http://www.finleyjacobs.co.uk <span class="label label-info">Work</span></p>
						<p class="form-control-static"><i class="fa fa-skype"></i> 0800 5837288 <span class="label label-info">Work</span></p>
						<p class="form-control-static"><i class="fa fa-skype"></i> 01455 888622 <span class="label label-success">Work</span></p>
						<p class="form-control-static">07453322941 <span class="label label-warning">Mobile</span></p>
						<p class="form-control-static">{{$currentClient->displayCustomerAddress()}}</p>
						<p class="form-control-static">
							<a href="{{$currentClient->displayGoogleMapLink()}}" target="_blank">show on map</a>
							| <a href="{{$currentClient->displayGoogleMapDirectionLink()}}" target="_blank">get directions</a>
						</p>
						<p class="form-control-static">Date of Birth: <strong>{{$currentClient->displayDob()}}</strong></p>
						<p class="form-control-static">Marital Status: <strong>{{$currentClient->marital_status}}</strong></p>
						<p class="form-control-static">Employment Status: <strong>{{$currentClient->employment_status}}</strong></p>
						<p class="form-control-static">Occupation: <strong>{{$currentClient->job_title}}</strong></p>
						<p class="form-control-static"><a href="#">Edit client information</a></p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <hr/>
		 <div class="row">
		 	<div class="col-md-12">
		 		<div class="form-body client-detail" style="display:none">
		 			<div class="form-group">
		 				<p class="form-control-static">Something: <strong>Something</strong></p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <hr/>
		 <div class="row">
		 	<div class="col-md-12">
		 		<h5><strong>Family</strong></h5>
		 		<div class="form-body client-detail">
		 			<div class="form-group">
		 				<p class="form-control-static"><strong>Karen Warden</strong> - 02/11/1978 - Spouse/Partner</p>
		 				<p class="form-control-static"><strong>Finley Warden</strong> - 29/09/2011 - Son</p>
		 				<p class="form-control-static"><strong>Neve Summer Warden</strong> - 20/06/2014 - Spouse/Partner</p>
		 				<p class="form-control-static"><a href="#"><i class="fa fa-plus-circle"></i> Create new person</a></p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <hr/>
		 <div class="row">
		 	<div class="col-md-12">
		 		<h5><strong>Background Information</strong></h5>
		 		<div class="form-body client-detail">
		 			<div class="form-group">
		 				<p class="form-control-static"><a href="#">Edit background information</a></p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
	</div>
</div>
