@section('head-custom-js')
	<link href="{{$asset_path}}/global/css/invoice_design.css" rel="stylesheet" type="text/css"/>
@stop

<div class="col-md-12">
	<a class="btn btn-default" href="{{ URL::to('invoice/dashboard') }}" role="button">Invoice Home</a>
	<a class="btn btn-default" href="{{ URL::to('invoice/setting') }}" role="button">Invoice Setting</a>
</div>

<div class="col-md-4">
	<div class="widget widget-stats bg-blue">
		<div class="stats-icon stats-icon-lg"><i class="fa fa-puzzle-piece fa-fw"></i></div>
		<div class="stats-title">{{ trans('invoice.products') }}</div>
		<div class="stats-number">{{ $invoiceTopBarStats['products'] }}</div>
		<hr>
		<div class="stats-footer">
			<div class="stats-desc pull-left">{{ trans('invoice.number_of_products') }}</div>
			<a class="pull-right" href="{{ URL::to('invoice/product') }}">View Products</a>
		</div>
	</div> 	
</div>  

<div class="col-md-4">
	<div class="widget widget-stats bg-purple">
		<div class="stats-icon stats-icon-lg"><i class="fa fa-file-pdf-o fa-fw"></i></div>
		<div class="stats-title">{{ trans('invoice.invoices') }}</div>
		<div class="stats-number">{{ $invoiceTopBarStats['invoices'] }}</div>
		<hr>
		<div class="stats-footer">
			<div class="stats-desc pull-left">{{ trans('invoice.number_of_invoices') }}</div>
			<a class="pull-right" href="{{ URL::to('invoice/invoice') }}">View Invoices</a>
		</div>
	</div> 
</div> 		

<div class="col-md-4">
	<div class="widget widget-stats bg-grey" style="background: none repeat scroll 0 0 #2C3E50 !important">
		<div class="stats-icon stats-icon-lg"><i class="fa fa-money fa-fw"></i></div>
		<div class="stats-title">{{ trans('invoice.amount') }}</div>
		<div class="stats-number">{{ $invoiceTopBarStats['totalAmount'] }}</div>
		<hr>
		<div class="stats-footer">
			<div class="stats-desc pull-left">{{ trans('invoice.value_of_amounts') }}</div>
			<a class="pull-right" href="{{ URL::to('invoice/report') }}">View Reports</a>
		</div>
	</div> 
</div>