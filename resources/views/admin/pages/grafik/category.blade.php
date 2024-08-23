@extends('admin.layout.APP_PANEL')
@section('page_title', 'Grafik | Kategori Barang')
@section('menu_title', ' Grafik Kategori Barang')

@section('HTML_Main')
    @livewire('grafik.category.category-grafik')
@endsection

@section('page_css')

@endsection

@section('page_script')
    <script src="{{ asset('mania/libs/apexcharts/apexcharts.min.js') }}"></script>
    {{-- <script src="{{asset('mania/js/pages/apexcharts.init.js')}}"></script> --}}
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>

@endsection
