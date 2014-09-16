<div class="col-md-6">
	<div class="row">
		<div class="col-md-12">
			<!-- CUSTOM FILES -->
			<div class="portlet light bordered" style="min-height: 425px">
				<div class="portlet-title tabbable-line">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Custom Files (Saved PDF's from custom forms)</span>
					</div>
				</div>
				<div class="portlet-body tabbable-line">
					<!--BEGIN TABS-->
					<div class="tab-content">
						<div class="tab-pane active">
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 310px;"><div class="scroller" style="overflow: hidden; width: auto; height: 337px;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
								<ul class="feeds">
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Client order form
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
									@foreach(range(1,4) as $i)
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														File {{ $i }}
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												{{ 20 + $i }} mins
											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 187.717355371901px; display: block; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
						</div>
					</div>
					<!--END TABS-->
					<button class="btn green-haze btn-circle btn-sm pull-right">New</button>
				</div>
			</div>	
			<!-- END CUSTOM FILES -->
		</div>
		<div class="col-md-12">
			<!-- FILES BOX 2 -->
			<div class="portlet light bordered">
				<div class="portlet-title tabbable-line">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Files Box 2</span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_2_1" data-toggle="tab">
							Files </a>
						</li>
						<li>
							<a href="#tab_2_2" data-toggle="tab">
							Add New </a>
						</li>
					</ul>
				</div>
				<div class="portlet-body tabbable-line">
					<!--BEGIN TABS-->
					<div class="tab-content">
						<div class="tab-pane active" id="tab_2_1">
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 310px;"><div class="scroller" style="overflow: hidden; width: auto; height: 337px;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
								<ul class="feeds">
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Client order form
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
									@foreach(range(1,4) as $i)
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														File {{ $i }}
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												{{ 20 + $i }} mins
											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 187.717355371901px; display: block; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
						</div>
						<div class="tab-pane" id="tab_2_2">
							<form action="../../assets/global/plugins/dropzone/upload.php" class="dropzone" id="my-dropzone">
							</form>
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>								
			<!-- END FILES BOX 2 -->
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="row">
		<div class="col-md-12">
			<!-- FILES BOX 1 -->
			<div class="portlet light bordered">
				<div class="portlet-title tabbable-line">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Files Box 1</span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab">
							Files </a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab">
							Add New </a>
						</li>
					</ul>
				</div>
				<div class="portlet-body tabbable-line">
					<!--BEGIN TABS-->
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 310px;"><div class="scroller" style="overflow: hidden; width: auto; height: 337px;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
								<ul class="feeds">
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Client order form
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
									@foreach(range(1,4) as $i)
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														File {{ $i }}
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												{{ 20 + $i }} mins
											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 187.717355371901px; display: block; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
						</div>
						<div class="tab-pane" id="tab_1_2">
							<form action="../../assets/global/plugins/dropzone/upload.php" class="dropzone" id="my-dropzone">
							</form>
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>	
			<!-- END FILES BOX 1 -->
		</div>
		<div class="col-md-12">
			<!-- FILES BOX 3 -->
			<div class="portlet light bordered">
				<div class="portlet-title tabbable-line">
					<div class="caption">
						<span class="caption-subject font-green-sharp ">Files Box 3</span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tab_3_1" data-toggle="tab">
							Files </a>
						</li>
						<li>
							<a href="#tab_3_2" data-toggle="tab">
							Add New </a>
						</li>
					</ul>
				</div>
				<div class="portlet-body tabbable-line">
					<!--BEGIN TABS-->
					<div class="tab-content">
						<div class="tab-pane active" id="tab_3_1">
							<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 310px;"><div class="scroller" style="overflow: hidden; width: auto; height: 337px;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
								<ul class="feeds">
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Client order form
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
									@foreach(range(1,4) as $i)
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-danger">
														<i class="fa fa-file-pdf-o"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														File {{ $i }}
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												{{ 20 + $i }} mins
											</div>
										</div>
									</li>
									@endforeach
								</ul>
							</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 187.717355371901px; display: block; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
						</div>
						<div class="tab-pane" id="tab_3_2">
							<form id="fileupload" action="../../assets/global/plugins/jquery-file-upload/server/php/" method="POST" enctype="multipart/form-data">
								<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								<div class="row fileupload-buttonbar">
									<div class="col-lg-12">
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="btn btn-sm green fileinput-button">
										<i class="fa fa-plus"></i>
										<span>
										Add files... </span>
										<input type="file" name="files[]" multiple="">
										</span>
										<button type="submit" class="btn btn-sm blue start">
										<i class="fa fa-upload"></i>
										<span>
										Start upload </span>
										</button>
										<button type="reset" class="btn btn-sm warning cancel">
										<i class="fa fa-ban-circle"></i>
										<span>
										Cancel upload </span>
										</button>
										<button type="button" class="btn btn-sm red delete">
										<i class="fa fa-trash"></i>
										<span>
										Delete </span>
										</button>
										<!-- <input type="checkbox" class="toggle"> -->
										<!-- The global file processing state -->
										<span class="fileupload-process">
										</span>
									</div>
									<!-- The global progress information -->
									<div class="col-lg-5 fileupload-progress fade">
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
								<!-- The table listing the files available for upload/download -->
								<table role="presentation" class="table table-striped clearfix">
								<tbody class="files">
								</tbody>
								</table>
							</form>
						</div>
					</div>
					<!--END TABS-->
				</div>
			</div>								
			<!-- END FILES BOX 3 -->
		</div>
	</div>
</div>