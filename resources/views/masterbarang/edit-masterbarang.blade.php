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
            Edit Master Barang
        @endslot
    @endcomponent
    {{-- <form> --}}
    @foreach ($barang as $find)
        <form action="/master-barang/update/{{ $find->id }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" name="kode" placeholder="Kode Barang"
                                value="{{ $find->kode }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Nama Barang</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Barang"
                                value="{{ $find->nama }}">
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
                                    @if ($g->id == $find->kdgol)
                                        <option value="{{ $g->id }}" selected>({{ $g->kdgol }})
                                            {{ $g->namagol }}</option>
                                    @else
                                        <option value="{{ $g->id }}">({{ $g->kdgol }}) {{ $g->namagol }}
                                        </option>
                                    @endif
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
                                    @if ($j->id == $find->kdjenis)
                                        <option value="{{ $j->id }}" selected>({{ $j->kdjenis }})
                                            {{ $j->namajenis }}
                                        </option>
                                    @else
                                        <option value="{{ $j->id }}">({{ $j->kdjenis }})
                                            {{ $j->namajenis }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Satuan 1</label>
                            <input type="text" class="form-control" name="sat1" placeholder="Satuan"
                                value="{{ $find->sat1 }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Max 1</label>
                            <input type="text" class="form-control" name="max1" placeholder="Max"
                                value="{{ $find->max1 }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Satuan 2</label>
                            <input type="text" class="form-control" name="sat2" placeholder="Satuan"
                                value="{{ $find->sat2 }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Max 2</label>
                            <input type="text" class="form-control" name="max2" placeholder="Max"
                                value="{{ $find->max2 }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Satuan 3</label>
                            <input type="text" class="form-control" name="sat3" placeholder="Satuan"
                                value="{{ $find->sat3 }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Ukuran</label>
                            <input type="text" class="form-control" name="ukuran" placeholder="Ukuran"
                                value="{{ $find->ukuran }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Exp Date</label>
                            <input type="number" class="form-control" name="expdate" placeholder="Exp Date"
                                value="{{ $find->expdate }}">
                        </div>
                    </div>
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-md btn-secondary">back</a>
            <button type="submit" class="btn btn-md btn-primary">Save</button>
        </form>
    @endforeach
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/ckeditor/ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
