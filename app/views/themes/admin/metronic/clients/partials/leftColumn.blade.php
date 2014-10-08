<div class="panel panel-default">
	<!--
	<div class="panel-heading">
		 Panel heading without title
	</div>
	-->
	<div class="panel-body">
		 <div class="row">
		 	<div class="col-md-3">
		 		@if( $currentClient->type == 1 )
		 		@elseif($currentClient->type == 2)
		 		@endif
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
												'client'=>$currentClient->id,
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
												'client'=>$currentClient->id,
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
									{{$phone->number}}
									<span class="label label-info" style="font-size:9px;">{{$phone->type}}</span>
									<a
										href="{{
											action('Clients\ClientsController@getConfirmPhoneDelete',
											array(
												'id'=>$phone->id,
												'client'=>$currentClient->id,'hash'=>($phone->id . csrf_token()))
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
						<p class="form-control-static">Date of Birth: <strong>{{$currentClient->displayDob()}}</strong></p>
						<p class="form-control-static">Marital Status: <strong>{{$currentClient->marital_status}}</strong></p>
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
		 			<div class="form-group">
		 				@if( $customer->customerAssociatedTo($customer->id)->count() > 0 )
							@foreach( $customer->customerAssociatedTo($customer->id)->get() as $family )
								@if( $family->relationship == 'Spouse/Partner' )
									<p class="form-control-static">
										<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$family->id))}}">
											<strong>
												xxx
												{{($family->partner_title == '' ) ? $family->title:$family->partner_title}}
												{{($family->partner_first_name == '') ? $family->first_name:$family->partner_first_name}}
												{{($family->partner_last_name == '') ? $family->last_name:$family->partner_last_name}}
											</strong>
										</a>
										- {{$currentClient->parseDate($family->partner_dob)}} - {{$family->relationship}}
								@else
									<p class="form-control-static">
										<strong>{{$family->first_name.' '.$family->last_name}}</strong>
										- {{$currentClient->parseDate($family->dob)}} - {{$family->relationship}}
								@endif
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
								</p>
							@endforeach
		 				@endif
		 			</div>
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
