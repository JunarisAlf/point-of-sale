@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Daftar Penjualan Online')
@section('menu_title', 'Daftar Penjualan Online')

@section('HTML_Main')
   @livewire('trx.sell-online-list.sell-list-table')
   @livewire('trx.sell-online-list.sell-detail-modal')
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{asset('mania/libs/flatpickr/flatpickr.min.css')}}">
@endsection
@section('page_script')
    <script src="{{asset('mania/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        const dateRange = flatpickr('#datepicker-range', {
            mode: "range",
            dateFormat: "d-m-Y",
            defaultDate: new Date(),
            onChange: function(selectedDates, dateStr, instance) {
                Livewire.emit('dateRangeChange', dateStr);
            }
        });
    </script>
@endsection
