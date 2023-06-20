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
            Laporan
        @endslot
        @slot('title')
            Laporan Pergolongan
        @endslot
    @endcomponent
    <form action="/caripergol" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Range Tanggal</label>
                        <div class="input-daterange input-group">
                            <input type="date" id="start" class="form-control" name="start" value=""
                                required />
                            <span class="p-2">to</span>
                            <input type="date" id="end" class="form-control" name="end" required />
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Kode Golongan</label>
                        <select name="kode" id="kode" class="form-select select2" required>
                            <option value="" selected disabled>Pilih Kode Golongan</option>
                            @foreach ($golongan as $g)
                                <option value="{{ $g->id }}">({{ $g->kdgol }})
                                    {{ $g->namagol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-sm btn-primary" type="submit">submit</button>
                    </div>
                </div>
            </div>
        </div>
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
