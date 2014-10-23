<div class="portlet portlet-sortable light bordered">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-pin font-yellow-lemon"></i>
			<span class="caption-subject bold font-yellow-lemon uppercase">
			Tabs </span>
		</div>
		<ul class="nav nav-tabs">
			<li>
				<a href=".portlet_tab2" data-toggle="tab">
				Tab 2 </a>
			</li>
			<li class="active">
				<a href=".portlet_tab1" data-toggle="tab">
				Tab 1 </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body tabbable-line">
		<div class="tab-content">
			<div class="tab-pane active portlet_tab1" id="">
					<h4>Tab 1 Content</h4>
					<p>
						 Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.ut laoreet dolore magna ut laoreet dolore magna. ut laoreet dolore magna. ut laoreet dolore magna.
					</p>

			</div>
			<div class="tab-pane portlet_tab2" id="">
					<!-- BEGIN PAGE CONTENT-->
					<div class="row">
						<div class="col-md-12">
							<blockquote>
								<p style="font-size:16px">
									 File Upload widget with multiple file selection.<br>
									 The maximum file size for uploads is 5 MB<br>
									 Only image files (JPG, GIF, PNG) are allowed <br>
								</p>
							</blockquote>
							<br>
							{{
								Form::open(
									array(
										'action' => array(
											'File\ClientFileController@postAjaxUploadFile',
										),
										'role'=>'form',
										'files'=> true,
										'class'=>'fileupload form-horizontal',
										'data-upload-template-id'=>'template-upload-2',
										'data-download-template-id'=>'template-download-2',
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
										{{Form::file('images[]',array('multiple'=>true))}}
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
										<p>xx</p>
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
								<div class="row">
									<div class="col-md-12">
										<!-- The table listing the files available for upload/download -->
										<table role="presentation" class="table table-striped table-responsive clearfix">
											<tbody class="files">
											</tbody>
										</table>
									</div>
								</div>

							{{Form::close()}}
						</div>
					</div>
					<!-- END PAGE CONTENT-->
			</div>
		</div>
	</div>
</div>
		<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
		<script id="template-upload-2" type="text/x-tmpl">
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
		                <button class="btn btn-sm blue start" disabled>
		                    <i class="fa fa-upload"></i>
		                    <span>Start</span>
		                </button>
		            {% } %}
		            {% if (!i) { %}
		                <button class="btn btn-sm red cancel">
		                    <i class="fa fa-ban"></i>
		                    <span>Cancel</span>
		                </button>
		            {% } %}
		        </td>
		    </tr>
		{% } %}
		</script>
		<!-- The template to display files available for download -->
		<script id="template-download-2" type="text/x-tmpl">
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
