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
							<i class="fa fa-gift"></i>Update Signature
						</div>
					</div>
					<div class="portlet-body">
						<div class="row">
							<div class="col-md-12">
								{{
									Form::open(
										array(
											'url'	=>	'settings/email/update-signature/'.$id
										)
									)
								}}	
								<div class="form-body">
									<div class="form-group">
										{{ Form::label('signature_name', 'Signature Name') }}
										{{ 
											Form::text
											(
												'signature_name', $name, array('class' => 'form-control', 'required' => 'required')
											) 
										}}
									</div>
									<div class="form-group">
										{{ Form::label('signature_body', 'Signature Body') }}
										{{ 
											Form::textarea
											(
												'signature_body', $body, array('class' => 'form-control', 'required' => 'required')
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
                        row+='<tr><td><input type="text" value="['+form_name+':'+item.field_name+']" class="form-control" style="border:0px" /></td></tr>';
                    });

                    $("#fields_container table tbody").append(row);

                    Metronic.unblockUI('#fields_container');
                }).error(function() {
                    Metronic.unblockUI('#fields_container');
                });
            });
		});
	</script>
	@stop
@stop