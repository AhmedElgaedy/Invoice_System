<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
class InvoiceAchiveController extends Controller
{
    
    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('Invoices.archive_invoice',compact('invoices'));
    }


    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
  public function update(Request $request)
    {
         $id = $request->invoice_id;
         $flight = Invoice::withTrashed()->where('id', $id)->restore();
         session()->flash('restore_invoice');
         return redirect('/invoices');
    }

    
    public function destroy(Request $request)
    {
         $invoices = Invoice::withTrashed()->where('id',$request->invoice_id)->first();
         $invoices->forceDelete();
         session()->flash('delete_invoice');
         return redirect('/Archive');
    
    }
}