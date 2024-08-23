@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Data Barang')
@section('menu_title', 'Barang')

@section('HTML_Main')
    @livewire('master.item.item-table')
    @livewire('master.item.delete-item-modal')
    @livewire('master.item.edit-item-modal')
    @livewire('master.item.create-item-modal')
@endsection

@section('page_css')
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
    <script type="text/javascript" src="{{asset('js/xlsx.full.min.js')}}"></script>
    <script src="{{asset('js/alphine.js')}}" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('opt', () => ({
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
                    let val = this.imaskObj.unmaskedValue
                    console.log(val);
                    Livewire.emit(event, val)
                },
                updateVal(val){
                    console.log('updated val',val)
                    this.imaskObj.unmaskedValue = '' + val;
                },
                inputTimeOut: null,

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
            Alpine.data('barcode', () => ({
                initBarcode(element, code){
                    JsBarcode(element, code, {format: 'CODE128', height:20});
                }
            }))

        })


    </script>
@endsection
@section('page_script')
    <script src="{{asset('js/jsbarcode.js')}}" ></script>
    <script>JsBarcode(".barcode").init();</script>
    <!-- form mask -->
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#category-select').select2({
                width: '100%'
            });
        });
        $('#category-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('categoryFilterChange', selectedValue)
        });

        // create
        $(document).ready(function() {
            $('#category-select-create').select2({
                width: '100%'
            });
        });
        $('#category-select-create').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('categoryChange', selectedValue)
        });

        // Update
        $(document).ready(function() {
            $('#category-select-edit').select2({
                width: '100%'
            });
        });
        $('#category-select-edit').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('categoryChange', selectedValue)
        });
        window.addEventListener('changeCategoryVal', event => {
            $('#category-select-edit').val(event.detail.category_id).trigger('change');
        })

    </script>
@endsection
