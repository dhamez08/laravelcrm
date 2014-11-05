@extends( $settings_index )
@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
		<link rel="stylesheet" type="text/css" href="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.css">
	@stop
@stop
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
									<div class="row">
										<div class="col-md-9">
											<div class="form-group">
											{{ Form::label('template_body', 'Template Body') }}
											<textarea name="template_body" id="template_body">{{ $body }}</textarea>
											</div>
										</div>
										<div class="col-md-3" style="padding:0px;padding-right:30px;">
											<h2>Dynamic Fields</h2>
											<select id="custom_form" class="form-control">
					                            <option value="0">Choose a Custom Form</option>
					                        <?php
					                        $forms = \CustomForm\CustomFormEntity::get_instance()->getFormsByLoggedUser();
					                        ?>
					                        @foreach($forms as $form)
					                        	<option value="{{ $form->id }}">{{ $form->name }}</option>
					                        @endforeach
					                        </select>

					                        <div id="fields_container" style="margin-top:15px;min-height:230px;">
					                        	<div class="scroller" style="height:230px" data-always-visible="0" data-rail-visible="0" data-rail-color="red" data-handle-color="green">
					                        	<table class="table table-bordered table-hover">
													<tbody>
													</tbody>
												</table>
					                        	</div>
					                        </div>
										</div>															
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

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	<script type='text/javascript' src="{{$asset_path}}/global/plugins/jquery.caret.js"></script>
	<script src="{{$asset_path}}/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
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
			    if(!$(event.target).closest('.note-editor').length) {
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
					alert('please click/focus on the editor to insert the dynamic field!');
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
	@stop
@stop