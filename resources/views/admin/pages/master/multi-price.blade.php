@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Harga Multi')
@section('menu_title', 'Harga Multi')

@section('HTML_Main')
    @livewire('master.multi.multi-price-table')
    @livewire('master.multi.delete-multi-price-modal')
    @livewire('master.multi.edit-multi-price-modal')
    @livewire('master.multi.create-multi-price-modal')

    @livewire('master.multi.create-qty-conv-modal')
    @livewire('master.multi.edit-qty-conv-modal')
    @livewire('master.multi.delete-qty-conv-modal')

@endsection

@section('page_css')
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
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
@section('page_script')
    <!-- form mask -->
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#item-select').select2({
                width: '100%'
            });
        });
        $('#item-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('itemSelectChange', selectedValue)
        });


    </script>
@endsection
