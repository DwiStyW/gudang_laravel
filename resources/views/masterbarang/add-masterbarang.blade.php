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
            Add Master Barang
        @endslot
    @endcomponent
    {{-- <form> --}}

    <form action="/master-barang/store" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" name="kode" placeholder="Kode Barang">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Nama Barang</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Barang">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Golongan</label>
                        <select name="kdgol" id="" class="form-select select2">
                            <option value="" selected disabled>Pilih Golongan</option>
                            @foreach ($golongan as $g)
                                <option value="{{ $g->id }}">({{ $g->kdgol }}) {{ $g->namagol }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Jenis</label>
                        <select name="kdjenis" id="" class="form-select select2">
                            <option value="" selected disabled>Pilih Jenis</option>
                            @foreach ($jenis as $j)
                                <option value="{{ $j->id }}">({{ $j->kdjenis }}) {{ $j->namajenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Satuan 1</label>
                        <input type="text" class="form-control" name="sat1" placeholder="Satuan">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Max 1</label>
                        <input type="text" class="form-control" name="max1" placeholder="Max">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Satuan 2</label>
                        <input type="text" class="form-control" name="sat2" placeholder="Satuan">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Max 2</label>
                        <input type="text" class="form-control" name="max2" placeholder="Max">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Satuan 3</label>
                        <input type="text" class="form-control" name="sat3" placeholder="Satuan">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" placeholder="Ukuran">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">Exp Date</label>
                        <input type="number" class="form-control" name="expdate" placeholder="Exp Date">
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
