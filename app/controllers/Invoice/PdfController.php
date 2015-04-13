<?php
namespace Invoice;

use Invoice\Invoice;
use Request;
use Invoice\UserSetting;
use Invoice\Image;
use Invoice\InvoiceSetting;
use PDF2;
use Redirect;
use Auth;

class PdfController extends \BaseController {


	public function show($id)
	{
		$newInvoice 		= new Invoice;
		$invoice			= $newInvoice->single($id, Request::segment(4) ? false : true);
		
		if ( $invoice ) 
		{
			$userID = Request::segment(4) ? $invoice->belongs_user : Auth::id();
			
			$data = array(
				'owner'				=> UserSetting::where('user_id', $userID)->first(),
				'logo'				=> Image::where('user_id', $userID)->first(),
				'invoice' 			=> $invoice,
				'invoiceSettings'	=> InvoiceSetting::where('user_id', $userID)->first(),
				'invoiceProducts'	=> $newInvoice->products($id,  Request::segment(4) ? false : true)
			);		
		}
		else 
		{
			return Redirect::to('invoice/invoice')->with('message', trans('invoice.access_denied'));
		}		
		
		$pdf 		= PDF2::loadView('themes.admin.metronic.invoice.invoices.themes.theme_01', $data)->setPaper('letter')->setOrientation('portrait');
		$pdfName	= 'invoice_' . $invoice->number . '_' . date('Y-m-d');
		
		return 	$pdf->download( $pdfName . '.pdf');	
	}	

}