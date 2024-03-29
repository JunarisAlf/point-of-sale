<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 ">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body p-0">
                <div class="card-body flex flex-row gap-4 grid grid-cols-1 md:grid-cols-12">
                    <div class="col-span-12 items-center ">
                        <label for="category-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Barang</label>
                        <div class="rounded @error('item_id') border-red-500 border-[0.5px] @enderror" >
                            <div wire:ignore>
                                <select  data-trigger name="item_id"  id="item-select" wire:model="item_id">
                                    {{-- <option selected>Pilih Barang</option> --}}
                                    {{-- @foreach ($items as $item)
                                        <option  value="{{$item->id}}">{{$item->barcode}} - {{$item->name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        @error('item_id')
                            <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                        @enderror
                    </div>

                 </div>
                {{-- <div class="">
                    <a wire:click="submit" href="javascript: void(0);" class="btn border-transparent bg-green-500 block text-center text-white shadow shadow-green-300 dark:shadow-zinc-600">Tambahkan</a>
                </div> --}}
            </div>
       </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            // const discMask = document.getElementById('discount_mask');
            // let discMaskObj = new IMask(discMask,
            //     {
            //         mask: 'Rp.  num',
            //         blocks: {
            //             num: {
            //                 mask: Number,
            //                 thousandsSeparator: '.',
            //             }
            //         }
            //     });
            // window.addEventListener('discount-updated', event => {
            //     discMaskObj.unmaskedValue = '' + @this.discount;
            // })
            // discMask.addEventListener('input', function(){
            //     Livewire.emit('discountChange', discMaskObj.unmaskedValue)
            // })


            // const priceMask = document.getElementById('price_mask');
            // let priceImaskObj = new IMask(priceMask,
            //     {
            //         mask: 'Rp.  num',
            //         blocks: {
            //             num: {
            //                 mask: Number,
            //                 thousandsSeparator: '.',
            //             }
            //         }
            //     });
            // window.addEventListener('price-updated', event => {
            //     priceImaskObj.unmaskedValue = '' + @this.price;
            // })

            // const totalPriceMask = document.getElementById('total_price_mask');
            // let TotalPriceImaskObj = new IMask(totalPriceMask,
            //     {
            //         mask: 'Rp.  num',
            //         blocks: {
            //             num: {
            //                 mask: Number,
            //                 thousandsSeparator: '.',
            //             }
            //         }
            //     });
            // window.addEventListener('total_price-updated', event => {
            //     console.log(@this.total_price)
            //     TotalPriceImaskObj.unmaskedValue = '' + @this.total_price;
            // })

            window.addEventListener('itemSubmited', event => {
                priceImaskObj.unmaskedValue = '';
                TotalPriceImaskObj.unmaskedValue = '';
            })

        })
    </script>
</div>
