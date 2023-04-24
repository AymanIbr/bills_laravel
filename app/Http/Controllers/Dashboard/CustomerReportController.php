<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use Illuminate\Http\Request;

class CustomerReportController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('Dashboard.reports.customer_report', compact('categories'));
    }

    public function Search_customers(Request $request)
    {
        if ($request->category_id && $request->product && $request->start_at == '' && $request->end_at == '') {
            $invoices = Invoice::select('*')->where('category_id', '=', $request->category_id)->where('product', '=', $request->product)->get();
            $categories = Category::all();
            return view('Dashboard.reports.customer_report', compact('categories'))->withDetails($invoices);
        } else {
            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $invoices = Invoice::whereBetween('invoice_Date',[$start_at,$end_at])->where('category_id', '=', $request->category_id)->where('product', '=', $request->product)->get();
            $categories = Category::all();
            return view('Dashboard.reports.customer_report', compact('categories'))->withDetails($invoices);
        }
    }
}
