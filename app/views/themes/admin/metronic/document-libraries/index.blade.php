@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{$asset_path}}/global/plugins/dropzone/css/dropzone.css" rel="stylesheet"/>
    <link href="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
    <link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
    <link href="{{$asset_path}}/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<!-- CUSTOM FILES -->
				<div class="portlet light bordered" style="min-height: 625px">
					<div class="portlet-title tabbable-line">
						<div class="caption col-md-8">
							<span class="caption-subject font-green-sharp ">My Uploaded Documents</span>
						</div>
						<div class="col-md-4 text-right">
							<span class="text-primary" style="font-size:16px;">
								<a class="btn blue" href="#" data-toggle="modal" data-target="#section-subsection-modal" data-sectionid="55" id="btnCreateSection">
									<i class="fa fa-plus"></i> Create New Section
								</a>
                                <a class="btn red disabled" href="#" id="delete-all">
                                    <i class="fa fa-times"></i> Delete Selected
                                </a>
							</span>
							
						</div>
					</div>
					<div class="portlet-body tabbable-line">
						<!--BEGIN TABS-->
						<div class="tab-content">
							<div class="tab-pane active">
                                @foreach($sections as $section)
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title" style="border-bottom-width: 0px;">
                                        <div class="caption">
                                            <i class="fa fa-folder"></i>{{$section->description}}
                                        </div>
                                        <div class="tools">
                                            <a class="collapse" href="javascript:;" data-original-title="" title=""></a>
                                        </div>
                                        <div class="actions">
                                            <a class="btn btn-default btn-sm" href="javascript:;" name="btnCreateSubsection" data-sectionid="{{$section->id}}" data-target="#section-subsection-modal" data-toggle="modal">
                                                <i class="fa fa-plus"></i> Add Subsection </a>
                                            <a class="btn btn-default btn-sm" href="javascript:;" name="btnEditSection" data-sectiondesc="{{$section->description}}" data-sectionid="{{$section->id}}" data-target="#section-subsection-modal" data-toggle="modal" >
                                                <i class="fa fa-pencil"></i> Edit </a>
                                            <a class="btn btn-default btn-sm delete-section" href="javascript:;" data-master-section-id="{{$section->id}}">
                                                <i class="fa fa-trash"></i> Delete </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div id="main-section-{{$section->id}}" class="panel-group accordion">
                                        <!-- Loop within subsections -->
                                            @foreach($subsections[$section->id] as $subsection)
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <div class="row" style="margin: 0">
                                                            <div class="col-md-10">
                                                                <a href="#sub-section-{{$subsection->id}}" data-parent="#main-section-{{$section->id}}" data-toggle="collapse" class="accordion-toggle collapsed" aria-expanded="false">
                                                                    {{$subsection->description}} </a>
                                                            </div>
                                                            <div class="col-md-2 text-right" style="padding-top: 6px; padding-bottom: 6px">
                                                                <a href="javascript:;" class="btn btn-default btn-sm" name="btnAddNewDocument" data-sectionid="{{$section->id}}" data-subsectionid="{{$subsection->id}}" data-target="#add-document-library-modal" data-toggle="modal">
                                                                    <i class="fa fa-upload"></i></a>
                                                                <a href="javascript:;" class="btn btn-default btn-sm" name="btnEditSection" data-sectiondesc="{{$subsection->description}}" data-sectionid="{{$subsection->id}}" data-target="#section-subsection-modal" data-toggle="modal">
                                                                    <i class="fa fa-pencil"></i></a>
                                                                <a href="javascript:;" class="btn btn-default btn-sm delete-section" data-master-section-id="{{$subsection->id}}">
                                                                    <i class="fa fa-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse collapse" id="sub-section-{{$subsection->id}}" aria-expanded="false" style="height: 0px;">
                                                    <div class="panel-body">
                                                        <ul class="feeds">
                                                            @foreach($documents[$subsection->id] as $document)
                                                                <li>
                                                                    <div class="col-md-7">
                                                                        <div class="row">
                                                                            <div class="col-md-1">
                                                                                <input class="file-checkbox" type="checkbox" data-file-id="{{$document->id}}" />
                                                                            </div>
                                                                            <div class="col-md-1">
                                                                                <div class="label label-sm label-danger">
                                                                                    <i class="fa {{ $icons[$document->file_ext] or 'fa-file-o' }}"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                                <div class="desc">
                                                                                    <a href="{{ $path.'/'.$document->filename }}" target="_blank" class="file-preview" data-thumb="{{ asset('public' . $document->thumbnail) }}">{{ $document->name }}</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <a href="{{ url('document-library/delete/'.$document->id) }}" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Remove</a>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endforeach

							</div>
						</div>
						<!--END TABS-->
						<!-- <button class="btn green-haze btn-circle btn-sm pull-right" data-toggle="modal" data-target="#add-document-library-modal">New</button> -->
					</div>
				</div>	
				<!-- END CUSTOM FILES -->
			</div>
		</div>
	</div>

	@include( \DashboardEntity::get_instance()->getView() . '.document-libraries.partials.modals.add-document-library-modal' )
	@stop
	@include( \DashboardEntity::get_instance()->getView() . '.document-libraries.partials.modals.section-subsection-modal' )
	@stop
@stop
@section('script-footer')
	@parent
	@section('footer-custom-js')
        @parent
            <!-- BEGIN:File Upload Plugin JS files-->
            <!-- The Templates plugin is included to render the upload/download listings -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
            <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
            <!-- The Canvas to Blob plugin is included for image resizing functionality -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
            <!-- blueimp Gallery script -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
            <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
            <!-- The basic File Upload plugin -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
            <!-- The File Upload processing plugin -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
            <!-- The File Upload image preview & resize plugin -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
            <!-- The File Upload audio preview plugin -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
            <!-- The File Upload video preview plugin -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
            <!-- The File Upload validation plugin -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
            <!-- The File Upload user interface plugin -->
            <script src="{{$asset_path}}/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>

            <script src="{{$asset_path}}/pages/scripts/form-fileupload.js"></script>
            <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
            <script>
                $(function(){
                    var file_ids = new Array();

                    $('.accordion-toggle').on('click', function () {
                        var panel_group = $(this).closest('.panel-group');
                        panel_group.find('.panel-collapse').collapse('toggle');
                    });

                    $('.file-checkbox').on('click', function(){
                        var cbx = $(this);
                        var file_id = cbx.data('file-id');

                        if(cbx.is(':checked')){
                            file_ids.push(file_id);
                        } else {
                            var index = file_ids.indexOf(file_id);
                            if (index >= 0)
                                file_ids.splice(index, 1);
                        }

                        if(file_ids.length){
                            $('#delete-all').removeClass('disabled');
                        } else {
                            $('#delete-all').addClass('disabled');
                        }
                    });

                    $('#delete-all').on('click',function(){
                        var bootbox_open = true;
                        var box = bootbox.confirm({
                            message: 'Are you sure you want to delete selected documents?',
                            callback: function(result){
                                if(result){
                                    var query = $.param({ file_ids: file_ids });
                                    window.location.href = baseURL+'/document-library/bulk-delete?'+query;
                                }

                                if(bootbox_open){
                                    bootbox_open = false;
                                    box.find('.close').click();
                                }
                            },
                            show: true
                        });
                    });

                    $('.delete-section').on('click',function(){
                        var bootbox_open = true;
                        var section_id = $(this).data('master-section-id');
                        var box = bootbox.confirm({
                            message: 'Are you sure you want to delete this section? This will delete all files inside the sections.',
                            callback: function(result){
                                if(result){
                                    window.location.href = baseURL+'/document-library/delete-section/'+section_id;
                                }

                                if(bootbox_open){
                                    bootbox_open = false;
                                    box.find('.close').click();
                                }
                            },
                            show: true
                        });
                    })
                });
            </script>
        <script>
            jQuery(document).ready(function() {
                $(document).bind('drop dragover', function (e) {
                    e.preventDefault();
                });
                FormFileUpload.init();
                deleteFiles.init();
                jQuery('a.clientFiles').each(function(){
                    jQuery(this).editable({
                        send:'always',
                        ajaxOptions: {
                            dataType: 'json'
                        },
                        success: function(response, newValue) {
                            if(!response) {
                                return "Unknown error!";
                            }

                            if(response.result === false) {
                                return response.message;
                            }
                        }
                    });
                });
            });
        </script>
        @stop
@stop
