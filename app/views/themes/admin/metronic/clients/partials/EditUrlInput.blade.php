<div id="edit-clone-website">
	<div class="row website-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
			{{
				Form::text(
					'urls['.$urlIdx.'][url]',
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
					'urls['.$urlIdx.'][for]',
					$websiteType,
					$val->website,
					array(
						'class'=>'form-control input-sm',
						'id'=>'baseFor'
					)
				);
			}}
			</div>
		</div>
		<div class="col-xs-2">
			<div class="form-group">
			{{
				Form::select(
					'urls['.$urlIdx.'][is]',
					$websiteIs,
					$val->type,
					array(
						'class'=>'form-control input-sm',
						'id'=>'baseIs'
					)
				);
			}}
			</div>
		</div>
	</div>
</div>

