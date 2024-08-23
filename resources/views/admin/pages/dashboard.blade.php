@extends('admin.layout.APP_PANEL')
@section('page_title', 'HOME')
@section('menu_title', 'Dashboard')

@section('HTML_Main')
    @livewire('dashboard.cash-count')
    @livewire('dashboard.general-count')
    @livewire('dashboard.money-count')
    {{-- @livewire('dashboard.table') --}}

@endsection

@section('page_css')

@endsection

@section('page_script')
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/moment.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/daterangepicker.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}}" />
    <script type="text/javascript">
        $(function() {
            let ranges =  {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
            let start = moment();
            let end = moment();
            // sell
            function cb1(start, end) {
                $('#sell-range span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                Livewire.emit('sellDateRangeChange', start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
            }
            $('#sell-range').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: ranges
            }, cb1);
            cb1(start, end);


            // cash out
            function cb2(start, end) {
                $('#cash-out-range span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
                Livewire.emit('cashOutRangeChange', start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
            }
            $('#cash-out-range').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: ranges
            }, cb2);
            cb2(start, end);

        });
    </script>
@endsection
