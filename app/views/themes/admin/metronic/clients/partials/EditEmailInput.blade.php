<div id="edit-clone-email">
	<div class="email-wrapper">
		<div class="well">
			<div class="form-group">
				<label class="control-label col-md-3">Email</label>
				<div class="col-md-8">
				{{
					Form::email(
						'edit_emails['.$emailIdx.'][mail]',
						$val->email,
						array(
							'class'=>'form-control input-sm'
						)
					);
				}}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Type</label>
				<div class="col-md-4">
				{{
					Form::select(
						'edit_emails['.$emailIdx.'][for]',
						$emailFor,
						$val->type,
						array(
							'class'=>'form-control input-sm',
						)
					);
				}}
				</div>
				<div class="col-md-4">
				<a
					href="{{
						action('Clients\ClientsController@getConfirmMailDelete',
						array(
							'id'=>$val->id,
							'client'=>$val->customer_id,
							'hash'=>($val->id . csrf_token()),
							'from'=>$from
							)
						)
					}}"
					class="btn red btn-xs deleteMail"
				>
					<i class="fa fa-trash-o fa-5x"></i>
				</a>
				</div>
			</div>
		</div>
		{{Form::hidden('edit_emails['.$emailIdx.'][id]',$val->id)}}
	</div>
</div>

