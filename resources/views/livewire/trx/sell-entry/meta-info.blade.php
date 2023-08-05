<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-header border-b border-gray-50 p-5 dark:border-zinc-600 flex flex-col">
                <div class="flex flex-row justify-between">
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total (Rp.)</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Rp. {{number_format($grand_price, 0, ',', '.')}}</h5>
                </div>
                <div class="flex flex-row justify-between">
                    <h6 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">Diskon</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">
                        - Rp. {{number_format($grand_discount, 0, ',', '.')}}
                    </h5>
                </div>
               
            </div>
            <div class="card-body  flex flex-row gap-4 grid grid-cols-2">
               
                <div class="col-span-2 md:col-span-1 items-center ">
                    <label for="category-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Pelanggan</label>
                    <div wire:ignore>
                        <select  class="" data-trigger name="supplier_id" placeholder="This is a search placeholder" id="customer-select" wire:model="customer_id"> 
                            <option value="" selected>Pilih Pelanggan</option>
                            <option value="umum" selected>Umum</option>
                            <option value="" selected>Pelanggan A</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1  items-center ">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Pembayaran</label>
                    <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="is_paid">
                        <option  selected>Pembayran</option>
                        <option  value="1">Lunas</option>
                        <option  value="0" >Terhutang</option>
                    </select>
                </div>


            </div>
        </div>
     </div>
</div>
