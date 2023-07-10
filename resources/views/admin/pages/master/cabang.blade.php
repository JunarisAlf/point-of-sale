@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Data Cabang')
@section('menu_title', 'Cabang')

@section('HTML_Main')
   @livewire('master.cabang.cabang-table', ['user' => $user])
   @livewire('master.cabang.create-cabang-modal')

@endsection

{{-- @section('page_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
@endsection

@section('page_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
@endsection --}}