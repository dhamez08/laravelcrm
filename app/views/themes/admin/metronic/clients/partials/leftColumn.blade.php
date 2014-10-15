<div class="panel panel-default">
	<!--
	<div class="panel-heading">
		 Panel heading without title
	</div>
	-->
	<div class="panel-body">
		 <div class="row">
		 	<div class="col-md-3">
		 		<img src="{{$asset_path . '/global/img/summary_person.png'}}" alt="profile pic" class="profilePic"/>
		 	</div>
		 	<div class="col-md-9">
		 		<p>{{$currentClient->displayCustomerName()}}</p>
		 		@if( $belongToPartner )
					@if( $belongToPartner->type == 2 )
						<span>{{$customer->job_title}} at
						<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$belongToPartner->id))}}">
							{{$belongToPartner->company_name}}
						</a>
						</span>
					@else
						<p>{{$customer->relationship}} of </p>
						<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$belongToPartner->id))}}">
						{{$belongToPartner->first_name}} {{$belongToPartner->last_name}}
						</a>
					@endif
		 		@endif
		 		<ul class="client-social-icons hide">
		 			<li><i class="fa fa-twitter"></i></li>
		 		</ul>
		 	</div>
		 </div>
		 <div class="clearfix"></div>
		 <div class="row">
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
		 			<div class="form-group">
						<p></p>
						@if( $url->count() > 0 )
							@foreach($url->get() as $urls)
								<p>
									<i class="fa fa-cloud"></i>
									<a href="{{$urls->url}}" target="_blank">{{$urls->url}}</a>
									<span class="label label-info" style="font-size:9px;">{{$urls->type}}</span>
								</p>
							@endforeach
						@endif
						@if( $email->count() > 0 )
							@foreach($email->get() as $mail)
								<p>
									<i class="fa fa-envelope"></i>
									<a href="mailto:{{$mail->email}}" target="_blank">{{$mail->email}}</a>
									<span class="label label-info" style="font-size:9px;">{{$mail->type}}</span>
								</p>
							@endforeach
						@endif
						@if( $telephone->count() > 0 )
							@foreach($telephone->get() as $phone)
								<p>
									<i class="fa fa-phone"></i>
									{{$phone->number}}
									<span class="label label-info" style="font-size:9px;">{{$phone->type}}</span>
								</p>
							@endforeach
						@endif
						<address>{{$currentClient->displayCustomerAddress()}}</address>
						<p class="form-control-static">
							<a href="{{$currentClient->displayGoogleMapLink()}}" target="_blank">show on map</a>
							| <a href="{{$currentClient->displayGoogleMapDirectionLink()}}" target="_blank">get directions</a>
						</p>
						<p class="form-control-static">Date of Birth: <strong>{{$currentClient->displayDob('l jS \\of F Y')}}</strong></p>
						<p class="form-control-static">Smoker: <strong>{{($currentClient->smoker == 1) ? 'Yes':'No'}}</strong></p>
						<p class="form-control-static">Marital Status: <strong>{{$currentClient->marital_status}}</strong></p>
						<p class="form-control-static">Living Status: <strong>{{$currentClient->living_status}}</strong></p>
						<p class="form-control-static">Employment Status: <strong>{{$currentClient->employment_status}}</strong></p>
						<p class="form-control-static">Occupation: <strong>{{$currentClient->job_title}}</strong></p>
						<p class="form-control-static"><a href="{{action('Clients\ClientsController@getEdit',array('clientId'=>$customer->id))}}">Edit client information</a></p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <hr/>
		 <div class="row">
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
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
		 			<table class="table table-hover">
					  <thead>
						<tr>
						  <th></th>
						  <th></th>
						</tr>
					  </thead>
					  <tbody>
						  @if( $customer->customerAssociatedTo($customer->id)->count() > 0 )
							@foreach( $customer->customerAssociatedTo($customer->id)->get() as $family )
								<tr>
									<td>
										@if( $family->relationship == 'Spouse/Partner' )
												<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$family->id))}}">
													<strong>
														{{($family->partner_title == '' ) ? $family->title:$family->partner_title}}
														{{($family->partner_first_name == '') ? $family->first_name:$family->partner_first_name}}
														{{($family->partner_last_name == '') ? $family->last_name:$family->partner_last_name}}
													</strong>
												</a>
												- {{$currentClient->parseDate($family->partner_dob)}} - {{$family->relationship}}
										@else
												<strong>{{$family->first_name.' '.$family->last_name}}</strong>
												- {{$currentClient->parseDate($family->dob)}} - {{$family->relationship}}
										@endif
									<td>
									<td>
										<a 	class="btn red btn-sm deletePerson"
											href="{{
												action(
													'Clients\ClientsController@getConfirmPersonDelete',
													array(
														'id'=>$family->id,
														'client'=>$currentClient->id,
														'hash'=>($family->id . csrf_token())
													)
												)
											}}"
										>
											<i class="fa fa-trash-o fa-5x"></i>
										</a>
									</td>
								</tr>
							@endforeach
		 				@endif
						</tr>
					  </tbody>
					</table>
		 		</div>
		 	</div>
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
		 			<div class="form-group">
		 				<p class="form-control-static">
							<a href="{{action('Clients\ClientsController@getAddFamilyPerson',array('clientId'=>$customer->id))}}">
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
