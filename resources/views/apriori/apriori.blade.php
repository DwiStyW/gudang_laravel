@extends('layouts.master')
@section('title')
    @lang('Apriori')
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
            <div class="row">
                <div class="col-11">
                    <input type="number" class="form-control" id="ms1" placeholder="0">
                </div>
                <div class="col-1">
                    <button class="btn btn-secondary" onclick="prosesms1()">proses</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <label for="exampleFormControlTextarea1">minimum support 2 itemset</label>
            <div class="row">
                <div class="col-11">
                    <input type="number" class="form-control" id="ms2" placeholder="0">
                </div>
                <div class="col-1">
                    <button class="btn btn-secondary" onclick="prosesms2()">proses</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <label for="exampleFormControlTextarea1">minimum confidence</label>
            <div class="row">
                <div class="col-11">
                    <input type="number" class="form-control" id="mc1" placeholder="0">
                </div>
                <div class="col-1">
                    <button class="btn btn-secondary" onclick="prosesmc()">proses</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button onclick="apriori()" class="btn btn-primary"><i class="uil uil-process"></i> proses asosiasi</button>
                <button onclick="reset()" class="btn btn-danger ms-1"><i class="uil uil-refresh"></i> reset</button>
            </div>
        </div>
    </div>
    <div id="dataset"></div>
    <div id="tabelpola2item"></div>
    <div id="tabelms1"></div>
    <div id="tabelms2"></div>
    <div id="tabelmc"></div>
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
        var datatr = @json($gdform); //data noform
        var datatransaksi = @json($transaksi); //data
        var datamst = @json($master);
        // console.log(datamst)

        var arrns1 = [];

        // console.log(datatransaksi[0].kode)

        for (let i = 0; i < datamst.length; i++) {
            findkode = datatransaksi.filter(a => a.kode == datamst[i].kode);
            ns1 = findkode.length / datatr.length * 100;
            arrns1.push({
                no: i + 1,
                kode: datamst[i].kode,
                nama: datamst[i].nama,
                fm1: findkode.length,
                support1: ns1
            })
        }


        var tabel = '';
        tabel += '  <div class="card">';
        tabel += '  <div class="card-body">';
        tabel += '  <h6>Total transaksi = ' + datatr.length + ' Transaksi</h6>';
        tabel +=
            '<table id="tabeldataset" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
        tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
        tabel += '      <tr>';
        tabel += '          <th>No</th>';
        tabel += '          <th>Barang</th>';
        tabel += '          <th>Frekuensi kemunculan</th>';
        tabel += '          <th>support 1 (%)</th>';
        tabel += '      </tr>';
        tabel += '  </thead>';
        tabel += '</table>';
        tabel += '</div>';
        tabel += '</div>';
        $(document).ready(function() {
            var data = arrns1;
            // console.log(data)
            $('#tabeldataset').DataTable({

                columns: [{
                        data: 'no',
                    },
                    {
                        data: 'nama',
                    },
                    {
                        data: 'fm1',
                    },
                    {
                        data: 'support1',
                    }
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

                dom: 't<"rowt justify-content-between"ip>',
            });

        });
        document.getElementById('dataset').innerHTML = tabel;
        document.getElementById('tabelpola2item').style.display = "none";
        document.getElementById('dataset').style.display = "block";
        document.getElementById('tabelms1').style.display = "none";
        document.getElementById('tabelms2').style.display = "none";
        document.getElementById('tabelmc').style.display = "none";
        document.getElementById('tabelasosiasi').style.display = "none";

        // console.log(arrns1);
        function prosesms1() {
            var ms1 = document.getElementById('ms1').value;
            var elarrns1 = arrns1.filter(b => b.support1 >= ms1);
            var array1 = [];
            var no = 1;
            for (let c = 0; c < elarrns1.length; c++) {
                array1.push({
                    no: no++,
                    kode: elarrns1[c].kode,
                    nama: elarrns1[c].nama,
                    fm1: elarrns1[c].fm1,
                    support1: elarrns1[c].support1
                })

                // console.log(b)
            }
            var tabel = '';
            tabel += '  <div class="card">';
            tabel += '  <div class="card-body">';
            tabel +=
                '<div class="d-flex justify-content-between">' +
                ' <div> <h6>Total transaksi = ' + datatr.length + ' Transaksi</h6>' + '  <h6>Minimun support 1 itemset = ' +
                ms1 + '%</h6></div>' +
                '<div><button class="btn btn-secondary" onclick="pola2item()">pola 2 itemset</button></div>' +
                '</div>';
            tabel +=
                '<table id="tabelprosesms1" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
            tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
            tabel += '      <tr>';
            tabel += '          <th>No</th>';
            tabel += '          <th>Barang</th>';
            tabel += '          <th>Frekuensi kemunculan</th>';
            tabel += '          <th>support 1 (%)</th>';
            tabel += '      </tr>';
            tabel += '  </thead>';
            tabel += '</table>';

            tabel += '</div>';
            tabel += '</div>';

            $(document).ready(function() {
                var data = array1;
                $('#tabelprosesms1').DataTable({

                    columns: [{
                            data: 'no',
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: 'fm1',
                        },
                        {
                            data: 'support1',
                        }
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

                    dom: 't<"rowt justify-content-between"ip>',
                });
            });
            document.getElementById('tabelms1').innerHTML = tabel;
            document.getElementById('tabelms1').style.display = "block";
            document.getElementById('tabelpola2item').style.display = "none";
            document.getElementById('dataset').style.display = "none";
            document.getElementById('tabelms2').style.display = "none";
            document.getElementById('tabelmc').style.display = "none";
            document.getElementById('tabelasosiasi').style.display = "none";

        }

        function pola2item() {
            var ms1 = document.getElementById('ms1').value;
            var elarrns1 = arrns1.filter(b => b.support1 >= ms1);
            var ar1 = [];
            var ar2 = [];
            var ar3 = [];
            var ar4 = [];
            for (let c = 0; c < elarrns1.length; c++) {
                var a = elarrns1[c].kode;
                var nama1 = elarrns1[c].nama;
                var b = elarrns1.filter(c => c.kode != a);
                for (let d = 0; d < b.length; d++) {
                    ar1.push({
                        kode1: a,
                        nama1: nama1,
                        kode2: b[d].kode,
                        nama2: b[d].nama
                    })
                }
                // console.log(ar1)
            }

            for (let f = 0; f < datatr.length; f++) {
                for (let g = 0; g < datatr[f].length; g++) {
                    var kode = datatr[f].map(function(item) {
                        return item['kode'];
                    });

                    ar2.push({
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

            for (let [noform, value] of Object.entries(gnoform(ar2))) {
                ar3.push({
                    noform: noform,
                    kode: value[0].kode
                })
            }
            no = 1;
            for (let e = 0; e < ar1.length; e++) {
                var kode1 = ar1[e].kode1;
                var nama1 = ar1[e].nama1;
                var kode2 = ar1[e].kode2;
                var nama2 = ar1[e].nama2;
                let fk2k = ar3.filter(function(kode) {
                    return kode.kode.includes(kode1) && kode.kode.includes(kode2)
                })
                let fkk1 = ar3.filter(function(kode) {
                    return kode.kode.includes(kode1)
                })
                ns2 = fk2k.length / ar3.length * 100;
                nc = fk2k.length / fkk1.length * 100;

                ar4.push({
                    no: no++,
                    nama: nama1 + ', ' + nama2,
                    fk2k: fk2k.length,
                    fkk1: fkk1.length,
                    ns2: ns2,
                    nc: nc,
                })
            }
            var tabel = '';
            tabel += '  <div class="card">';
            tabel += '  <div class="card-body">';
            tabel += '  <h6>Total transaksi = ' + datatr.length + ' Transaksi</h6>';
            tabel += '  <h6>Minimun support 1 itemset = ' + ms1 + '%</h6>';
            tabel +=
                '<table id="pola2item" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
            tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
            tabel += '      <tr>';
            tabel += '          <th>No</th>';
            tabel += '          <th>Barang</th>';
            tabel += '          <th>Frekuensi kemunculan</th>';
            tabel += '          <th>support 2 (%)</th>';
            tabel += '          <th>confidence (%)</th>';
            tabel += '      </tr>';
            tabel += '  </thead>';
            tabel += '</table>';
            tabel += '</div>';
            tabel += '</div>';

            $(document).ready(function() {
                var data = ar4;
                $('#pola2item').DataTable({

                    columns: [{
                            data: 'no',
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: 'fk2k',
                        },
                        {
                            data: 'ns2',
                        },
                        {
                            data: 'nc',
                        }
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

                    dom: 't<"rowt justify-content-between"ip>',
                });
            });
            document.getElementById('tabelpola2item').innerHTML = tabel;
            document.getElementById('tabelpola2item').style.display = "block";
            document.getElementById('dataset').style.display = "none";
            document.getElementById('tabelms1').style.display = "none";
            document.getElementById('tabelms2').style.display = "none";
            document.getElementById('tabelmc').style.display = "none";
            document.getElementById('tabelasosiasi').style.display = "none";
        }

        function prosesms2() {
            var ms1 = document.getElementById('ms1').value;
            var elarrns1 = arrns1.filter(b => b.support1 >= ms1);
            var ar1 = [];
            var ar2 = [];
            var ar3 = [];
            var ar4 = [];
            for (let c = 0; c < elarrns1.length; c++) {
                var a = elarrns1[c].kode;
                var nama1 = elarrns1[c].nama;
                var b = elarrns1.filter(c => c.kode != a);
                for (let d = 0; d < b.length; d++) {
                    ar1.push({
                        kode1: a,
                        nama1: nama1,
                        kode2: b[d].kode,
                        nama2: b[d].nama
                    })
                }
                // console.log(ar1)
            }

            for (let f = 0; f < datatr.length; f++) {
                for (let g = 0; g < datatr[f].length; g++) {
                    var kode = datatr[f].map(function(item) {
                        return item['kode'];
                    });

                    ar2.push({
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

            for (let [noform, value] of Object.entries(gnoform(ar2))) {
                ar3.push({
                    noform: noform,
                    kode: value[0].kode
                })
            }

            for (let e = 0; e < ar1.length; e++) {
                var kode1 = ar1[e].kode1;
                var nama1 = ar1[e].nama1;
                var kode2 = ar1[e].kode2;
                var nama2 = ar1[e].nama2;
                let fk2k = ar3.filter(function(kode) {
                    return kode.kode.includes(kode1) && kode.kode.includes(kode2)
                })
                let fkk1 = ar3.filter(function(kode) {
                    return kode.kode.includes(kode1)
                })
                ns2 = fk2k.length / ar3.length * 100;
                nc = fk2k.length / fkk1.length * 100;

                ar4.push({
                    kode1: kode1,
                    nama1: nama1,
                    kode2: kode2,
                    nama2: nama2,
                    fk2k: fk2k.length,
                    fkk1: fkk1.length,
                    ns2: ns2,
                    nc: nc,
                })
            }
            // console.log(ar4);

            var ms2 = document.getElementById('ms2').value;
            var elarrns2 = ar4.filter(b => b.ns2 >= ms2)
            var array2 = [];
            var no = 1;
            for (let f = 0; f < elarrns2.length; f++) {
                array2.push({
                    no: no++,
                    kode: elarrns2[f].kode1 + ', ' + elarrns2[f].kode2,
                    nama: elarrns2[f].nama1 + ', ' + elarrns2[f].nama2,
                    fk2k: elarrns2[f].fk2k,
                    ns2: elarrns2[f].ns2,
                })
            }
            // console.log(array2)
            var tabel = '';
            tabel += '  <div class="card">';
            tabel += '  <div class="card-body">';
            tabel += '  <h6>Total transaksi = ' + datatr.length + ' Transaksi</h6>';
            tabel += '  <h6>Minimun support 1 itemset = ' + ms1 + '%</h6>';
            tabel += '  <h6>Minimun support 2 itemset = ' + ms2 + '%</h6>';
            tabel +=
                '<table id="tabelprosesms2" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
            tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
            tabel += '      <tr>';
            tabel += '          <th>No</th>';
            tabel += '          <th>Barang</th>';
            tabel += '          <th>Frekuensi kemunculan</th>';
            tabel += '          <th>support 2 (%)</th>';
            tabel += '      </tr>';
            tabel += '  </thead>';
            tabel += '</table>';
            tabel += '</div>';
            tabel += '</div>';

            $(document).ready(function() {
                var data = array2;
                $('#tabelprosesms2').DataTable({

                    columns: [{
                            data: 'no',
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: 'fk2k',
                        },
                        {
                            data: 'ns2',
                        }
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

                    dom: 't<"rowt justify-content-between"ip>',
                });
            });
            document.getElementById('tabelms2').innerHTML = tabel;
            document.getElementById('dataset').style.display = "none";
            document.getElementById('tabelpola2item').style.display = "none";
            document.getElementById('tabelms1').style.display = "none";
            document.getElementById('tabelms2').style.display = "block";
            document.getElementById('tabelmc').style.display = "none";
            document.getElementById('tabelasosiasi').style.display = "none";
        }

        function prosesmc() {
            var ms1 = document.getElementById('ms1').value;
            var elarrns1 = arrns1.filter(b => b.support1 >= ms1);
            var ar1 = [];
            var ar2 = [];
            var ar3 = [];
            var ar4 = [];
            for (let c = 0; c < elarrns1.length; c++) {
                var a = elarrns1[c].kode;
                var nama1 = elarrns1[c].nama;
                var b = elarrns1.filter(c => c.kode != a);
                for (let d = 0; d < b.length; d++) {
                    ar1.push({
                        kode1: a,
                        nama1: nama1,
                        kode2: b[d].kode,
                        nama2: b[d].nama
                    })
                }
                // console.log(b)
            }

            for (let f = 0; f < datatr.length; f++) {
                for (let g = 0; g < datatr[f].length; g++) {
                    var kode = datatr[f].map(function(item) {
                        return item['kode'];
                    });

                    ar2.push({
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

            for (let [noform, value] of Object.entries(gnoform(ar2))) {
                ar3.push({
                    noform: noform,
                    kode: value[0].kode
                })
            }

            for (let e = 0; e < ar1.length; e++) {
                var kode1 = ar1[e].kode1;
                var nama1 = ar1[e].nama1;
                var kode2 = ar1[e].kode2;
                var nama2 = ar1[e].nama2;
                let fk2k = ar3.filter(function(kode) {
                    return kode.kode.includes(kode1) && kode.kode.includes(kode2)
                })
                let fkk1 = ar3.filter(function(kode) {
                    return kode.kode.includes(kode1)
                })
                ns2 = fk2k.length / ar3.length * 100;
                nc = fk2k.length / fkk1.length * 100;

                ar4.push({
                    kode1: kode1,
                    nama1: nama1,
                    kode2: kode2,
                    nama2: nama2,
                    fk2k: fk2k.length,
                    fkk1: fkk1.length,
                    ns2: ns2,
                    nc: nc,
                })
            }
            // console.log(ar4);

            var ms2 = document.getElementById('ms2').value;
            var elarrns2 = ar4.filter(b => b.ns2 >= ms2)
            var array2 = [];
            var no = 1;
            for (let f = 0; f < elarrns2.length; f++) {
                array2.push({
                    kode1: elarrns2[f].kode1,
                    nama1: elarrns2[f].nama1,
                    kode2: elarrns2[f].kode2,
                    nama2: elarrns2[f].nama2,
                    fk2k: elarrns2[f].fk2k,
                    fkk1: elarrns2[f].fkk1,
                    ns2: elarrns2[f].ns2,
                    nc: elarrns2[f].nc,
                })
            }
            var mc1 = document.getElementById('mc1').value;
            var elarrnc = array2.filter(b => b.nc >= mc1);
            var no = 1;
            var array3 = [];
            for (let g = 0; g < elarrnc.length; g++) {
                var ns2 = elarrnc[g].ns2;
                var nc = elarrnc[g].nc;
                // console.log(ns2.toFixed(2))
                array3.push({
                    no: no++,
                    kode: elarrnc[g].kode1 + ', ' + elarrnc[g].kode2,
                    nama: elarrnc[g].nama1 + ', ' + elarrnc[g].nama2,
                    fk2k: elarrnc[g].fk2k,
                    fkk1: elarrnc[g].fkk1,
                    ns2: ns2,
                    nc: nc,
                })
            }
            // console.log(array3);
            var tabel = '';
            tabel += '  <div class="card">';
            tabel += '  <div class="card-body">';
            tabel += '  <h6>Total transaksi = ' + datatr.length + ' Transaksi</h6>';
            tabel += '  <h6>Minimun support 1 itemset = ' + ms1 + '%</h6>';
            tabel += '  <h6>Minimun support 2 itemset = ' + ms2 + '%</h6>';
            tabel += '  <h6>Minimun confidence = ' + mc1 + '%</h6>';
            tabel +=
                '<table id="tabelprosesmc" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
            tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
            tabel += '      <tr>';
            tabel += '          <th>No</th>';
            tabel += '          <th>Barang</th>';
            tabel += '          <th>Frekuensi kemunculan 2 itemset</th>';
            tabel += '          <th>Frekuensi kemunculan itemset ke-1</th>';
            tabel += '          <th>support 2 itemset(%)</th>';
            tabel += '          <th>confidence (%)</th>';
            tabel += '      </tr>';
            tabel += '  </thead>';
            tabel += '</table>';
            tabel += '</div>';
            tabel += '</div>';

            $(document).ready(function() {
                var data = array3;
                $('#tabelprosesmc').DataTable({

                    columns: [{
                            data: 'no',
                        },
                        {
                            data: 'nama',
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
                        }
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

                    dom: 't<"rowt justify-content-between"ip>',
                });
            });
            document.getElementById('tabelmc').innerHTML = tabel;
            document.getElementById('dataset').style.display = "none";
            document.getElementById('tabelpola2item').style.display = "none";
            document.getElementById('tabelms1').style.display = "none";
            document.getElementById('tabelms2').style.display = "none";
            document.getElementById('tabelmc').style.display = "block";
            document.getElementById('tabelasosiasi').style.display = "none";
        }

        function apriori() {
            var datanoform = [];
            var arr2k = [];
            var arrnf = [];
            var arrms1 = [];
            var arrns2 = [];
            var arrms2 = [];
            var result = [];
            var ms1 = document.getElementById('ms1').value;
            var elarrns1 = arrns1.filter(b => b.support1 >= ms1);

            for (let c = 0; c < elarrns1.length; c++) {
                var a = elarrns1[c].kode;
                var nama1 = elarrns1[c].nama;
                var b = elarrns1.filter(c => c.kode != a);
                for (let d = 0; d < b.length; d++) {
                    arr2k.push({
                        kode1: a,
                        nama1: nama1,
                        kode2: b[d].kode,
                        nama2: b[d].nama
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
                var nama1 = arr2k[e].nama1;
                var kode2 = arr2k[e].kode2;
                var nama2 = arr2k[e].nama2;
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
                    nama1: nama1,
                    kode2: kode2,
                    nama2: nama2,
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
                    nama1: elarrns2[f].nama1,
                    kode2: elarrns2[f].kode2,
                    nama2: elarrns2[f].nama2,
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
                    nama: elarrnc[g].nama1 + ', ' + elarrnc[g].nama2,
                    fk2k: elarrnc[g].fk2k,
                    fkk1: elarrnc[g].fkk1,
                    ns2: ns2.toFixed(2),
                    nc: nc.toFixed(2),
                    asosiasi: 'Jika terdapat transaksi barang keluar <b>' + elarrnc[g].nama1 +
                        '</b> maka juga terdapat transaksi barang keluar <b>' + elarrnc[g].nama2 +
                        '</b> yang memiliki nilai support <b>' + ns2.toFixed(2) + '%</b> dan confidence <b>' +
                        nc.toFixed(2) +
                        '%</b> dari semua transaksi yang dianalisis. Oleh sebab itu maka posisi atau tata letak kedua barang dapat diletakkan secara berdampingan.'
                })
            }
            var tabel = '';
            tabel += '  <div class="card">';
            tabel += '  <div class="card-body">';
            tabel += '  <h6>Total transaksi = ' + datatr.length + ' Transaksi</h6>';
            tabel += '  <h6>Minimun support 1 itemset = ' + ms1 + '%</h6>';
            tabel += '  <h6>Minimun support 2 itemset = ' + ms2 + '%</h6>';
            tabel += '  <h6>Minimun confidence = ' + mc1 + '%</h6>';
            tabel +=
                '<table id="tabel" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
            tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
            tabel += '      <tr>';
            tabel += '          <th>No</th>';
            tabel += '          <th>Barang</th>';
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
                            data: 'nama',
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
            document.getElementById('dataset').style.display = "none";
            document.getElementById('tabelpola2item').style.display = "none";
            document.getElementById('tabelms1').style.display = "none";
            document.getElementById('tabelms2').style.display = "none";
            document.getElementById('tabelmc').style.display = "none";
            document.getElementById('tabelasosiasi').style.display = "block";
        }

        function reset() {
            var tabel = '';
            tabel += '  <div class="card">';
            tabel += '  <div class="card-body">';
            tabel += '  <h6>Total transaksi = ' + datatr.length + ' Transaksi</h6>';
            tabel +=
                '<table id="tabeldataset" class="table table-striped table-bordered display responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">';
            tabel += '  <thead style="background: rgba(91, 115, 232, 0.2);color:rgba(91, 115, 232)">';
            tabel += '      <tr>';
            tabel += '          <th>No</th>';
            tabel += '          <th>Barang</th>';
            tabel += '          <th>Frekuensi kemunculan</th>';
            tabel += '          <th>support 1 (%)</th>';
            tabel += '      </tr>';
            tabel += '  </thead>';
            tabel += '</table>';
            tabel += '</div>';
            tabel += '</div>';
            $(document).ready(function() {
                var data = arrns1;
                // console.log(data)
                $('#tabeldataset').DataTable({

                    columns: [{
                            data: 'no',
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: 'fm1',
                        },
                        {
                            data: 'support1',
                        }
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

                    dom: 't<"rowt justify-content-between"ip>',
                });

            });
            document.getElementById('dataset').innerHTML = tabel;
            document.getElementById('dataset').style.display = "block";
            document.getElementById('tabelms1').style.display = "none";
            document.getElementById('tabelms2').style.display = "none";
            document.getElementById('tabelpola2item').style.display = "none";
            document.getElementById('tabelmc').style.display = "none";
            document.getElementById('tabelasosiasi').style.display = "none";

            document.getElementById('ms1').value = 0;
            document.getElementById('ms2').value = 0;
            document.getElementById('mc1').value = 0;
        }
    </script>
@endsection
