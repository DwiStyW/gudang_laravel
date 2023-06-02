@extends('layouts.master')
@section('title')
    @lang('translation.Golongan')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Master
        @endslot
        @slot('title')
            Golongan
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-success" href="master-golongan/add"> Create Master Golongan</a>
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
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($mastergolongan as $m)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $m->kdgol }}</td>
                                    <td>{{ $m->namagol }}</td>
                                    <td>
                                        <a href="master-golongan/show/{{ $m->id }}" class="px-3 text-warning">
                                            <i class="uil uil-eye font-size-18"></i>
                                        </a>

                                        <a href="master-golongan/edit/{{ $m->id }}" class="px-3 text-primary">
                                            <i class="uil uil-pen font-size-18"></i>
                                        </a>

                                        <a href="master-golongan/delete/{{ $m->id }}" class="px-3 text-danger">
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
    </script>
@endsection
