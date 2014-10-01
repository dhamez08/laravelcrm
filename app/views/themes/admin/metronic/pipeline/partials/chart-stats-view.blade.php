@extends( $pipeline_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<style>
	#placeholder { width: 450px; height: 200px; position: relative; margin: 0 auto; }
	</style>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	@parent
		@section('portlet-content')
			<div class="row">
				<div class="col-md-6">
					<!-- BEGIN BASIC CHART PORTLET-->
					<div class="portlet solid bordered grey-cararra">
                        <form class="form-inline" method="get">
                            <label for="user" class="control-label"><strong>Pipeline for user:</strong></label>
                            <select id="user" name="user" class="form-control" onchange="this.form.submit()">
                                <option value="" @if(\Input::get('user')=='' || !\Input::get('user')) selected="selected" @endif>Myself Only</option>
                                <option value="all" @if(\Input::get('user')=='all') selected="selected" @endif>All Users</option>
                            @if(count($group)>0)
                                @foreach($group as $g)
                                    <option value="{{ $g->user_id }}" @if($g->user_id==\Input::get('user')) selected="selected" @endif>{{ $g->first_name . ' ' . $g->last_name . ' (' . $g->username . ')' }}</option>
                                @endforeach
                            @endif
                            </select>
                        </form>
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-bar-chart-o"></i>Pipeline Forecast
							</div>
						</div>
						<div class="portlet-body">
							<div style="height:460px;text-align:center">        
                                <div id="pipeline-forecast-placeholder" style="width:100%;height:100%;"></div>        
                            </div>
						</div>
					</div>
					<!-- END BASIC CHART PORTLET-->
				</div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet solid bordered grey-cararra">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-calendar"></i>
                                        Pipeline Stats
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dashboard-stat red-intense">
                                                <div class="visual"><i class="fa fa-calendar"></i></div>
                                                <div class="details">   
                                                    <div class="number">
                                                    @if(count($stats)>0)
                                                        £{{ number_format($stats[0]->pipeline,2) }}
                                                    @else
                                                        £0.00
                                                    @endif
                                                    </div>
                                                    <div class="desc">Pipeline Value</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="dashboard-stat green-haze">
                                                <div class="visual"><i class="fa fa-calendar"></i></div>
                                                <div class="details">   
                                                    <div class="number">
                                                    @if(count($stats)>0)
                                                        £{{ number_format($stats[0]->total,2) }}
                                                    @else
                                                        £0.00
                                                    @endif
                                                    </div>
                                                    <div class="desc">Total Value</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet solid bordered grey-cararra">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-table"></i>
                                        Conversion Rates
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dashboard-stat blue-madison">
                                                <div class="visual"><i class="fa fa-bar-chart-o"></i></div>
                                                <div class="details">   
                                                    <div class="number">{{ $conversion_30days }}%</div>
                                                    <div class="desc">This Month</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dashboard-stat purple-plum">
                                                <div class="visual"><i class="fa fa-bar-chart-o"></i></div>
                                                <div class="details">   
                                                    <div class="number">{{ $conversion_90days }}%</div>
                                                    <div class="desc">Last 90 Days</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dashboard-stat red-intense">
                                                <div class="visual"><i class="fa fa-bar-chart-o"></i></div>
                                                <div class="details">   
                                                    <div class="number">{{ $conversion_360days }}%</div>
                                                    <div class="desc">Year to Date</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet solid bordered grey-cararra">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-table"></i>
                                        Actual Sales
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="dashboard-stat blue-madison">
                                                <div class="visual"><i class="fa fa-money"></i></div>
                                                <div class="details">   
                                                    <div class="number">£{{ number_format($sales_30days,2) }}</div>
                                                    <div class="desc">This Month</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dashboard-stat purple-plum">
                                                <div class="visual"><i class="fa fa-money"></i></div>
                                                <div class="details">   
                                                    <div class="number">£{{ number_format($sales_90days,2) }}</div>
                                                    <div class="desc">Last 90 Days</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="dashboard-stat red-intense">
                                                <div class="visual"><i class="fa fa-money"></i></div>
                                                <div class="details">   
                                                    <div class="number">£{{ number_format($sales_360days,2) }}</div>
                                                    <div class="desc">Year to Date</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-6">
                    <!-- BEGIN BASIC CHART PORTLET-->
                    <div class="portlet solid bordered grey-cararra">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bar-chart-o"></i>Sales by Month
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div style="height:400px;text-align:center">        
                                <div id="sales-placeholder" style="width:100%;height:100%;"></div>        
                            </div>
                        </div>
                    </div>
                    <!-- END BASIC CHART PORTLET-->
                </div>
            </div>
		@stop
	@stop
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	<script src="{{$asset_path}}/global/plugins/flot/jquery.flot.min.js"></script>
	<script src="{{$asset_path}}/global/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="{{$asset_path}}/global/plugins/flot/jquery.flot.orderBars.js"></script>
	<script src="{{$asset_path}}/global/plugins/flot/jquery.flot.axislabels.js"></script>
	<script type="text/javascript">

        //Pipeline forecast chart data
        var data = [
                    @foreach($forecast as $key=>$value)
                        [{{ $key }}, {{ $value->maxcash }}],
                    @endforeach
                    ];

        var data1 = [
                    @foreach($forecast as $key=>$value)
                        [{{ $key }}, {{ $value->thecash }}],
                    @endforeach
                    ];

        var dataset = [
                        { label: "Expected Total Value", data: data, color: "#009CB6" },
                        { label: "Pipeline Value", data: data1, color: "#6AE5FA" }
                    ];
        var ticks = [
                    @foreach($forecast as $key=>$value)
                        [{{ $key }}, "{{ $value->themonth }}"],
                    @endforeach
                    ];
 
        var options = {
            series: {
                bars: {
                    @if(count($forecast)>0)
                    show: true,
                    @else
                    show: false,
                    @endif
                    order:1,
                    barWidth: 0.75
                }
            },
            bars: {
                barWidth: 0.4
            },
            xaxis: {
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                ticks: ticks
            },
            yaxis: {
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                tickFormatter: function (v, axis) {
                    return "£" + v;
                }
            },
            legend: {
                noColumns: 0,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
        };

        //sales chart data

        var data_sales = [
                         @foreach($sales_by_month as $key=>$sales)
                            [{{ $key }}, {{ $sales[0]->total }}],
                         @endforeach
                    ];

        var dataset_sales = [
                        { label: "Actual Sales Value", data: data_sales, color: "#6AE5FA" }
                    ];

        var ticks_sales = [
                        @foreach($sales_by_month as $key=>$sales)
                            [{{ $key }}, "{{ $sales[0]->themonth }}"],
                        @endforeach
                        ];
 
        var options_sales = {
            series: {
                bars: {
                    show: true,
                    order:1,
                    align: "center"
                } 
            },
            bars: {
                barWidth: 0.4
            },
            xaxis: {
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10,
                ticks: ticks_sales
            },
            yaxis: {
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 3,
                tickFormatter: function (v, axis) {
                    return "£" + v;
                }
            },
            legend: {
                noColumns: 0,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: true,
                borderWidth: 2,
                backgroundColor: { colors: ["#ffffff", "#EDF5FF"] }
            }
        };

        $(document).ready(function () {
            $.plot($("#pipeline-forecast-placeholder"), dataset, options);
            $("#pipeline-forecast-placeholder").UseTooltip();

            $.plot($("#sales-placeholder"), dataset_sales, options_sales);
            $("#sales-placeholder").UseTooltip();
        });
 
        function gd(year, month, day) {
            return new Date(year, month, day).getTime();
        }
 
        var previousPoint = null, previousLabel = null;
 
        $.fn.UseTooltip = function () {
            $(this).bind("plothover", function (event, pos, item) {
                if (item) {
                    if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                        previousPoint = item.dataIndex;
                        previousLabel = item.series.label;
                        $("#tooltip").remove();
 
                        var x = item.datapoint[0];
                        var y = item.datapoint[1];
 
                        var color = item.series.color;
 
                        //console.log(item.series.xaxis.ticks[x].label);               
 
                        showTooltip(item.pageX,
                        item.pageY,
                        color,
                        "<strong>" + item.series.label + "</strong>" + " : <strong>£" + y + "</strong>");
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        };
 
        function showTooltip(x, y, color, contents) {
            $('<div id="tooltip">' + contents + '</div>').css({
                position: 'absolute',
                display: 'none',
                top: y - 40,
                left: x - 40,
                border: '2px solid ' + color,
                padding: '3px',
                'font-size': '9px',
                'border-radius': '5px',
                'background-color': '#fff',
                'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                opacity: 0.9
            }).appendTo("body").fadeIn(200);
        }
    </script>
	@stop
@stop
