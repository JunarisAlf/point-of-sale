@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Tambah Penjualan')
@section('menu_title', 'Tambah Penjualan')

@section('HTML_Main')
    @livewire('trx.sell-entry.meta-info')
    @livewire('trx.sell-entry.entry-item')
    @livewire('trx.sell-entry.entry-table')

@endsection

@section('page_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        
        //  Customer
        $(document).ready(function() {
            $('#customer-select').select2({
                width: '100%'
            });
        });
        $('#customer-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('customerChange', selectedValue)
        });
        window.addEventListener('itemSubmited', event => {
            $('#customer-select').val(null).trigger('change');
        })

        //  Item
        $(document).ready(function() {
            $('#item-select').select2({
                width: '100%'
            });
        });
        $('#item-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('itemChanged', selectedValue)
        });
        window.addEventListener('itemSubmited', event => {
            $('#item-select').val(null).trigger('change');
        })

    </script>
@endsection