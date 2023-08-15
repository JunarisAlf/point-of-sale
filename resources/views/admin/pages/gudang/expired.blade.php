@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Expired Barang')
@section('menu_title', 'Eexpired Barang')

@section('HTML_Main')
    @livewire('gudang.expired.expired-table', ['user' => $user])
    {{-- @livewire('gudang.stock.create-stock-modal') --}}
    {{-- @livewire('gudang.stock.delete-stock-modal') --}}
   {{-- @livewire('gudang.stock.edit-stock-modal') --}}
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
