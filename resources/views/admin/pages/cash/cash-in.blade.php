@extends('admin.layout.APP_PANEL')
@section('page_title', 'Cash | Uang Masuk')
@section('menu_title', 'Uang Masuk')

@section('HTML_Main')
   @livewire('cash.cash-in.cash-table', ['user' => $user])
   @livewire('cash.cash-in.cash-modal')
   @livewire('cash.cash-in.cash-setor-modal')

@endsection

@section('page_css')
@endsection
@section('page_script')
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
@endsection
