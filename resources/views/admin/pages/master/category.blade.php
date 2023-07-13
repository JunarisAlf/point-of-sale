@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Data Kategory')
@section('menu_title', 'Kategory')

@section('HTML_Main')
   @livewire('master.category.category-table')
   @livewire('master.category.create-category-modal')
   @livewire('master.category.delete-category-modal')
   @livewire('master.category.edit-category-modal')
@endsection
