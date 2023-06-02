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
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
@endsection
