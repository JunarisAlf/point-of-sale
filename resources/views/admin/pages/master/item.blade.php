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
                inputVal: '',
                handleChange(){
                    let val = this.imaskObj.unmaskedValue
                    console.log(val);
                    Livewire.emit('sellingPriceChange', val)
                    // this.imaskObj.updateValue(val)
                }
            }))
        })
    </script>
@endsection
@section('page_script')
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