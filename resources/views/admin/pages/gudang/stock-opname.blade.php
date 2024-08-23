@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Stock Opname')
@section('menu_title', 'Stock Opname')

@section('HTML_Main')
    @livewire('gudang.opname.date', ['user' => $user])
    @livewire('gudang.opname.opname-table', ['user' => $user])
    @livewire('gudang.opname.opname-done', ['user' => $user])
    @livewire('gudang.opname.opname-modal')

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
    <!-- form mask -->
    {{-- <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script>
        // create
        $(document).ready(function() {
            $('#category-select').select2({
                width: '100%'
            });
        });
        $('#category-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('categoryChange', selectedValue)
        });
    </script> --}}
@endsection
