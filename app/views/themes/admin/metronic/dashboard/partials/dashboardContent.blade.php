<!-- LEFT -->
<div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			{{\Task\TaskController::get_instance()->getWidgetDisplay(null,null)}}
		</div>
	</div>
</div>
<!-- LEFT -->
<!-- RIGHT -->
<div class="col-lg-6 col-md-6 col-sm-12 col-sx-12">
	<div class="row">
		<div class="col-md-12 col-sm-12">
            @include($view_path . '.pipeline.partials.stats-view', 
                array(
                    'stats' => isset($stats) ? $stats : array(),
                    'conversion_30days' => isset($conversion_30days) ? $conversion_30days : 0,
                    'conversion_90days' => isset($conversion_90days) ? $conversion_90days : 0,
                    'conversion_360days' => isset($conversion_360days) ? $conversion_360days : 0,
                    'sales_30days' => isset($sales_30days) ? $sales_30days : 0,
                    'sales_90days' => isset($sales_90days) ? $sales_90days : 0,
                    'sales_360days' => isset($sales_360days) ? $sales_360days : 0,
                )
            )
		</div>
	</div>
</div>
<!-- RIGHT -->
