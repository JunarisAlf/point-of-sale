@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Expired Barang')
@section('menu_title', 'Eexpired Barang')

@section('HTML_Main')
    @livewire('gudang.expired.expired-table', ['user' => $user])
    @livewire('gudang.expired.expired-edit-modal')
@endsection

@section('page_css')
    {{-- <link href="{{asset('css/select2.css')}}" rel="stylesheet" /> --}}
    <script type="text/javascript" src="{{asset('js/xlsx.full.min.js')}}"></script>
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
