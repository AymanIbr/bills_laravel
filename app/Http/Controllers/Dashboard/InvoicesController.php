<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\InvoiceEvent;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Details_invoice;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Invoice_attachments;
use App\Models\Invoice_detalis;
use App\Models\User;
use App\Notifications\AddInvoice;
use Dotenv\Store\StoreBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;
use Rap2hpoutre\FastExcel\FastExcel;

// use Rap2hpoutre\FastExcel\FastExcel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::with('category')->get();
        return view('Dashboard.invoices.invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Dashboard.invoices.add_invoices', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $invoice = new Invoice();
        $invoice->invoice_number = $request->get('invoice_number');
        $invoice->invoice_Date = $request->get('invoice_Date');
        $invoice->Due_date = $request->get('Due_date');
        $invoice->product = $request->get('product');
        $invoice->category_id = $request->get('category_id');
        $invoice->Amount_collection = $request->get('Amount_collection');
        $invoice->Amount_Commission = $request->get('Amount_Commission');
        $invoice->Discount = $request->get('Discount');
        $invoice->Value_VAT = $request->get('Value_VAT');
        $invoice->Rate_VAT = $request->get('Rate_VAT');
        $invoice->Total = $request->get('Total');
        $invoice->Status = 'غير مدفوعة';
        $invoice->Value_Status = 2;
        $invoice->note = $request->get('note');
        $invoice->save();

        $invoice_id = Invoice::latest()->first()->id;
        $Invoice_detalis = new Details_invoice();
        $Invoice_detalis->invoice_id = $invoice_id;
        $Invoice_detalis->invoice_number = $request->get('invoice_number');
        $Invoice_detalis->product = $request->get('product');
        $Invoice_detalis->section = $request->get('invoice_number');
        $Invoice_detalis->note = $request->get('note');
        $Invoice_detalis->status = 'غير مدفوعة';
        $Invoice_detalis->value_status = 2;
        $Invoice_detalis->user = Auth::user()->name;
        $Invoice_detalis->save();


        $attachments = new Invoice_attachments();
        $invoice_id = Invoice::latest()->first()->id;
        $attachments->invoice_number = $request->get('invoice_number');
        $attachments->Created_by = Auth::user()->name;
        $attachments->invoice_id = $invoice_id;
        if ($request->hasFile('file_name')) {
            $ex = $request->file('file_name')->getClientOriginalName();  // ترجع امتداد الملف
            $file_name =   $ex;
            $request->file('file_name')->storePubliclyAs('file_name', $file_name, ['disk' => 'public']);
            $attachments->file_name = $file_name;
        }
        $attachments->save();

        // pusher
        InvoiceEvent::dispatch('تم انشاء فاتورة جديدة بواسطة ' . auth()->user()->name);

        // $user = User::first();
        // Notification::send($user, new AddInvoice($invoice_id));

        $user = User::get(); // تذهب على كل المستخدمين
        // $user = User::find(Auth::user()->id);  // لو اردت ان ترسلها للشخص الي انشاها فقط
        $invoice_id = Invoice::latest()->first();
        Notification::send($user, new AddInvoice($invoice_id));
        // Mail::to($user)->send(new AddInvoice($user,$invoice_id));

        return redirect()->route('invoices.index')->with('success', 'تم اضافة الفاتورة بنجاح');

        // Invoice::create($request->all());
        // return response()->view('index')->with('success','تم اضافة الفاتورة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice)
    {

        $invoices = Invoice::where('id', $invoice)->first();
        $details = Details_invoice::where('invoice_id', $invoice)->get();
        // \dd($details);
        $attachments = Invoice_attachments::where('invoice_id', $invoice)->get();
        return view('Dashboard.invoices.show', compact('invoices', 'details', 'attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $categories = Category::all();
        return view('Dashboard.invoices.edit_invoice', compact('invoice', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->invoice_number = $request->get('invoice_number');
        $invoice->invoice_Date = $request->get('invoice_Date');
        $invoice->Due_date = $request->get('Due_date');
        $invoice->product = $request->get('product');
        $invoice->category_id = $request->get('category_id');
        $invoice->Amount_collection = $request->get('Amount_collection');
        $invoice->Amount_Commission = $request->get('Amount_Commission');
        $invoice->Discount = $request->get('Discount');
        $invoice->Value_VAT = $request->get('Value_VAT');
        $invoice->Rate_VAT = $request->get('Rate_VAT');
        $invoice->Total = $request->get('Total');
        $invoice->note = $request->get('note');
        $invoice->save();

        return redirect()->route('invoices.index')->with('success', 'تم تعديل الفاتورة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;  // الي جاي من الموديولا
        $invoice = Invoice::where('id', $id)->first();
        $Details = invoice_attachments::where('invoice_id', $id)->first();
        $id_page = $request->id_page;
        if (!$id_page == 2) {
            if (!empty($Details->invoice_number)) {
                Storage::delete($Details->invoice_number);
            }
            $invoice->forceDelete();
            return redirect()->route('invoices.index')->with('error', 'تم حذف الفاتورة بنجاح');
        } else {
            $invoice->delete();
            return redirect()->route('invoices.index')->with('success', 'تم ارشفة الفاتورة بنجاح');
        }
    }

    public function paymentStatus(Invoice $invoice)
    {
        return view('Dashboard.invoices.status_update', compact('invoice'));
    }

    public function paymentUpdate(Invoice $invoice, Request $request)
    {

        if ($request->Status === 'مدفوعة') {
            $invoice->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            Details_invoice::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $invoice->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            Details_invoice::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        return redirect()->route('invoices.index')->with('success', 'تم تعديل حالة الدفع بنجاح');
    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("category_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    public function InvoicePaid()
    {
        $invoices = Invoice::where('Value_Status', 1)->get();
        return view('Dashboard.invoices.Paid_bills', compact('invoices'));
    }
    public function InvoiceUaid()
    {
        $invoices = Invoice::where('Value_Status', 2)->get();
        return view('Dashboard.invoices.unpaid_bills', compact('invoices'));
    }
    public function InvoicePartial()
    {
        $invoices = Invoice::where('Value_Status', 3)->get();
        return view('Dashboard.invoices.Partially_paid', compact('invoices'));
    }
    //Archive Invoice
    public function archive()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('Dashboard.invoices.archive_invoice', compact('invoices'));
    }

    public function restore(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invoice::onlyTrashed()->findOrFail($id);
        $invoices->restore();

        return redirect()->route('invoices.archive')->with('success', 'تم الغاء الارشفة بنجاح');
    }
    public function forecDelete(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = Invoice::onlyTrashed()->findOrFail($id);
        $invoices->forceDelete();
        return redirect()->route('invoices.archive')->with('error', 'تم حذف الفاتورة بنجاح');
    }

    // print
    public function printInvoice($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('Dashboard.invoices.print_invoice', compact('invoices'));
    }

    // excel
    public function export()
    {
        $invoice = Invoice::all();
        // $invoice = invoice::select('invoice_number', 'invoice_Date', 'Due_date','category_id', 'product', 'Amount_collection','Amount_Commission', 'Rate_VAT', 'Value_VAT','Total', 'Status', 'Payment_Date','note')->get();

        return (new FastExcel($invoice))->download('invoice_export.xlsx');
    }

    public function MarkAsRead_all(Request $request)
    {
        $userUnreadNotification= auth()->user()->unreadNotifications;

        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }
    }
}
