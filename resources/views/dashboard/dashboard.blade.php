@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            Gudang
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        @if (Auth::user()->role == 'admin')
            <div class="col-lg-4">
                <div class="card border-primary border-top">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Master Jenis</h4>
                                <h5>{{ count($masterjenis) }}</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="uil uil-archive font-size-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-primary border-top">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Master Golongan</h4>
                                <h5>{{ count($mastergolongan) }}</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="uil uil-archive font-size-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-primary border-top">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Master Barang</h4>
                                <h5>{{ count($masterbarang) }}</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="uil uil-archive font-size-24"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="transaksi"></div>
                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="column-trans"></div>
                </div>
            </div>

        </div>
        <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script>
        let datak = @json($datatrkeluar);
        datak.sort((a, b) => {
            return b.y - a.y;
        })
        var datakeluar = datak.slice(0, 10);
        // var datam = @json($datatrmasuk);
        // var datamasuk = []
        // for (let i = 0; i < datakeluar.length; i++) {
        //     filtermasuk = datam.filter(a => a.kode == datakeluar[i].kode)
        //     datamasuk.push({
        //         'kode': filtermasuk[0].kode,
        //         'totaltransmasuk': filtermasuk[0].totaltransmasuk
        //     })
        // }

        var seriesOptions = [],
            seriesCounter = 0,
            names = ['Transaksi masuk', 'Transaksi keluar'];

        function createChart() {

            Highcharts.stockChart('transaksi', {

                chart: {
                    height: 400
                },

                title: {
                    text: 'Transaksi'
                },
                rangeSelector: {
                    selected: 4
                },
                yAxis: {
                    plotLines: [{
                        width: 2,
                        color: 'silver'
                    }]
                },
                tooltip: {
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
                    split: true
                },

                series: seriesOptions
            });

        }

        function success(data) {
            var name = 'Transaksi ' + this.url.match(/(masuk|keluar)/)[0];
            var i = names.indexOf(name);
            seriesOptions[i] = {
                name: name,
                data: data
            };
            seriesCounter += 1;

            if (seriesCounter === names.length) {
                createChart();
            }
        }

        Highcharts.getJSON(
            'http://127.0.0.1:8080/api/masuk',
            success
        );
        Highcharts.getJSON(
            'http://127.0.0.1:8080/api/keluar',
            success
        );

        Highcharts.chart('column-trans', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: 'Grafik total transaksi keluar perbarang'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Transaksi'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
            },
            series: [{
                name: 'Transaksi',
                colorByPoint: true,
                data: datakeluar
            }]
        });
    </script>
@endsection
