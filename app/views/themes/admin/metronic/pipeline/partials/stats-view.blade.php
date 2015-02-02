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