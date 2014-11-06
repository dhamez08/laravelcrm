<div class="sendemail">
	<a href="{{ url('email/client/'.$customer->id) }}" class="btn btn-sm btn-success sendemail"><i class="fa fa-envelope-o"></i> Send Email</a>
</div>
@include($view_path.'.clients.partials.modals.sendemail-modal')
<div class="panel panel-default">
	<!--
	<div class="panel-heading">
		 Panel heading without title
	</div>
	-->
	<div class="panel-body">
		 <div class="row">
		 	<div class="col-md-12">
		 		<img src="{{$asset_path . '/global/img/summary_person.png'}}" alt="profile pic" class="profilePic"/>
		 	</div>
		 	<div class="col-md-12">
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
								@if( in_array($urls->website,array_flatten(\Config::get('crm.website_for'))))
									<a href="{{$urls->url}}" target="_blank">
										@if(strtolower($urls->website) == 'website')
											<i class="fa fa-cloud fa-2x"></i>
										@else
											<i class="fa fa-{{strtolower($urls->website)}} fa-2x"></i>
										@endif
									</a>
								@endif
							@endforeach
						@endif
						@if( $email->count() > 0 )
							@foreach($email->get() as $mail)
								<p>
									<a href="mailto:{{$mail->email}}?bcc=dropbox.13554456@123crm.co.uk&subject= **enter your subject here** [REF:{{$customer->ref}}]" target="_blank">
										@if( strlen($mail->email) > 15 )
											{{substr($mail->email,0,15)}}...
										@else
											{{$mail->email}}
										@endif
									</a>
									<span class="label label-info" style="font-size:9px;">{{$mail->type}}</span>
								</p>
							@endforeach
						@endif
						@if( $telephone->count() > 0 )
							@foreach($telephone->get() as $phone)
								<p>
									<i class="fa fa-phone"></i>
									{{$phone->number}}
									@if( $phone->type == 'Mobile' )
										<a
											class="openModal"
											data-toggle="modal"
											data-target=".ajaxModal"
											href="{{action('SMS\SMSController@getAjaxIndividualSendSms', array('customerid'=>$customerId,'mobile_number'=>$phone->number))}}"
										>
											<span class="label label-info" style="font-size:9px;">{{$phone->type}}</span>
										</a>
									@else
										<span class="label label-info" style="font-size:9px;">{{$phone->type}}</span>
									@endif

								</p>
							@endforeach
						@endif
						{{$currentClient->displayHtmlAddress()}}
						<p class="form-control-static">
							<a href="{{$currentClient->displayGoogleMapLink()}}" target="_blank">show on map</a>
							| <a href="{{$currentClient->displayGoogleMapDirectionLink()}}" target="_blank">get directions</a>
						</p>
						<p class="form-control-static">Date of Birth: <br><strong>{{$currentClient->displayDob('d/m/Y')}}</strong></p>
						<p class="form-control-static">Smoker: <br><strong>{{($currentClient->smoker == 1) ? 'Yes':'No'}}</strong></p>
						<p class="form-control-static">Marital Status: <br><strong>{{$currentClient->marital_status}}</strong></p>
						<p class="form-control-static">Living Status: <br><strong>{{$currentClient->living_status}}</strong></p>
						<p class="form-control-static">Employment Status: <br><strong>{{$currentClient->employment_status}}</strong></p>
						<p class="form-control-static">Occupation: <br><strong>{{$currentClient->job_title}}</strong></p>
						<p class="form-control-static"><br><a href="{{action('Clients\ClientsController@getEdit',array('clientId'=>$customer->id))}}">Edit client information</a></p>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <hr/>
		 <div class="row">
			<div class="col-md-12">
				<div class="form-body client-detail">
					<div class="form-group">
						<h4>Tags</h4>
						{{\ClientTags\ClientTagsController::get_instance()->getClientTagWidget($customer->id)}}
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
												- {{$currentClient->parseDate($family->dob,'d/m/Y')}} - {{$family->relationship}}
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
