@extends('layouts.master')
@section('title')
    @lang('translation.Barang')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Master
        @endslot
        @slot('title')
            Barang
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success" href="master-barang/add"> Create Master Barang</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tabel" class="table table-striped table-bordered"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">
                            <tr>
                                <th data-priority="1">No</th>
                                <th data-priority="1">Kode</th>
                                <th data-priority="1">Nama</th>
                                <th data-priority="4">Ukuran</th>
                                <th data-priority="2">Satuan 1</th>
                                <th data-priority="2">Max 1</th>
                                <th data-priority="2">Satuan 2</th>
                                <th data-priority="2">Max 2</th>
                                <th data-priority="2">Satuan 3</th>
                                <th data-priority="3">Golongan</th>
                                <th data-priority="3">Jenis</th>
                                <th data-priority="3">Tanggal Dibuat</th>
                                <th data-priority="3">Exp Date</th>
                                <th data-priority="3">Saldo</th>
                                <th data-priority="1">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($masterbarang as $m)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $m->kode }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ $m->ukuran }}</td>
                                    <td>{{ $m->sat1 }}</td>
                                    <td>{{ $m->max1 }}</td>
                                    <td>{{ $m->sat2 }}</td>
                                    <td>{{ $m->max2 }}</td>
                                    <td>{{ $m->sat3 }}</td>
                                    <td>({{ $m->kgol }}) {{ $m->namagol }}</td>
                                    <td>({{ $m->kjenis }}) {{ $m->namajenis }}</td>
                                    <td>{{ $m->tgl_dibuat }}</td>
                                    <td>{{ $m->expdate }}</td>
                                    <td>{{ $m->saldo }}</td>
                                    <td>
                                        <a href="master-barang/show/{{ $m->id }}" class="px-3 text-warning">
                                            <i class="uil uil-eye font-size-18"></i>
                                        </a>

                                        <a href="master-barang/edit/{{ $m->id }}" class="px-3 text-primary">
                                            <i class="uil uil-pen font-size-18"></i>
                                        </a>

                                        {{-- <a href="masterbarang/delete/{{ $m->id }}" class="px-3 text-danger">
                                        <i class="uil uil-trash-alt font-size-18"></i>
                                    </a> --}}
                                        <a onclick="hapus({{ $m->id }})" data-bs-toggle="modal"
                                            data-bs-target="#hapusmodal" class="px-3 text-danger">
                                            <i class="uil uil-trash-alt font-size-18"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="modal fade" id="hapusmodal" tabindex="-1" aria-labelledby="hapusmodal" aria-hidden="true">
        <div class="modal-dialog" style="width:350px;top:200px">
            <div class="modal-content">
                <div class="alert alert-border alert-border-warning alert-dismissible fade show mt-4 px-4 mb-0 text-center"
                    role="alert">
                    <i class="uil uil-exclamation-triangle d-block display-4 mt-2 mb-3 text-warning"></i>
                    <h5 class="text-warning">Apa kamu yakin?</h5>
                    <p>Anda tidak akan dapat mengembalikan ini!</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                    <div class="d-flex justify-content-evenly">
                        <div id="buttonhapus"></div>
                        <div>
                            <button type="button" class="btn btn-md btn-danger" data-bs-dismiss="modal"> Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                processing: true,
                deferRender: true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn btn-sm p-2 rounded',
                        title: 'Data export Master Barang'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm p-2 ms-1 rounded',
                        title: 'Data export Master Barang'
                    }
                ],
                language: {
                    paginate: {
                        previous: '‹',
                        next: '›'
                    },
                    aria: {
                        paginate: {
                            previous: 'Previous',
                            next: 'Next'
                        }
                    }
                },
                pagingType: 'simple_numbers',
                responsive: {
                    details: {
                        type: 'none'
                    }
                },
                dom: '<"d-flex justify-content-between"<"mt-3" B><"me-2 mb-1"f>>t<"d-flex justify-content-between"<"mt-2" l><ip>>',
            });
        });

        function hapus(id) {
            var id = id;
            var str = '<a href="master-barang/delete/' + id + '" class="btn btn-md btn-success">Ya, hapus!</a>';
            document.getElementById('buttonhapus').innerHTML = str;
        }
    </script>
@endsection
