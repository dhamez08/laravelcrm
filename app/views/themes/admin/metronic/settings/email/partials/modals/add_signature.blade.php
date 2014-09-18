<div class="modal fade" id="add-signature-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Email Signature</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<form role="form">
							<div class="form-body">
								<div class="form-group">
									<label>Signature Name</label>
									<input type="text" class="form-control" name="signature_name" placeholder="Signature Name" required>
								</div>
								<div class="form-group">
									<label>Signature Body</label>
									<textarea class="form-control" name="signature_body" id="signature_body"></textarea>
								</div>
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
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>