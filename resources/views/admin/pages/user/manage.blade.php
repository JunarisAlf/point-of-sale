@extends('admin.layout.APP_PANEL')
@section('page_title', 'Pengguna dan Hak Akses')
@section('menu_title', 'Pengguna dan Hak Akses')

@section('HTML_Main')
   @livewire('user.user-table')
   @livewire('user.create-user-modal')
   @livewire('user.delete-user-modal')
   @livewire('user.edit-user-modal')



@endsection

@section('page_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
@endsection

@section('page_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
@endsection