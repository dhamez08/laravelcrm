<div class="modal fade" id="add-template-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			{{
				Form::open(
					array(
						'url'	=>	'marketing/save-email-template'
					)
				)
			}}			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Email Template</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">

							<div class="form-body">
								<div class="form-group">
									{{ Form::label('template_name', 'Template Name') }}
									{{ 
										Form::text
										(
											'template_name', '', array('class' => 'form-control', 'required' => 'required')
										) 
									}}
								</div>
								<div class="form-group">
									{{ Form::label('template_subject', 'Template Subject') }}
									{{ 
										Form::text
										(
											'template_subject', '', array('class' => 'form-control', 'required' => 'required')
										) 
									}}									
								</div>
								<div class="row">
									<div class="col-md-9">
										<div class="form-group">
										{{ Form::label('template_body', 'Template Body') }}
										<textarea name="template_body" id="template_body"></textarea>
										</div>
									</div>
									<div class="col-md-3" style="padding:0px;padding-right:30px;">
										<h2>Dynamic Fields</h2>
										<select id="custom_form" class="form-control">
				                            <option value="0">Choose a Form</option>
				                            <option value="customer">---Customer Information---</option>
				                            <option value="custom_fields">---Custom Fields---</option>
				                        <?php
				                        $forms = \CustomForm\CustomFormEntity::get_instance()->getFormsByLoggedUser();
				                        ?>
				                        @foreach($forms as $form)
				                        	<option value="{{ $form->id }}">{{ $form->name }}</option>
				                        @endforeach
				                        </select>

				                        <div id="fields_container" style="margin-top:15px;min-height:230px;">
				                        	<div style="height:230px;overflow-y:scroll" data-always-visible="0" data-rail-visible="0" data-rail-color="red" data-handle-color="green">
				                        	<table class="table table-bordered table-hover">
												<tbody>
												</tbody>
											</table>
				                        	</div>
				                        </div>
									</div>															
								</div>
								<!--
								@foreach(range(1,5) as $i)
								<div class="form-group">
									<label>Attachment {{ $i }}</label>
									<input type="file" class="form-control" placeholder="Attachment 1">
								</div>					
								@endforeach			
								-->
							</div>
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn blue">Save</button>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>								
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>
@section('script-footer')
@parent
@section('footer-custom-js')
@parent
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
                    if($this.val()=='customer')
                        row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+item.field_name+'}</a></td></tr>';
                    else
                        row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">['+form_name+':'+item.field_name+']</a></td></tr>';
                });

                $("#fields_container table tbody").append(row);
                $('.scroller').slimscroll({height:'230px'})
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
            if(!$(event.target).closest('.note-editor').length && event.target!="javascript:void(0)") {
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
                $("#template_body").setCursorToTextEnd();
                //alert('please click/focus on the editor to insert the dynamic field!');
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