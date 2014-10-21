<div id="edit-clone-website">
	<div class="website-wrapper">
		<div class="well">
			<div class="form-group">
				<label class="control-label col-md-3">URL</label>
				<div class="col-md-9">
				{{
					Form::text(
						'edit_urls['.$urlIdx.'][url]',
						$val->url,
						array(
							'class'=>'form-control input-sm'
						)
					);
				}}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-md-3">Reference</label>
				<div class="col-md-9">
				{{
					Form::select(
						'edit_urls['.$urlIdx.'][for]',
						$websiteType,
						$val->website,
						array(
							'class'=>'form-control input-sm',
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
						'edit_urls['.$urlIdx.'][is]',
						$websiteIs,
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
						action('Clients\ClientsController@getConfirmUrlDelete',
						array(
							'id'=>$val->id,
							'client'=>$val->customer_id,
							'hash'=>($val->id . csrf_token()),
							'from'=>$from
							)
						)
					}}"
					class="btn red btn-xs deleteURL"
				>
						<i class="fa fa-trash-o fa-5x"></i>
				</a>
				</div>
			</div>
		</div>
		{{Form::hidden('edit_urls['.$urlIdx.'][id]',$val->id)}}
	</div>
</div>

