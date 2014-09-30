<div id="edit-clone-website">
	<div class="row website-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
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
		<div class="col-xs-2">
			<div class="form-group">
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
		<div class="col-xs-2">
			<div class="form-group">
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
		</div>
		{{Form::hidden('edit_urls['.$urlIdx.'][id]',$val->id)}}
	</div>
</div>

