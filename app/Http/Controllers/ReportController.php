<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;


class ReportController extends Controller
{
    public function index(){

     return view('reports.invoices_report');

    }

    public function Search_invoices(Request $request){

    $rdio = $request->rdio;


  // search for invoice

    if ($rdio == 1) {


 // on case selcting the date
        if ($request->type && $request->start_at =='' && $request->end_at =='') {

           $invoices = Invoice::select('*')->where('Status','=',$request->type)->get();
           $type = $request->type;
           return view('reports.invoices_report',compact('type'))->withDetails($invoices);
        }

        // on case not selcting the date
        else {

          $start_at = date($request->start_at);
          $end_at = date($request->end_at);
          $type = $request->type;

          $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
          return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);

        }



    } 

//====================================================================

// search by invoice's number
    else {

        $invoices = Invoice::select('*')->where('invoice_number','=',$request->invoice_number)->get();
        return view('reports.invoices_report')->withDetails($invoices);

    }

    }

}