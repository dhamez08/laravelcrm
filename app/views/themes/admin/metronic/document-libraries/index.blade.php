@extends( $dashboard_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
	@parent
	<!-- BEGIN PAGE LEVEL STYLES -->
	<!-- END PAGE LEVEL SCRIPTS -->
	@stop
@stop

@section('body-content')
	@parent
	@section('innerpage-content')
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-9">
				<!-- CUSTOM FILES -->
				<div class="portlet light bordered" style="min-height: 425px">
					<div class="portlet-title tabbable-line">
						<div class="caption col-md-8">
							<span class="caption-subject font-green-sharp ">My Uploaded Documents</span>
						</div>
						<div class="col-md-4 text-right">
							<span class="text-primary" style="font-size:16px;"><a><i class="fa fa-plus-circle"></i> <a href="#" data-toggle="modal" data-target="#section-subsection-modal">Create New Section</a></span>
							
						</div>
					</div>
					<div class="portlet-body tabbable-line">
						<!--BEGIN TABS-->
						<div class="tab-content">
							<div class="tab-pane active">
								<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 310px;">
									<div class="scroller" style="overflow: hidden; width: auto; height: 337px;" data-always-visible="1" data-rail-visible="0" data-initialized="1">
										<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
											<div class="panel panel-default">
												<div class="panel-heading" role="tab" id="headingOne" style="height:40px;">
													<h4 class="panel-title" style="width:100%;">
														<div class="col-md-8">
														<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
															<span class="font-green-sharp" style="font-size:18px;">Section</span>
														</a>
														</div>
														<div class="col-md-4 text-right text-primary">
															<i class="fa fa-plus-circle"></i> Add New Subsection | <i class="fa fa-edit"></i> Edit Section
														</div>
													</h4>
												</div>
												<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" style="margin-top:8px;">
													<ul class="list-group feeds">
														<li class="list-group-item list-group-item-heading panel-title">
															<div class="col-md-8">
																<span class="font-green-sharp" style="font-size:18px;">Subsection</span>
															</div>
															<div class="col-md-4 text-primary text-right">
																<i class="fa fa-plus-circle"></i><a href="#" data-toggle="modal" data-target="#add-document-library-modal">Add New Document</a> | <i class="fa fa-edit"></i> Edit Subsection
															</div>
														</li>
														@foreach($documents as $document)
															<li class="list-group-item">
																<div class="col1">
																	<div class="cont">
																		<div class="cont-col1">
																			<div class="label label-sm label-danger">
																				<i class="fa {{ $icons[$document->file_ext] }}"></i>
																			</div>
																		</div>
																		<div class="cont-col2">
																			<div class="desc">
																				<a href="{{ $path.'/'.$document->filename }}" target="_blank">{{ $document->name }}</a>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col2 text-right">
																	<a href="{{ url('document-library/delete/'.$document->id) }}" class="btn btn-sm red" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-times"></i> Remove</a>
																</div>
															</li>
														@endforeach
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 187.717355371901px; display: block; background: rgb(187, 187, 187);">
									</div>
									<div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);">
									</div>
								</div>
							</div>
						</div>
						<!--END TABS-->
						<button class="btn green-haze btn-circle btn-sm pull-right" data-toggle="modal" data-target="#add-document-library-modal">New</button>
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
	@stop
@stop
