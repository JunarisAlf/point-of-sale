@extends('admin.layout.APP_PANEL')
@section('page_title', 'Cash | Uang Masuk dan Keluar')
@section('menu_title', 'Uang Masuk dan Keluar')

@section('HTML_Main')
   @livewire('cash.in-out.cash-table')
   @livewire('cash.in-out.cash-modal')
   @livewire('cash.in-out.cash-setor-modal')

@endsection

@section('page_css')
@endsection
@section('page_script')
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
@endsection