@extends('admin.layout.APP_PANEL')
@section('page_title', 'Grafik | Pembelian')
@section('menu_title', ' Grafik Pembelian')

@section('HTML_Main')
    @livewire('grafik.buy.buy-grafik')
@endsection

@section('page_css')

@endsection

@section('page_script')
    <script src="{{ asset('mania/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- <script src="{{asset('mania/js/pages/apexcharts.init.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}}" />
    <script type="text/javascript">
        $(function() {
            let ranges =  {
                'Minggu Ini': [moment().startOf('week'), moment().endOf('week')],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                '7 Hari Terkahir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
            }
            let start = moment().startOf('week');
            let end = moment().endOf('week');
            // sell
            function cb1(start, end) {
                $('#sell-range span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                Livewire.emit('rangeChange', start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
            }
            $('#sell-range').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: ranges
            }, cb1);
            cb1(start, end);


        });
    </script>
@endsection
