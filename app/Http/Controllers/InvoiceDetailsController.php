<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\Invoice_attachments;
use App\Models\Invoice_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoices = Invoice::findOrFail($id);
        $details  = Invoice_Details::where('id_Invoice',$id)->get();
        $attachments  = Invoice_attachments::where('invoice_id',$id)->get();

        return view('Invoices.details_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoice_details $invoices_details)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    
        {
            $invoices = Invoice_attachments::findOrFail($request->id_file);
            $invoices->delete();
            Storage::disk('public_uploads')->delete($request->invoice_number.'/'.$request->file_name);
            session()->flash('delete', 'تم حذف المرفق بنجاح');
            return back();
        }
    
     public function get_file($invoice_number,$file_name)
    
        {
            $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
            return response()->download( $contents);
        }
    
    
    
        public function open_file($invoice_number,$file_name)
    
        {
            $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number.'/'.$file_name);
            return response()->file($files);
        }
    }

