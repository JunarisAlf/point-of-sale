@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Daftar Transfer Stok Barang')
@section('menu_title', 'Daftar Transfer Stok Barang')

@section('HTML_Main')
    @livewire('gudang.transfer-list.transfer-item-table', ['user' => $user])
    @livewire('gudang.transfer-list.confirm-modal')
    @livewire('gudang.transfer-list.reject-modal')

@endsection

@section('page_css')
    {{-- <link href="{{asset('css/select2.css')}}" rel="stylesheet" /> --}}
    <script src="{{asset('js/alphine.js')}}" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('overscroll', () => ({
                enableHorizontalScroll(element) {
                    function handleHorizontalScroll(event) {
                        event.preventDefault();
                        const scrollAmount = event.deltaY || event.deltaX;
                        // Adjust the scroll speed as desired
                        event.currentTarget.scrollLeft += scrollAmount/2;
                    }
                    if (element.scrollWidth > element.clientWidth) {
                        element.addEventListener('wheel', handleHorizontalScroll, { passive: false });
                    }
                },
                disableHorizontalScroll(element) {
                    element.removeEventListener('wheel', this.handleHorizontalScroll);
                },

            }));

        })
    </script>
@endsection
