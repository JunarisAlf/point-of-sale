@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Data Pelanggan')
@section('menu_title', 'Pelanggan')

@section('HTML_Main')
    @livewire('master.customer.customer-table')
    @livewire('master.customer.customer-create-modal')
    @livewire('master.customer.customer-edit-modal')
    @livewire('master.customer.customer-delete-modal')
@endsection

@section('page_css')
    <script src="//unpkg.com/alpinejs" defer></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
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
