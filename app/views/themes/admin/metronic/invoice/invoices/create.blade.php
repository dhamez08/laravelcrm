@extends($dashboard_index)

@section('innerpage-content')

	<div class="col-md-12 col-lg-12">
		<h1><i class="fa fa-plus"></i> {{ trans('invoice.new_invoice') }}</h1>
	</div>	

	{{ Form::open(array('url' => 'invoice/invoice', 'role' => 'form', 'class' => 'solsoForm')) }}

		<div class="col-md-6 col-lg-3">
			<div class="form-group">
				<label for="client">{{ trans('invoice.client') }}</label>
				<select name="client" class="form-control required solsoSelect2">
					<option value="" selected>choose</option>
					
					@foreach ($clients as $v)
						<option value="{{ $v->id }}"> {{ $v->first_name }} {{ $v->last_name }} </option>
					@endforeach			
					
				</select>
				
				<?php echo $errors->first('client', '<p class="error">:messages</p>');?>
			</div>
		</div>
		
		<div class="col-md-3 col-lg-3">		
			<div class="form-group">
				<label for="number">{{ trans('invoice.invoice_number') }}</label>
				<div class="input-group">
					<span class="input-group-addon solso-pre">{{ $invoiceCode }}</span>
					<input type="text" name="number" class="form-control required no-line" autocomplete="off" value="{{ $invoiceNumber ? $invoiceNumber : Input::old('number') }}">
				</div>
				
				<?php echo $errors->first('number', '<p class="error">:messages</p>');?>
			</div>
		</div>		
		<div class="clearfix"></div>
		
		<div class="col-md-3 col-lg-3">
			<div class="form-group">
				<label for="currency">{{ trans('invoice.currency') }}</label>
				<select name="currency" class="form-control required solsoCurrencyEvent">
					<option value="" selected>{{ trans('invoice.choose') }}</option>
					
					@foreach ($currencies as $v)
						<option value="{{ $v->id }}"> {{ $v->name }} </option>
					@endforeach					
					
				</select>
				
				<?php echo $errors->first('currency', '<p class="error">:messages</p>');?>
			</div>		
		</div>		
		
		<div class="col-md-3 col-lg-3">		
			<div class="form-group">
				<label for="date">{{ trans('invoice.date') }}</label>
				<input type="text" name="startDate" class="form-control datepicker required" autocomplete="off" value="{{ Input::old('startDate') }}">
				
				<?php echo $errors->first('startDate', '<p class="error">:messages</p>');?>
			</div>
		</div>	
		
		<div class="col-md-3 col-lg-3">		
			<div class="form-group">
				<label for="end">{{ trans('invoice.due_date') }}</label>
				<input type="text" name="endDate" class="form-control datepicker required" autocomplete="off" value="{{ Input::old('endDate') }}">
				
				<?php echo $errors->first('endDate', '<p class="error">:messages</p>');?>
			</div>
		</div>			
		<div class="clearfix"></div>
		
		<div class="table-responsive">
		<div class="col-md-12 col-lg-12">	
			<table class="table">
			<thead>
				<tr>
					<th>{{ trans('invoice.crt') }}.</th>
					<th class="col-md-5">{{ trans('invoice.product') }}</th>
					<th class="col-md-1">{{ trans('invoice.quantity') }}</th>
					<th class="col-md-1">{{ trans('invoice.price') }}</th>
					<th class="col-md-1">{{ trans('invoice.tax_rate') }}</th>
					<th class="col-md-1">{{ trans('invoice.discount') }}</th>
					<th class="col-md-1">{{ trans('invoice.type') }}</th>
					<th class="col-md-1">{{ trans('invoice.subtotal') }}</th>
					<th class="xs-small">{{ trans('invoice.action') }}</th>
				</tr>	
			</thead>
				
			<tbody class="solsoParent">	
				<tr class="solsoChild">
					<td class="crt">1</td>
					
					<td>
						<select name="products[]" class="form-control required solsoSelect2 solsoCloneSelect2">
							<option value="" selected>{{ trans('invoice.choose') }}</option>
							
							@foreach ($products as $v)
								<option value="{{ $v->id }}"> {{ substr($v->name, 0, 100) }} {{ strlen($v->name) > 100 ? '...' : '' }} </option>
							@endforeach			
							
						</select>				
					</td>
					
					<td>
						<input type="text" name="qty[]" class="form-control required solsoEvent" autocomplete="off">
					</td>
					
					<td>
						<input type="text" name="price[]" class="form-control required solsoEvent" autocomplete="off">
					</td>
					
					<td>
						<select name="taxes[]" class="form-control required solsoEvent">
							<option value="" selected>{{ trans('invoice.choose') }}</option>
							
							@foreach ($taxes as $v)
								<option value="{{ $v->value }}"> {{ $v->value }} %</option>
							@endforeach			
							
						</select>					
					</td>
					
					<td>
						<input type="text" name="discount[]" class="form-control" autocomplete="off">
					</td>	
				
					<td>
						<select name="discountType[]" class="form-control solsoEvent">
							<option value="" selected>{{ trans('invoice.choose') }}</option>
							<option value="1">{{ trans('invoice.amount') }}</option>
							<option value="2">%</option>
						</select>
					</td>

					<td>
						<h4 class="pull-right">
							<span class="solsoSubTotal">0.00</span>
						</h4>	
					</td>
					
					<td>
						<button type="button" class="btn btn-danger disabled removeClone"><i class="fa fa-minus"></i></button>
					</td>					
				</tr>
			</tbody>
			
			<tfoot>
				<tr>
					<td colspan="5">
						<div class="col-md-12 col-lg-6 form-inline">
							<label for="end" class="show">{{ trans('invoice.invoice_discount') }}</label>
							<input type="text" name="invoiceDiscount" class="form-control" autocomplete="off">
							
							<select name="invoiceDiscountType" class="form-control solsoEvent">
								<option value="" selected>{{ trans('invoice.choose') }}</option>
								<option value="1">{{ trans('invoice.amount') }}</option>
								<option value="2">%</option>
							</select>							
						</div>						
					</td>
					
					<td colspan="2">
						<h3 class="pull-right top10">{{ trans('invoice.total') }}</h3>
					</td>
					
					<td colspan="2">
						<h3 class="top10">
							<span class="solsoTotal">0.00</span>
							<span class="solsoCurrency"></span>
						</h3>
					</td>
				</tr>
			</tfoot>
			</table>
		</div>
		</div>

		<div class="form-group col-md-12 top20 text-center">
			<button type="button" class="btn btn-primary btn-lg" id="createClone"><i class="fa fa-plus"></i> {{ trans('invoice.add_new_product') }}</button>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="description">{{ trans('invoice.invoice_extra_information') }}</label>
				<textarea name="description" class="form-control" rows="7" autocomplete="off">{{ Input::old('description') }}</textarea>
			</div>	
		</div>				
	
		<div class="col-md-6">
			<label for="description">{{ trans('invoice.add_payment') }}</label>
			
			<div role="alert" class="alert alert-info">
				<p>{{ trans('invoice.invoice_text_02') }}<p/>
			</div>			
		
			<div class="row">
				<div class="col-md-4">		
					<div class="form-group">
						<label for="paymentAmount">{{ trans('invoice.amount_paid') }}</label>
						<input type="text" name="paymentAmount" class="form-control" autocomplete="off"	data-parsley-type="number">
					</div>
				</div>	
				
				<div class="col-md-4">		
					<div class="form-group">
						<label for="paymentDate">{{ trans('invoice.date') }}</label>
						<input type="text" name="paymentDate" class="form-control datepicker" autocomplete="off">
					</div>
				</div>				
				
				<div class="col-md-4">		
					<div class="form-group">
						<label for="paymentMethod">{{ trans('invoice.payment_method') }}</label>
						<select name="paymentMethod" class="form-control">
							<option value="" selected>{{ trans('invoice.choose') }}</option>

							@foreach ($payments as $v)
								<option value="{{ $v->id }}"> {{ $v->name }} </option>
							@endforeach					
							
						</select>
					</div>				
				</div>		
			</div>		
		</div>	
	
		<div class="form-group col-md-12">
			<button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> {{ trans('invoice.create_invoice') }}</button>	
		</div>
		
	{{ Form::close() }}
	
@stop

@section('footer-custom-js')
<script type="text/javascript">
if ($('.solsoSelect2').length) {
	$( ".solsoSelect2" ).select2();
}

$('.datepicker').datepicker({
	format: 'yyyy-mm-dd'
});

$('.datepicker').on('changeDate', function() {
	$('.datepicker').datepicker('hide');
});	

var startDate 	= '';
var endDate 	= '';
$('#dp4').datepicker()
	.on('changeDate', function(ev){
		startDate = new Date(ev.date);
		$('#dp4').datepicker('hide');
	});
$('#dp5').datepicker()
	.on('changeDate', function(ev){
		if (ev.date.valueOf() < startDate.valueOf()){
			$(".solsoErrorPopover").popover('show');
		} else {
			$(".solsoErrorPopover").popover('hide');
			endDate = new Date(ev.date);
		}
		$('#dp5').datepicker('hide');
	});
</script>

<!-- === SOLUTII SOFT === -->
<script>
	/* === PRODUCT === */
		$( document ).on('click', '.solsoShowDetails', function(){
			$.ajax({
				url: "invoice/product/" + $(this).attr('data-value'),
				type: 'get',
				dataType: 'json',
				data: { product: $(this).val() },
				success:function(data) {
					$( '.product-name' ).text(data['name']);
					$( '.product-price' ).text(data['price']);
					$( '.product-description' ).text(data['description']);
				}
			});
		});
	/* === END PRODUCT === */

	/* === CLONE ROW === */
	$('#createClone').on('click', function(e) {
		$( '.solsoSelect2.solsoCloneSelect2').select2('destroy');
		
		$( '.solsoParent' )
			.append( '<tr>' + $( 'tr.solsoChild' ).html()  + '</tr>' );
	
		$( '.crt' ).each(function( index ) {
			$( this ).text(index+1);
			
			if (index > 0) {
				$( this ).parent().find( '.removeClone' ).removeClass('disabled');
			}
		});			
		
		$( ".solsoSubTotal" ).last().text('0.00');
		
		$( '.solsoCloneSelect2' ).select2();

		return false;
	});
	
	$( document ).on('click', '.removeClone', function() {
		$(this).parents().eq(1).remove();
		
		$( '.crt' ).each(function( index ) {
			$( this ).text(index+1);
		});				
		
		if ( $(this).attr('data-id').length ) {
			$.ajax({
				url: "{{ URL::route('invoice.deleteProduct') }}",
				type: 'post',
				dataType: 'json',
				data: { id: $(this).attr('data-id') },
				success:function(data) {
				}
			});
		}
	});
	/* === END CLONE ROW === */	
	
	/* === INVOICE === */
	$( document ).on('change', '.solsoCloneSelect2', function() {
		inputPrice = $(this).closest('tr').find("[name='price[]']");
		
		$.ajax({
			url: "{{ URL::route('ajax.productPrice') }}",
			type: 'post',
			dataType: 'json',
			data: { product: $(this).val() },
			success:function(data) {
				inputPrice.val(data['price']);
			}
		});
	});		
	
	$( document ).on('change', '.solsoCurrencyEvent', function() {
		if ( $(this).val() != '') {
			$( '.solsoCurrency' ).text( $( "[name='currency'] option[value='" + $(this).val() + "']").text() );
		}
	});	
	
	$( document ).on("click change paste keyup", ".solsoEvent", function() {
		var qty			= $(this).closest('tr').find("[name='qty[]']").val();
		var price		= $(this).closest('tr').find("[name='price[]']").val();
		var tax			= $(this).closest('tr').find("[name='taxes[]']").val();
		var discount	= $(this).closest('tr').find("[name='discount[]']").val();	
		var type		= $(this).closest('tr').find("[name='discountType[]']").val();	
		var totalDisc	= $(this).closest('tr').find("[name='invoiceDiscount']").val();	
		var invoiceType	= $(this).closest('tr').find("[name='invoiceDiscountType']").val();	
		var subTotal	= 0;
		var total		= 0;
		
		itemQty			= parseFloat(qty)  > 0 		? parseFloat(qty).toFixed(2) 		: 0;
		itemPrice		= parseFloat(price)  > 0 	? parseFloat(price).toFixed(2) 		: 0;
		itemTax			= parseFloat(tax) > 0 		? parseFloat(tax).toFixed(2) 		: 0;
		itemDiscount	= parseFloat(discount) > 0	? parseFloat(discount).toFixed(2)	: 0;
		invoiceDiscount	= parseFloat(totalDisc) > 0	? parseFloat(totalDisc).toFixed(2)	: 0;
		
		solsoValue 			= itemQty * itemPrice;
		solsoTax			= solsoValue * (itemTax / 100);
		solsoPrice			= solsoValue + solsoTax;
		solsoDiscount		= itemDiscount;
		solsoTotalDiscount	= invoiceDiscount;
		
		if ( type == 2 ) {
			solsoDiscount	= solsoPrice * (itemDiscount / 100);
		}
		
		subTotal		= solsoPrice - solsoDiscount;
		
		$(this).closest('tr').find(".solsoSubTotal").text( subTotal.toFixed(2) );
		
		$( '.solsoSubTotal' ).each(function() {
			total += parseFloat($(this).text());
		});
		
		if ( invoiceType == 2 ) {
			solsoTotalDiscount = total * (invoiceDiscount / 100);
		}
		
		$( '.solsoTotal' ).text( (total - solsoTotalDiscount).toFixed(2) );
	});
	/* === END INVOICE === */

	/* === SETTINGS === */
	$( document ).on('click', '.solsoCurrencySettings', function(e) {
		e.preventDefault();
		
		var id	 	= $(this).attr('data-id');
		var name 	= $(this).closest('label').find("input[type='radio']").attr('name');
		var value 	= $(this).closest('label').find("input[type='radio']").val();
		var url		= '';
	
		if ( name == 'position') {
			goToUrl = "{{ URL::route('currency.currencyPosition') }}";
		}
		
		if ( name == 'default') {
			goToUrl = "{{ URL::route('setting.defaultCurrency') }}";
		}			
	
		$.ajax({
			url: goToUrl,
			type: 'post',
			dataType: 'html',
			data: { itemID: id, itemValue: value  },
			success:function(data) {
				$('#tab5').html(data);
			}
		});
		
		solsoAlerts();
	});
	/* === END SETTINGS === */
</script>
@stop