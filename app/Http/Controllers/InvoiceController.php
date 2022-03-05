<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceShowRequest;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function getTotalInvoice(InvoiceShowRequest $request)
    {
        $total = 0;

        $invoiceId = $request->invoice;

        $invoic = Invoice::find($invoiceId);

        foreach($invoic->products as $product){
            $total =+ $total + $product->getTotalPrice();
        }

        return view('welcome')->withInput($request->only('invoice'))->with('total', $total);
    }

    public function getIdInvoiceProductsHigherHundred()
    {
        $maxQty = 100;
        $invoices = Invoice::with('products')->get();

        foreach($invoices as $products){
            foreach($products->products as $product){
                if($product->quantity > $maxQty){
                    $arrayInvoiceId[] = $product->invoice_id;
                }
            }
        }

        return view('welcome')->with('arrayInvoiceId', $arrayInvoiceId);
    }
}
