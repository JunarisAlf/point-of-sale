@extends('admin.layout.APP_PANEL')
@section('page_title', 'Gudang | Atur Barang')
@section('menu_title', 'Atur Barang')

@section('HTML_Main')
    @livewire('gudang.manage.item-table', ['user' => $user])
    @livewire('gudang.manage.item-fill-modal')
    @livewire('gudang.manage.item-edit-modal')
    @livewire('gudang.manage.item-create-modal')
@endsection

@section('page_css')
    <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
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
                    this.imaskObj.unmaskedValue = '' + val;
                    console.log('updated val',val)
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

        })
    </script>
@endsection
@section('page_script')
    <!-- form mask -->
    <script src="{{asset('mania/libs/imask/imask.min.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/select2.js')}}"></script>
    <script>

        //  item
        $(document).ready(function() {
            $('#item-select').select2({
                width: '100%'
            });
        });
        $('#item-select').on('change', function() {
            let selectedValue = $(this).val();
            Livewire.emit('itemChange', selectedValue)
        });
        window.addEventListener('expired-created', event => {
            console.log('expired crated')
            $('#item-select').val(null).trigger('change');
        })



    </script>
@endsection

