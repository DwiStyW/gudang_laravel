@extends('layouts.master')
@section('title')
    @lang('Masuk')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Laporan
        @endslot
        @slot('title')
            Riwayat Keluar Masuk
        @endslot
    @endcomponent
    <div class="row" onload="myFunction()">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    Laporan Saldo Akhir</b><br>
                    Tanggal <b>{{ $start }}</b> sampai <b>{{ $end }}</b>
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
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama</th>
                                <th>Urai</th>
                                <th>Satuan 1</th>
                                <th>Satuan 2</th>
                                <th>Satuan 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $d)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $d['kode'] }}</td>
                                    <td>{{ $d['nama'] }}</td>
                                    <td>Saldo Akhir</td>
                                    <td>{{ $d['saldoakhir1'] }}</td>
                                    <td>{{ $d['saldoakhir2'] }}</td>
                                    <td>{{ $d['saldoakhir3'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
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
                        title: 'Laporan Riwayat Keluar Masuk'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn btn-sm p-2 ms-1 rounded',
                        title: 'Laporan Riwayat Keluar Masuk'
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

        const myVar = setTimeout(showPage, 1000);

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("myDiv").style.display = "block";
        }
    </script>
@endsection