@extends('admin.layout.APP_PANEL')
@section('page_title', 'Login Log')
@section('menu_title', 'Login Log')

@section('HTML_Main')
    @livewire('user.user-log.table')
@endsection

