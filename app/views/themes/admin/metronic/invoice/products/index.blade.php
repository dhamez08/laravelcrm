@extends($dashboard_index)

@section('innerpage-content')

	<div class="col-md-12 col-lg-12">
		<h1><i class="fa fa-list"></i> {{ trans('invoice.products') }}</h1>
		
		<a href="product/create" class="btn btn-primary"><i class="fa fa-plus"></i> {{ trans('invoice.create_new_product') }}</a>
	</div>	

	<div class="col-md-12 col-lg-12 top40">
		<h3>{{ trans('invoice.products') }}</h3>
		
		<div class="table-responsive">
			<table class="table solsoTable">
				<thead>
					<tr>
						<th>{{ trans('invoice.crt') }}.</th>
						<th>{{ trans('invoice.product') }}</th>
						<th>{{ trans('invoice.code') }}</th>
						<th class="small text-right">{{ trans('invoice.price') }}</th>
						<th class="small">{{ trans('invoice.action') }}</th>
						<th class="small">{{ trans('invoice.action') }}</th>
						<th class="small">{{ trans('invoice.action') }}</th>
					</tr>
				</thead>
				
				<tbody>
				
				@foreach ($products as $crt => $v)
				
					<tr>
						<td>
							{{ $crt+1 }}
						</td>
						
						<td>
							{{ $v->name }}
						</td>						
						
						<td>
							{{ $v->code }}
						</td>
						
						<td class="text-right">
							{{ $currency->position == 1 ? $currency->name : '' }} {{ $v->price }} {{ $currency->position == 2 ? $currency->name : '' }} 
						</td>						
						
						<td>		
							<a  class="btn btn-info solsoShowDetails" data-toggle="modal" data-target="#solsoInfoProduct" data-value="{{ $v->id }}"><i class="fa fa-eye"></i> {{ trans('invoice.show') }}</a>	
						</td>
						
						<td>		
							<a class="btn btn-primary" href="{{ URL::to('invoice/product/' . $v->id . '/edit') }}"><i class="fa fa-edit"></i> {{ trans('invoice.edit') }}</a>
						</td>
						
						<td>		
							<a  class="btn btn-danger solsoConfirm" data-toggle="modal" data-target="#solsoDeleteModal" data-url="{{ URL::to('invoice/product/' . $v->id) }}"><i class="fa fa-trash"></i> {{ trans('invoice.delete') }}</a>		
						</td>
					</tr>
					
				@endforeach
				
				</tbody>
			</table>
		</div>	
	</div>
	
	@include($view_path . '.invoice/_modals/delete')
	@include($view_path . '.invoice/_modals/product')
	
@stop

@section('footer-custom-js')
<script type="text/javascript">
/* === PRODUCT === */
	$( document ).on('click', '.solsoShowDetails', function(){
		$.ajax({
			url: "product/" + $(this).attr('data-value'),
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

/* === MODAL YES/NO === */
$( document ).on('click', '.solsoConfirm', function(){
	$(" #solsoFormID ").prop('action', $(this).attr('data-url'));
});
/* === MODAL YES/NO === */
</script>
@stop