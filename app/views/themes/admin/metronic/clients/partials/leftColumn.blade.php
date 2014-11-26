@include($view_path.'.clients.partials.modals.sendemail-modal')
<div class="panel panel-default" style="padding-bottom:0px;">
	<div class="panel-body" style="padding-bottom:0px;">
		 <div class="row">
		 	<div class="col-md-12">
			 	<a href="#" class="pull-left" title="Tags" id="toggle-client-tags">
					<i class="icon-tag"></i>
				</a>
				<a href="{{action('Clients\ClientsController@getEdit',array('clientId'=>$customer->id))}}" class="pull-right" title="Edit Profile Information">
					<i class="icon-pencil"></i>
				</a>
			</div>
		 	<div class="col-md-12 summary-profile-pic text-center">
				<a href="#" data-target=".socialProfile" data-toggle="modal" class="openModal">
					@if($customer->profile_image > 0)
		 				<img src="{{$profileImg->where('id',$customer->profile_image)->first()->image}}" alt="profile pic" class="profilePic round-50"/>
					@else
						<img src="{{url('public/img/profile_images/profile.jpg')}}" alt="profile pic" class="profilePic round-50"/>
					@endif
				</a>
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
		 				<?php $sms = ''; ?>
		 				@if( $telephone->count() > 0 )
							@foreach($telephone->get() as $phone)
								@if( $phone->type == 'Mobile' )
									<?php $sms = $phone->number; ?>
								@endif
							@endforeach
						@endif
		 				<a
							class="openModal btn btn-sm green-meadow round-10"
							data-toggle="modal"
							data-target=".ajaxModal"
							href="{{action('SMS\SMSController@getAjaxIndividualSendSms', array('customerid'=>$customer->id,'mobile_number'=>$sms))}}"
						>
		 				SMS</a>
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
			 	<div id="personalinformation" class="collapse-profile-menu hide">
			 		<div class="row">
					 	<div class="col-md-12">
					 		<div class="form-body client-detail">
					 			<div>
									<span class="label label-info" style="font-size:9px;">{{$currentClient->type}} Address</span>
									{{$currentClient->displayHtmlAddress()}}

									<p class="form-control-static text-center">
										<a href="{{$currentClient->displayGoogleMapLink()}}" target="_blank">show on map</a>
										|
										<a href="{{$currentClient->displayGoogleMapDirectionLink()}}" target="_blank">get directions</a>
									</p>
								</div>

								<hr style="padding:5px;" />

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
									<hr style="padding:5px;" />
									<div class="col-md-12">
										<p class="form-control-static">Date of Birth: <strong>{{$currentClient->displayDob('d/m/Y')}}</strong></p>
										<p class="form-control-static">Smoker: <strong>{{($currentClient->smoker == 1) ? 'Yes':'No'}}</strong></p>
										<p class="form-control-static">Marital Status: <strong>{{$currentClient->marital_status}}</strong></p>
										<p class="form-control-static">Living Status: <strong>{{$currentClient->living_status}}</strong></p>
										<p class="form-control-static">Employment Status: <strong>{{$currentClient->employment_status}}</strong></p>
										<p class="form-control-static">Occupation: <strong>{{$currentClient->job_title}}</strong></p>
			                    	</div>
			                    </div>
			                </div>
			            </div>
					 </div>
			 	</div>
			 	<a href="#family" class="client_menu"><i class="icon-heart"></i>Family</a>
			 	<div id="family" class="collapse-profile-menu hide">
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
			 	<a href="#customfields" class="client_menu"><i class="icon-note"></i>Custom Fields</a>
			 	<div id="customfields" class="collapse-profile-menu hide">
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
			 	<a href="#tasklistview" class="client_menu"><i class="icon-list"></i>Tasks</a>
			 	<div id="tasklistview" class="collapse-profile-menu hide">
			 		<div class="row">
						<div class="col-md-12">
							<p class="text-center">
								<a href="{{action(
											'Clients\ClientsController@getCreateClientTask',
											array(
												'customerid'=>isset($customerId) ? $customerId:'')
											)
										}}"
									data-target=".createTask"
									data-toggle="modal"
									class="openModal">
								<i class="fa fa-plus"></i> Add new tasks</a>
							</p>
								<!-- START TASK LIST -->
								<ul class="task-list">
									@if($tasks['total'] > 0)
										@foreach($tasks['data'] as $task)
											<li class="">
												<div class="task-title">
													{{$task->displayHtmlTaskDue()}}
													{{$task->displayHtmlLabelIcon()}}
													&nbsp;<br />
													<span class="task-title-sp">
														<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id,'redirect'=>'task'))}}">
															{{$task->displayName()}}
														</a>
														-
														<a href="{{action('Clients\ClientsController@getClientSummary',array('id'=>$task->customer_id))}}">
															{{$task->displayTaskFullName()}}
														</a>
													</span>
													<div class="task-config">
														<div class="task-config-btn btn-group hide">
															<a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
															<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
															</a>
															<ul class="dropdown-menu pull-right">
																<li>
																	<a class="complete-task" href="{{action('Task\TaskController@getCompleteTask',array('id'=>$task->id,'customerid'=>$task->customer_id))}}">
																	<i class="fa fa-check"></i> Complete </a>
																</li>
																<li>
																	<a class="openModal" data-toggle="modal" data-target=".ajaxModal" href="{{action('Task\TaskController@getEditClientTask',array('id'=>$task->id,'customerid'=>$task->customer_id))}}">
																	<i class="fa fa-pencil"></i> Edit </a>
																</li>
																<li>
																	<a class="delete-task" href="{{action('Task\TaskController@getCancelTask',array('id'=>$task->id,'customerid'=>$task->customer_id))}}">
																	<i class="fa fa-trash-o"></i> Cancel </a>
																</li>
															</ul>
														</div>
													</div>
												 </div>
												</li>
											@endforeach
										@endif
									</ul>
							</div>
						</div>
			 		</div>
		 	</div>
		 </div>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<a href="javscript;;" class="col-sm-4 text-center">
				<div class="text-success counter text-center">0</div>
				<div class="counter_label text-center">Projects</div>
			</a>
			<a href="javascript;;" class="col-sm-4 text-center">
				<div class="text-success counter text-center">{{$tasks['total']}}</div>
				<div class="counter_label text-center">Tasks</div>
			</a>
			<a href="{{url('file/client-file/'.$customer->id)}}" class="col-sm-4 text-center">
				<div class="text-success counter text-center">{{$files_count}}</div>
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
										{{--preg_replace("/([A-Za-z0-9]\.|)[A-Za-z0-9]+?\.([A-Za-z0-9]{3})/","",str_ireplace("/posts","",$urls->url))--}}
										@if(strtolower(trim($urls->website,'+')) == 'twitter')
											{{'@'.trim(str_ireplace("/","",strrchr(str_ireplace("/posts","",$urls->url),"/")))}}
										@else
											{{trim(str_ireplace("/","",strrchr(str_ireplace("/posts","",$urls->url),"/")))}}
										@endif

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

<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<input type="hidden" id="gmap_geocoding_address" value="{{$currentClient->displayCurrentAddress()}}" />
				<div id="gmap_geocoding" class="gmaps"></div>
			</div>
		</div>
	</div>
</div>

<!--Profile Model-->
@include($view_path.'.clients.partials.clientProfilePhotoWidget')
