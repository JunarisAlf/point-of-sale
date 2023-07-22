@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Stock Opname')
@section('menu_title', 'Stock Opname')

@section('HTML_Main')
    @livewire('gudang.opname.date')
    @livewire('gudang.opname.opname-table')
    @livewire('gudang.opname.opname-done')
    @livewire('gudang.opname.opname-modal')

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
@section('page_script')
    <!-- form mask -->
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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