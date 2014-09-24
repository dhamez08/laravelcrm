<div id="clone-website">
	<div class="row website-wrapper">
		<div class="col-xs-4">
			<div class="form-group">
			{{
				Form::text(
					'urls[0][url]',
					null,
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
					'urls[0][for]',
					$websiteType,
					null,
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
					'urls[0][is]',
					$websiteIs,
					null,
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
<div class="col-xs-12">
	<button class="btn green btn-xs add-website" type="button">Add Web Address</button>
</div>
