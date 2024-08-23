@extends('admin.layout.APP_PANEL')
@section('page_title', 'MASTER | Data Barang')
@section('menu_title', 'Barang')

@section('HTML_Main')
    @livewire('master.supplier.supplier-table')
    @livewire('master.supplier.create-supplier-modal')
    @livewire('master.supplier.delete-supplier-modal')
    @livewire('master.supplier.edit-supplier-modal')
@endsection

@section('page_css')
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
