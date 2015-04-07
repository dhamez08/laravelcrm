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
<div class="col-md-12">
    <div class="tabbable tabbable-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#predefined" aria-expanded="true"> User Templates </a>
            </li>
            <li class="">
                <a data-toggle="tab" href="#personal" aria-expanded="false"> Personal </a>
            </li>
            <li class="">
                <a id="template-creator-tab" data-toggle="tab" href="#template-creator" aria-expanded="false"> Template Creator </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="predefined" class="tab-pane active">
                <div class="row mix-grid thumbnails">
<!--                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">-->
<!--                        <div class="mix-inner">-->
<!--                            <img alt="" src="{{asset('public/img/template_previews/worn_left.jpg')}}" class="img-responsive">-->
<!--                            <div class="mix-details">-->
<!--                                <h4>Set this template as default?</h4>-->
<!--                                <a class="mix-link"><i class="fa fa-check"></i></a>-->
<!--                                <a data-rel="fancybox-button" title="Project Name" href="{{asset('public/img/template_previews/worn_left.jpg')}}" class="mix-preview fancybox-button"><i class="fa fa-pencil"></i></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
                    @foreach($user_email_templates as $template)
                    <div class="col-lg-2 col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                        <div class="mix-inner">
                            <img alt="" src="{{asset('public/documents/'.$template['preview'])}}" class="img-responsive">
                            <div class="mix-details">
                                <h4>Set this template as default?</h4>
                                <a class="mix-link"><i class="fa fa-check"></i></a>
                                <a data-rel="fancybox-button" data-template-id="{{$template['id']}}" class="mix-preview fancybox-button template-edit"><i class="fa fa-pencil"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach


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
                                <div class="panel-heading" role="tab" id="module-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#controls" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-gear"></i> Controls
                                        </a>
                                    </h4>
                                </div>
                                <div id="controls" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="module-heading">
                                    <div class="panel-body" id="layout-list">
                                        <div class="control-item" id="create-new">
                                            Create New
                                        </div>
                                        <div class="control-item" id="save-template">
                                            Save
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="module-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#layouts" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fa fa-th-large"></i> Modules
                                        </a>
                                    </h4>
                                </div>
                                <div id="layouts" class="panel-collapse collapse" role="tabpanel" aria-labelledby="module-heading">
                                    <div class="panel-body" id="layout-list">
                                        <!-- Start -->
                                        <div class="panel-group" id="layout-list" role="tablist" aria-multiselectable="true">
                                        @foreach($layouts as $layout)
                                            <div class="panel panel-default">
                                                <div class="panel-heading" role="tab" id="layout-{{$layout['id']}}-heading">
                                                    <h4 class="panel-title">
                                                        <a class="layout-name" data-layout-id="{{$layout['id']}}" data-toggle="collapse" data-parent="#layout-list" href="#layout-{{$layout['id']}}-sections" aria-expanded="true" aria-controls="collapseOne">
                                                            <strong>{{$layout['name']}}</strong>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="layout-{{$layout['id']}}-sections" class="panel-collapse collapse" role="tabpanel" aria-labelledby="layout-{{$layout['id']}}-heading">
                                                    <div class="panel-body display-image-list" id="layout-{{$layout['id']}}-section-list"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                        <!-- End -->
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="module-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#tool-box" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="fa fa-sliders"></i> Styles
                                        </a>
                                    </h4>
                                </div>
                                <div id="tool-box" class="panel-collapse collapse" role="tabpanel" aria-labelledby="toolbar-heading">
                                    <div class="panel-body">
                                        <div class="row text-control">
                                            <div class="col-md-6 m-top-15">
                                                <label for="font-size-slider" class="editor-label">Apply to All</label>
                                            </div>
                                            <div class="col-md-6 m-top-15">
                                                <input type="checkbox" id="apply-all" data-size="small" />
                                            </div>
                                        </div>
                                        <div class="row text-control">
                                            <div class="col-md-6 m-top-15">
                                                <label for="font-size-slider" class="editor-label">Font Size</label>
                                            </div>
                                            <div class="col-md-6 m-top-15">
                                                <input id="font-size-slider" type="range" min="12" max="24" step="1" />
                                            </div>
                                        </div>
                                        <div class="row text-control">
                                            <div class="col-md-6 m-top-15">
                                                <label for="font-size-slider" class="editor-label">Font Color</label>
                                            </div>
                                            <div class="col-md-6 m-top-15">
                                                <input id="font-color" class="form-control tool-box-input" type="text"/>
                                            </div>
                                        </div>
                                        <div class="row text-control box-control">
                                            <div class="col-md-6 m-top-15">
                                                <label for="font-size-slider" class="editor-label">Background Color</label>
                                            </div>
                                            <div class="col-md-6 m-top-15">
                                                <input id="background-color" class="form-control tool-box-input" type="text"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12 colorpicker-container hide">
                                            <div id="colorpicker"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="module-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#preview-box" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="fa fa-expand"></i> Preview
                                        </a>
                                    </h4>
                                </div>
                                <div id="preview-box" class="panel-collapse collapse" role="tabpanel" aria-labelledby="toolbar-heading">
                                    <div class="panel-body" id="layout-list">
                                        <div class="control-item" id="fullscreen-preview">
                                            Fullscreen
                                        </div>
                                        <div class="control-item" id="mobile-preview">
                                            Mobile
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="module-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#dynamic-field" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="fa fa-th-list"></i> Dynamic Fields
                                        </a>
                                    </h4>
                                </div>
                                <div id="dynamic-field" class="panel-collapse collapse" role="tabpanel" aria-labelledby="toolbar-heading">
                                    <div class="panel-body" id="layout-list">
                                        <select id="custom_form" class="form-control">
                                            <option value="0">Choose a Form</option>
                                            <option value="customer">---Customer Information---</option>
                                            <option value="custom_fields">---Custom Fields---</option>
                                            <?php
                                            $forms = \CustomForm\CustomFormEntity::get_instance()->getFormsByLoggedUser();
                                            ?>
                                            @foreach($forms as $form)
                                            <option value="{{ $form->id }}">{{ $form->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="fields_container" style="margin-top:15px;min-height:230px;">
                                            <div class="scroller" style="height:230px" data-always-visible="0" data-rail-visible="0" data-rail-color="red" data-handle-color="green">
                                                <table class="table table-hover">
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                    <!-- Canvas -->
                        <div id="template-loader-container">
                            <img id="cropper-loader" src="{{$asset_path}}/global/img/spiffygif_88x88.gif"/>
                        </div>
                        <input type="hidden" id="mobile-preview-style" value='/* iPad Text Smoother */div, p, a, li, td { -webkit-text-size-adjust:none; }/* Reset */* { margin-top: 0px; margin-bottom: 0px; padding: 0px; border: none; line-height: normal; outline: none; list-style: none; -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }table { border-collapse: collapse !important; padding: 0px !important; border: none !important; border-bottom-width: 0px !important; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }table td { border-collapse: collapse; }body { margin: 0px; padding: 0px; background-color: #FFFFFF;}.ExternalClass * { line-height: 100%; }/* Responsive */@media only screen and (max-width:600px) {	/* Tables	parameters: width, alignment, padding */	table[class=scale] { width: 100%!important; }		/* Td */	td[class=scale-center-both] { width: 100%!important; text-align: center!important; padding-left: 20px!important; padding-right: 20px!important; }	td[class=scale-center-both-bottom] { width: 100%!important; text-align: center!important; padding-left: 20px!important; padding-right: 20px!important; padding-bottom: 24px!important; }	td[class=scale-center-both-bottom60] { width: 100%!important; text-align: center!important; padding-left: 20px!important; padding-right: 20px!important; padding-bottom: 60px!important; }	td[class=scale-center-both-top] { width: 100%!important; text-align: center!important; padding-left: 20px!important; padding-right: 20px!important; padding-top: 24px!important; }	td[class=scale-center-bottom] { width: 100%!important; text-align: center!important; padding-bottom: 24px!important; }	td[class=scale-center-bottom-top] { width: 100%!important; text-align: center!important; padding-bottom: 24px!important; padding-top: 24px!important; }	td[class=h30] { height: 30px!important; }	img[class="reset"] { display: inline!important; }	img[class="reset2"] { display: inline!important; width: 100%!important; }}'>
                        <div class="template-control form-inline">
                            <div class="form-group row">
                                <div class="col-md-4 label-container"><label for="template-name">Template Name: </label></div>
                                <div class="col-md-8"><input id="template-name" type="text" class="col-md-8 form-control" placeholder="Enter a title for your template"></div>
                            </div>
                        </div>
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
    {{ $cropper_modal }}
    {{ $mobile_preview_modal }}
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
<script src="{{$asset_path}}/pages/scripts/underscore-min.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/rangy-core.js" type="text/javascript"></script>
<script src="{{$asset_path}}/pages/scripts/rangy-selectionsaverestore.js" type="text/javascript"></script>
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

//        $("select#custom_form").live("change", function() {
//            $this = $(this);
//            $("#fields_container table tbody").html('');
//            //show loading
//            Metronic.blockUI({
//                target: '#fields_container',
//                boxed: true,
//                message: 'Processing...'
//            });
//
//            var row='';
//            $.get(BASE_URL+'/settings/custom-forms/fields/'+$this.val(), function(response) {
//                var form_name = response.form.name;
//                $.each(response.build, function(i, item) {
//                    //row+='<tr><td><input type="text" value="['+form_name+':'+item.field_name+']" class="form-control" style="border:0px" /></td></tr>';
//                    if($this.val()=='customer')
//                        row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+item.field_name+'}</a></td></tr>';
//                    else
//                        row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">['+form_name+':'+item.field_name+']</a></td></tr>';
//                });
//
//                $("#fields_container table tbody").append(row);
//
//                Metronic.unblockUI('#fields_container');
//            }).error(function() {
//                Metronic.unblockUI('#fields_container');
//            });
//        });

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
