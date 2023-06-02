@extends('layouts.master')
@section('title')
    @lang('translation.Add_Product')
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Master
        @endslot
        @slot('title')
            Add Jenis
        @endslot
    @endcomponent
    {{-- <form> --}}

    <form action="/master-golongan/store" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Kode Golongan</label>
                        <input type="text" class="form-control" name="kdgol">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Nama Golongan</label>
                        <input type="text" class="form-control" name="namagol">
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-md btn-secondary">back</a>
        <button type="submit" class="btn btn-md btn-primary">Save</button>
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/ckeditor/ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
