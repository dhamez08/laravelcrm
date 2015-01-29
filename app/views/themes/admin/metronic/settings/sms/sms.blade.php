@extends( $settings_index )

@section('begin-head')
	@parent
	@section('head-page-level-css')
		@parent
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
											 Actions
										</th>
									</tr>
									</thead>
									<tbody>
									@foreach($sms_templates as $template)
									<tr>
										<td>
											{{ $template->name }}
										</td>
										<td>
											 <a href="{{ url('settings/sms/update-template/'.$template->id) }}" class="btn btn-sm blue"><i class="fa fa-edit"></i></a>
											 <a href="{{ url('settings/sms/remove-template/'.$template->id) }}" class="btn btn-sm red"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									@endforeach
									</tbody>
								</table>
								<a type="button" class="btn green" data-toggle="modal" href="#add-template-modal"><i class="fa fa-plus"></i> Add SMS Template</a>
							</div>
						</div>
					</div>
				</div>									
			</div>
			<div class="col-md-4">
				<h1>{{ $portlet_title or '' }}</h1>
			</div>
		</div>
	@stop
@stop

@section('body-modals')
	{{ $add_template_modal }}
@stop

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	<script>
	var BASE_URL = '{{ url('/') }}';
	var ASSET_PATH = '{{$asset_path}}';
	var ASSET_PATH_PUBLIC = '{{ url('public/admin/metronic/assets') }}';
	</script>
	<script src="{{$asset_path}}/pages/scripts/components-editors.js" type="text/javascript"></script>
	<script type="text/javascript">
	    (function($){
            $.fn.setCursorToTextEnd = function() {
                var $initialVal = this.val();
                this.val($initialVal);
            };
		    $.fn.getCursorPosition = function() {
		        var el = $(this).get(0);
		        var pos = 0;
		        if('selectionStart' in el) {
		            pos = el.selectionStart;
		        } else if('selection' in document) {
		            el.focus();
		            var Sel = document.selection.createRange();
		            var SelLength = document.selection.createRange().text.length;
		            Sel.moveStart('character', -el.value.length);
		            pos = Sel.text.length - SelLength;
		        }
		        return pos;
		    }            
        })(jQuery);

		jQuery(document).ready(function() {

		   var isValid = 0;
		   $("select#custom_form").live("change", function() {
                $this = $(this);
                $("#fields_container table tbody").html('');
                //show loading
                Metronic.blockUI({
                    target: '#fields_container',
                    boxed: true,
                    message: 'Processing...'
                });
                isValid = 1;
                var row='';
                $.get(BASE_URL+'/settings/custom-forms/fields/'+$this.val(), function(response) {
                    var form_name = response.form.name;
                    $.each(response.build, function(i, item) {
                        //row+='<tr><td><input type="text" value="['+form_name+':'+item.field_name+']" class="form-control" style="border:0px" /></td></tr>';
                    	if($this.val()=='customer')
                    		row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+item.field_name+'}</a></td></tr>';
                    	else if($this.val()=='custom_fields')
                            row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">{'+form_name+':'+item.field_name+'}</a></td></tr>';
                    	else
                    		row+='<tr><td><a href="javascript:void(0)" class="custom_form_link">['+form_name+':'+item.field_name+']</a></td></tr>';
                    });

                    $("#fields_container table tbody").append(row);

                    Metronic.unblockUI('#fields_container');
                    $("#template_body").focus();
                }).error(function() {
                    Metronic.unblockUI('#fields_container');
                    $("#template_body").focus();
                });



            });

			
			/*
			$("#template_body").live("click", function() {
				isValid = 1;
			});

			$(document).click(function(event) { 
			    if(!$(event.target).closest('#template_body').length && event.target!="javascript:void(0)") {
			        isValid = 0;
			    }        
			});
			*/
			

            $("a.custom_form_link").live("click", function() {
            	console.log('clicked = ' + isValid);
            	//if(isValid==1 && $("#template_body").val()!='') {
				if(isValid==1) {            		
            		console.log('valid');
	                var selection = document.getSelection();                
					//var cursorPos = selection.anchorOffset;
					var cursorPos = $('#template_body').getCursorPosition();
					//var oldContent = selection.anchorNode.nodeValue;
					var oldContent = $('#template_body').val();
					var toInsert = $(this).html();

					if(oldContent!=null) {
						var newContent = oldContent.substring(0, cursorPos) + toInsert + oldContent.substring(cursorPos);
						//selection.anchorNode.nodeValue = newContent;
						$('#template_body').val(newContent);
						$("#template_body").setCursorToTextEnd();
					} else if($("#template_body").val()=='<p><br></p>') {
						$("#template_body").val(toInsert);
						$("#template_body").setCursorToTextEnd();
					} else {
						$("#template_body").val($("#template_body").val()+toInsert);
						$("#template_body").setCursorToTextEnd();
					}
				} else {
					console.log('invalid');
				    $("#template_body").setCursorToTextEnd();
					//alert('please click/focus on the editor to insert the dynamic field!');
				}
            });
           
		});
	</script>
	@stop
@stop