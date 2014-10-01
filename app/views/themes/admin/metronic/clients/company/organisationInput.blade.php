<div class="col-xs-5">
	<div class="form-group">
	<label class="control-label">Company Name</label>
	{{
		Form::text(
			'company_name',
			null,
			array(
				'class'=>'form-control input-sm'
			)
		);
	}}
	</div>
</div>
<div class="col-xs-5">
	<div class="form-group">
		<label class="control-label">&nbsp;</label>
		<button id="searchCompanyInfo" class="btn btn-primary" type="button">search company information</button>
	</div>
</div>
<div class="col-xs-12">
	<div class="form-group">
		<div id="company_lookup_results">
			<select style="width:500px;" class="form-control" multiple="multiple" id="company_lookup_results_list">
			</select>
		</div>
	</div>
</div>
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">Company Registration Number</label>
	{{
		Form::text(
			'companyreg',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'companyreg',
			)
		);
	}}
	</div>
</div>
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">Number Employees</label>
	{{
		Form::text(
			'companyemployee',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'companyemployee',
			)
		);
	}}
	</div>
</div>
<div class="col-xs-6">
	<div class="form-group">
	<label class="control-label">Company Industry Sector:</label>
	{{
		Form::text(
			'sector',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'sector',
			)
		);
	}}
	</div>
</div>
