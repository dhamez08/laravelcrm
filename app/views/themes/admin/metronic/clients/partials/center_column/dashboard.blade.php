<div class="col-md-12">
	<div class="row" id="portlets">
		<div class="col-lg-6 column">
			<!-- BEGIN TASKS -->
			{{\Task\TaskController::get_instance()->getWidgetDisplay($customerId,$belongsTo)}}
			<!-- END TASKS -->

			<!-- BEGIN FILE -->
			<div class="portlet light bordered">
				<div class="portlet-title tabbable-line">
					<div class="caption font-green-sharp">
						<i class="icon-doc font-green-sharp"></i>
						<span class="caption-subject bold uppercase">Files </span>
					</div>
					<div class="actions pull-left" style="margin-left: 5px;">
						<a data-toggle="modal" role="button" href="#fileuploadmodal" class="btn btn-icon-only btn-circle btn-sm green-meadow"><i class="fa fa-plus"></i> </a>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#recent" data-toggle="tab">Recent </a>
						</li>
						<li class="">
							<a href="#livedocs" data-toggle="tab">Live Document </a>
						</li>
						<li class="">
							<a href="#search" data-toggle="tab">Search </a>
						</li>
					</ul>
				</div>
				<div class="portlet-body">
					<div class="tab-content">
						<div class="tab-pane active" id="recent">
							{{ 
								Form::open(
									array(
										'action' => array(
											'File\ClientFileController@postBulkDeleteFile',
											'customer_id' => $customerId
										),
										'role' => 'form'
									)
								) 
							}}
							@if(count($customer_files) > 0)
								@include($view_path.'.clients.partials.bulkDeleteToolbar', array('checkbox_name' => 'files_check_all', 'table_target' => '#table-file-list'))						
							@endif	
							<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
								<table class="table table-condensed" id="table-file-list">
									<tbody>
										@if(count($customer_files) > 0)
											@foreach($customer_files as $files)
												<tr>
													<td style="width:1%">
														{{ Form::checkbox('files_to_delete[]', $files->id) }}
													</td>
													<td>
														<span class="label label-sm label-info">
															<?php
															$ext = explode(".",$files->filename);
															$ext = strtolower(trim(end($ext)));
															$file_type = "file";
															switch($ext){
																case "pdf":
																	$file_type = "file-pdf";
																	break;
																case "doc":
																case "docx":
																	$file_type = "file-word";
																	break;
																case "png":
																case "jpg":
																case "jpeg":
																case "bmp":
																case "gif":
																case "tif":
																	$file_type = "file-image";
																	break;
																case "ppt":
																case "pptx":
																	$file_type = "file-powerpoint";
																	break;
																case "xls":
																case "xlsx":
																	$file_type = "file-excel";
																	break;
																case "php":
																case "js":
																case "py":
																case "rb":
																case "cpp":
																case "c":
																case "sh":
																case "html":
																case "css":
																case "sass":
																case "less":
																	$file_type = "file-code";
																	break;
																case "mp3":
																case "mp4":
																case "acc":
																case "ogg":
																	$file_type = "file-sound";
																	break;
																case "mkv":
																case "flv":
																case "avi":
																case "wmv":
																	$file_type = "file-video";
																	break;
																case "zip":
																case "rar":
																case "bz":
																case "gz":
																	$file_type = "file-zip";
																	break;
																default:
																	$file_type = "file";
															}
															?>
															<i class="fa fa-{{$file_type}}-o"></i>
														</span>
														&nbsp;&nbsp;<a download href="{{asset('public/documents/' . $files->filename)}}" class="file-preview" data-thumb="{{asset('public' . $files->thumbnail)}}" title="Download File {{$files->filename}}">{{$files->filename}}</a>
													</td>
													<td>
													<a href="{{
																action(
																	'File\ClientFileController@getDeleteFileSummary',
																	array(
																		'id'=>$files->id,
																		'customerid'=>$files->customer_id
																	)
																)
															}}"
														class="pull-right" title="Delete File {{$files->filename}}">
															<i class="icon-trash"></i> 
													</a>
													</td>
												</tr>
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
							{{ Form::close() }}
						</div>
						<div class="tab-pane" id="livedocs">
							<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
								<table class="table table-condensed" id="table-file-list">
									<tbody>
										@if($shared)
										<tr>
											<td colspan="3">Documents shared with client</td>
										</tr>
											@foreach($shared as $shared_file)
												<tr>
													<td>
														<span class="label label-sm label-info">
															<?php
															$ext = explode(".",$shared_file['url']);
															$ext = strtolower(trim(end($ext)));
															$file_type = "file";
															switch($ext){
																case "pdf":
																	$file_type = "file-pdf";
																	break;
																case "doc":
																case "docx":
																	$file_type = "file-word";
																	break;
																case "png":
																case "jpg":
																case "jpeg":
																case "bmp":
																case "gif":
																case "tif":
																	$file_type = "file-image";
																	break;
																case "ppt":
																case "pptx":
																	$file_type = "file-powerpoint";
																	break;
																case "xls":
																case "xlsx":
																	$file_type = "file-excel";
																	break;
																case "php":
																case "js":
																case "py":
																case "rb":
																case "cpp":
																case "c":
																case "sh":
																case "html":
																case "css":
																case "sass":
																case "less":
																	$file_type = "file-code";
																	break;
																case "mp3":
																case "mp4":
																case "acc":
																case "ogg":
																	$file_type = "file-sound";
																	break;
																case "mkv":
																case "flv":
																case "avi":
																case "wmv":
																	$file_type = "file-video";
																	break;
																case "zip":
																case "rar":
																case "bz":
																case "gz":
																	$file_type = "file-zip";
																	break;
																default:
																	$file_type = "file";
															}
															?>
															<i class="fa fa-{{$file_type}}-o"></i>
														</span>
													</td>
													<td>
														<a href="{{ $shared_file['url'] }}" class="file-preview" data-thumb="{{ $shared_file['thumb_url'] }}" target="_blank"> {{ $shared_file['name'] }}</a>

														@if($shared_file['notes']!="")
															<em> - {{ $shared_file['notes'] }}</em>				
														@endif	
													</td>
													<td style="text-align:right;"><small>{{ date("d/m/y H:i", strtotime($shared_file['time'])) }}</small></td>
												
												</tr>
											@endforeach
										@endif

                                        @if($uploaded)
                                            <tr>
                                                <td colspan="3">Documents uploaded by client</td>
                                            </tr>
                                            @foreach($uploaded as $uploaded_file)
                                            <tr>
                                                <td>
                                                    <span class="label label-sm label-info">
                                                                <?php
                                                                $ext = explode(".",$uploaded_file['url']);
                                                                $ext = strtolower(trim(end($ext)));
                                                                $file_type = "file";
                                                                switch($ext){
                                                                    case "pdf":
                                                                        $file_type = "file-pdf";
                                                                        break;
                                                                    case "doc":
                                                                    case "docx":
                                                                        $file_type = "file-word";
                                                                        break;
                                                                    case "png":
                                                                    case "jpg":
                                                                    case "jpeg":
                                                                    case "bmp":
                                                                    case "gif":
                                                                    case "tif":
                                                                        $file_type = "file-image";
                                                                        break;
                                                                    case "ppt":
                                                                    case "pptx":
                                                                        $file_type = "file-powerpoint";
                                                                        break;
                                                                    case "xls":
                                                                    case "xlsx":
                                                                        $file_type = "file-excel";
                                                                        break;
                                                                    case "php":
                                                                    case "js":
                                                                    case "py":
                                                                    case "rb":
                                                                    case "cpp":
                                                                    case "c":
                                                                    case "sh":
                                                                    case "html":
                                                                    case "css":
                                                                    case "sass":
                                                                    case "less":
                                                                        $file_type = "file-code";
                                                                        break;
                                                                    case "mp3":
                                                                    case "mp4":
                                                                    case "acc":
                                                                    case "ogg":
                                                                        $file_type = "file-sound";
                                                                        break;
                                                                    case "mkv":
                                                                    case "flv":
                                                                    case "avi":
                                                                    case "wmv":
                                                                        $file_type = "file-video";
                                                                        break;
                                                                    case "zip":
                                                                    case "rar":
                                                                    case "bz":
                                                                    case "gz":
                                                                        $file_type = "file-zip";
                                                                        break;
                                                                    default:
                                                                        $file_type = "file";
                                                                }
                                                                ?>
                                                                <i class="fa fa-{{$file_type}}-o"></i>
                                                            </span>
                                                </td>
                                                <td>
                                                    <a href="{{ $uploaded_file['url'] }}" class="file-preview" data-thumb="{{ $uploaded_file['thumb_url'] }}" target="_blank"> {{ $uploaded_file['name'] }}</a>

                                                    @if($uploaded_file['notes']!="")
                                                    <em> - {{ $uploaded_file['notes'] }}</em>
                                                    @endif
                                                </td>
                                                <td style="text-align:right;"><small>{{ date("d/m/y H:i", strtotime($uploaded_file['time'])) }}</small></td>

                                            </tr>
                                            @endforeach
                                        @endif

                                        @if(!$shared && !$uploaded)
										<tr>
											<td colspan="3">
												No document found.
											</td>
										</tr>
										@endif
										
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="search">
							<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
								<div class="form-group">
									<input type="hidden" name="filekeysearchclient" id="filekeysearchclient" value="{{$customerId}}"/>
									<input class="form-control" type="text" id="filekeysearch" placeholder="Enter Search Keyword" value="">
								</div>
								<ul class="feeds" id="filesearchfeed"></ul>
							</div>
						</div>
					</div>
				</div>
				<div class="portlet-footer">
					<a href="{{url('file/client-file/'.$customer->id)}}" class="pull-right">See all Files <i class="icon-arrow-right"></i></a>
					<div class="clearfix"></div>
				</div>
			</div>
			<!-- END FILE -->

		</div>
		<div class="col-lg-6 column sortable">

				<!-- BEGIN ACTIVITY -->
				{{\Activity\ActivityController::get_instance()->getWidgetDisplay($customerId,'')}}
				<!-- END ACTIVITY -->

				<!-- BEGIN FEED -->
				<div class="portlet light bordered">
					<div class="portlet-title tabbable-line">
						<div class="caption font-green-sharp">
							<i class="icon-feed font-green-sharp"></i>
							<span class="caption-subject bold uppercase">FEEDS </span>
						</div>
						<ul class="nav nav-tabs">
							{{--
							<li class="">
								<a href="#facebook" data-toggle="tab"><i class="fa fa-facebook"></i> Facebook </a>
							</li>
							--}}
							<li class="active">
								<a href="#twitter" data-toggle="tab"><i class="fa fa-twitter"></i> Twitter </a>
							</li>
							{{--
							<li class="">
								<a href="#linkedin" data-toggle="tab"><i class="fa fa-linkedin"></i> Linkedin </a>
							</li>
							--}}
						</ul>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane" id="facebook">
								<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
									<ul class="feeds feeds-facebook">
									</ul>
								</div>
							</div>
							<div class="tab-pane active" id="twitter">
								<div style="overflow-y:auto;height:350px;min-height:350px;max-height:350px;" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
									<ul class="feeds">
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-twitter"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Feeds from Twitter
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 Just now
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="tab-pane" id="linkedin">
								<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
									<ul class="feeds">
										<li>
											<div class="col1">
												<div class="cont">
													<div class="cont-col1">
														<div class="label label-sm label-info">
															<i class="fa fa-linkedin"></i>
														</div>
													</div>
													<div class="cont-col2">
														<div class="desc">
															 Feeds from linkedin
														</div>
													</div>
												</div>
											</div>
											<div class="col2">
												<div class="date">
													 Just now
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="portlet-footer">
						<a href="#" class="pull-right">See all Feeds <i class="icon-arrow-right"></i></a>
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- END FEED-->

		</div>
	</div>
</div>

<div id="fileuploadmodal" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Files Upload</h4>
			</div>
			<div class="modal-body form add_new1">
				<!-- BEGIN PAGE CONTENT-->
					<div class="col-md-12">
						<blockquote>
							<p style="font-size:16px">
								 File Upload widget with multiple file selection.<br>
								 The maximum file size for uploads is 10 MB<br>
							</p>
                            <input type="hidden" id="redirect-url" />
						</blockquote>
						<br>
							{{
								Form::open(
									array(
										'action' => array(
											'File\ClientFileController@postOnAjaxUploadFile',
											'file_id'=>2,
											'customer_id'=>$customer->id,
											'page' => 'client_summary'
										),
										'role'=>'form',
										'files'=> true,
										'class'=>'fileupload form-horizontal'
									)
								)
							}}
								<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								<div class="row fileupload-buttonbar">
									<div class="col-md-12">
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="btn green fileinput-button">
										<i class="fa fa-plus"></i>
										<span>
										Add files... </span>
										{{Form::file('files[]',array('multiple'=>true))}}
										</span>
										<button type="submit" class="btn blue start">
										<i class="fa fa-upload"></i>
										<span>
										Start upload </span>
										</button>
										<button type="reset" class="btn warning cancel">
										<i class="fa fa-ban-circle"></i>
										<span>
										Cancel upload </span>
										</button>
										<!-- The global file processing state -->
										<span class="fileupload-process">
										</span>
									</div>
									<!-- The global progress information -->
									<div class="col-md-12 fileupload-progress fade">
										<!-- The global progress bar -->
										<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
											<div class="progress-bar progress-bar-success" style="width:0%;">
											</div>
										</div>
										<!-- The extended global progress information -->
										<div class="progress-extended">
											 &nbsp;
										</div>
									</div>
								</div>
								<div class="well">
									<h3>You can Drop files here or Click "Add Files"..</h3>
									<!-- The table listing the files available for upload/download -->
									<table role="presentation" style="width:auto !important;" class="table table-striped table-responsive clearfix">
										<tbody class="files">
										</tbody>
									</table>
								</div>
							{{Form::close()}}
					</div>
				<!-- END PAGE CONTENT-->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn blue start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn red cancel">
                    <i class="fa fa-ban"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
        {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download fade">
                <td>
                    <span class="preview">
                        {% if (file.thumbnailUrl) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                        {% } %}
                    </span>
                </td>
                <td>
                    <p class="name">
                        {% if (file.url) { %}
                            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                        {% } else { %}
                            <span>{%=file.name%}</span>
                        {% } %}
                    </p>
                    {% if (file.error) { %}
                        <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                    {% } %}
                </td>
                <td>
                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                </td>
                <td>
                    {% if (file.deleteUrl) { %}
                        <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                            <i class="fa fa-trash-o"></i>
                            <span>Delete</span>
                        </button>
                        <input type="checkbox" name="delete" value="1" class="toggle">
                    {% } else { %}
                        <button class="btn yellow cancel btn-sm">
                            <i class="fa fa-ban"></i>
                            <span>Cancel</span>
                        </button>
                    {% } %}
                </td>
            </tr>
        {% } %}
    </script>

@section('script-footer')
	@parent
		@section('footer-custom-js')
			@parent
				<script type="text/javascript" src="{{$asset_path}}/pages/scripts/twitter-feeds.js"></script>
				<script>
				jQuery(document).ready(function() {
					TwitterFeeds.init("{{URL::to('/')}}","{{\Twitter\Twitter::get_instance()->getTwitterUsername($customer->id)}}");
				});
				</script>
				<script>
					$(function(){
						$("#twitter").find("iframe").css("width","99%");
					});
				</script>
		@stop
@stop
