<div class="form-group">
	<label class="control-label col-md-3">Company Name</label>
	<div class="col-md-9">
	{{
		Form::text(
			'company_name',
			null,
			array(
				'class'=>'form-control input-sm',
				'id'=>'company',
				isset($customer) ? 'readonly':'',
			)
		);
	}}
	</div>
</div>
@if( !isset($customer) )
<div class="form-group">
	<label class="control-label col-md-3"></label>
	<div class="col-md-4">
		<button id="searchCompanyInfo" class="btn btn-primary btn-md" type="button">search company information</button>
	</div>
</div>
@endif
@if( !isset($customer) )
<div class="form-group">
	<label class="control-label col-md-3">&nbsp;</label>
	<div class="col-md-9">
		<div id="company_lookup_results">
			<select style="width:100%;" class="form-control" multiple="multiple" id="company_lookup_results_list">
			</select>
		</div>
	</div>
</div>
@endif
<div class="form-group">
	<label class="control-label col-md-3">Company Registration Number</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">Number Employees</label>
	<div class="col-md-9">
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
<div class="form-group">
	<label class="control-label col-md-3">Company Industry Sector:</label>
	<div class="col-md-9">
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
