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
											 <a href="{{ url('settings/email/update-template/'.$template->id) }}" class="btn btn-sm blue"><i class="fa fa-edit"></i></a>
											 <a href="{{ url('settings/email/remove-template/'.$template->id) }}" class="btn btn-sm red"><i class="fa fa-times"></i></a>
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
									@foreach($email_signatures as $signature)
									<tr>
										<td>
											{{ $signature->name }}
										</td>
										<td>
											 <a href="{{ url('settings/email/update-signature/'.$signature->id) }}" class="btn btn-sm blue"><i class="fa fa-edit"></i></a>
											 <a href="{{ url('settings/email/remove-signature/'.$signature->id) }}" class="btn btn-sm red"><i class="fa fa-times"></i></a>																	 
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
	@stop
@stop

@section('body-modals')
	{{ $add_template_modal }}
	{{ $add_signature_modal }}	
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
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
						$("#template_body").code($("#template_body").code()+'<p>'+toInsert+'</p>');
					}
				} else {
					alert('please click/focus on the editor to insert the dynamic field!');
				}
            });

            $(".note-image-dialog .close").live("click", function() {
            	$(".note-image-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });

			$(".note-video-dialog .close").live("click", function() {
            	$(".note-video-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });

			$(".note-link-dialog .close").live("click", function() {
            	$(".note-link-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });

            $(".note-help-dialog .modal-close").live("click", function() {
            	$(".note-help-dialog").removeClass("in").hide();
            	$('.modal-backdrop').remove();
            	$(this).closest(".note-editor").find(".note-editable").focus();
            });

            
		});
	</script>
	@stop
@stop