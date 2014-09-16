<div class="tab-pane {{ $tabActive=='opportunities' ? 'active':'' }}" id="tab_opportunities">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@if( count($opportunity_tags)>0 )
				<table class="table table-striped">
					@foreach($opportunity_tags as $tag)
					<tr>
						<td><a class="editableTag" data-pk="{{ $tag->id }}" data-params="{_token:'{{csrf_token();}}'}">{{ $tag->tag }}</a></td>
						<td><a href="{{ URL::to('settings/tags/opportunities/delete/'.$tag->id) }}" onclick="return confirm('Are you sure you want to delete?')">Delete</a></td>
					</tr>
					@endforeach
				</table>
				@else
					No tags for opportunities have been added yet.
				@endif
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-sm btn-default" data-toggle="modal" data-target=".bs-opportunity-modal-md"><div class="caption"><i class="fa fa-plus"></i>&nbsp;Add oppotunities tag</div></button>
			</div>
		</div>
	</div>

</div>
<!-- modal for creating client tags -->
<div class="modal fade bs-opportunity-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content container-fluid">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal">
      		<span aria-hidden="true">x</span>
      		<span class="sr-only">Close</span>
      	</button>
      	<h4 class="modal-title">Add Opportunities Tag</h3>
      </div>
      <div class="modal-body">
      	{{ Form::open(array('url' => 'settings/tags/opportunities')) }}
      	<div class="row">
	      	<div class="col-md-12">
	      		<div class="form-group">
	      			<label for="tag">Tag name:</label>
	      			<input type="text" class="form-control" id="tag" name="tag" placeholder="Enter the tag name">
	      		</div>
	      	</div>
      	</div>
      	<div class="row">
	      	<div class="col-md-12">
	      		<button type="submit" class="btn btn-success">Save</button>
	      		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	      	</div>
      	</div>
      	{{ Form::close() }}
      </div>

    </div>
  </div>
</div>
<!-- end modal -->

@section('script-footer')
	@parent
	@section('footer-custom-js')
	@parent
	<script>
		$(function(){
	        //edit form style - popup or inline
	        $.fn.editable.defaults.mode = 'inline';
	        $('.editableTag').editable({
		            validate: function(value) {
		                if($.trim(value) == '') 
		                    return 'Value is required.';
		        },
		        type: 'text',
		        url:'{{URL::to("settings/tags/opportunities/update")}}',  
		        title: 'Edit Tag',
		        placement: 'right', 
		        send:'always',
		        ajaxOptions: {
		        dataType: 'json'
		        }
		     });
	    });
	</script>
	@stop
@stop
