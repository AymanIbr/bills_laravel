@extends('layouts.master')
@section('css')
@endsection
@section('title','تفاصيل الفاتورة')
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <x-alert />
    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    الفاتورة</a>
                                            </li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab4">
                                            <table class="table table-striped" style="text-align:center">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">رقم الفاتورة</th>
                                                        <td>{{ $invoices->invoice_number }}</td>
                                                        <th scope="row">تاريخ الاصدار</th>
                                                        <td>{{ $invoices->invoice_Date }}</td>
                                                        <th scope="row">تاريخ الاستحقاق</th>
                                                        <td>{{ $invoices->Due_date }}</td>
                                                        <th scope="row">القسم</th>
                                                        <td>{{ $invoices->category->sections_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">المنتج</th>
                                                        <td>{{ $invoices->product }}</td>
                                                        <th scope="row">مبلغ التحصيل</th>
                                                        <td>{{ $invoices->Amount_collection }}</td>
                                                        <th scope="row">مبلغ العمولة</th>
                                                        <td>{{ $invoices->Amount_Commission }}</td>
                                                        <th scope="row">الخصم</th>
                                                        <td>{{ $invoices->Discount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">نسبة الضريبة</th>
                                                        <td>{{ $invoices->Rate_VAT }}</td>
                                                        <th scope="row">قيمة الضريبة</th>
                                                        <td>{{ $invoices->Value_VAT }}</td>
                                                        <th scope="row">الاجمالي مع الضريبة</th>
                                                        <td>{{ $invoices->Total }}</td>
                                                        <th scope="row">الحالة الحالية</th>
                                                        @if ($invoices->Value_Status == 1)
                                                            <td>
                                                                <span
                                                                    class="badge badge-pill badge-success">{{ $invoices->Status }}</span>
                                                            </td>
                                                        @elseif ($invoices->Value_Status == 2)
                                                            <td>
                                                                <span
                                                                    class="badge badge-pill badge-danger">{{ $invoices->Status }}</span>
                                                            </td>
                                                        @else
                                                            <td>
                                                                <span
                                                                    class="badge badge-pill badge-warning">{{ $invoices->Status }}</span>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">ملاحظات</td>
                                                        <th>{{ $invoices->note }}</th>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab5">
                                            <div class="table responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center ">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>رقم الفاتورة</th>
                                                            <th>نوع المنتج</th>
                                                            <th>القسم</th>
                                                            <th>حالة الدفع</th>
                                                            <th>تاريخ الدفع</th>
                                                            <th>ملاحظات</th>
                                                            <th>تاريخ الاضافة</th>
                                                            <th>المستخدم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($details as $detail)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <th>{{ $detail->invoice_number }}</th>
                                                                <th>{{ $detail->product }}</th>
                                                                <th>{{ $invoices->category->sections_name }}</th>
                                                                @if ($invoices->Value_Status == 1)
                                                                    <td>
                                                                        <span
                                                                            class="badge badge-pill badge-success">{{ $invoices->Status }}</span>
                                                                    </td>
                                                                @elseif ($invoices->Value_Status == 2)
                                                                    <td>
                                                                        <span
                                                                            class="badge badge-pill badge-danger">{{ $invoices->Status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <span
                                                                            class="badge badge-pill badge-warning">{{ $invoices->Status }}</span>
                                                                    </td>
                                                                @endif
                                                                <th>{{ $detail->Payment_Date }}</th>
                                                                <th>{{ $detail->note }}</th>
                                                                <th>{{ $detail->created_at->format('Y - m - d') }}</th>
                                                                <th>{{ $detail->user }}</th>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action={{ route('attachments.store') }}}"
                                                            enctype="multipart/form-data">
                                                           @csrf
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $invoices->invoice_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoices->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">تاكيد</button>
                                                        </form>
                                                    </div>
                                                <br>
                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($attachments as $attachment)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $attachment->file_name }}</td>
                                                                    <td>{{ $attachment->Created_by }}</td>
                                                                    <td>{{ $attachment->created_at }}</td>
                                                                    <td colspan="2">

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                        href="{{ route('OpenFile', $attachment->file_name) }}"
                                                                        role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                        عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                        href="{{ route('DownloadFile', $attachment->file_name) }}"
                                                                        role="button"><i
                                                                            class="fas fa-download"></i>&nbsp;
                                                                        تحميل</a>

                                                                        <form class="d-inline"
                                                                        action="{{ route('invoice.delete', $attachment->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <!-- Form Method Spoofing -->
                                                                        @method('delete')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-outline-danger">حذف</button>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->

        </div>
        <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection
