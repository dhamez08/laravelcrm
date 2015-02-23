<div class="col-md-3">
    <div class="panel status panel-purple-plum">
        <div class="panel-heading">
            <h1 class="panel-title text-center">
                £{{ number_format($sales_30days,2) }}
            </h1>
        </div>
        <div class="panel-body text-center">                        
            <strong><a href="{{ url('pipeline/list-view?status=wonthismonth') }}">Sales Month to Date</a></strong>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="panel status panel-green-light">
        <div class="panel-heading">
            <h1 class="panel-title text-center">
                {{ $conversion_30days }}%
            </h1>
        </div>
        <div class="panel-body text-center">                        
            <strong><a href="{{ url('pipeline/list-view') }}">Conversion Month to Date</a></strong>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="panel status panel-red-intense">
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
            <strong>Pipeline Total</strong>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="panel status panel-blue-madison">
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
            <strong>Pipeline Expected</strong>
        </div>
    </div>
</div>  