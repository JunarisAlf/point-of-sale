<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 ">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body">
                <div class="card-body flex flex-row gap-4 grid grid-cols-1 md:grid-cols-12">
    
                    <div class="col-span-1  md:col-span-3 items-center ">
                        <label for="category-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Barang</label>
                        <div class="rounded @error('item_id') border-red-500 border-[0.5px] @enderror" >
                            <div wire:ignore>
                                <select  class="" data-trigger name="item_id" placeholder="This is a search placeholder" id="item-select" wire:model="item_id"> 
                                    <option selected>Pilih Barang</option>
                                    @foreach ($items as $item)
                                        <option  value="{{$item->id}}">{{$item->barcode}} - {{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('item_id')
                            <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-1  md:col-span-1">
                        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Jumlah</label>
                        <div class="relative">
                            <input name="quantity" class="w-full rounded border-gray-100 @error('quantity') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="quantity" type="number" min="1">
                            @error('quantity')
                                <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                            @enderror
                        </div>
                        @error('quantity')
                            <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-1 md:col-span-2">
                        <div class="mb-3">
                            <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Diskon (Rp.)</label>
                            <div class="relative rounded">
                                <input name="discount" type="text" wire:ignore id="discount_mask"
                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100 "  >
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 col-span-1 md:col-span-2">
                        <label for="example-text-input"
                            class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Diskon (-%)</label>
                        <div class="relative">
                            <input name="percentage"
                                class="@error('percentage') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                                wire:model="percentage" type="number" step="any">
                            @error('percentage')
                                <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                            @enderror
                        </div>
                        @error('percentage')
                            <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 col-span-1 md:col-span-2">
                        <div class="mb-3 opacity-70 pointer-events-none">
                            <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Harga Satuan</label>
                            <div class="relative rounded">
                                <input name="total_price" type="text" wire:ignore id="price_mask"
                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100 "  >
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 col-span-1 md:col-span-2">
                        <div class="mb-3 opacity-70 pointer-events-none">
                            <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Harga Total</label>
                            <div class="relative rounded">
                                <input name="total_price" type="text" wire:ignore id="total_price_mask"
                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100 ">
                            </div>
                        </div>
                    </div>

                 </div>
                <div class="">
                    <a wire:click="submit" href="javascript: void(0);" class="btn border-transparent bg-green-500 block text-center text-white shadow shadow-green-300 dark:shadow-zinc-600">Tambahkan</a>
                </div>    
            </div>
       </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            const discMask = document.getElementById('discount_mask');
            let discMaskObj = new IMask(discMask, 
                {
                    mask: 'Rp.  num',
                    blocks: {
                        num: {
                            mask: Number,
                            thousandsSeparator: '.',
                        }
                    }
                });
            window.addEventListener('discount-updated', event => {
                discMaskObj.unmaskedValue = '' + @this.discount;
            })
            discMask.addEventListener('input', function(){
                Livewire.emit('discountChange', discMaskObj.unmaskedValue)
            })


            const priceMask = document.getElementById('price_mask');
            let priceImaskObj = new IMask(priceMask, 
                {
                    mask: 'Rp.  num',
                    blocks: {
                        num: {
                            mask: Number,
                            thousandsSeparator: '.',
                        }
                    }
                });
            window.addEventListener('price-updated', event => {
                priceImaskObj.unmaskedValue = '' + @this.price;
            })

            const totalPriceMask = document.getElementById('total_price_mask');
            let TotalPriceImaskObj = new IMask(totalPriceMask, 
                {
                    mask: 'Rp.  num',
                    blocks: {
                        num: {
                            mask: Number,
                            thousandsSeparator: '.',
                        }
                    }
                });
            window.addEventListener('total_price-updated', event => {
                console.log(@this.total_price)
                TotalPriceImaskObj.unmaskedValue = '' + @this.total_price;
            })

            window.addEventListener('itemSubmited', event => {
                priceImaskObj.unmaskedValue = '';
                TotalPriceImaskObj.unmaskedValue = '';
            })
           
        })
    </script>
</div>