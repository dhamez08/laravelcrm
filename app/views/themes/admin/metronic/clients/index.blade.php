@extends( $dashboard_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
		<link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
	@stop
@stop
@section('body-content')
	@parent
	@section('left-sidebar')

	@stop
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
								<p>Filter By</p>
							</div>
							<table class="table table-striped table-advance table-hover">
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
										<tr>
											<td>
												Photo here
											</td>
											<td>
												<div>
													{{--var_dump($customers)--}}
													@if( $customers['type'] == 2 )
														<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$customers['customer_id']))}}">{{$customers['company_name']}}</a>
													@else
														<a href="{{action('Clients\ClientsController@getClientSummary',array('clientId'=>$customers['customer_id']))}}">{{$customers['fullname']}}</a>
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
												<a href="#" class="btn default btn-xs red-stripe">
												Delete </a>
											</td>
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
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
		@parent
	@stop
@stop
