<div id="edit-clone-email">
	<div class="row email-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
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
		<div class="col-xs-4">
			<div class="form-group">
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
		</div>
		<div class="col-xs-4">
			<div class="form-group">
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
		{{Form::hidden('edit_emails['.$emailIdx.'][id]',$val->id)}}
	</div>
</div>

