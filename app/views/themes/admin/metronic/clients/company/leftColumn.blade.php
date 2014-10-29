<div class="panel panel-default">
	<!--
	<div class="panel-heading">
		 Panel heading without title
	</div>
	-->
	<div class="panel-body">
		 <div class="row">
		 	<div class="col-md-12">
		 		<img src="{{$asset_path . '/global/img/summary_comp.png'}}" alt="profile pic" class="profilePic"/>
		 	</div>
		 	<div class="col-md-12">
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
									{{$phone->number}} <span class="label label-info" style="font-size:9px;">{{$phone->type}}</span>
								</p>
							@endforeach
						@endif
						{{$currentClient->displayHtmlAddress()}}
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
		 <div class="row">
			<div class="col-md-12">
				<div class="form-body client-detail">
					<div class="form-group">
						<h4>Tags</h4>
						{{$tag_widget}}
					</div>
				</div>
			</div>
		 </div>
		  <hr/>
		 <div class="row">
		 	<div class="col-md-12">
		 		<h5>People working at <strong>{{$customer->company_name}}</strong></h5>
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
							@foreach( $customer->customerAssociatedTo($customer->id)->get() as $people )
								<tr>
									<td>
										<p class="form-control-static">
										<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$people->id))}}">
												<strong>
													{{$people->title.' '.$people->first_name.' '.$people->last_name}}
												</strong>
											</a>
										</p>
										<p>{{$people->job_title}}</p>
									<td>
									<td>
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
