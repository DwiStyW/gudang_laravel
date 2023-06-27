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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="transaksi"></div>
                </div>
            </div>

        </div>
        <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script>
        var seriesOptions = [],
            seriesCounter = 0,
            names = ['Transaksi masuk', 'Transaksi keluar'];

        /**
         * Create the chart when all data is loaded
         * @return {undefined}
         */
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
            // console.log(name);
            seriesOptions[i] = {
                name: name,
                data: data
            };

            // As we're loading the data asynchronously, we don't know what order it
            // will arrive. So we keep a counter and create the chart when all the data is loaded.
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
    </script>
@endsection
