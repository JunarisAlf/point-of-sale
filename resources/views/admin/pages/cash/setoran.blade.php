@extends('admin.layout.APP_PANEL')
@section('page_title', 'Cash | Daftar Setoran')
@section('menu_title', 'Daftar Setoran')

@section('HTML_Main')
   @livewire('cash.setoran.setoran-table', ['user' => $user])
   @livewire('cash.setoran.delete-setoran-modal')
   @livewire('cash.setoran.edit-setoran-modal')

@endsection
@section('page_css')
    <link rel="stylesheet" href="{{asset('mania/libs/flatpickr/flatpickr.min.css')}}">
@endsection

@section('page_script')
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
    <script src="{{asset('mania/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/xlsx.full.min.js')}}"></script>
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
