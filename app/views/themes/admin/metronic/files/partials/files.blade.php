<div class="col-md-12 col-summary">
	<div class="row">
		<div class="col-lg-6 col-summary">
			<!-- BEGIN TASKS -->
			@if( trim($file1) != '' )
				@include($view_path.'.files.partials.customforms', array('title'=>$file1,'id'=>'1'))
			@endif
			<!-- END TASKS -->
		</div>
		<div class="col-lg-6 col-summary">
			<!-- BEGIN ACTIVITY -->
			{{-- @if( trim($file2) != '' ) --}}
				@include($view_path.'.files.partials.widget',array('title'=>$file2,'id'=>'2'))
			{{-- @endif --}}
			<!-- END ACTIVITY -->
		</div>
	</div>
</div>
<div class="col-md-12 col-summary">
	<div class="row">
		<div class="col-lg-6 col-summary">
			<!-- FILES -->
			{{-- @if( trim($file3) != '' )  --}}
				@include($view_path.'.files.partials.widget',array('title'=>$file3,'id'=>'3'))
			{{-- @endif --}}
			<!-- FILES -->
		</div>
		<div class="col-lg-6 col-summary">
			<!-- FEEDS -->
			{{-- @if( trim($file4) != '' ) --}}
				@include($view_path.'.files.partials.widget',array('title'=>$file4,'id'=>'4'))
			{{-- @endif --}}
			<!-- END FEEDS -->
		</div>
	</div>
</div>

@include($view_path . '.files.partials.modal-share-file', array('clientId' => $customer->id))

@section('footer-custom-js')
	@parent
	<script type="text/javascript">
		$(document).ready(function() {
			$('#modal-share-file').on('shown.bs.modal', function(e) {
				$(this).find('input[name="filename"]').val($(e.relatedTarget).data('filename'));
			});
		});
	</script>
@stop