<!-- modal for creating custom forms -->
<div class="modal fade" id="section-subsection-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content container-fluid">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal">
      		<span aria-hidden="true">x</span>
      		<span class="sr-only">Close</span>
      	</button>
      	<h4 class="modal-title" id="modalTitle">Document Section / Subsection</h3>
      </div>
      <div class="modal-body">
      	{{ Form::open(array('url' => 'document-library/section')) }}
      	<div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Description</label>
                  <input type="text" class="form-control" name="description" id="txtDescription"/>
				  <input type="hidden" name="parent_id" id="txtSectionId" value="0"/>
				  <input type="hidden" name="id" id="txtId" value="0"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      	<div class="row">
	      	<div class="col-md-12">
	      		<button type="submit" class="btn blue">OK</button>
	      		<button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
	      	</div>
      	</div>
      	{{ Form::close() }}
      </div>

    </div>
  </div>
</div>
<!-- end modal -->