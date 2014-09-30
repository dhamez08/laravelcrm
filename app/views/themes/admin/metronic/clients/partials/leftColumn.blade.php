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
		 		@if( $belongToPartner )
					<p>{{$customer->relationship}} of {{$belongToPartner->first_name}} {{$belongToPartner->last_name}}</p>
		 		@endif
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
						@if( $url->count() > 0 )
							@foreach($url->get() as $urls)
								<p class="form-control-static">
									<i class="fa fa-cloud"></i>
									<a href="{{$urls->url}}" target="_blank">{{$urls->url}}</a> <span class="label label-info">{{$urls->type}}</span>
								</p>
							@endforeach
						@endif
						@if( $email->count() > 0 )
							@foreach($email->get() as $mail)
								<p class="form-control-static">
									<i class="fa fa-envelope"></i>
									<a href="mailto:{{$mail->email}}" target="_blank">{{$mail->email}}</a> <span class="label label-info">{{$mail->type}}</span>
								</p>
							@endforeach
						@endif
						@if( $telephone->count() > 0 )
							@foreach($telephone->get() as $phone)
								<p class="form-control-static">
									<i class="fa fa-phone"></i>
									{{$phone->number}} <span class="label label-info">{{$phone->type}}</span>
								</p>
							@endforeach
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
		 				@if( $customer->customerAssociatedTo($customer->id)->count() > 0 )
							@foreach( $customer->customerAssociatedTo($customer->id)->get() as $family )
								@if( $family->relationship == 'Spouse/Partner' )
									<p class="form-control-static">
										<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$partner->partner_id))}}">
										<strong>{{$family->partner_title.' '.$family->partner_first_name.' '.$family->partner_last_name}}</strong>
										</a>
										- {{$currentClient->parseDate($family->partner_dob)}} - {{$family->relationship}}
									</p>
								@elseif( $family->type == 4 )
									<p class="form-control-static">
										<strong>{{$family->first_name.' '.$family->last_name}}</strong>
										- {{$currentClient->parseDate($family->dob)}} - {{$family->relationship}}
									</p>
								@endif
							@endforeach
		 				@endif
		 			</div>
		 		</div>
		 	</div>
		 	<div class="col-md-12">
		 		<div class="form-body client-detail">
		 			<div class="form-group">
		 				<p class="form-control-static"><a href="#">Add family</a></p>
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
