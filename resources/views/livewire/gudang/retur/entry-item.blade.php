<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 ">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body">
                <div class="card-body flex flex-row gap-4 grid grid-cols-1 md:grid-cols-12">

                    <div class="col-span-1  md:col-span-8 items-center ">
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

                    <div class="mb-4 col-span-1  md:col-span-2">
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


                    <div class="col-span-1 sm:col-span-2 items-center ">
                        <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Satuan</label>
                        <select class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="qtyAlias_id">
                            <option selected value="">-</option>
                            @foreach ($qtyAliases  as $alias)
                                <option value={{$alias->id}}>{{$alias->name}}</option>
                            @endforeach
                        </select>
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
            priceMask.addEventListener('input', function(){
                Livewire.emit('priceChange', priceImaskObj.unmaskedValue)
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
                TotalPriceImaskObj.unmaskedValue = '' + @this.total_price;
            })
            totalPriceMask.addEventListener('input', function(){
                Livewire.emit('totalPriceChange', TotalPriceImaskObj.unmaskedValue)
            })

            window.addEventListener('itemSubmited', event => {
                priceImaskObj.unmaskedValue = '';
                TotalPriceImaskObj.unmaskedValue = '';
            })

        })
    </script>
</div>
