<div class="modal fade" id="add-template-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Email Template</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form role="form">
							<div class="form-body">
								<div class="form-group">
									<label>Template Name</label>
									<input type="text" class="form-control" name="template_name" placeholder="Template Name" required>
								</div>
								<div class="form-group">
									<label>Template Subject</label>
									<input type="text" class="form-control" name="template_subject" placeholder="Template Subject" required>
								</div>
								<div class="form-group">
									<label>Template Body</label>
									<textarea class="form-control" name="template_body" id="template_body"></textarea>
								</div>
								@foreach(range(1,5) as $i)
								<div class="form-group">
									<label>Attachment {{ $i }}</label>
									<input type="file" class="form-control" placeholder="Attachment 1">
								</div>					
								@endforeach			
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="button" class="btn blue">Save changes</button>
			</div>
		</div>
	</div>
</div>