<?php
namespace Invoice;

use DB;
use DateTime;
use Auth;

class Invoice extends \Eloquent {


	public function client() 
	{
		return $this->belongsTo('Clients\Clients');
	}	
	

	public function invoices() 
	{
		$query = DB::table('invoices')
				->leftJoin('customer', 'customer.id', '=', 'invoices.client_id')
				->leftJoin('invoice_statuses', 'invoice_statuses.id', '=', 'invoices.status_id')
				->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency_id')
				->leftJoin('invoice_payments','invoice_payments.invoice_id', '=', 'invoices.id')
				->select(	'invoices.amount', 'invoices.start_date', 'invoices.due_date', 'invoices.description as invoiceDescription',
							'customer.first_name as client', 'invoices.id', 'invoices.number', 
							'invoice_statuses.name as status', 'invoices.description', 
							'currencies.id as currencyID', 'currencies.name as currency', 'currencies.position',
							DB::raw('IFNULL(SUM(`invoice_payments`.`payment_amount`), 0) as paid'),
							DB::raw('concat(customer.first_name, " ", customer.last_name) as client_fullname')
						)
				->where('invoices.user_id', Auth::id())
				->orderBy('due_date', 'desc')
				->groupBy('invoices.id')
				->get();
				
		return $query;		
	}	
	
	public function single($invoiceID, $userID) 
	{
		$query = DB::table('invoices')
				->join('customer', 'customer.id', '=', 'invoices.client_id')
				->join('customer_address', 'customer_address.customer_id', '=', 'customer.id')
				->join('invoice_statuses', 'invoice_statuses.id', '=', 'invoices.status_id')
				->join('currencies', 'currencies.id', '=', 'invoices.currency_id')
				->select(	'invoices.id as invoiceID', 'invoices.number', 'invoices.amount', 'invoices.discount', 'invoices.type', 'invoices.start_date', 'invoices.description',
							'invoices.due_date', 'invoice_statuses.name as status', 'invoices.description as invoiceDescription', 'invoices.client_id as clientID',
							'customer.*', 'customer.first_name as client', 	
							'currencies.id as currencyID', 'currencies.name as currency', 'currencies.position',
							'customer_address.address_line_1', 'customer_address.address_line_2', 'customer_address.town', 'customer_address.town', 'customer_address.county', 'customer_address.postcode',
							DB::raw('concat(customer.first_name, " ", customer.last_name) as client_fullname')
						)
				->where('invoices.id', $invoiceID)	
				/*	
				->where(function($querySplit) use ($userID) {
				
					if ($userID)
					{
						$querySplit->where('invoices.user_id', Auth::id());
					}	
					else
					{
						$client = DB::table('customer')
								//->where('email', Auth::user()->email)	
								->where('id', Auth::id())
								->select('id')
								->first();

						$querySplit->where('invoices.client_id', $client->id);		
					}
					
				})
				*/
				->first();
				
		return $query;		
	}	
	
	public function lastUnpaidInvoices()
	{
		$today = new DateTime('today');
		
		$query = DB::table('invoices')
				->join('customer', 'customer.id', '=', 'invoices.client_id')
				->leftJoin('invoice_statuses', 'invoice_statuses.id', '=', 'invoices.status_id')
				->select(	'invoices.id', 'invoices.number', 'invoices.due_date',
							'customer.first_name as client',
							'invoice_statuses.name as status',
							DB::raw('concat(customer.first_name, " ", customer.last_name) as client_fullname')
						)				
				->where('invoices.user_id', Auth::id())	
				->whereIn('invoices.status_id', array(2, 3))
				->get();
				
		return $query;		
	}
	
	public function overdueInvoices()
	{
		$today = new DateTime('today');
		
		$query = DB::table('invoices')
				->join('customer', 'customer.id', '=', 'invoices.client_id')
				->select(	'invoices.id', 'invoices.number', 'invoices.due_date',
							'customer.first_name as client',
							DB::raw('concat(customer.first_name, " ", customer.last_name) as client_fullname')
						)				
				->where('invoices.user_id', Auth::id())	
				->where('invoices.status_id', '5')
				->get();
				
		return $query;		
	}	
	
	public function invoiceStatus()
	{
		$today = new DateTime('today');
		
		DB::table('invoices')
				->whereIn('status_id', array(2, 3))
				->where('due_date', '<=', $today)
				->update(array('status_id' => 5));	
	}
	
	public function invoiceChart()
	{
		$total = Invoice::where('user_id', Auth::id())->count();
		
		$query = DB::table('invoices')
				->leftJoin('invoice_statuses', 'invoice_statuses.id', '=', 'invoices.status_id')
				->where('invoices.user_id', Auth::id())	
				->select( DB::raw('COUNT(*) as num'), 'invoice_statuses.name' )
				->groupBy('invoices.status_id')
				->get();

		$count	= $query;
		$chart 	= array(
			'paid' => array(
				'count'		=> 0,
				'percent'	=> 0
			),
			'unpaid' => array(
				'count'		=> 0,
				'percent'	=> 0
			),		
			'partiallypaid' => array(
				'count'		=> 0,
				'percent'	=> 0
			),	
			'cancelled' => array(
				'count'		=> 0,
				'percent'	=> 0
			),		
			'overdue' => array(
				'count'		=> 0,
				'percent'	=> 0
			)			
		);
		
		foreach ($count as $v)
		{
			$chart[str_replace(' ', '', $v->name)] = array(
				'count'		=> $v->num,
				'percent'	=> $total > 0 ? ( $v->num * 100) / $total : 0
			);
		}
		
		return $chart;
	}	
	
	public function products($invoiceID, $userID)
	{
		$query = DB::table('invoice_products')
				->join('products', 'products.id', '=', 'invoice_products.product_id')	
				->where('invoice_products.invoice_id', $invoiceID)

				->where(function($querySplit) use ($userID) {
				
					if ($userID)
					{
						$querySplit->where('products.user_id', Auth::id());
					}	
					
				})				
				
				->select('products.name', 'products.description', 'invoice_products.*')
				->get();
		
		return $query;
	}
	
	public function invoicesReceived()
	{
		$client = DB::table('customer')
				->where('email', Auth::user()->email)	
				->select('id')
				->first();
		
		if (isset($client->id))
		{
			$query = DB::table('invoices')
					->leftJoin('customer', 'customer.id', '=', 'invoices.client_id')
					->leftJoin('invoice_statuses', 'invoice_statuses.id', '=', 'invoices.status_id')
					->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency_id')
					->leftJoin('invoice_payments','invoice_payments.invoice_id', '=', 'invoices.id')
					->select(	'invoices.amount', 'invoices.start_date', 'invoices.due_date', 'invoices.description as invoiceDescription',
								'customer.first_name as client', 'invoices.id', 'invoices.number', 
								'invoice_statuses.name as status', 'invoices.description', 
								'currencies.id as currencyID', 'currencies.name as currency', 'currencies.position',
								DB::raw('IFNULL(SUM(`invoice_payments`.`payment_amount`), 0) as paid')
							)
					->where('invoices.client_id', $client->id)
					->orderBy('due_date', 'desc')
					->groupBy('invoices.id')
					->get();
					
			return $query;
		}
		
		return false;
	}
	
	
	
	public function totalProduct($option, $productQty, $productPrice, $productTax, $productDiscount, $discountType)
	{
		$value		= $productQty * $productPrice;
		$tax		= $value * ($productTax / 100);
		$price		= $value + $tax;
		$discount	= 0;
		
		if ( $discountType == 1 )
		{			
			$discount = $productDiscount;
		}
		
		if ( $discountType == 2 )
		{
			$discount = $price * ($productDiscount / 100);
		}
		
		if ($option == 1)
		{
			return $discount;
		}
			
		return $price - $discount;	
	}
	
	public function totalInvoice($productQty, $productPrice, $productTax, $productDiscount, $discountType, $invoiceDiscount, $invoiceDiscountType)
	{
		$total 		= 0;
		$discount	= 0;
		
		foreach ($productQty as $k => $q)
		{
			$total += $this->totalProduct(2, $productQty[$k], $productPrice[$k], $productTax[$k], $productDiscount[$k], $discountType[$k]);
		}
		
		if ( $invoiceDiscountType == 1 )
		{
			$discount = $invoiceDiscount;
		}
		if ( $invoiceDiscountType == 2 )
		{
			$discount = $total * ($invoiceDiscount / 100);
		}	
		
		return abs($total - $discount);
	}

}