@extends('admin.layout.APP_PANEL')
@section('page_title', 'Ubah Password')
@section('menu_title', 'Ubah Password')

@section('HTML_Main')
   @livewire('account.change-password', ['user' => $user])
@endsection