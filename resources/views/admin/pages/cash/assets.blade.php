@extends('admin.layout.APP_PANEL')
@section('page_title', 'Cash | Informasi Asset')
@section('menu_title', 'Informasi Asset')

@section('HTML_Main')
   @livewire('cash.assets.assets-table')

@endsection

