@include($view_path.'.clients.partials.modals.sendemail-modal')
<div class="panel panel-default" style="padding-bottom:0px;">
	<div class="panel-body" style="padding-bottom:0px;">
		 <div class="row">
		 	<div class="col-md-12">
			 	<a href="#" class="pull-left" title="">
					<i class="icon-tag"></i>
				</a>
				<a href="{{action('Clients\ClientsController@getEdit',array('clientId'=>$customer->id))}}" class="pull-right" title="Edit Profile Information">
					<i class="icon-pencil"></i>
				</a>
			</div>
		 	<div class="col-md-12 summary-profile-pic text-center">
		 		<img src="{{$asset_path . '/pages/media/profile/profile.jpg'}}" alt="profile pic" class="profilePic round-50"/>
		 	</div>
		 	<div class="col-md-12">
		 		<div class="description">
			 		<p>{{$currentClient->displayCustomerName()}}</p>
			 		@if( $belongToPartner )
						@if( $belongToPartner->type == 2 )
							<span>{{$customer->job_title}} at </span>
							<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$belongToPartner->id))}}">
								{{$belongToPartner->company_name}}
							</a>
						@else
							<span>{{$customer->relationship}} of </span>
							<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$belongToPartner->id))}}">
							{{$belongToPartner->first_name}} {{$belongToPartner->last_name}}
							</a>
						@endif
			 		@endif
			 		<div class="clearfix"></div>
		 		</div>
		 		<div class="row text-center btnprofile">
		 			<div class="col-md-12">
		 				<a href="#" class="btn btn-sm green-meadow round-10">SMS</a>
		 				<a href="{{ url('email/client/'.$customer->id.'?back='.Request::url()) }}" class="btn btn-sm red round-10">Email</a>
		 			</div>
		 		</div>
		 		<ul class="client-social-icons hide">
		 			<li><i class="fa fa-twitter"></i></li>
		 		</ul>
		 	</div>
		 </div>
		 <div class="clearfix"></div>
		 <div class="row">
		 	<div class="profilemenu">
		 		<a class="client_menu" href="#personalinformation">
			 			<i class="icon-emoticon-smile"></i>
			 			Personal Information
			 	</a>
			 	<div id="personalinformation" class="hide">
			 		<div class="row">
					 	<div class="col-md-12">
					 		<div class="form-body client-detail">
					 			<div class="form-group">
									@if( $email->count() > 0 )
										@foreach($email->get() as $mail)
											<p>
												<span class="label label-info" style="font-size:9px;">{{$mail->type}}</span>
												<a href="mailto:{{$mail->email}}?bcc=dropbox.13554456@123crm.co.uk&subject= **enter your subject here** [REF:{{$customer->ref}}]" target="_blank">
													@if( strlen($mail->email) > 15 )
														{{substr($mail->email,0,15)}}...
													@else
														{{$mail->email}}
													@endif
												</a>
											</p>
										@endforeach
									@endif
									@if( $telephone->count() > 0 )
										@foreach($telephone->get() as $phone)
											<p>
												<span class="label label-info" style="font-size:9px;">{{$phone->type}}</span>
												@if( $phone->type == 'Mobile' )
													<a
														class="openModal"
														data-toggle="modal"
														data-target=".ajaxModal"
														href="{{action('SMS\SMSController@getAjaxIndividualSendSms', array('customerid'=>$customer->id,'mobile_number'=>$phone->number))}}"
													>
														<i class="fa fa-phone"></i>
														{{$phone->number}}
													</a>
												@else
													<i class="fa fa-phone"></i>
													{{$phone->number}}
												@endif
											</p>
										@endforeach
									@endif
									<div>
										<span class="label label-info" style="font-size:9px;">{{$currentClient->type}} Address</span>
										{{$currentClient->displayHtmlAddress()}}

										<p class="form-control-static text-center">
											<a href="{{$currentClient->displayGoogleMapLink()}}" target="_blank">show on map</a>
											| 
											<a href="{{$currentClient->displayGoogleMapDirectionLink()}}" target="_blank">get directions</a>
										</p>
									</div>
									<div class="col-md-12">
										<p class="form-control-static">Date of Birth: <br><strong>{{$currentClient->displayDob('d/m/Y')}}</strong></p>
										<p class="form-control-static">Smoker: <br><strong>{{($currentClient->smoker == 1) ? 'Yes':'No'}}</strong></p>
										<p class="form-control-static">Marital Status: <br><strong>{{$currentClient->marital_status}}</strong></p>
										<p class="form-control-static">Living Status: <br><strong>{{$currentClient->living_status}}</strong></p>
										<p class="form-control-static">Employment Status: <br><strong>{{$currentClient->employment_status}}</strong></p>
										<p class="form-control-static">Occupation: <br><strong>{{$currentClient->job_title}}</strong></p>
			                    	</div>
			                    </div>
			                </div>
			            </div>
					 </div>
			 	</div>
			 	<a href="#family" class="client_menu">
			 			<i class="icon-heart"></i>
			 			Family
			 	</a>
			 	<div id="family" class="hide">
			 		<div class="row">
					 	<div class="col-md-12">
					 		<div class="form-body client-detail">
					 			<table class="table table-hover">
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
								<p class="form-control-static text-center">
									<a href="{{action('Clients\ClientsController@getAddFamilyPerson',array('clientId'=>$customer->id))}}">
										<i class="fa fa-plus-circle"></i>
										Create New Person
									</a>
								</p>
					 		</div>
					 	</div>
					 </div>
			 	</div>
			 	<a href="#customfields" class="client_menu">
			 			<i class="icon-note"></i>
			 			Custom Fields
			 	</a>
			 	<div id="customfields" class="hide">
			 		<div class="row">
					    <div class="col-md-12">
					        <div class="form-body client-detail">
					        	<div class="col-md-12">
						            @if($customFields->get()->count()>0)
						                @foreach($customFields->get() as $field)
						                    <p class="form-control-static">{{ $field->field->label }}: <br><strong>{{ $field->value }}</strong></p>
						                @endforeach
						            @endif
					            </div>
					 		</div>
					 	</div>
					 </div>
			 	</div>
			 	<a href="#tasklist" class="client_menu">
			 			<i class="icon-list"></i>
			 			Tasks
			 	</a>
			 	<div id="tasklist" class="hide">

			 	</div>
		 	</div>
		 </div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<a href="#" class="col-sm-4 text-center">
				<div class="text-success counter text-center">3</div>
				<div class="counter_label text-center">Projects</div>
			</a>
			<a href="#" class="col-sm-4 text-center">
				<div class="text-success counter text-center">1</div>
				<div class="counter_label text-center">Tasks</div>
			</a>
			<a href="#" class="col-sm-4 text-center">
				<div class="text-success counter text-center">7</div>
				<div class="counter_label text-center">Uploads</div>
			</a>
		</div>
		<hr />
		<div class="row">
			<div class="col-md-12">
				<h4>About {{$currentClient->displayCustomerName()}}</h4>
				<p style="align:justify;">
					{{$currentClient->background_info}}
				</p>
			</div>

		</div>
		<div class="row">
			<div class="col-md-12">
				<ul class="profile-social-links">
					@if( $url->count() > 0 )
						@foreach($url->get() as $urls)
							@if( in_array($urls->website,array_flatten(\Config::get('crm.website_for'))))
								<li><a href="{{$urls->url}}" target="_blank">
									@if(strtolower(trim($urls->website,'+')) == 'website')
										<i class="fa fa-globe"></i>
										{{$urls->url}}
									@else
										<i class="fa fa-{{strtolower(trim($urls->website,'+'))}}"></i>
										{{preg_replace("/([A-Za-z0-9]\.|)[A-Za-z0-9]+?\.([A-Za-z0-9]{3})/",".",$urls->url)}}
									@endif
								</a></li>
							@endif
						@endforeach
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>
