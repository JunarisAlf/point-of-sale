@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Stock Opname')
@section('menu_title', 'Stock Opname')

@section('HTML_Main')
    @livewire('gudang.verif-opname.date', ['user' => $user])
    @livewire('gudang.verif-opname.detail')
@endsection

@section('page_css')
    {{-- <link href="{{asset('css/select2.css')}}" rel="stylesheet" /> --}}
    <script src="{{asset('js/alphine.js')}}" defer></script>
    <script type="text/javascript" src="{{asset('js/xlsx.full.min.js')}}"></script>
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
