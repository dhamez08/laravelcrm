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
                <a data-toggle="tab" href="#predefined" aria-expanded="true"> Predefined </a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#personal" aria-expanded="false"> Personal </a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#template-creator" aria-expanded="false"> Template Creator </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="predefined" class="tab-pane active">
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
            <div id="personal" class="tab-pane">
                <div class="row">
                    <div class="col-md-8">
                        <div class="portlet">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>Templates
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Subject
                                                </th>
                                                <th>
                                                    &nbsp;
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($email_templates as $template)
                                            <tr>
                                                <td>
                                                    {{ $template->name }}
                                                </td>
                                                <td>
                                                    {{ $template->subject }}
                                                </td>
                                                <td>
                                                    <a href="{{ url('marketing/update-template/'.$template->id) }}" class="btn btn-sm blue"><i class="fa fa-edit"></i></a>
                                                    <a href="{{ url('marketing/remove-template/'.$template->id) }}" class="btn btn-sm red"><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <a type="button" class="btn green" data-toggle="modal" href="#add-template-modal"><i class="fa fa-plus"></i> Add Email Template</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
            <div id="template-creator" class="tab-pane">
                <div class=row>
                    <div class="col-md-3 selector-background">
                    <!--  Section selector  -->
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#sections" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-th-large"></i> Modules
                                        </a>
                                    </h4>
                                </div>
                                <div id="sections" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <div class="col-md-12 section-element"><img data-section="header" src="{{asset('public/img/template_builder/header.jpg')}}"/></div>
                                        <div class="col-md-12 section-element"><img data-section="content-1" src="{{asset('public/img/template_builder/1-1 feature.jpg')}}"/></div>
                                        <div class="col-md-12 section-element"><img data-section="content-2" src="{{asset('public/img/template_builder/1-1 content box.jpg')}}"/></div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#tool-box" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="fa fa-sliders"></i> Toolbox
                                        </a>
                                    </h4>
                                </div>
                                <div id="tool-box" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <div class="col-md-12 m-top-15">
                                            <label for="font-size-slider" class="editor-label">Font Size</label>
                                        </div>
                                        <div class="col-md-12">
                                            <input id="font-size-slider" type="range" min="12" max="24" step="1" />
                                        </div>
                                        <div class="col-md-12 m-top-15">
                                            <label for="font-size-slider" class="editor-label">Font Color</label>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="colorpicker"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                    <!-- Canvas -->
                        <div id="template-canvas" class="canvas">

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
    {{ $add_template_modal }}
@stop

@section('script-footer')
    @parent
    @section('footer-custom-js')
    @parent
<script type='text/javascript' src="{{$asset_path}}/global/plugins/jquery.caret.js"></script>
<script src="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
<script src="{{$asset_path}}/global/plugins/farbtastic/farbtastic.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/underscore-min.js" type="text/javascript"></script>
<script>
    var BASE_URL = '{{ url('/') }}';
    var ASSET_PATH = '{{$asset_path}}';
    var ASSET_PATH_PUBLIC = '{{ url('public/admin/metronic/assets') }}';
</script>
<script src="{{$asset_path}}/pages/scripts/components-editors.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        $('#template_body').summernote({height: 300});
        $('#signature_body').summernote({height: 300});

        $("select#custom_form").live("change", function() {
            $this = $(this);
            $("#fields_container table tbody").html('');
            //show loading
            Metronic.blockUI({
                target: '#fields_container',
                boxed: true,
                message: 'Processing...'
            });

            var row='';
            $.get(BASE_URL+'/settings/custom-forms/fields/'+$this.val(), function(response) {
                var form_name = response.form.name;
                $.each(response.build, function(i, item) {
                    //row+='<tr><td><input type="text" value="['+form_name+':'+item.field_name+']" class="form-control" style="border:0px" /></td></tr>';
                    if($this.val()=='customer')
                        row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+item.field_name+'}</a></td></tr>';
                    else
                        row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">['+form_name+':'+item.field_name+']</a></td></tr>';
                });

                $("#fields_container table tbody").append(row);

                Metronic.unblockUI('#fields_container');
            }).error(function() {
                Metronic.unblockUI('#fields_container');
            });
        });

        var isValid = 0;

        $("#template_body").next().children('.note-editable').live("click", function() {
            isValid = 1;
        });

        $(document).click(function(event) {
            if(!$(event.target).closest('.note-editor').length && event.target!="javascript:void(0)") {
                isValid = 0;
            }
        });

        $("a.custom_form_link").live("click", function() {
            if(isValid==1) {
                var selection = document.getSelection();
                var cursorPos = selection.anchorOffset;
                var oldContent = selection.anchorNode.nodeValue;
                var toInsert = $(this).html();
                if(oldContent!=null) {
                    var newContent = oldContent.substring(0, cursorPos) + toInsert + oldContent.substring(cursorPos);
                    selection.anchorNode.nodeValue = newContent;
                } else {
                    $("#template_body").code($("#template_body").code()+''+toInsert+'');
                }
            } else {
                $("#template_body").setCursorToTextEnd();
                //alert('please click/focus on the editor to insert the dynamic field!');
            }
        });

        $(".note-image-dialog .close").live("click", function() {
            $(".note-image-dialog").removeClass("in").hide();
            $('.modal-backdrop').remove();
        });

        $(".note-video-dialog .close").live("click", function() {
            $(".note-video-dialog").removeClass("in").hide();
            $('.modal-backdrop').remove();
        });

        $(".note-link-dialog .close").live("click", function() {
            $(".note-link-dialog").removeClass("in").hide();
            $('.modal-backdrop').remove();
        });

        $(".note-help-dialog .modal-close").live("click", function() {
            $(".note-help-dialog").removeClass("in").hide();
            $('.modal-backdrop').remove();
        });
    });
</script>
<script src="{{$asset_path}}/pages/scripts/template-builder.js" type="text/javascript"></script>
    @stop
@stop
