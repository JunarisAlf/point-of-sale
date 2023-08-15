@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Daftar Penjualan')
@section('menu_title', 'Daftar Penjualan')

@section('HTML_Main')
   @livewire('trx.sell-list.sell-list-table', ['user' => $user])
   @livewire('trx.sell-list.sell-detail-modal')
@endsection

@section('page_css')
    <link rel="stylesheet" href="{{asset('mania/libs/flatpickr/flatpickr.min.css')}}">
@endsection
@section('page_script')
    <script src="{{asset('mania/libs/flatpickr/flatpickr.min.js')}}"></script>
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
