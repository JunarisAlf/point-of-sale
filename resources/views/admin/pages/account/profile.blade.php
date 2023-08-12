@extends('admin.layout.APP_PANEL')
@section('page_title', 'Profile')
@section('menu_title', 'Akun Profile')

@section('HTML_Main')
   @livewire('account.profile.form', ['user' => $user])
@endsection