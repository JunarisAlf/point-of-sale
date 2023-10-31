@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Daftar Transfer Stok Barang')
@section('menu_title', 'Daftar Transfer Stok Barang')

@section('HTML_Main')
    @livewire('gudang.transfer-list.transfer-item-table', ['user' => $user])
    @livewire('gudang.transfer-list.confirm-modal')
    @livewire('gudang.transfer-list.reject-modal')

@endsection

@section('page_css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <script src="//unpkg.com/alpinejs" defer></script>
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
