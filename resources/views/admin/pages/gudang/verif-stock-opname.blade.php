@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Stock Opname')
@section('menu_title', 'Stock Opname')

@section('HTML_Main')
    @livewire('gudang.verif-opname.date', ['user' => $user])
    @livewire('gudang.verif-opname.detail')
@endsection

@section('page_css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
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
@section('page_script')

@endsection
