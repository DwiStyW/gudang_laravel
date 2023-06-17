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
                @foreach ($master as $m)
                @endforeach
                <div class="card-body">
                    Riwayat Keluar Masuk Kode <b>{{ $m->kode }} {{ $m->nama }}</b><br>
                    Tanggal {{ $start }} sampai {{ $end }}
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
                                <th rowspan="2">No</th>
                                <th rowspan="2">Tgl Form</th>
                                <th rowspan="2">No Form</th>
                                <th rowspan="2">Kode Barang</th>
                                <th rowspan="2">Nama Barang</th>
                                <th colspan="3">Masuk</th>
                                <th colspan="3">Keluar</th>
                                <th colspan="3">Saldo</th>
                                <th rowspan="2">Keterangan</th>
                                <th rowspan="2">Tanggal input</th>
                            </tr>
                            <tr>
                                <th>Sat 1</th>
                                <th>Sat 2</th>
                                <th>Sat 3</th>
                                <th>Sat 1</th>
                                <th>Sat 2</th>
                                <th>Sat 3</th>
                                <th>Sat 1</th>
                                <th>Sat 2</th>
                                <th>Sat 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            <tr>
                                <td>Saldo</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ $sat1 }}</td>
                                <td>{{ $sat2 }}</td>
                                <td>{{ $sat3 }}</td>
                                <td>Saldo Awal</td>
                                <td>{{ $start }}</td>
                            </tr>
                            @foreach ($riwayat as $r)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $r->tglform }}</td>
                                    <td>{{ $r->noform }}</td>
                                    <td>{{ $r->kode }}</td>
                                    <td>{{ $r->nama }}</td>
                                    @php
                                        $satin1 = floor($r->masuk / ($r->max1 * $r->max2));
                                        $sisa = $r->masuk - $satin1 * $r->max1 * $r->max2;
                                        $satin2 = floor($sisa / $r->max2);
                                        $satin3 = $sisa - $satin2 * $r->max2;
                                    @endphp
                                    <td>{{ $satin1 }}</td>
                                    <td>{{ $satin2 }}</td>
                                    <td>{{ $satin3 }}</td>
                                    @php
                                        $satout1 = floor($r->keluar / ($r->max1 * $r->max2));
                                        $sis = $r->keluar - $satout1 * $r->max1 * $r->max2;
                                        $satout2 = floor($sis / $r->max2);
                                        $satout3 = $sis - $satout2 * $r->max2;
                                    @endphp
                                    <td>{{ $satout1 }}</td>
                                    <td>{{ $satout2 }}</td>
                                    <td>{{ $satout3 }}</td>
                                    @php
                                        $saldo_mutasi = $sals + $r->masuk - $r->keluar;
                                        $st1 = floor($saldo_mutasi / ($r->max1 * $r->max2));
                                        $sissa = $saldo_mutasi - $st1 * $r->max1 * $r->max2;
                                        $st2 = floor($sissa / $r->max2);
                                        $st3 = $sissa - $st2 * $r->max2;
                                    @endphp
                                    <td>{{ $st1 }}</td>
                                    <td>{{ $st2 }}</td>
                                    <td>{{ $st3 }}</td>
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

        const myVar = setTimeout(showPage, 1000);

        function showPage() {
            document.getElementById("loader").style.display = "none";
            document.getElementById("myDiv").style.display = "block";
        }
    </script>
@endsection
