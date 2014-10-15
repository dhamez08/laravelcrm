<div id="edit-clone-phone">
	<div class="row phone-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
			{{
				Form::text(
					'edit_telephone['.$telephoneIdx.'][number]',
					$val->number,
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
					'edit_telephone['.$telephoneIdx.'][for]',
					$phoneFor,
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
						action('Clients\ClientsController@getConfirmPhoneDelete',
						array(
							'id'=>$val->id,
							'client'=>$val->customer_id,'hash'=>($val->id . csrf_token()))
						)
					}}"
					class="btn red btn-xs deletePhone"
				>
					<i class="fa fa-trash-o fa-5x"></i>
				</a>
			</div>
		</div>
		{{Form::hidden('edit_telephone['.$telephoneIdx.'][id]',$val->id)}}
	</div>
</div>

