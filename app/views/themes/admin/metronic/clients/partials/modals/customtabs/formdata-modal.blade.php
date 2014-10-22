<!-- modal for creating custom forms -->
  <div class="modal fade" id="form-data-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content container-fluid">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal">
        		<span aria-hidden="true">x</span>
        		<span class="sr-only">Close</span>
        	</button>
        	<h4 class="modal-title" id="content-form-name"></h4>
        </div>
        <div class="modal-body">
        	
  	      	<div class="col-md-12" id="content-form-data">
              <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate" id="content-form-spinner"></span>    
  	      	</div>

        	<div class="row" style="margin-top:15px" id="content-form-action">
  	      	<div class="col-md-12">
              <form action="{{ url('settings/custom-forms/preview-form-data') }}" target="_blank" method="post" style="float:left;margin-right:20px">
                {{ \Form::token() }}
                <input type="hidden" class="title-hidden-form" name="title" />
                <input type="hidden" class="content-hidden-form" name="content" />
                <button type="submit" class="btn blue">View as PDF</button>
              </form>
              <form action="{{ url('settings/custom-forms/save-form-data') }}" method="post" style="float:left">
                {{ \Form::token() }}
                <input type="hidden" class="customer-hidden-form" name="customer-hidden-form" value="{{ $customer->id }}" />
                <input type="hidden" class="title-hidden-form" name="title" />
                <input type="hidden" class="content-hidden-form" name="content" />
  	      		 <button type="submit" class="btn blue">Save as PDF</button>
              </form>
  	      	</div>
        	</div>
        </div>

      </div>
    </div>
  </div>
  <!-- end modal -->