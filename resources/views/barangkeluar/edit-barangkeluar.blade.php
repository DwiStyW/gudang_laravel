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
            Edit Barang Keluar
        @endslot
    @endcomponent
    {{-- <form> --}}
    @foreach ($riwayatkeluar as $find)
        <form action="/barang-keluar/update/{{ $find->id }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label class="form-label">Tanggal Form</label>
                            <input type="Date" class="form-control" name="tanggal" placeholder="Tanggal"
                                value="{{ $find->tglform }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">No Form</label>
                            <input type="text" class="form-control" name="noform" placeholder="No Form"
                                value="{{ $find->noform }}">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Kode Barang</label>
                            <select name="kode" id="kode" class="form-select select2" onchange="pilihkode()"
                                required>
                                <option value="" selected disabled>Pilih Kode Barang</option>
                                @foreach ($barang as $b)
                                    @if ($b->kode == $find->kode)
                                        <option value="{{ $b->kode }}" selected>({{ $b->kode }})
                                            {{ $b->nama }}</option>
                                    @else
                                        <option value="{{ $b->kode }}">({{ $b->kode }})
                                            {{ $b->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">No Batch</label>
                            <input type="text" class="form-control" name="nobatch" placeholder="No Batch"
                                value="{{ $find->nobatch }}">
                        </div>
                    </div>
                </div>
                @php
                    $sats1 = floor($find->keluar / ($find->max1 * $find->max2));
                    $sisa = $find->keluar - $sats1 * $find->max1 * $find->max2;
                    $sats2 = floor($sisa / $find->max2);
                    $sats3 = $sisa - $sats2 * $find->max2;
                @endphp
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Satuan 1</label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" name="sat1" placeholder="Satuan 1"
                                        value="{{ $sats1 }}">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" readonly id="satuan1"
                                        value="{{ $find->sat1 }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Satuan 2</label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" name="sat2" placeholder="Satuan 2"
                                        value="{{ $sats2 }}">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" readonly id="satuan2"
                                        value="{{ $find->sat2 }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Satuan 3</label>
                            <div class="row">
                                <div class="col-8">
                                    <input type="text" class="form-control" name="sat3" placeholder="Satuan 3"
                                        value="{{ $sats3 }}">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" readonly id="satuan3"
                                        value="{{ $find->sat3 }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label for="exampleFormControlTextarea1">Catatan</label>
                            <textarea type="text" class="form-control" name="catatan" rows="3" placeholder="Catatan">{{ $find->cat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <label class="form-label">Tanggal Input</label>
                            <input type="text" class="form-control" name="tgl" readonly
                                value="{{ $find->tanggal }}">
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
    <script>
        var barang = @json($barang);

        function pilihkode() {
            kode = document.getElementById('kode').value;
            var filterbarang = barang.filter(b => b.kode == kode);

            if (filterbarang.length == 1) {
                document.getElementById('satuan1').value = filterbarang[0].sat1;
                document.getElementById('satuan2').value = filterbarang[0].sat2;
                document.getElementById('satuan3').value = filterbarang[0].sat3;
            } else {
                console.log('ga ada idnya tai')
            }
        }
    </script>
@endsection
