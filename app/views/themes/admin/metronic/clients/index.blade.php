@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>

		<link href="{{$asset_path}}/global/plugins/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" rel="stylesheet"/>
	@stop
@stop
@section('body-content')
	@parent
    @section('left-sidebar')
        @include( \DashboardEntity::get_instance()->getView() . '.dashboard.partials.leftSidebar' )
    @show
	@section('pagebar')

	@stop
	@section('innerpage-page-title')
		&nbsp;
	@show
	@section('innerpage-content')
		<div class="col-md-12">
			<!-- CENTER COLUMN -->
			<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
				<div class="portlet-title">
					<div class="caption">
						@section('portlet-captions')
							<i class="fa fa-{{{$fa_icons or 'cog'}}}"></i>{{{$portlet_title or 'Portlet Title'}}}
						@show
					</div>
					<div class="actions">
						@section('portlet-actions')
							<a class="btn btn-default btn-sm" href="{{url('clients/create')}}">
							<i class="fa fa-plus"></i> Add Client</a>
							<a class="btn btn-default btn-sm" href="{{action('Clients\ClientsController@getCreateClientCompany')}}">
							<i class="fa fa-plus"></i> Add Company</a>
							<a class="btn btn-default btn-sm" href="{{action('Clients\ClientsController@getImportPerson')}}">
							<i class="fa fa-plus"></i> Import Client</a>
							{{\Clients\ClientsController::get_instance()->displayCreateTaskModal()}}
						@show
					</div>
				</div>
				<div class="portlet-body {{{$portlet_body_class or ''}}}">
					@section('portlet-content')
						<div class="client-list" style="padding:10px;">
							<div>
								{{Form::open(
									array(
										'action' => array('Clients\ClientsController@getIndex'),
										'method' => 'GET',
										'class' => 'form-inline',
										'role'=>'form',
									)
								)}}

										<div class="form-group">
											<label for="clientSearch">Search: </label>
											{{
												Form::text(
													'search',
													\Input::get('search', ''),
													array(
														'class' => 'form-control',
														'id' => 'clientSearch',
														'placeholder' => 'Enter name or phone number',
														'style' => 'min-width:230px'
													)
												)
											}}
										</div>	

										@if( isset($tags) )
										<div class="form-group">
											<label for="clientTags">Tags: </label>
											{{
												Form::select(
													'tags[]',
													$tags->lists('tag','id'),
													isset($tag_id) ? $tag_id:null,
													array('multiple')
												);
											}}											
										</div>				
										@endif	

										<div class="form-group">
											<label for="clientUser">User: </label>
											{{
												Form::select(
													'user',
													$user_list,
													\Input::get('user', 'all'),
													array('class' => 'form-control')
												)

											}}
										</div>				

										<div class="row hidden">
											<div class="col-md-12">

												<div class="portlet box blue" style="margin-top:10px; margin-bottom:10px">
													<div class="portlet-title">
														<div class="caption caption-mini">
															<i class="fa fa-cogs"></i>Advanced Filters
														</div>
														<div class="tools" style="float:left">
															<a href="javascript:;" class="expand">
															</a>
														</div>
													</div>
													<div class="portlet-body" style="display:none">
														<div class="row">
															<div class="col-md-12" style="margin: 10px 10px;">
																<label>Age: </label>
																{{ Form::number('age_min', \Input::get('age_min'), array('placeholder' => 'Minimum Age')) }} - {{ Form::number('age_max', \Input::get('age_max'), array('placeholder' => 'Maximum Age')) }}
																&nbsp;&nbsp;
																<label>Marital Status: </label>
																{{ Form::select('marital_status', Config::get('crm.marital_status'), \Input::get('marital_status')) }}
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										{{Form::submit('Apply Filters',array('class'=>"btn blue"))}}
								{{Form::close()}}
							</div>
							<p></p>
							<table id="dt-customer-list" class="table table-striped table-advance table-hover">
								<thead>
									<tr>
										<th>

										</th>
										<th>
											Client / Company Name
										</th>
										<th>
										</th>
									</tr>
								</thead>
								<tbody>
									@if( isset($array_customer) && count($array_customer) > 0 )
										@foreach($array_customer as $customers)
										@if( is_null($tag_id) )
											<tr>
												<td style="width:1%">
													<img src="{{ isset($customers['profile_image']->image) ? $customers['profile_image']->image : url('public/img/profile_images/summary_person.png') }}" style="width:35px">
												</td>
												<td>
													<div>
														@if( $customers['type'] == 2 )
															<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$customers['customer_id']))}}">{{$customers['company_name']}}</a>
														@else
															<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$customers['customer_id']))}}" data-toggle="popover" data-trigger="hover" data-placement="right" data-title="Client Overview" data-client-fullname="{{ $customers['fullname'] }}" data-client-address="{{ $customers['address'] }}" data-client-phone="{{ implode(', ', $customers['telephone']) }}" data-client-email="{{ implode(', ', $customers['emails']) }}" data-client-website="{{ implode(', ', $customers['urls']) }}" data-client-profile-picture="{{ isset($customers['profile_image']->image) ? $customers['profile_image']->image : url('public/img/profile_images/summary_person.png') }}">{{$customers['fullname']}}</a>
														@endif

														{{--@if( $customers['associated'] != 0 && $customers['relationship'] != '' )--}}
															<?php $partner = \Helpers::array_key_exists_wildcard($array_customer,$customers['associated'],'key-value'); ?>
															{{--var_dump($partner)--}}
															@if( $partner )
																@if( $partner[$customers['associated']]['type'] == 2 )
																	- {{$customers['job_title']}} at {{$partner[$customers['associated']]['company_name']}}
																@else
																	- {{$customers['relationship']}} of {{$partner[$customers['associated']]['fullname']}}
																@endif

															@endif
														{{--@endif--}}
														@if($customers['address'])
														<br/>
														<small>{{ $customers['address'] }}</small>
														@endif
														@if($customers['telephone'])
														<br/>
														<small>Phone: {{ implode(', ', $customers['telephone']) }}</small>
														@endif

													</div>
												</td>
												<td>
													<a href="{{ url('clients/delete-client/' . $customers['customer_id'] . '/' . \Session::token() ) }}" class="btn btn-danger btn-sm btn-delete-client">
													<i class="fa fa-trash"></i> </a>
												</td>
											@else
												{{-- @if( in_array($tag_id,$customers['my_tag_object']->lists('tag_id')) ) --}}
												@if(count(array_diff($tag_id, $customers['my_tag_object']->lists('tag_id'))) == 0)
													<td style="width:1%">
														<img src="{{ isset($customers['profile_image']->image) ? $customers['profile_image']->image : url('public/img/profile_images/summary_person.png') }}" style="width:35px">
													</td>
													<td>
														<div>
															@if( $customers['type'] == 2 )
																<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$customers['customer_id']))}}">{{$customers['company_name']}}</a>
															@else
																<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$customers['customer_id']))}}" data-toggle="popover" data-trigger="hover" data-placement="right" data-title="Client Overview" data-client-fullname="{{ $customers['fullname'] }}" data-client-address="{{ $customers['address'] }}" data-client-phone="{{ implode(', ', $customers['telephone']) }}" data-client-email="{{ implode(', ', $customers['emails']) }}" data-client-website="{{ implode(', ', $customers['urls']) }}" {{ isset($customers['profile_image']->image) ? $customers['profile_image']->image : url('public/img/profile_images/summary_person.png') }}>{{$customers['fullname']}}</a>
															@endif

															{{--@if( $customers['associated'] != 0 && $customers['relationship'] != '' )--}}
																<?php $partner = \Helpers::array_key_exists_wildcard($array_customer,$customers['associated'],'key-value'); ?>
																{{--var_dump($partner)--}}
																@if( $partner )
																	@if( $partner[$customers['associated']]['type'] == 2 )
																		- {{$customers['job_title']}} at {{$partner[$customers['associated']]['company_name']}}
																	@else
																		- {{$customers['relationship']}} of {{$partner[$customers['associated']]['fullname']}}
																	@endif

																@endif
															{{--@endif--}}
														</div>
													</td>
													<td>
														<a href="{{ url('clients/delete-client/' . $customers['customer_id'] . '/' . \Session::token() ) }}" class="btn btn-danger btn-sm btn-delete-client">
														<i class="fa fa-trash"></i> </a>
													</td>
												@endif
											@endif
										</tr>
										@endforeach
									@endif

								</tbody>
							</table>
						</div>
					@show
				</div>
			</div>
			{{--@include($view_path.'.clients.partials.center_column.'.$center_column_view)--}}
			<!-- END CENTER COLUMN -->
		</div>

		<div id="client-popover-template" class="hidden">
			<div class="client-popover-detail-wrapper">
				<div class="row">
					<div class="col-md-offset-2 col-md-8">
						<img src="" class="profile-picture img-rounded img-responsive" />
					</div>
				</div>
				<div class="row">
		            <div class="col-md-12">
		                <h4 class="fullname"></h4>
		                <p class="hidden"><strong>Family Members: </strong> <span class="family-members"></span> </p>
		                <p><strong>Address: </strong> <span class="address"></span> </p>
		                <p><strong>Phone: </strong> <span class="phone"></span> </p>
		                <p><strong>Email: </strong> <span class="email"></span> </p>
		                <p><strong>Website: </strong> <span class="website"></span> </p>
		            </div>             
				</div>
			</div>

		</div>

	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		@parent
		<script src="{{$asset_path}}/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="{{$asset_path}}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
		<script type="text/javascript">
			$('select[name="tags[]"]').select2({
				//'width': 'resolve'
				width: '230px'
			});

			var clientListTable = $('#dt-customer-list').dataTable({
				'paging': false,
				'ordering': false,
				'bInfo': false,
				//'bFilter': false
				'dom': 't'				
			});
			var clientListTableApi = clientListTable.DataTable();

			$('input[name="search"]').keyup(function(){
				clientListTableApi.search($(this).val()).draw() ;
			})	

			$('.btn-delete-client').on('click', function() {
				return confirm('Are you sure you want to delete?');
			});

			$(document).ready(function() {
				$('input[name="search"]').trigger('keyup');

				$('a[data-toggle="popover"]').popover({
					html: true,
					content: function() {
						var popoverTemplate = $('#client-popover-template');

						popoverTemplate = popoverTemplate.find('.client-popover-detail-wrapper');
						popoverTemplate.find('.profile-picture').attr('src', $(this).data('client-profile-picture'));
						popoverTemplate.find('.fullname').text($(this).data('client-fullname'));
						popoverTemplate.find('.family-members').text('FAMILY MEMBERS');
						popoverTemplate.find('.address').text($(this).data('client-address'));
						popoverTemplate.find('.phone').text($(this).data('client-phone'));
						popoverTemplate.find('.email').text($(this).data('client-email'));
						popoverTemplate.find('.website').text($(this).data('client-website'));

						return $('#client-popover-template').html();
					}
				});
			});

		</script>
	@stop
@stop
