@extends( $dashboard_index )
@section('body-content')
	@parent

	@section('innerpage-page-title')
	@stop

	@section('innerpage-content')
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gear"></i>Settings
						</div>
					</div>
					<div class="portlet-body">
						<ul class="nav nav-tabs">
							<li class="">
								<a href="#">
								Overview </a>
							</li>
							<li class="">
								<a href="#">
								Users </a>
							</li>
							<li class="">
								<a href="#">
								Tags </a>
							</li>							
							<li class="">
								<a href="#">
								Custom Fields </a>
							</li>
							<li class="active">
								<a href="#">
								Email </a>
							</li>
							<li class="">
								<a href="#">
								Screen </a>
							</li>														
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade active in" >
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
															@foreach(range(1,3) as $i)
															<tr>
																<td>
																	 Initial Email
																</td>
																<td>
																	 Welcome to Finley Jacobs
																</td>
																<td>
																	 <button class="btn btn-sm blue"><i class="fa fa-edit"></i></button>
																	 <button class="btn btn-sm red"><i class="fa fa-times"></i></button>
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
										<div class="portlet">
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-gift"></i>Signatures
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
																	 &nbsp;
																</th>
															</tr>
															</thead>
															<tbody>
															@foreach(range(1,5) as $i)
															<tr>
																<td>
																	Signature {{ $i }}
																</td>
																<td>
																	 <button class="btn btn-sm blue"><i class="fa fa-edit"></i></button>
																	 <button class="btn btn-sm red"><i class="fa fa-times"></i></button>																	 
																</td>
															</tr>
															@endforeach
															</tbody>
														</table>
														<a type="button" class="btn green" data-toggle="modal" href="#add-signature-modal"><i class="fa fa-plus"></i> Add Signature</a>
													</div>
												</div>
											</div>
										</div>										
									</div>
									<div class="col-md-4">
										<h1>Email Settings</h1>
									</div>
								</div>
							</div>
						</div>
						<div class="clearfix margin-bottom-20">
						</div>
					</div>
				</div>
			</div>
		</div>
	@stop
@stop

@section('body-modals')
	@include($view_path.'.settings.email.partials.modals.add_template')
	@include($view_path.'.settings.email.partials.modals.add_signature')	
@stop

@section('footer-custom-js')
	<script src="{{$asset_path}}/global/plugins/ckeditor/ckeditor.js"></script>
	<script src="{{$asset_path}}/global/plugins/ckeditor/adapters/jquery.js"></script>
	<script>
		CKEDITOR.replace('template_body');
		CKEDITOR.config.toolbarGroups = [		    
		    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		    { name: 'links' },
		    { name: 'insert' },
		];
		CKEDITOR.replace('signature_body');
		CKEDITOR.config.toolbarGroups = [		    
		    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		    { name: 'links' },
		    { name: 'insert' },
		];
		/*
		$.fn.modal.Constructor.prototype.enforceFocus = function () {
		    modal_this = this
		    $(document).on('focusin.modal', function (e) {
		        if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length
		        &&
		        !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) {
		            modal_this.$element.focus()
		        }
		    })
		};
		*/	
	</script>
@stop