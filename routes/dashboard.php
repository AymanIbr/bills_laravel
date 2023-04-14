<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\InvoiceAttachmentController;
use App\Http\Controllers\Dashboard\InvoicesController;
use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| dashboard Routes
|--------------------------------------------------------------------------
|
*/




Route::prefix('/')->middleware('auth')->group(function () {


    Route::resource('invoices', InvoicesController::class);
    Route::get('/category/{id}', [InvoicesController::class, 'getproducts']);
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductController::class);
    Route::resource('attachments', InvoiceAttachmentController::class);
    // view file
    Route::get('view_file/{file_name}', [InvoiceAttachmentController::class, 'OpenFile'])->name('OpenFile');
    //download
    Route::get('download_file/{file_name}', [InvoiceAttachmentController::class, 'DownloadFile'])->name('DownloadFile');
    //delete file
    Route::delete('delete_file/{attachment}', [InvoiceAttachmentController::class, 'DeleteFile'])->name('invoice.delete');
    // حالة الدفع
    Route::get('/status_show/{invoice}', [InvoicesController::class, 'paymentStatus'])->name('paymentStatus');
    Route::post('/status_update/{invoice}', [InvoicesController::class, 'paymentUpdate'])->name('paymentUpdate');
    // الفواتير
    Route::get('invoice_paid', [InvoicesController::class, 'InvoicePaid'])->name('InvoicePaid');
    Route::get('invoice_Unpaid', [InvoicesController::class, 'InvoiceUaid'])->name('InvoiceUpaid');
    Route::get('invoice_partial', [InvoicesController::class, 'InvoicePartial'])->name('InvoicePartial');

    //Archive
    Route::get('invoice_archive', [InvoicesController::class, 'archive'])->name('invoices.archive');
    Route::put('invoices/{invoice}/restore', [InvoicesController::class, 'restore'])->name('invoices.restore');
    Route::delete('invoices/{invoice}/force-delete', [InvoicesController::class, 'forecDelete'])->name('invoices.force-delete');


    Route::get('/{page}', [AdminController::class, 'index']);
});
