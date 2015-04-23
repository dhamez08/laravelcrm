@extends($dashboard_index)

@section('head-custom-css')
	<link href="{{$asset_path}}/global/css/invoice_design.css" rel="stylesheet" type="text/css"/>

	{{-- <link href="{{$asset_path}}/global/plugins/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet"/> --}}
	{{-- <link href="{{$asset_path}}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css" rel="stylesheet"/> --}}
@stop

@section('innerpage-content')
	
	<div class="col-md-12">
		{{--
		<div role="alert" class="alert alert-warning">
			<strong> {{ trans('invoice.message') }}: </strong> {{ trans('invoice.message_09') }} 
			<a href="{{ URL::to('setting') }}" >{{ trans('invoice.settings') }} -> {{ trans('invoice.application') }}</a>
			{{ trans('invoice.message_10') }}
		</div>	
		--}}
	
		@if ($check['email'] == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong> {{ trans('invoice.message') }}: </strong> {{ trans('invoice.message_01') }} 
				<a href="{{ URL::to('invoice/setting#tab1') }}" >{{ trans('invoice.settings') }} -> {{ trans('invoice.company') }}</a>
			</div>	
		@endif

		@if ($check['logo'] == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('invoice.message') }}: </strong> {{ trans('invoice.message_02') }} 
				<a href="{{ URL::to('invoice/setting#tab2') }}" >{{ trans('invoice.settings') }} -> {{ trans('invoice.logo') }}</a>
			</div>	
		@endif		
		
		@if ($check['tax'] == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('invoice.message') }}: </strong> {{ trans('invoice.message_03') }} 
				<a href="{{ URL::to('invoice/setting#tab4') }}" >{{ trans('invoice.settings') }} -> {{ trans('invoice.tax') }}</a>
			</div>	
		@endif

		@if ($check['currency'] == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('invoice.message') }}: </strong> {{ trans('invoice.message_04') }} 
				<a href="{{ URL::to('invoice/setting#tab5') }}" >{{ trans('invoice.settings') }} -> {{ trans('invoice.currency') }}</a>
			</div>	
		@endif

		@if ($check['payment'] == 0)
			<div role="alert" class="alert alert-warning top20">
				<strong>{{ trans('invoice.message') }}: </strong> {{ trans('invoice.message_05') }} 
				<a href="{{ URL::to('invoice/setting#tab6') }}" >{{ trans('invoice.settings') }} -> {{ trans('invoice.payment') }}</a>
			</div>	
		@endif		
		
	</div>
	
	{{-- @include($view_path . '.invoice.dashboard.topbar-stats') --}}

	<div class="col-md-12">
		<form class="form-inline pull-right" style="margin-bottom: 10px">
		  <div class="form-group">
		    <label for="exampleInputName2">Filter by Dates</label>		    
		    {{ Form::select(
		    	'filter_by_date', 
		    	array(1 => 'Month to date', 2 => 'Last 30 days', 3 => 'Last 90 days', 4 => 'Last year'), 
		    	\Input::get('filter_by_date', 1), 		    	
		    	array('class' => 'form-control')
		    	) 
		    }}
		  </div>
		</form>		
	</div>	

	
	<div class="col-sm-6 col-md-2">
		<div class="solso-pie-chart thumbnail chart-invoice-pending">
			<p>{{ trans('invoice.paid') }}: {{ $invoiceChart['paid']['count'] }}</p>
			<p>{{ trans('invoice.unpaid') }}: {{ $invoiceChart['unpaid']['count'] }}</p>
			<p>{{ trans('invoice.partial_paid') }}: {{ $invoiceChart['partiallypaid']['count'] }}</p>
			<p>{{ trans('invoice.overdue') }}: {{ $invoiceChart['overdue']['count'] }}</p>
			<p>{{ trans('invoice.canceled') }}: {{ $invoiceChart['cancelled']['count'] }}</p>
		</div> 
	</div>		

	<div class="col-sm-6 col-md-2">
		<div class="solso-pie-chart thumbnail chart-invoice-paid">
			<div class="chart" data-percent="{{ $invoiceChart['paid']['percent']}}">
				<span class="percent"></span>
			</div>	
			
			<h4>{{ trans('invoice.paid') }}</h4>
		</div>
	</div> 	

	<div class="col-sm-6 col-md-2">
		<div class="solso-pie-chart thumbnail chart-invoice-unpaid">
			<div class="chart" data-percent="{{ $invoiceChart['unpaid']['percent'] }}">
				<span class="percent"></span>
			</div>	
			
			<h4>{{ trans('invoice.unpaid') }}</h4>
		</div>
	</div>  

	<div class="col-sm-6 col-md-2">
		<div class="solso-pie-chart thumbnail chart-invoice-partial-paid">
			<div class="chart" data-percent="{{ $invoiceChart['partiallypaid']['percent'] }}">
				<span class="percent"></span>
			</div>	
			
			<h4>{{ trans('invoice.partial_paid') }}</h4>
		</div>
	</div> 		

	<div class="col-sm-6 col-md-2">
		<div class="solso-pie-chart thumbnail chart-invoice-overdue">
			<div class="chart" data-percent="{{ $invoiceChart['overdue']['percent'] }}">
				<span class="percent"></span>
			</div>	
			
			<h4>{{ trans('invoice.overdue') }}</h4>
		</div>
	</div> 

	<div class="col-sm-6 col-md-2">
		<div class="solso-pie-chart thumbnail chart-invoice-canceled">
			<div class="chart" data-percent="{{ $invoiceChart['cancelled']['percent']}}">
				<span class="percent"></span>
			</div>	
			
			<h4>{{ trans('invoice.canceled') }}</h4>
		</div>
	</div>	
	
			
	<div class="col-sm-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">{{ trans('invoice.report_01') }}

				<a href="<?php echo URL::to('invoice/report');?>" class="pull-right"><i class="fa fa-line-chart"></i>{{ trans('invoice.reports') }}</a></h2>
			</div>
			
			<div class="panel-body">
				<div id="chartInvoicesLastMonth"></div>
				<input type="hidden" class="chartInvoicesLastMonth" value="<?php echo $reports['month'];?>">
			</div>
		</div>				
	</div>

	<div class="col-sm-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">{{ trans('invoice.report_02') }}

				<a href="<?php echo URL::to('invoice/report');?>" class="pull-right"><i class="fa fa-line-chart"></i> {{ trans('invoice.reports') }}</a></h2>
			</div>
			
			<div class="panel-body">
				<div id="chartInvoicesLastYear"></div>
				<input type="hidden" class="chartInvoicesLastYear" value="<?php echo $reports['year'];?>">
			</div>
		</div>				
	</div>

	<div class="col-sm-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">{{ trans('invoice.invoices_to_be_paid') }}

				<a href="<?php echo URL::to('invoice/invoice');?>" class="pull-right"><i class="fa fa-file-pdf-o"></i> {{ trans('invoice.invoices') }}</a></h2>
			</div>
			
			<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-striped solsoTable">
					<thead>
						<tr>
							<th>{{ trans('invoice.crt') }}.</th>
							<th class="small">{{ trans('invoice.number') }}</th>
							<th>{{ trans('invoice.client') }}</th>
							<th class="small">{{ trans('invoice.due_date') }}</th>
							<th class="small">{{ trans('invoice.status') }}</th>
							<th class="small">{{ trans('invoice.action') }}</th>
						</tr>
					</thead>				
					
					<tbody>
						@foreach($lastInvoices as $crt => $v)
						<tr>
							<td>
								{{ $crt + 1 }}
							</td>
							
							<td>
								{{ $v->number }}
							</td>

							<td>
								{{ $v->client_fullname }}
							</td>													
							
							<td>
								{{ $v->due_date }}
							</td>
							
							<td>
								<span class="label label-{{ str_replace(' ', '-', $v->status) }} ">{{ $v->status }}</label>
							</td>
							
							<td>
								<a class="btn btn-info" href="{{ URL::to('invoice/invoice/' . $v->id) }}" target="_blank"><i class="fa fa-eye"></i> {{ trans('invoice.show') }}</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>		
				</div>
			</div>
		</div>				
	</div>

	<div class="col-sm-6 col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2 class="panel-title">{{ trans('invoice.overdue_invoices') }}

				<a href="<?php echo URL::to('invoice/invoice');?>" class="pull-right"><i class="fa fa-file-pdf-o"></i> {{ trans('invoice.invoices') }}</a></h2>
			</div>
			
			<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-striped solsoTable">
					<thead>
						<tr>
							<th>{{ trans('invoice.crt') }}.</th>
							<th class="small">{{ trans('invoice.number') }}</th>
							<th>{{ trans('invoice.client') }}</th>
							<th class="small">{{ trans('invoice.due_date') }}</th>
							<th class="small">{{ trans('invoice.status') }}</th>
							<th class="small">{{ trans('invoice.action') }}</th>
						</tr>
					</thead>				
					
					<tbody>
						@foreach($overdueInvoices as $crt => $v)
						<tr>
							<td>
								{{ $crt + 1 }}
							</td>
							
							<td>
								{{ $v->number }}
							</td>

							<td>
								{{ $v->client_fullname }}
							</td>													
							
							<td>
								{{ $v->due_date }}
							</td>
							
							<td>
								<span class="label label-overdue">{{ trans('invoice.overdue') }}</label>
							</td>
							
							<td>
								<a class="btn btn-info" href="{{ URL::to('invoice/invoice/' . $v->id) }}" target="_blank"><i class="fa fa-eye"></i> {{ trans('invoice.show') }}</a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>		
				</div>
			</div>
		</div>				
	</div>

@stop

@section('footer-custom-js')
<!-- RENDRO EASY PIE CHART -->
<script type="text/javascript" src="{{ $asset_path }}/global/plugins/rendro-easy-pie-chart/dist/jquery.easing.min.js"></script>
<script type="text/javascript" src="{{ $asset_path }}/global/plugins/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script type="text/javascript">
	$('.chart').easyPieChart({
		easing: 'easeOutBounce',
		onStep: function(from, to, percent) {
			$(this.el).find('.percent').text(Math.round(percent));
		}
	});
</script>	
<!-- END RENDRO EASY PIE CHART -->

<!-- GOOGLE CHARTS -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);

function drawChart() {
	/* === INVOICES === */
	var data = google.visualization.arrayToDataTable(
		eval($('.chartInvoicesLastMonth').val())
	);
	var view = new google.visualization.DataView(data);
	view.setColumns([0, 1,
					   {
						calc: "stringify",
						sourceColumn: 1,
						type: "string",
						role: "annotation" },
					   2]);			
	var options = {
		fontName: 'Dosis',
		fontSize: 14,
		legend: { position: "none" },
		title: "{{ date('F Y') }}",
	};
	var chart = new google.visualization.ColumnChart(document.getElementById('chartInvoicesLastMonth'));
	chart.draw(view, options);
	
	var data = google.visualization.arrayToDataTable(
		eval($('.chartInvoicesLastYear').val())
	);
	var view = new google.visualization.DataView(data);
	view.setColumns([0, 1,
					   {
						calc: "stringify",
						sourceColumn: 1,
						type: "string",
						role: "annotation" },
					   2]);					
	var options = {
		fontName: 'Dosis',
		fontSize: 14,			
		title: "{{ date('Y') }}",
		legend: { position: "none" },
	};
	var chart = new google.visualization.ColumnChart(document.getElementById('chartInvoicesLastYear'));
	chart.draw(view, options);		
	/* === END INVOICES === */	
}

</script>
<!-- END GOOGLE CHARTS -->

{{-- <script src="{{$asset_path}}/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script> --}}
{{-- <script src="{{$asset_path}}/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script> --}}
<script>
	$('.solsoTable').dataTable();
</script>
@stop