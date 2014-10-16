@if($customtab->section3==1)
  <!-- modal for creating notes -->
  <div class="modal fade" id="section3notes-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content container-fluid">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">x</span>
            <span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title">Add new Note</h3>
        </div>
        <div class="modal-body">
          {{ Form::open(array('url' => '#')) }}
          <div class="row">
            <div class="col-md-12">
                <label class="control-label">Note:</label>
                <textarea class="form-control" name="notes" placeholder="Enter your Notes"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn blue">Save</button>
              <button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
            </div>
          </div>
          {{ Form::close() }}
        </div>

      </div>
    </div>
  </div>
  <!-- end modal -->
@elseif($customtab->section3==2)
  <!-- modal for creating notes -->
  <div class="modal fade" id="section3files-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content container-fluid">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">x</span>
            <span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title">Add new File</h3>
        </div>
        <div class="modal-body">
          {{ Form::open(array('url' => '#')) }}
          <div class="row">
            <div class="col-md-12">
                <div>
                  <label class="control-label">Name:</label>
                  <input type="text" name="name" class="form-control" placeholder="Enter a name..." />
                </div>
                <div>
                  <label class="control-label">Select a file:</label>
                  <input type="file" name="file" class="form-control"/>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn blue">Upload</button>
              <button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
            </div>
          </div>
          {{ Form::close() }}
        </div>

      </div>
    </div>
  </div>
  <!-- end modal -->
@elseif($customtab->section3==3)
  <!-- modal for creating custom forms -->
  <div class="modal fade" id="section3form-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content container-fluid">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">
        		<span aria-hidden="true">x</span>
        		<span class="sr-only">Close</span>
        	</button>
        	<h4 class="modal-title">{{ \CustomForm\CustomForm::find($customtab->section3_form)->name }}</h3>
        </div>
        <div class="modal-body">
        	{{ Form::open(array('url' => '#')) }}
        	<div class="row">
  	      	<div class="col-md-12">
  				{{ \CustomForm\CustomForm::find($customtab->section3_form)->build }}          
  	      	</div>
        	</div>
        	<div class="row">
  	      	<div class="col-md-12">
  	      		<button type="button" class="btn blue">Save</button>
  	      		<button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
  	      	</div>
        	</div>
        	{{ Form::close() }}
        </div>

      </div>
    </div>
  </div>
  <!-- end modal -->
@endif