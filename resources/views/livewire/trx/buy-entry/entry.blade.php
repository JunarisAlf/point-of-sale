<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
             <div class="card-header border-b border-gray-50 p-5 dark:border-zinc-600 flex flex-row justify-between px-8">
                 <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total (Rp.)</h5>
                 <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Rp. {{number_format($grand_price, 0, ',', '.')}}</h5>
             </div>
             <div class="card-body  flex flex-row gap-4 grid grid-cols-1">

                <div class="col-span-1">
                    <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Date</label>
                    <input wire:model='date' class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="datetime-local" id="example-date-input">
                </div>

                <div class="col-span-1 items-center ">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Cabang</label>
                    <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="cabang_id">
                        <option  value="" selected>Pilih Cabang</option>
                        @foreach ($cabangs as $cabang)
                            <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1 items-center ">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Supplier</label>
                    <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="supplier_id">
                        <option  value="" selected>Pilih Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option  value="{{$supplier->id}}">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-1 grid grid-cols-1 sm:grid-cols-2 flex flex-row gap-8">
                    <div class="col-span-1 items-center ">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Pembayaran</label>
                        <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="is_paid">
                            <option  value="1">Lunas</option>
                            <option  value="0" >Terhutang</option>
                        </select>
                    </div>

                    <div class="col-span-1 items-center ">
                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Status Barang</label>
                        <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="is_arrived">
                            <option  value="0" >Belum Tiba</option>
                        </select>
                    </div>
                </div>


             </div>
        </div>
     </div>
</div>
