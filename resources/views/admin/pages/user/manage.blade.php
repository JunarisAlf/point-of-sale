@extends('admin.layout.APP_PANEL')
@section('page_title', 'Pengguna dan Hak Akses')
@section('menu_title', 'Pengguna dan Hak Akses')

@section('HTML_Main')
   @livewire('user.user-table')
   @livewire('user.create-user-modal')
   @livewire('user.delete-user-modal')
   @livewire('user.edit-user-modal')



@endsection

