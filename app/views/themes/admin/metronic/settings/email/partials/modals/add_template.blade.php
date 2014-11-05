<div class="modal fade" id="add-template-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			{{
				Form::open(
					array(
						'url'	=>	'settings/email/save-template'
					)
				)
			}}			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Add Email Template</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">

							<div class="form-body">
								<div class="form-group">
									{{ Form::label('template_name', 'Template Name') }}
									{{ 
										Form::text
										(
											'template_name', '', array('class' => 'form-control', 'required' => 'required')
										) 
									}}
								</div>
								<div class="form-group">
									{{ Form::label('template_subject', 'Template Subject') }}
									{{ 
										Form::text
										(
											'template_subject', '', array('class' => 'form-control', 'required' => 'required')
										) 
									}}									
								</div>
								<div class="row">
									<div class="col-md-9">
										<div class="form-group">
										{{ Form::label('template_body', 'Template Body') }}
										<textarea name="template_body" id="template_body"></textarea>
										</div>
									</div>
									<div class="col-md-3" style="padding:0px;padding-right:30px;">
										<h2>Dynamic Fields</h2>
										<select id="custom_form" class="form-control">
				                            <option value="0">Choose a Custom Form</option>
				                            <option value="customer">Customer Information</option>
				                        <?php
				                        $forms = \CustomForm\CustomFormEntity::get_instance()->getFormsByLoggedUser();
				                        ?>
				                        @foreach($forms as $form)
				                        	<option value="{{ $form->id }}">{{ $form->name }}</option>
				                        @endforeach
				                        </select>

				                        <div id="fields_container" style="margin-top:15px;min-height:230px;">
				                        	<div style="height:230px;overflow-y:scroll" data-always-visible="0" data-rail-visible="0" data-rail-color="red" data-handle-color="green">
				                        	<table class="table table-bordered table-hover">
												<tbody>
												</tbody>
											</table>
				                        	</div>
				                        </div>
									</div>															
								</div>
								<!--
								@foreach(range(1,5) as $i)
								<div class="form-group">
									<label>Attachment {{ $i }}</label>
									<input type="file" class="form-control" placeholder="Attachment 1">
								</div>					
								@endforeach			
								-->
							</div>
						
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn blue">Save</button>
				<button type="button" class="btn default" data-dismiss="modal">Close</button>								
			</div>
			{{ Form::close() }}
		</div>
	</div>
</div>