@extends( $dashboard_index )
@section('begin-head')
@parent
@section('head-page-level-css')
@parent
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{$asset_path}}/pages//css/portfolio.css" rel="stylesheet"/>
<link href="{{$asset_path}}/pages//css/email-marketing.css" rel="stylesheet"/>
<link href="{{$asset_path}}/pages//css/template-builder.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.css"/>
<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/farbtastic/farbtastic.css"/>
<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/jcrop/css/jquery.Jcrop.min.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
@stop
@stop

@section('body-content')
@parent
@section('innerpage-content')
<div class="portlet box {{{$dashboard_class or 'blue'}}} tabbable">
    <div class="portlet-title">
        <div class="caption">
            @section('portlet-captions')
            {{{$portlet_title or 'Portlet Title'}}}
            @show
        </div>
    </div>
    <div class="portlet-body {{{$portlet_body_class or ''}}}">
        <div class="tabbable portlet-tabs">
                <ul class="nav nav-tabs">
                    <li class="">
                        <a id="list-view-tab" data-toggle="tab" href="#list-report" aria-expanded="true"> List View </a>
                    </li>
                    <li class="active">
                        <a id="chart-view-tab" data-toggle="tab" href="#chart-report" aria-expanded="false"> Chart View </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="chart-report" class="tab-pane active">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Date Range:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-icon">
                                                <i class="fa fa-calendar"></i>
                                                <input type="text" id="start-date" placeholder="Start" data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="" value="" size="16" class="form-control date-picker email-date">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-icon">
                                                <i class="fa fa-calendar"></i>
                                                <input type="text" id="end-date" placeholder="End" data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="" value="" size="16" class="form-control date-picker email-date">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button id="date-range-button" class="btn blue" type="button">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Email Marketing Statistics</span>
                                                <span class="caption-helper date-label"></span>
                                            </div>
                                            <div class="tools">
                                                <a class="collapse" href="javascript:;" data-original-title="" title="">
                                                </a>
<!--                                                <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">-->
<!--                                                </a>-->
<!--                                                <a class="reload" href="javascript:;" data-original-title="" title="">-->
<!--                                                </a>-->
                                                <a class="fullscreen" href="javascript:;" data-original-title="" title="">
                                                </a>
                                                <a class="remove" href="javascript:;" data-original-title="" title="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="email-total-report" style="height: 300px"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Total Email Sent</span>
                                                <span class="caption-helper date-label"></span>
                                            </div>
                                            <div class="tools">
                                                <a class="collapse" href="javascript:;" data-original-title="" title="">
                                                </a>
<!--                                                <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">-->
<!--                                                </a>-->
<!--                                                <a class="reload" href="javascript:;" data-original-title="" title="">-->
<!--                                                </a>-->
                                                <a class="fullscreen" href="javascript:;" data-original-title="" title="">
                                                </a>
                                                <a class="remove" href="javascript:;" data-original-title="" title="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="email-total-sent" style="height: 300px"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Total Email Read</span>
                                                <span class="caption-helper date-label"></span>
                                            </div>
                                            <div class="tools">
                                                <a class="collapse" href="javascript:;" data-original-title="" title="">
                                                </a>
<!--                                                <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">-->
<!--                                                </a>-->
<!--                                                <a class="reload" href="javascript:;" data-original-title="" title="">-->
<!--                                                </a>-->
                                                <a class="fullscreen" href="javascript:;" data-original-title="" title="">
                                                </a>
                                                <a class="remove" href="javascript:;" data-original-title="" title="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="email-total-read" style="height: 300px"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                                <div class="col-md-6">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> Total Email Bounced</span>
                                                <span class="caption-helper date-label"></span>
                                            </div>
                                            <div class="tools">
                                                <a class="collapse" href="javascript:;" data-original-title="" title="">
                                                </a>
<!--                                                <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">-->
<!--                                                </a>-->
<!--                                                <a class="reload" href="javascript:;" data-original-title="" title="">-->
<!--                                                </a>-->
                                                <a class="fullscreen" href="javascript:;" data-original-title="" title="">
                                                </a>
                                                <a class="remove" href="javascript:;" data-original-title="" title="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="email-total-bounced" style="height: 300px"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="list-report" class="tab-pane">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="row form-group">
                                        <div class="col-md-2">
                                            <label class="control-label">Filter:</label>
                                        </div>
                                        <div class="col-md-10">
                                            <select id="email-status-filter" class="form-control">
                                                <option value="all">All</option>
                                                <option value="sent">Sent</option>
                                                <option value="read">Read</option>
                                                <option value="bounced">Bounced</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9"></div>
                            </div>
                            <div id="email-list-container">
                                <table id="email-list-table" class="table table-striped table-bordered table-advance table-hover">
                                    <thead class="flip-content">
                                        <tr>
                                            <th width="20%">
                                                Sender
                                            </th>
                                            <th>
                                                Recepient
                                            </th>
                                            <th class="numeric">
                                                Subject
                                            </th>
                                            <th class="numeric">
                                                Date Sent
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center"><span id="email-list-more" style="cursor: pointer">More <i class="fa fa-chevron-down"></i></span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@stop
@stop

@section('body-modals')

@stop

@section('script-footer')
@parent
@section('footer-custom-js')
@parent
<script type='text/javascript' src="{{$asset_path}}/global/plugins/jcrop/js/jquery.Jcrop.min.js"></script>
<script type='text/javascript' src="{{$asset_path}}/global/plugins/jquery.caret.js"></script>
<script src="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="{{$asset_path}}/global/plugins/farbtastic/farbtastic.js" type="text/javascript"></script>
<script src="{{$asset_path}}/global/plugins/html2canvas/html2canvas.js" type="text/javascript"></script>
<script src="{{$asset_path}}/global/plugins/amcharts/amcharts.js" type="text/javascript"></script>
<script src="{{$asset_path}}/global/plugins/amcharts/serial.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/email-reporting.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/underscore-min.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/rangy-core.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/rangy-selectionsaverestore.js" type="text/javascript"></script>
<script>
    var BASE_URL = '{{ url('/') }}';
    var ASSET_PATH = '{{$asset_path}}';
    var ASSET_PATH_PUBLIC = '{{ url('public/admin/metronic/assets') }}';

    $(function(){
        jQuery('.email-date').datepicker({
            autoclose:true,
            format: 'yyyy-mm-dd'
        });
    });
</script>
<script src="{{$asset_path}}/pages/scripts/components-editors.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/template-builder.js" type="text/javascript"></script>
@stop
@stop
