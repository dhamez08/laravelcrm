@extends( $dashboard_index )
    @section('begin-head')
        @parent
        @section('head-page-level-css')
            @parent
            <!-- BEGIN PAGE LEVEL STYLES -->
            <link href="{{$asset_path}}/pages//css/portfolio.css" rel="stylesheet"/>
            <link href="{{$asset_path}}/pages//css/email-marketing.css" rel="stylesheet"/>
            <!-- END PAGE LEVEL SCRIPTS -->
        @stop
@stop

@section('body-content')
@parent
@section('innerpage-content')
<div class="col-md-12">
    <div class="tabbable tabbable-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#tab_1" aria-expanded="true"> Predefined </a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#tab_2" aria-expanded="false"> Personal </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="tab_1" class="tab-pane active">
                <div class="row mix-grid thumbnails">
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/worn_left.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/worn_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/textile_left.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/textile_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/natural_1.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/natural_1.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/mistymeadow_left.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/mistymeadow_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/helvetica_left.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/helvetica_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/harbourcoat_left.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/harbourcoat_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/fabric_left.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/fabric_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/img/template_previews/eco_left.jpg')}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/eco_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="tab_2" class="tab_pane">

            </div>
        </div>
    </div>
</div>

@stop
@stop
@section('script-footer')
@parent
@section('footer-custom-js')
@parent
@stop
@stop
