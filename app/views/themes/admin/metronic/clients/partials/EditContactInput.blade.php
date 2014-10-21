<div id="edit-clone-phone">
	<div class="phone-wrapper">
		<div class="well">
			<div class="form-group">
				<label class="control-label col-md-3">Number</label>
				<div class="col-md-8">
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
			<div class="form-group">
				<label class="control-label col-md-3">Type</label>
				<div class="col-md-4">
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
				<div class="col-md-4">
				<a
					href="{{
						action('Clients\ClientsController@getConfirmPhoneDelete',
						array(
							'id'=>$val->id,
							'client'=>$val->customer_id,'hash'=>($val->id . csrf_token()),
							'from'=>$from
							)
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
</div>

