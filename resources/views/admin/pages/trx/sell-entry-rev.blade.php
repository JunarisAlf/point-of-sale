@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Tambah Penjualan')
@section('menu_title', 'Tambah Penjualan')

@section('HTML_Main')
    @livewire('trx.sell-entry-rev.meta-info')
    @livewire('trx.sell-entry-rev.entry-item')
    @livewire('trx.sell-entry-rev.entry-table')
    @livewire('trx.sell-entry-rev.confirm-modal')
@endsection

@section('page_css')
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
    <script src="{{asset('js/alphine.js')}}" defer></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
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
        Livewire.on('refreshPage', function (url) {
            var newTab = window.open(url, '_blank'); // Open new tab
            if (newTab) {
                newTab.addEventListener('load', function () {
                    // Wait for the new tab to fully load
                    setTimeout(function () {
                        location.reload(); // Refresh the page after new tab loads
                    }, 500); // Adjust the delay as needed
                });
            } else {
                // Handle case where new tab was blocked
                alert('Please allow popups to open the new tab.');
            }
        });

        //  Customer
        $(document).ready(function() {
            $('#customer-select').select2({
                width: '100%'
            });
        });
        $('#customer-select').on('change', function() {
            let selectedValue = $(this).val();
            console.log(selectedValue)
            Livewire.emit('customerChange', selectedValue)
        });

        //  Item
        $(document).ready(function() {
            $('#item-select').select2({
                width: '100%',
                placeholder: 'Input Barcode atau Nama Barang'
                ajax: {
                    url: '/ajax/get-item',
                    dataType: 'json',
                    delay: 100,
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
        });
        $('#item-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('itemChanged', selectedValue)
        });
        window.addEventListener('itemSubmited', event => {
            $('#item-select').val(null).trigger('change');
            $('#item-select').next('.select2-container').find('.select2-search__field').focus();
        })

    </script>
@endsection
