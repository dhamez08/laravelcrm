<div class="portlet portlet-sortable light bordered" style="height:500px;">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-pin font-yellow-lemon"></i>
			<span class="caption-subject bold font-yellow-lemon uppercase">
			{{$title}} </span>
		</div>
		<ul class="nav nav-tabs">
			<li  class="active">
				<a href="#" data-toggle="tab">
				Files </a>
			</li>
		</ul>
	</div>
	<div class="portlet-body tabbable-line" style="max-height:500px;">

		<div class="scroller" style="height:350px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
			<ul class="feeds">
				@foreach($customerFiles->get()	as $files)
					@if($files->type == $id)
					<li>
						<div class="col1">
							<div class="cont">
								<div class="cont-col1">
									<div class="label label-sm label-info">
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
									</div>
								</div>
								<div class="cont-col2">
									<div class="desc">
										 <a download href="{{asset('public/documents/' . $files->filename)}}" title="Download File {{$files->filename}}">{{$files->filename}}</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col2">
							<a href="{{
										action(
											'File\ClientFileController@getDeleteFile',
											array(
												'id'=>$files->id,
												'customerid'=>$files->customer_id
											)
										)
									}}"
								class="pull-right" title="Delete File {{$files->filename}}"><i class="icon-trash"></i> </a>
						</div>
					</li>
					@endif
				@endforeach
			</ul>
		</div>	

		{{--
		<div class="list_files_widget">
			@foreach($customerFiles->get()	as $files)
				@if($files->type == $id)
					<p>
						<a href="{{asset('public/documents/' . $files->filename)}}" target="_blank">{{$files->filename}}</a>
						<a 	class="btn red btn-sm deleteFile"
							href="{{
								action(
									'File\ClientFileController@getDeleteFile',
									array(
										'id'=>$files->id,
										'customerid'=>$files->customer_id
									)
								)
							}}"
						>
							<i class="fa fa-trash-o fa-5x"></i>
						</a>
					</p>
				@endif
			@endforeach
		</div>
		--}}
	</div>
</div>
