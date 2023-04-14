<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Invoice_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'mimes:pdf,jpeg,png,jpg',
        ], [
            'file_name.mimes' => ' pdf,jpeg,png,jpg صيغة المرفق يجب ان تكون'
        ]);

        $attachments = new Invoice_attachments();
        $attachments->invoice_number = $request->get('invoice_number');
        $attachments->Created_by = Auth::user()->name;
        $attachments->invoice_id = $request->invoice_id;
        if ($request->hasFile('file_name')) {
            $ex = $request->file('file_name')->getClientOriginalName();
            $file_name =   $ex;
            $request->file('file_name')->storePubliclyAs('file_name', $file_name, ['disk' => 'public']);
            $attachments->file_name = $file_name;
        }
        $attachments->save();
        return redirect()->route('invoices.index')->with('success', 'تم اضافة المرفق بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function OpenFile($file_name)
    {
        $pathToFile = public_path('storage/file_name' . '/' . $file_name);
        return response()->file($pathToFile);
    }
    public function DownloadFile($file_name)
    {
        $pathToFile = public_path('storage/file_name' . '/' . $file_name);
        return response()->download($pathToFile);
    }
    public function DeleteFile(Invoice_attachments $attachment)
    {
        Storage::delete($attachment->id);
        $attachment->delete();
        return redirect()->back()->with('success', 'تم حذف الملف بنجاح');
    }
}
