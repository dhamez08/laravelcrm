<!-- modal for creating custom forms -->
<div class="modal fade" id="add-document-library-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content container-fluid">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal">
      		<span aria-hidden="true">x</span>
      		<span class="sr-only">Close</span>
      	</button>
      	<h4 class="modal-title">Upload File To Library</h3>
      </div>
      <div class="modal-body">
      	{{ Form::open(array('url' => 'document-library/upload','files'=>true)) }}
      	<div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Name of Document:</label>
                  <input type="text" class="form-control" name="name" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Select Document:</label>
                  <input type="file" class="form-control" name="doc" />
				  <input type="hidden" name="section_id" id="sectionId" value="0"/>
				  <input type="hidden" name="subsection_id" id="subSectionId" value="0"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      	<div class="row">
	      	<div class="col-md-12">
	      		<button type="submit" class="btn blue">Upload</button>
	      		<button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
	      	</div>
      	</div>
      	{{ Form::close() }}
      </div>

    </div>
  </div>
</div>
<!-- end modal -->