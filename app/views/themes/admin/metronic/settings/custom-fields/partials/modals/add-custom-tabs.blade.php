<!-- modal for creating client tags -->
<div class="modal fade bs-tab-modal-md" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content container-fluid">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal">
      		<span aria-hidden="true">x</span>
      		<span class="sr-only">Close</span>
      	</button>
      	<h4 class="modal-title">Add Custom Client Tab</h3>
      </div>
      <div class="modal-body">
      	{{ Form::open(array('url' => 'settings/custom-fields/add-tab')) }}
      	<div class="row">
	      	<div class="col-md-12">
	      		<div class="form-group">
	      			<label for="tab">Tab name:</label>
	      			<input type="text" class="form-control" id="tab" name="tab" placeholder="Enter the tab name">
	      		</div>

            <div class="form-group">
              <label class="control-label">Icon</label>
              <select name="icon" class="bs-select form-control" data-show-subtext="true" data-live-search="true">
                @foreach($icons as $icon )
                <option value="{{$icon}}" data-icon="{{$icon}}">{{$icon}}</option>
                @endforeach
              </select>
            </div>

	      	</div>
      	</div>
      	<div class="row">
	      	<div class="col-md-12">
	      		<button type="submit" class="btn blue">Save</button>
	      		<button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
	      	</div>
      	</div>
      	{{ Form::close() }}
      </div>

    </div>
  </div>
</div>
<!-- end modal -->