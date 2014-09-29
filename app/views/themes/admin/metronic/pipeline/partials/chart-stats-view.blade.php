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
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Pipeline Forecast
							</div>
						</div>
						<div class="portlet-body">
							<div style="height:400px;text-align:center">        
                                <div id="flot-placeholder" style="width:100%;height:100%;"></div>        
                            </div>
						</div>
					</div>
					<!-- END BASIC CHART PORTLET-->
				</div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Pipeline Stats
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    asdasdasdasd
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Conversion Rates
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    asdasdasdasd
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Actual Sales
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    asdasdasdasd
                                </div>
                            </div>
                        </div>
                    </div>
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
        //******* 2012 Average Temperature - BAR CHART
        var data = [
                        [0, 100],
                        [1, 300],
                        [2, 100],
                        [3, 600],
                        [4, 1000],
                        [5, 700],
                        [6, 600],
                        [7, 700],
                    ];

        var data1 = [
                        [0, 20],
                        [1, 35],
                        [2, 15],
                        [3, 70],
                        [4, 300],
                        [5, 230],
                        [6, 100],
                        [7, 100],
                    ];

        var dataset = [
                        { label: "Expected Total Value", data: data, color: "#009CB6" },
                        { label: "Pipeline Value", data: data1, color: "#6AE5FA" }
                    ];
        var ticks = [[0, "January 2014"], [1, "Febuary 2014"], [2, "March 2014"], [3, "May 2014"],[4, "June 2014"], [5, "August 2014"], [6, "September 2014"], [7, "October 2014"]];
 
        var options = {
            series: {
                bars: {
                    show: true,
                    order:1
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
 
        $(document).ready(function () {
            $.plot($("#flot-placeholder"), dataset, options);
            $("#flot-placeholder").UseTooltip();
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
