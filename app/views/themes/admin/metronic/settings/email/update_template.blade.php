@extends( $settings_index )
@section('body-content')
	@parent

	@section('portlet-content')
		<div class="row">
			<div class="col-md-8">
				<div class="portlet">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i>Update Template
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								{{
									Form::open(
										array(
											'url'	=>	'settings/email/update-template/'.$id
										)
									)
								}}	
								<div class="form-body">
									<div class="form-group">
										{{ Form::label('template_name', 'Template Name') }}
										{{ 
											Form::text
											(
												'template_name', $name, array('class' => 'form-control', 'required' => 'required')
											) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('template_subject', 'Template Subject') }}
										{{ 
											Form::text
											(
												'template_subject', $subject, array('class' => 'form-control', 'required' => 'required')
											) 
										}}									
									</div>
									<div class="form-group">
										{{ Form::label('template_body', 'Template Body') }}
										{{ 
											Form::textarea
											(
												'template_body', $body, array('class' => 'form-control', 'required' => 'required')
											) 
										}}																		
									</div>
									<div class="pull-right">
										<button type="submit" class="btn green">Update</button>
										<a href="{{ url('settings/email') }}" class="btn red">Cancel</a>
									</div>
								</div>
								{{ Form::close() }}
						</div>
						</div>
					</div>
				</div>									
			</div>
			<div class="col-md-4">
				<h1>Email Settings</h1>
			</div>
		</div>
	@stop
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