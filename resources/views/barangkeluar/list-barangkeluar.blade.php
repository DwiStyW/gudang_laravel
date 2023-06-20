@extends('layouts.master')
@section('title')
    @lang('Keluar')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Transaksi
        @endslot
        @slot('title')
            Keluar
        @endslot
    @endcomponent

    <div class="row" onload="myFunction()">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success" href="barang-keluar/add"> Input Barang Keluar</a>
                </div>
            </div>
        </div>
    </div>
    <div id="loader"></div>
    <div class="row" id="myDiv" class="animate-bottom">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tabel" class="table table-striped table-bordered display responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">
                            <tr>
                                <th data-priority="1">No</th>
                                <th data-priority="1">Tgl Form</th>
                                <th data-priority="1">No Form</th>
                                <th data-priority="1">Kode Barang</th>
                                <th data-priority="2">Nama Barang</th>
                                <th data-priority="1">No Batch</th>
                                <th data-priority="1">No Pallet</th>
                                <th data-priority="3">Status</th>
                                <th data-priority="1">Satuan 1</th>
                                <th data-priority="1">Satuan 2</th>
                                <th data-priority="1">Satuan 3</th>
                                <th data-priority="3">Tgl Input</th>
                                {{-- <th data-priority="3">Oleh</th> --}}
                                <th data-priority="3">Catatan</th>
                                <th data-priority="1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($riwayatkeluar as $rm)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $rm->tglform }}</td>
                                    <td>{{ $rm->noform }}</td>
                                    <td>{{ $rm->kode }}</td>
                                    <td>{{ $rm->nama }}</td>
                                    <td>{{ $rm->nobatch }}</td>
                                    <td>{{ $rm->nopallet }}</td>
                                    <td>{{ $rm->statpallet }}</td>
                                    @php
                                        $sats1 = floor($rm->keluar / ($rm->max1 * $rm->max2));
                                        $sisa = $rm->keluar - $sats1 * $rm->max1 * $rm->max2;
                                        $sats2 = floor($sisa / $rm->max2);
                                        $sats3 = $sisa - $sats2 * $rm->max2;
                                    @endphp
                                    <td>{{ $sats1 . ' ' . $rm->sat1 }}</td>
                                    <td>{{ $sats2 . ' ' . $rm->sat2 }}</td>
                                    <td>{{ $sats3 . ' ' . $rm->sat3 }}</td>
                                    <td>{{ $rm->tanggal }}</td>
                                    {{-- <td>{{ $rm->adm }}</td> --}}
                                    <td>{{ $rm->cat }}</td>
                                    <td>
                                        <a href="barang-keluar/show/{{ $rm->id }}" class="px-3 text-warning">
                                            <i class="uil uil-eye font-size-18"></i>
                                        </a>

                                        <a href="barang-keluar/edit/{{ $rm->id }}" class="px-3 text-primary">
                                            <i class="uil uil-pen font-size-18"></i>
                                        </a>

                                        {{-- <a href="masterbarang/delete/{{ $m->id }}" class="px-3 text-danger">
                                        <i class="uil uil-trash-alt font-size-18"></i>
                                    </a> --}}
                                        <a onclick="hapus({{ $rm->id }})" data-bs-toggle="modal"
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
    {{-- <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable({
                responsive: true,
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
                    },
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
                dom: '<"d-flex justify-content-between"<"mt-3" B><"me-2 mb-1"f>><"table-responsive"<t>><"d-flex justify-content-between"<"mt-2" l><ip>>',
            });
        });

        function hapus(id) {
            var id = id;
            var str = '<a href="barang-keluar/delete/' + id + '" class="btn btn-md btn-success">Ya, hapus!</a>';
            document.getElementById('buttonhapus').innerHTML = str;
        }

        const myVar = setTimeout(showPage, 1000);

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("myDiv").style.display = "block";
        }
    </script>
@endsection
