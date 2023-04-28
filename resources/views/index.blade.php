@extends('layouts.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
@section('title', 'لوحة التحكم | الصفحةالرئيسية')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">أهلا بك مجددا</h2>
            {{-- <p class="mg-b-0">Sales monitoring dashboard template.</p> --}}
        </div>
    </div>

</div>
<!-- /breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row row-sm">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">اجمالي الفواتير</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{-- {{ $invoice }} --}}
                                {{-- {{ \App\Models\Invoice::count() }} --}}
                                {{ number_format(\App\Models\Invoice::sum('Total'), 2) }} $
                            </h4>
                            <h3 class="mb-1 tx-12 text-white">العدد :
                                {{ \App\Models\Invoice::count() }}
                            </h3>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7"> 100%</span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">الفواتير الغير مدفوعة</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ number_format(\App\Models\Invoice::where('Status', 'غير مدفوعة')->sum('Total'), 2) }}
                                $
                            </h4>
                            <h3 class="mb-1 tx-12 text-white">العدد :
                                {{ \App\Models\Invoice::where('Status', 'غير مدفوعة')->count() }}
                            </h3>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white op-7">
                                {{ round((\App\Models\Invoice::where('Status', 'غير مدفوعة')->count() / \App\Models\Invoice::count()) * 100) }}%
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ number_format(\App\Models\Invoice::where('Status', 'مدفوعة')->sum('Total'), 2) }}$
                            </h4>
                            <h3 class="mb-1 tx-12 text-white">العدد :
                                {{ \App\Models\Invoice::where('Status', 'مدفوعة')->count() }}
                            </h3>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7">
                                {{ round((\App\Models\Invoice::where('Status', 'مدفوعة')->count() / \App\Models\Invoice::count()) * 100) }}%
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                {{ number_format(\App\Models\Invoice::where('Status', 'مدفوعة جزئيا')->sum('Total'), 2) }}$
                            </h4>
                            <h3 class="mb-1 tx-12 text-white">العدد :
                                {{ \App\Models\Invoice::where('Status', 'مدفوعة جزئيا')->count() }}
                            </h3>
                        </div>
                        <span class="float-right my-auto mr-auto">
                            <i class="fas fa-arrow-circle-down text-white"></i>
                            <span class="text-white op-7">
                                {{ round((\App\Models\Invoice::where('Status', 'مدفوعة جزئيا')->count() / \App\Models\Invoice::count()) * 100) }}%
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>
</div>
<!-- row closed -->

<!-- row opened -->
<div class="row row-sm">
    <div class="col-md-12 col-lg-12 col-xl-7">
        <div class="card">
            <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-0">نسبة احصائيات الفواتير</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            <div class="card-body"style="width: 70%">
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-5">
        <div class="card card-dashboard-map-one">
            <label class="main-content-label">نسبة احصائيات الفواتير</label>
            <div class=""style="width: 100%" >
                {!! $chartjs_2->render() !!}
            </div>
        </div>
    </div>
</div>
<!-- row closed -->

</div>
</div>
<!-- Container closed -->
@endsection
@section('js')
<!--Internal  Chart.bundle js -->
<script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Moment js -->
<script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<!--Internal  Flot js-->
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
<script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
<script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
<!--Internal Apexchart js-->
<script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
<!-- Internal Map -->
<script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
<!--Internal  index js -->
<script src="{{ URL::asset('assets/js/index.js') }}"></script>
<script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script>
@endsection
