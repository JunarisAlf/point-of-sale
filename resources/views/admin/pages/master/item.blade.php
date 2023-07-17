@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Data Barang')
@section('menu_title', 'Barang')

@section('HTML_Main')
    @livewire('master.item.item-table')
    @livewire('master.item.create-item-modal')
    @livewire('master.item.delete-item-modal')
    @livewire('master.item.edit-item-modal')
@endsection

@section('page_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>
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
                    JsBarcode(element)
                        .options({font: "OCR-B"}) // Will affect all barcodes
                        .EAN13(code, {fontSize: 18, textMargin: 0})
                        .blank(20) // Create space between the barcodes
                        .render();
                }                
            }))
            
        })
    </script>
@endsection
@section('page_script')
    <script src="{{asset('js/cdn.jsdelivr.net_npm_jsbarcode@3.11.0_dist_barcodes_JsBarcode.ean-upc.min.js')}}" ></script>
    <script>JsBarcode(".barcode").init();</script>
    <!-- form mask -->
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE=" crossorigin="anonymous"></script>
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
      
    </script>
@endsection