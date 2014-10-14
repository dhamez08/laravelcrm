<script id="control-customize-template" type="text/x-handlebars-template">
	<div class="modal-dialog modal-md">
    <div class="modal-content container-fluid">
      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal">
      		<span aria-hidden="true">x</span>
      		<span class="sr-only">Close</span>
      	</button>
      	<h4 class="modal-title">{{header}}</h3>
      </div>
		<div class="modal-body">
			<form id="theForm" class="form-horizontal">
				<input type="hidden" value="{{type}}" name="type"></input>
				<input type="hidden" value="{{forCtrl}}" name="forCtrl"></input>
				<input type="hidden" value="{{forLastFieldName}}" name="forLastFieldName"></input>
				<div class="row">
			      	<div class="col-md-12">
			      		<div class="form-group">
							<label class="control-label">Label</label>
							<input type="text" name="label" value="" class="form-control"></input>
						</div>
					</div>
				</div>
				
				{{{content}}}
			</form>
		</div>
		<div class="modal-footer">
			<button class="btn btn-primary" onclick='save_customize_changes()'>Save changes</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick='delete_ctrl()'>Delete</button>
		</div>
	</div>
	</div>
</script>

<script id="textbox-template" type="text/x-handlebars-template">
	<div class="row">
      	<div class="col-md-12">
      		<div class="form-group">
				<label class="control-label">Placeholder</label> 
				<input type="text" name="placeholder" value="" class="form-control"></input>
			</div>
		</div>
	</div>
	<div class="row">
	  	<div class="col-md-12">
	  		<div class="form-group">
	  			<label class="control-label">Name</label> 
	  			<input type="text" value="" name="name" class="form-control"></input>
	  		</div>
	  	</div>
	 </div>
</script>

<script id="combobox-template" type="text/x-handlebars-template">
	<div class="row">
      	<div class="col-md-12">
      		<div class="form-group">
      			<label class="control-label">Options</label> 
      			<textarea name="options" rows="5" class="form-control"></textarea>
      		</div>
      	</div>
    </div>
    <div class="row">
	  	<div class="col-md-12">
	  		<div class="form-group">
	  			<label class="control-label">Name</label> 
	  			<input type="text" value="" name="name" class="form-control"></input>
	  		</div>
	  	</div>
	 </div>
</script>

<script id="rating-template" type="text/x-handlebars-template">
	<div class="row">
	  	<div class="col-md-12">
	  		<div class="form-group">
	  			<label class="control-label">Name</label> 
	  			<input type="text" value="" name="name" class="form-control"></input>
	  		</div>
	  	</div>
	 </div>
</script>