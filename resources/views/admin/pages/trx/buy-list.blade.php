@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Daftar Pembelian')
@section('menu_title', 'Daftar Pembelian')

@section('HTML_Main')
   @livewire('trx.buy-list.mark-paid-modal')
   @livewire('trx.buy-list.mark-arrived-modal')
   @livewire('trx.buy-list.detail-modal')
   @livewire('trx.buy-list.expired-modal')

   @livewire('trx.buy-list.buy-list-table', ['user' => $user])
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
