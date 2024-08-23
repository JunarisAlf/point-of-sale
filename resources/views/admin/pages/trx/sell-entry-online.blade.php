@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Tambah Penjualan Online')
@section('menu_title', 'Tambah Penjualan Online')

@section('HTML_Main')
    @livewire('trx.sell-entry-online.meta-info', ['user' => $user])
    @livewire('trx.sell-entry-online.entry-item')
    @livewire('trx.sell-entry-online.entry-table')
    @livewire('trx.sell-entry-online.confirm-modal')
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
        Livewire.on('refreshPage', function (url) {
            setTimeout(function () {
                location.reload();
            }, 200);
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
                placeholder: 'Input Barcode atau Nama Barang',
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
        })

    </script>
@endsection
