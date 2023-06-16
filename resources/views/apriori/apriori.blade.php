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
            Algoritma
        @endslot
        @slot('title')
            Apriori
        @endslot
    @endcomponent
    {{-- <form> --}}
    <div class="card">
        <div class="card-body">
            <label for="exampleFormControlTextarea1">minimum support 1 itemset</label>
            <input type="number" class="form-control" id="ms1" placeholder="0">
        </div>
        <div class="card-body">
            <label for="exampleFormControlTextarea1">minimum support 2 itemset</label>
            <input type="number" class="form-control" id="ms2" placeholder="0">
        </div>
        <div class="card-body">
            <label for="exampleFormControlTextarea1">minimum confidence</label>
            <input type="number" class="form-control" id="mc1" placeholder="0">
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button onclick="apriori()" class="btn btn-primary">submit</button>
            </div>
        </div>
    </div>
    <div id="tabelasosiasi"></div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/ckeditor/ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>

    <script>
        var datatr = @json($gdform);
        var datatransaksi = @json($transaksi);
        var datamst = @json($master);
        var datanoform = [];
        var arrns1 = [];
        var arr2k = [];
        var arrnf = [];
        var arrms1 = [];
        var arrns2 = [];
        var arrms2 = [];
        var result = [];


        // console.log(datatransaksi[0].kode)

        for (let i = 0; i < datamst.length; i++) {
            findkode = datatransaksi.filter(a => a.kode == datamst[i].kode);
            ns1 = findkode.length / datatr.length * 100;
            arrns1.push({
                kode: datamst[i].kode,
                fm1: findkode.length,
                support1: ns1
            })
            // console.log(datamst[i].kode + ' | ' + findkode.length + ' | ' + ns1 + '%')
        }
        // console.log(arrns1);

        function apriori() {
            var ms1 = document.getElementById('ms1').value;
            var elarrns1 = arrns1.filter(b => b.support1 >= ms1);

            for (let c = 0; c < elarrns1.length; c++) {
                var a = elarrns1[c].kode;
                var b = elarrns1.filter(c => c.kode != a);
                for (let d = 0; d < b.length; d++) {
                    arr2k.push({
                        kode1: a,
                        kode2: b[d].kode
                    })
                }
                // console.log(b)
            }

            for (let f = 0; f < datatr.length; f++) {
                for (let g = 0; g < datatr[f].length; g++) {
                    var kode = datatr[f].map(function(item) {
                        return item['kode'];
                    });

                    arrnf.push({
                        noform: datatr[f][g].noform,
                        kode: kode.join(',')
                    })
                    // console.log(kode.join(','))
                }

            }
            // grupby
            const groupBy = (keys) => (array) =>
                array.reduce((objectsByKeyValue, obj) => {
                    const value = keys.map((key) => obj[key]).join("-");
                    objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
                    return objectsByKeyValue;
                }, {});
            // const arr = filterabsen;
            const gnoform = groupBy(['noform']);

            for (let [noform, value] of Object.entries(gnoform(arrnf))) {
                datanoform.push({
                    noform: noform,
                    kode: value[0].kode
                })
            }

            for (let e = 0; e < arr2k.length; e++) {
                var kode1 = arr2k[e].kode1;
                var kode2 = arr2k[e].kode2;
                let fk2k = datanoform.filter(function(kode) {
                    return kode.kode.includes(kode1) && kode.kode.includes(kode2)
                })
                let fkk1 = datanoform.filter(function(kode) {
                    return kode.kode.includes(kode1)
                })
                ns2 = fk2k.length / datanoform.length * 100;
                nc = fk2k.length / fkk1.length * 100;

                arrms1.push({
                    kode1: kode1,
                    kode2: kode2,
                    fk2k: fk2k.length,
                    fkk1: fkk1.length,
                    ns2: ns2,
                    nc: nc,
                })
            }
            console.log(arrms1);


            var ms2 = document.getElementById('ms2').value;
            var elarrns2 = arrms1.filter(b => b.ns2 >= ms2)
            for (let f = 0; f < elarrns2.length; f++) {
                arrms2.push({
                    kode1: elarrns2[f].kode1,
                    kode2: elarrns2[f].kode2,
                    fk2k: elarrns2[f].fk2k,
                    fkk1: elarrns2[f].fkk1,
                    ns2: elarrns2[f].ns2,
                    nc: elarrns2[f].nc,
                })
            }


            var mc1 = document.getElementById('mc1').value;
            var elarrnc = arrms2.filter(b => b.nc >= mc1);
            var no = 1;
            for (let g = 0; g < elarrnc.length; g++) {
                var ns2 = elarrnc[g].ns2;
                var nc = elarrnc[g].nc;
                // console.log(ns2.toFixed(2))
                result.push({
                    no: no++,
                    kode: elarrnc[g].kode1 + ', ' + elarrnc[g].kode2,
                    fk2k: elarrnc[g].fk2k,
                    fkk1: elarrnc[g].fkk1,
                    ns2: ns2.toFixed(2),
                    nc: nc.toFixed(2),
                    asosiasi: 'Jika terdapat transaksi barang keluar dengan kode <b>' + elarrnc[g].kode1 +
                        '</b> maka juga terdapat transaksi barang keluar dengan kode <b>' + elarrnc[g].kode2 +
                        '</b> yang memiliki nilai support <b>' + ns2.toFixed(2) + '%</b> dan confidence <b>' +
                        nc.toFixed(2) +
                        '%</b> dari semua transaksi yang dianalisis. Oleh sebab itu maka posisi atau tata letak kedua barang dapat diletakkan secara berdampingan.'
                })
            }
            var tabel = '';
            tabel += '  <div class="card">';
            tabel += '  <div class="card-body">';
            tabel +=
                '<table id="tabel" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
            tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
            tabel += '      <tr>';
            tabel += '          <th>No</th>';
            tabel += '          <th>kode</th>';
            tabel += '          <th>frekuensi 2 itemset</th>';
            tabel += '          <th>kemunculan frekuensi</th>';
            tabel += '          <th>support (%)</th>';
            tabel += '          <th>confidence (%)</th>';
            tabel += '          <th style="width:700px !important">aturan asosiasi</th>';
            tabel += '      </tr>';
            tabel += '  </thead>';
            tabel += '</table>';
            tabel += '</div>';
            tabel += '</div>';

            $(document).ready(function() {
                var data = result;
                $('#tabel').DataTable({

                    columns: [{
                            data: 'no',
                        },
                        {
                            data: 'kode',
                        },
                        {
                            data: 'fk2k',
                        },
                        {
                            data: 'fkk1',
                        },
                        {
                            data: 'ns2',
                        },
                        {
                            data: 'nc',
                        },
                        {
                            data: 'asosiasi',
                        },
                    ],
                    data: data,
                    processing: true,
                    deferRender: true,
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
                    responsive: true,
                    columnDefs: [{
                            "responsivePriority": 10001,
                            "targets": 6
                        },
                        {
                            "width": "100%",
                            "targets": 6
                        },
                        {
                            targets: [0, 1, 2, 3, 6],
                            visible: true
                        },
                        {
                            targets: '_all',
                            visible: false
                        }
                    ],
                    dom: 't<"rowt justify-content-between"ip>',
                });
            });
            document.getElementById('tabelasosiasi').innerHTML = tabel;
        }
    </script>
@endsection
