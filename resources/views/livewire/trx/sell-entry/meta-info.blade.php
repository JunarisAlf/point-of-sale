<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-header border-b border-gray-50 p-5 dark:border-zinc-600 flex flex-col">
                <div class="flex flex-row justify-between">
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total (Rp.)</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Rp. {{number_format($grand_price, 0, ',', '.')}}</h5>
                </div>
                <div class="flex flex-row justify-between">
                    <h6 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">Sub Total</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">
                        Rp. {{number_format($sub_total, 0, ',', '.')}}
                    </h5>
                </div>
                <div class="flex flex-row justify-between">
                    <h6 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">Diskon</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">
                        - Rp. {{number_format($grand_discount, 0, ',', '.')}}
                    </h5>
                </div>
               
            </div>
            <div class="card-body  flex flex-row gap-4 grid grid-cols-2">
                <div class="col-span-2  items-center ">
                    <label for="category-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Pelanggan</label>
                    <div class="rounded @error('customer_id') border-red-500 border-[0.5px] @enderror" >
                        <div wire:ignore>
                        <select  class="" data-trigger name="supplier_id" placeholder="This is a search placeholder" id="customer-select" wire:model="customer_id"> 
                            <option value='' selected>UMUM</option>
                            @foreach ($customerSelect as $customer)
                                <option value="{{$customer->id}}" selected>{{$customer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    
                    @error('customer_id')
                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                    @enderror
                </div>

               

            </div>
        </div>
     </div>
</div>
