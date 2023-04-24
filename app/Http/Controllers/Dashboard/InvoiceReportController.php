<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    public function index()
    {
        return view('Dashboard.reports.invoices_report');
    }
    public function Search_invoices(Request $request)
    {
        $rdio = $request->rdio;

        if ($rdio == 1) {


            if ($request->type && $request->start_at == '' && $request->end_at == '') {

                $invoices = Invoice::select('*')->where('Status', '=', $request->type)->get();
                $type = $request->type;
                return view('Dashboard.reports.invoices_report', compact('type'))->withDetails($invoices);
            } else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', '=', $request->type)->get();
                return view('Dashboard.reports.invoices_report', compact('type', 'start_at', 'end_at'))->withDetails($invoices);
            }
        } else {

            $invoices = Invoice::select('*')->where('invoice_number', '=', $request->invoice_number)->get();
            return view('Dashboard.reports.invoices_report')->withDetails($invoices);
        }
    }
}
