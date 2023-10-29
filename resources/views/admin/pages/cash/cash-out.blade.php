@extends('admin.layout.APP_PANEL')
@section('page_title', 'Cash | Uang Keluar')
@section('menu_title', 'Uang Keluar')

@section('HTML_Main')
   @livewire('cash.cash-out.cash-table', ['user' => $user])
   @livewire('cash.cash-out.cash-modal')
   @livewire('cash.cash-out.cash-setor-modal')

@endsection

@section('page_css')
@endsection
@section('page_script')
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
@endsection
