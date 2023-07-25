@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Daftar Pembelian')
@section('menu_title', 'Daftar Pembelian')

@section('HTML_Main')
   @livewire('trx.buy-list.buy-list-table')
   @livewire('trx.buy-list.mark-paid-modal')
   @livewire('trx.buy-list.mark-arrived-modal')

@endsection
