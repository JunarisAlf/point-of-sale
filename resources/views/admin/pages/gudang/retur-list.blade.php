@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Daftar Retur')
@section('menu_title', 'Daftar Retur')

@section('HTML_Main')
   @livewire('gudang.retur-list.delete-retur-modal')
   @livewire('gudang.retur-list.detail-modal')
   @livewire('gudang.retur-list.retur-list-table', ['user' => $user])
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
