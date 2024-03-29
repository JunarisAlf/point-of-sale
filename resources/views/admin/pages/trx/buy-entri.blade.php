@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Entry Pembelian')
@section('menu_title', 'Entry Pembelian')

@section('HTML_Main')
    @livewire('trx.buy-entry.entry')
    @livewire('trx.buy-entry.entry-item')
    @livewire('trx.buy-entry.entry-table')

@endsection

@section('page_css')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('opt', () => ({
                init(){
                    window.addEventListener('itemSubmited', event => {
                        this.updateVal('');
                    })
                    window.addEventListener('totalPriceUpdated', event => {
                        this.updateVal(event.detail.totalPrice);
                    })
                },
                test: 'fsfs',
                imaskOpt: {
                    mask: 'Rp.  num',
                    blocks: {
                        num: {
                            mask: Number,
                            thousandsSeparator: '.',
                        }
                    }
                },
                imaskObj: '',
                handleChange(event){
                    let val = this.imaskObj.unmaskedValue;
                    Livewire.emit(event, val)
                },
                updateVal(val){
                    console.log('updated val',val)
                    this.imaskObj.unmaskedValue = '' + val;
                },

            }));
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        //  item
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
            Livewire.emit('itemChange', selectedValue)
        });
        window.addEventListener('itemSubmited', event => {
            $('#item-select').val(null).trigger('change');
        })
        window.addEventListener('cabangSubmited', event => {
            $('#cabang-select').val(null).trigger('change');
        })

        $(document).ready(function() {
            $('#supplier-select').select2({
                width: '100%'
            });
        });
        $('#supplier-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('supplierChange', selectedValue)
        });
    </script>
@endsection
