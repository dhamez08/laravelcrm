<!-- modal for sending email -->
  <div class="modal fade" id="send-email-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content container-fluid">
              <div class="modal-header">
                	<button type="button" class="close" data-dismiss="modal">
                		  <span aria-hidden="true">x</span>
                		  <span class="sr-only">Close</span>
                	</button>
              	  <h4 class="modal-title">Send Email</h4>
              </div>
            <div class="modal-body">
                <div class="row">
        	      	<div class="col-md-12" id="content-form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="email_to" class="control-label">To:</label>
                          <input type="text" name="email_to" class="form-control" />
                        </div>
                        <div class="col-md-6">
                          <label for="email_subject" class="control-label">Subject:</label>
                          <input type="text" name="email_subject" class="form-control" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label for="email_body" class="control-label">Email Body:</label>
                          {{ 
                            Form::textarea
                            (
                              'email_body', '', array('class' => 'form-control', 'required' => 'required')
                            ) 
                          }}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="email_files" class="control-label">Attach Files:</label>
                          <select name="email_files" class="form-control">
                            <option></option>
                          </select>
                        </div>
                      </div>
        	      	</div>
                </div>
              	<div class="row" style="margin-top:15px;">
          	      	<div class="col-md-12">
                        <button type="button" class="btn blue" data-dismiss="modal">Cancel</button>
              	      	<button type="button" class="btn blue">Send</button>
          	      	</div>
              	</div>
            </div>

          </div>
      </div>
  </div>
  <!-- end modal -->