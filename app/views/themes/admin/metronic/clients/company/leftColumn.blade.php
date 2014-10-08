<div class="panel panel-default">
	<!--
	<div class="panel-heading">
		 Panel heading without title
	</div>
	-->
	<div class="panel-body">
		 <div class="row">
		 	<div class="col-md-3">
		 		<img src="{{$asset_path . '/global/img/summary_comp.png'}}" alt="profile pic" class="profilePic"/>
		 	</div>
		 	<div class="col-md-9">
		 		<p>{{$customer->company_name}}</p>
		 	</div>
		 </div>
		 <div class="clearfix"></div>
		 <div class="row">
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
		 			<div class="form-group">
						<p></p>
						@if( $url->count() > 0 )
							<ul class="list-unstyled">
								@foreach($url->get() as $urls)
									<li>
										<i class="fa fa-cloud"></i>
										<a href="{{$urls->url}}" target="_blank">{{$urls->url}}</a>
										<span class="label label-info" style="font-size:9px;">{{$urls->type}}</span>
										<a
											href="{{
												action('Clients\ClientsController@getConfirmUrlDelete',
												array(
													'id'=>$urls->id,
													'client'=>$customer->id,
													'hash'=>($urls->id . csrf_token()))
												)
											}}"
											class="btn red btn-xs deleteURL"
										>
												<i class="fa fa-trash-o fa-5x"></i>
										</a>
									</li>
								@endforeach
							</ul>
						@endif
						@if( $email->count() > 0 )
							<ul class="list-unstyled">
							@foreach($email->get() as $mail)
								<li>
									<i class="fa fa-envelope"></i>
									<a href="mailto:{{$mail->email}}" target="_blank">{{$mail->email}}</a>
									<span class="label label-info" style="font-size:9px;">{{$mail->type}}</span>
									<a
										href="{{
											action('Clients\ClientsController@getConfirmMailDelete',
											array(
												'id'=>$mail->id,
												'client'=>$customer->id,
												'hash'=>($mail->id . csrf_token()))
											)
										}}"
										class="btn red btn-xs deleteMail"
									>
										<i class="fa fa-trash-o fa-5x"></i>
									</a>
								</li>
							@endforeach
							</ul>
						@endif
						@if( $telephone->count() > 0 )
							<ul class="list-unstyled">
							@foreach($telephone->get() as $phone)
								<li>
									<i class="fa fa-phone"></i>
									{{$phone->number}} <span class="label label-info" style="font-size:9px;">{{$phone->type}}</span>
									<a
										href="{{
											action('Clients\ClientsController@getConfirmPhoneDelete',
											array(
												'id'=>$phone->id,
												'client'=>$customer->id,'hash'=>($phone->id . csrf_token()))
											)
										}}"
										class="btn red btn-xs deletePhone"
									>
										<i class="fa fa-trash-o fa-5x"></i>
									</a>
								</li>
							@endforeach
							</ul>
						@endif
						<p class="form-control-static">{{$currentClient->displayCustomerAddress()}}</p>
						<p class="form-control-static">
							<a href="{{$currentClient->displayGoogleMapLink()}}" target="_blank">show on map</a>
							| <a href="{{$currentClient->displayGoogleMapDirectionLink()}}" target="_blank">get directions</a>
						</p>
						<p class="form-control-static">Company Number: <strong>{{$currentClient->companyreg}}</strong></p>
						<p class="form-control-static">Number of Employees: <strong>{{$currentClient->companyemployee}}</strong></p>
						<p class="form-control-static">Industry Sector: <strong>{{$currentClient->sector}}</strong></p>
						<p class="form-control-static">
							<a href="{{action('Clients\ClientsController@getEditCompany',array('clientId'=>$customer->id))}}">
								Edit company information
							</a>
						</p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <hr/>
		 <div class="row hide">
		 	<div class="col-md-12">
		 		<div class="form-body client-detail" style="display:none">
		 			<div class="form-group">
		 				<p class="form-control-static">Something: <strong>Something</strong></p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-md-12">
		 		<h5>People working at <strong>{{$customer->company_name}}</strong></h5>
		 		<div class="form-body client-detail">
		 			<div class="form-group">
		 				@if( $customer->customerAssociatedTo($customer->id)->count() > 0 )
							@foreach( $customer->customerAssociatedTo($customer->id)->get() as $people )
									<p class="form-control-static">
										<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$people->id))}}">
											<strong>
												{{$people->title.' '.$people->first_name.' '.$people->last_name}}
											</strong>
										</a>
									</p>
									<p>{{$people->job_title}}</p>
									<a 	class="btn red btn-sm deletePerson"
										href="{{
											action(
												'Clients\ClientsController@getConfirmPersonDelete',
												array(
													'id'=>$people->id,
													'client'=>$currentClient->id,
													'hash'=>($people->id . csrf_token())
												)
											)
										}}"
									>
										<i class="fa fa-trash-o fa-5x"></i>
									</a>
							@endforeach
		 				@endif
		 			</div>
		 		</div>
		 	</div>
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
		 			<div class="form-group">
		 				<p class="form-control-static">
							<a href="{{action('Clients\ClientsController@getAddCompanyPerson',array('clientId'=>$customer->id))}}">
								<i class="fa fa-plus-circle"></i>
								Create New Person
							</a>
						</p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		  <hr/>
		 <div class="row">
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
		 			<div class="form-group">
		 				<h5><strong>Company Information</strong></h5>
		 				<p><strong>Company Name :</strong> {{$currentClient->displayCompanyDetails()->name}}</p>
		 				<p><strong>Company Number :</strong> {{$currentClient->displayCompanyDetails()->company_number}}</p>
		 				<p><strong>Registered Address :</strong> {{$currentClient->displayCompanyDetails()->registered_address}}</p>
		 				<p><strong>Category :</strong> {{$currentClient->displayCompanyDetails()->category}}</p>
		 				<p><strong>Trading Status :</strong> {{$currentClient->displayCompanyDetails()->status}}</p>
		 				<p><strong>Incorporation Date :</strong> {{$currentClient->displayCompanyDetails()->inc_date}}</p>
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
