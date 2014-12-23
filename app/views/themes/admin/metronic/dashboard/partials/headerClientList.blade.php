<div class="page-bar">
	<ul class="page-breadcrumb client-list-top">
		@if($clientTopList->count() > 0 )
			@foreach($clientTopList->get() as $client)
				<li>
					<i class="fa fa-user"></i>
					<a href="{{url('clients/client-summary') . '/' . $client->id}}">{{($client->type == 2) ? $client->company_name:$client->first_name ." ". $client->last_name}}</a>
				</li>
			@endforeach
		@endif
	</ul>
	<div style="width:30%" class="page-toolbar" id="clientSearch">
		<div class="pull-right">
			<div class="input-group">
				<input type="text" placeholder="Search" class="form-control">
				<span class="input-group-btn">
				<button type="button" class="btn blue"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</div>
	</div>
</div>
@yield('additonal-pagebar')
@if(isset($customer))
	@include($view_path.'.clients.partials.CustomerTagWidget')
@endif

@section('script-footer')
	@parent
		@section('footer-custom-js')
			@parent
			<script type="text/javascript" src="{{$asset_path}}/pages/scripts/client-search.js"></script>
			<script>
				jQuery(document).ready(function() {
					ClientSearch.init( baseURL );
				});
			</script>
		@stop
@stop