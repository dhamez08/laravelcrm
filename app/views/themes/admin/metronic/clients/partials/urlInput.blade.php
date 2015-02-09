<div id="clone-website">
	<div class="website-wrapper">
		<div class="well">
			<div class="form-group">
				<label class="control-label col-md-3">URL</label>
				<div class="col-md-9">
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
			<div class="form-group">
				<label class="control-label col-md-3">Reference</label>
				<div class="col-md-9">
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
			<div class="form-group">
				<label class="control-label col-md-3">Type</label>
				<div class="col-md-9">
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
</div>
{{-- 
<div class="col-xs-12">
	<button class="btn green btn-xs add-website" type="button">Add Web Address</button>
</div>
--}}