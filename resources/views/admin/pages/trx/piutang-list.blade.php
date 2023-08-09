@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Daftar Piutang')
@section('menu_title', 'Daftar Piutang')

@section('HTML_Main')
   @livewire('trx.piutang-list.piutang-table')
   @livewire('trx.piutang-list.detail-modal')
   @livewire('trx.piutang-list.mark-paid-modal')

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
