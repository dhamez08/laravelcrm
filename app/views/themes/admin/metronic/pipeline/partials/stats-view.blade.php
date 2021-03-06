<style type="text/css">
.status .panel-title {
    font-family: 'Oswald', sans-serif;
    font-size: 30px;
    font-weight: bold;
    color: #fff;
    line-height: 45px;
    padding-top: 10px;
    letter-spacing: -0.8px;
}
</style>
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
                        
                        <div class="panel status panel-yellow">
                            <div class="panel-heading">
                                <h1 class="panel-title text-center">
                                @if(count($stats)>0)
                                    £{{ number_format($stats[0]->pipeline,2) }}
                                @else
                                    £0.00
                                @endif
                                </h1>
                            </div>
                            <div class="panel-body text-center">                        
                                <strong>Pipeline Value</strong>
                            </div>
                        </div>

                    </div>          
                    <div class="col-md-6">
                      
                        <div class="panel status panel-orange">
                            <div class="panel-heading">
                                <h1 class="panel-title text-center">
                                @if(count($stats)>0)
                                    £{{ number_format($stats[0]->total,2) }}
                                @else
                                    £0.00
                                @endif
                                </h1>
                            </div>
                            <div class="panel-body text-center">                        
                                <strong>Total Value</strong>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row hidden">
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
                        <div class="easy-pie-chart">
                            <div class="number conversion_30days" data-percent="{{ $conversion_30days }}">
                                <span>
                                {{ $conversion_30days }} </span>
                                %
                            </div>
                            <a class="title" href="{{ url('pipeline/list-view?status=conversionthismonth') }}">
                            This Month
                            </a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm">
                    </div>
                    <div class="col-md-4">
                        <div class="easy-pie-chart">
                            <div class="number conversion_90days" data-percent="{{ $conversion_90days }}">
                                <span>
                                {{ $conversion_90days }} </span>
                                %
                            </div>
                            <a class="title" href="{{ url('pipeline/list-view?status=conversion90days') }}">
                            Last 90 Days
                            </a>
                        </div>
                    </div>
                    <div class="margin-bottom-10 visible-sm">
                    </div>
                    <div class="col-md-4">
                        <div class="easy-pie-chart">
                            <div class="number conversion_360days" data-percent="{{ $conversion_360days }}">
                                <span>
                                {{ $conversion_360days }} </span>
                                %
                            </div>
                            <a class="title" href="{{ url('pipeline/list-view?status=conversionthisyear') }}">
                            Year to Date
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row hidden">
                    <div class="col-md-4">
                        <div class="dashboard-stat blue-madison">
                            <div class="visual"><i class="fa fa-bar-chart-o"></i></div>
                            <div class="details">   
                                <div class="number">{{ $conversion_30days }}%</div>
                                <div class="desc"><a href="{{ url('pipeline/list-view') }}">This Month</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-stat purple-plum">
                            <div class="visual"><i class="fa fa-bar-chart-o"></i></div>
                            <div class="details">   
                                <div class="number">{{ $conversion_90days }}%</div>
                                <div class="desc"><a href="{{ url('pipeline/list-view') }}">Last 90 Days</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-stat red-intense">
                            <div class="visual"><i class="fa fa-bar-chart-o"></i></div>
                            <div class="details">   
                                <div class="number">{{ $conversion_360days }}%</div>
                                <div class="desc"><a href="{{ url('pipeline/list-view') }}">Year to Date</a></div>
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
                        
                        <div class="panel status panel-blue-madison">
                            <div class="panel-heading">
                                <h1 class="panel-title text-center">
                                    £{{ number_format($sales_30days,2) }}
                                </h1>
                            </div>
                            <div class="panel-body text-center">                        
                                <strong><a href="{{ url('pipeline/list-view?status=wonthismonth') }}">This Month</a></strong>
                            </div>
                        </div>

                    </div>          
                    <div class="col-md-4">
                      
                        <div class="panel status panel-purple-plum">
                            <div class="panel-heading">
                                <h1 class="panel-title text-center">
                                    £{{ number_format($sales_90days,2) }}
                                </h1>
                            </div>
                            <div class="panel-body text-center">                        
                                <strong><a href="{{ url('pipeline/list-view?won90days') }}">Last 90 Days</a></strong>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                      
                        <div class="panel status panel-red-intense">
                            <div class="panel-heading">
                                <h1 class="panel-title text-center">
                                    £{{ number_format($sales_360days,2) }}
                                </h1>
                            </div>
                            <div class="panel-body text-center">                        
                                <strong><a href="{{ url('pipeline/list-view?wonthisyear') }}">Year to Date</a></strong>
                            </div>
                        </div>

                    </div>                    
                </div>

                <div class="row hidden">
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