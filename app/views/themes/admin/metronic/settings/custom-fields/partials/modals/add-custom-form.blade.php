<!-- modal for creating custom forms -->
<div class="modal fade" id="add-custom-form-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content container-fluid">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal">
      		<span aria-hidden="true">x</span>
      		<span class="sr-only">Close</span>
      	</button>
      	<h4 class="modal-title">Add Custom Form</h3>
      </div>
      <div class="modal-body">
      	{{ Form::open(array('url' => 'settings/custom-forms/add-form')) }}
      	<div class="row">
	      	<div class="col-md-12">
	      		<div class="form-group">
              {{ Form::label('form_name', 'Form Name') }}
              {{ 
                Form::text
                (
                  'form_name', '', array('class' => 'form-control', 'required' => 'required')
                ) 
              }}
	      		</div>
            <div class="form-group">
              {{ Form::label('form_description', 'Form Description') }}
              {{ 
                Form::text
                (
                  'form_description', '', array('class' => 'form-control', 'required' => 'required')
                ) 
              }}
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