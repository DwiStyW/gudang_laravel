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
            Add Barang Keluar
        @endslot
    @endcomponent
    {{-- <form> --}}

    <form action="/barang-keluar/store" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Tanggal Form</label>
                        <input type="Date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal"
                            oninput="input()">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label for="exampleFormControlTextarea1">No Form</label>
                        <input type="text" class="form-control" id="noform" name="noform" placeholder="No Form"
                            oninput="input()">
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-1">
                            <button onclick="loopplus()" id="plus" type="button" class="btn btn-sm btn-primary">
                                <i class="uil-plus"></i>
                            </button>
                            <button onclick="loopminus()" id="minus" type="button" disabled
                                class="btn btn-sm btn-primary mx-1 me-1">
                                <i class="uil-minus"></i>
                            </button>
                        </div>
                        <input type="hidden" name="indexloop" id="indexloop" value="1">
                        <div id="loop1">
                            <div class="row rounded p-3 mx-2 me-2 mt-2" style="border: 3px solid rgb(140, 140, 140)">
                                <div class="col-12">
                                    <div class="p-1">
                                        <label for="exampleFormControlTextarea1">Kode Barang</label>
                                        <select name="kode1" id="kode1" class="form-select select2"
                                            onchange="pilihkode()" required>
                                            <option value="" selected disabled>Pilih Kode Barang</option>
                                            @foreach ($barang as $b)
                                                <option value="{{ $b->kode }}">({{ $b->kode }})
                                                    {{ $b->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="p-1">
                                        <label for="exampleFormControlTextarea1">No Batch</label>
                                        <input type="text" class="form-control" name="nobatch1" placeholder="No Batch">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12">
                                    <div class="p-1">
                                        <label for="exampleFormControlTextarea1">Satuan 1</label>
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="sat1kode1"
                                                    placeholder="Satuan 1">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" readonly id="satuan1kode1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="p-1">
                                        <label for="exampleFormControlTextarea1">Satuan 2</label>
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="sat2kode1"
                                                    placeholder="Satuan 2">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" readonly id="satuan2kode1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="p-1">
                                        <label for="exampleFormControlTextarea1">Satuan 3</label>
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" class="form-control" name="sat3kode1"
                                                    placeholder="Satuan 3">
                                            </div>
                                            <div class="col-4">
                                                <input type="text" class="form-control" readonly id="satuan3kode1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                    <div class="p-1">
                                        <label for="exampleFormControlTextarea1">Catatan</label>
                                        <textarea type="text" class="form-control" name="catatan1" rows="3" placeholder="Catatan"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="loop2"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <label class="form-label">Tanggal Input</label>
                        <input type="text" class="form-control" name="tgl" readonly
                            value="{{ date('Y-m-d h:i:s') }}">
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:history.back()" class="btn btn-md btn-secondary">back</a>
        <button type="submit" class="btn btn-md btn-primary" onclick="submit()">Save</button>
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/ckeditor/ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
    <script>
        var a = 1;
        var barang = @json($barang);


        function pilihkode() {
            var length = document.getElementById('indexloop').value;
            // var setlength = localStorage.setItem("length", length);

            // console.log(length);
            for (i = 0; i < length; i++) {
                var indexloop = i + 1;
                var kode = {};

                kode = document.getElementById('kode' + indexloop).value;
                // var setKode = localStorage.setItem("kode" + indexloop, kode);
                var filterbarang = barang.filter(b => b.kode == kode);

                if (filterbarang.length == 1) {
                    console.log(indexloop)
                    document.getElementById('satuan1kode' + indexloop).value = filterbarang[0].sat1;
                    document.getElementById('satuan2kode' + indexloop).value = filterbarang[0].sat2;
                    document.getElementById('satuan3kode' + indexloop).value = filterbarang[0].sat3;
                } else {
                    // console.log('ga ada idnya tai')
                }

            }
        }

        function loopplus() {
            var awal = parseInt(document.getElementById('indexloop').value);
            var index = awal + a;
            var nextindex = index + a;
            var str = '';

            // indexloop untuk requestloop
            document.getElementById('indexloop').value = index;
            // untuk button minus
            if (index > 1) {
                document.getElementById('minus').disabled = false;
            }
            // untuk select2
            $(document).ready(function() {
                $(".select2").select2();
            });
            // formloop
            str += '<div class="row rounded p-3 mx-2 me-2 mt-2" style="border: 3px solid rgb(140, 140, 140)">';
            str += '    <div class="col-12">';
            str += '        <div class="p-1">';
            str += '            <label for="exampleFormControlTextarea1">Kode Barang</label>';
            str += '            <select name="kode' + index + '" id="kode' + index + '" class="form-select select2"';
            str += '            onchange="pilihkode()" required>';
            str += '                <option value="" selected disabled>Pilih Kode Barang</option>';
            for (let a = 0; a < barang.length; a++) {
                str += '                <option value="' + barang[a].kode + '">(' + barang[a].kode + ')';
                str += '                ' + barang[a].nama + '</option>';
            }
            str += '            </select>';
            str += '        </div>';
            str += '    </div>';
            str += '    <div class="col-lg-12 col-sm-12">';
            str += '        <div class="p-1">';
            str += '            <label for="exampleFormControlTextarea1">No Batch</label>';
            str += '            <input type="text" class="form-control" name="nobatch' + index +
                '" placeholder="No Batch">';
            str += '        </div>';
            str += '    </div>';
            str += '    <div class="col-lg-12 col-sm-12">';
            str += '        <div class="p-1">';
            str += '            <label for="exampleFormControlTextarea1">Satuan 1</label>';
            str += '            <div class="row">';
            str += '                <div class="col-8">';
            str += '                    <input type="text" class="form-control" name="sat1kode' + index + '"';
            str += '                        placeholder="Satuan 1">';
            str += '                </div>';
            str += '                <div class="col-4">';
            str += '                    <input type="text" class="form-control" readonly id="satuan1kode' + index + '">';
            str += '                </div>';
            str += '            </div>';
            str += '        </div>';
            str += '    </div>';
            str += '    <div class="col-lg-12 col-sm-12">';
            str += '        <div class="p-1">';
            str += '            <label for="exampleFormControlTextarea1">Satuan 2</label>';
            str += '            <div class="row">';
            str += '                <div class="col-8">';
            str += '                    <input type="text" class="form-control" name="sat2kode' + index + '"';
            str += '                        placeholder="Satuan 2">';
            str += '                </div>';
            str += '                <div class="col-4">';
            str += '                    <input type="text" class="form-control" readonly id="satuan2kode' + index + '">';
            str += '                </div>';
            str += '            </div>';
            str += '        </div>';
            str += '    </div>';
            str += '    <div class="col-lg-12 col-sm-12">';
            str += '        <div class="p-1">';
            str += '            <label for="exampleFormControlTextarea1">Satuan 3</label>';
            str += '            <div class="row">';
            str += '                <div class="col-8">';
            str += '                    <input type="text" class="form-control" name="sat3kode' + index + '"';
            str += '                        placeholder="Satuan 3">';
            str += '                </div>';
            str += '                <div class="col-4">';
            str += '                    <input type="text" class="form-control" readonly id="satuan3kode' + index + '">';
            str += '                </div>';
            str += '            </div>';
            str += '        </div>';
            str += '    </div>';
            str += '    <div class="col-lg-12 col-sm-12">';
            str += '        <div class="p-1">';
            str += '            <label for="exampleFormControlTextarea1">Catatan</label>';
            str += '<textarea type="text" class="form-control" name="catatan' + index +
                '" rows="3" placeholder="Catatan"></textarea>';
            str += '        </div>';
            str += '    </div>';
            str += '</div>';
            str += '<div id="loop' + nextindex + '"></div>';
            document.getElementById('loop' + index).innerHTML = str;
        }

        function loopminus() {
            var index = parseInt(document.getElementById('indexloop').value);

            document.getElementById('indexloop').value = index - 1;
            console.log(index);
            if (index - 1 == 1) {
                document.getElementById('minus').disabled = true;
            }
            document.getElementById('loop' + index).innerHTML = '<div id="loop' + index + '"></div>';

        }
    </script>
@endsection
