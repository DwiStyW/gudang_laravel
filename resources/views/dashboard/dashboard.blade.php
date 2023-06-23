@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Gudang
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-4">
            <div class="card border-primary border-top">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Master Jenis</h4>
                            <h5>{{ count($masterjenis) }}</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="uil uil-archive font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-primary border-top">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Master Golongan</h4>
                            <h5>{{ count($mastergolongan) }}</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="uil uil-archive font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-primary border-top">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4>Master Barang</h4>
                            <h5>{{ count($masterbarang) }}</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="uil uil-archive font-size-24"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
@endsection
