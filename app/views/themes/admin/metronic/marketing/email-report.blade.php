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
        <div class="portlet-tabs">
            <div class="tab-content">
                <div class="row">
                    <div class="col-md-6">
                        <!-- BEGIN CHART PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject bold uppercase font-green-haze"> Email Marketing Statistics</span>
                                    <span class="caption-helper">for the month of May</span>
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;" data-original-title="" title="">
                                    </a>
                                    <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">
                                    </a>
                                    <a class="reload" href="javascript:;" data-original-title="" title="">
                                    </a>
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
                                    <span class="caption-helper">for the month of May</span>
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;" data-original-title="" title="">
                                    </a>
                                    <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">
                                    </a>
                                    <a class="reload" href="javascript:;" data-original-title="" title="">
                                    </a>
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
                                    <span class="caption-helper">for the month of May</span>
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;" data-original-title="" title="">
                                    </a>
                                    <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">
                                    </a>
                                    <a class="reload" href="javascript:;" data-original-title="" title="">
                                    </a>
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
                                    <span class="caption-helper">for the month of May</span>
                                </div>
                                <div class="tools">
                                    <a class="collapse" href="javascript:;" data-original-title="" title="">
                                    </a>
                                    <a class="config" data-toggle="modal" href="#portlet-config" data-original-title="" title="">
                                    </a>
                                    <a class="reload" href="javascript:;" data-original-title="" title="">
                                    </a>
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
</script>
<script src="{{$asset_path}}/pages/scripts/components-editors.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/template-builder.js" type="text/javascript"></script>
@stop
@stop
