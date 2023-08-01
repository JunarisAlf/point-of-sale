@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Daftar Hutang')
@section('menu_title', 'Daftar Hutang')

@section('HTML_Main')
   @livewire('trx.debt-list.debt-list-table')
   @livewire('trx.debt-list.mark-paid-modal')
@endsection
