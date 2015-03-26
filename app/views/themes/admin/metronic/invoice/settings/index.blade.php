@extends($dashboard_index)

@section('header-custom-js')
	<link href="{{$asset_path}}/global/css/invoice_design.css" rel="stylesheet" type="text/css"/>
	<link href="{{$asset_path}}/global/plugins/bootstrap-fileinput2/css/fileinput.min.css" rel="stylesheet" type="text/css"/>
@stop

@section('innerpage-content')

	<div class="col-md-12 col-lg-12">
		<h1><i class="fa fa-cogs"></i> {{ trans('invoice.invoice_settings') }}</h1>
	</div>		
	
	<div class="col-md-12 col-lg-12">
		<ul id="solsoTabs" class="nav nav-tabs" role="tablist" id="myTab">
		
			{{-- @if (Auth::user()->role_id == 2) --}}
			
				<li class="active"><a href="#tab1" role="tab" data-toggle="tab">{{ trans('invoice.my_company') }}</a></li>
				<li><a href="#tab2" role="tab" data-toggle="tab">{{ trans('invoice.logo') }}</a></li>
				<li><a href="#tab3" role="tab" data-toggle="tab">{{ trans('invoice.invoice') }}</a></li>
				<li><a href="#tab4" role="tab" data-toggle="tab">{{ trans('invoice.invoice_tax') }}</a></li>
				<li><a href="#tab5" role="tab" data-toggle="tab">{{ trans('invoice.currencies') }}</a></li>
				<li><a href="#tab6" role="tab" data-toggle="tab">{{ trans('invoice.payments') }}</a></li>
				{{-- <li><a href="#tab7" role="tab" data-toggle="tab">{{ trans('invoice.invitation') }}</a></li> --}}
			
			{{-- @endif --}}
			
			<li {{ Auth::user()->role_id == 3 ? 'class="active"' : '' }}><a href="#tab8" role="tab" data-toggle="tab">{{ trans('invoice.languages') }}</a></li>
			{{--
			<li><a href="#tab9" role="tab" data-toggle="tab">{{ trans('invoice.account') }}</a></li>
			<li><a href="#tab10" role="tab" data-toggle="tab">{{ trans('invoice.password') }}</a></li>
			<li><a href="#tab11" role="tab" data-toggle="tab">{{ trans('invoice.application') }}</a></li>
			--}}
		</ul>
		
		<div class="row tab-content">
		
			{{-- @if (Auth::user()->role_id == 2) --}}
			
				<div class="tab-pane active" id="tab1">
					@include($view_path . '.invoice.settings.company')
				</div>
				
				<div class="tab-pane" id="tab2">
					@include($view_path . '.invoice.settings.logo')
				</div>	

				<div class="tab-pane" id="tab3">
					@include($view_path . '.invoice.settings.invoice')
				</div>

				<div class="tab-pane" id="tab4">
					@include($view_path . '.invoice.settings.tax')
				</div>			
				
				<div class="tab-pane" id="tab5">
					@include($view_path . '.invoice.settings.currency')
				</div>	

				<div class="tab-pane" id="tab6">
					@include($view_path . '.invoice.settings.payment')
				</div>					
				
				{{--
				<div class="tab-pane" id="tab7">
					@include($view_path . '.invoice.settings.invitation')
				</div>
				--}}				
			
			{{-- @endif --}}
			
			<div class="tab-pane {{ Auth::user()->role_id == 3 ? 'active' : '' }}" id="tab8">
				@include($view_path . '.invoice.settings.language')
			</div>	
			{{--
			<div class="tab-pane" id="tab9">
				@include($view_path . '.invoice.settings.account')
			</div>	

			<div class="tab-pane" id="tab10">
				@include($view_path . '.invoice.settings.password')
			</div>	

			<div class="tab-pane" id="tab11">
				@include($view_path . '.invoice.settings.user-mode')
			</div>
			--}}				
		</div>		
	</div>				

	@include($view_path . '.invoice._modals/delete')
		
@stop

@section('footer-custom-js')
<!-- BOOTSTRAP FILEINPUT -->
<script type="text/javascript" src="{{ $asset_path }}/global/plugins/bootstrap-fileinput2/js/fileinput.min.js"></script>
<script>	
	$(".solsoFileInput").fileinput({
		allowedFileExtensions: ['jpg', 'jpeg', 'gif', 'png', 'bmp']
	});		
</script>		
<!-- END BOOTSTRAP FILEINPUT -->

<script type="text/javascript">
	/* === MODAL YES/NO === */
	$( document ).on('click', '.solsoConfirm', function(){
		$(" #solsoFormID ").prop('action', $(this).attr('data-url'));
	});
	/* === MODAL YES/NO === */
</script>

<script type="text/javascript">
	/* === SETTINGS === */
	$( document ).on('click', '.solsoCurrencySettings', function(e) {
		e.preventDefault();
		
		var id	 	= $(this).attr('data-id');
		var name 	= $(this).closest('label').find("input[type='radio']").attr('name');
		var value 	= $(this).closest('label').find("input[type='radio']").val();
		var url		= '';
	
		if ( name == 'position') {
			goToUrl = "{{ URL::route('currency.currencyPosition') }}";
		}
		
		if ( name == 'default') {
			goToUrl = "{{ URL::route('setting.defaultCurrency') }}";
		}			
	
		$.ajax({
			url: goToUrl,
			type: 'post',
			dataType: 'html',
			data: { itemID: id, itemValue: value  },
			success:function(data) {
				$('#tab5').html(data);
			}
		});
		
		solsoAlerts();
	});
	/* === END SETTINGS === */
</script>
@stop