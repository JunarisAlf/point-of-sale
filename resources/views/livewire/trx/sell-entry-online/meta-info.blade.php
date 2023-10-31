<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-header border-b border-gray-50 p-5 dark:border-zinc-600 flex flex-col">
                <div class="flex flex-row justify-between">
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total (Rp.)</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Rp. {{number_format($grand_price, 0, ',', '.')}}</h5>
                </div>
            </div>



            <div class="card-body  flex flex-row gap-4 grid grid-cols-2">

                <div class="col-span-2  items-center ">
                    <div class="mb-3">
                        <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Cabang</label>
                        <select name="cabang_id"
                            class="@error('cabang_id') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-800 dark:bg-zinc-700/50 dark:text-zinc-100"
                            wire:model="cabang_id">
                            @if ($user->role === 'master')
                                <option selected>Pilih Cabang</option>
                                @foreach ($cabangSelect as $cabang)
                                    <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                                @endforeach
                                @else
                                    <option  selected value="{{$user->cabang->id}}">{{$user->cabang->name}}</option>
                            @endif
                        </select>
                        @error('cabang_id')
                            <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2  items-center ">
                    <label for="example-text-input"
                        class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Jenis Penjualan</label>
                    <div class="relative">
                        <select name="jenis"
                            class="@error('jenis') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-800 dark:bg-zinc-700/50 dark:text-zinc-100"
                            wire:model="jenis">
                                <option selected value="-">-- Pilih Jenis --</option>
                                <option value="SHOPEE">SHOPEE</option>
                                <option value="TOKOPEDIA">TOKOPEDIA</option>
                                <option value="LAZADA">LAZADA</option>
                                <option value="TIKTOK SHOP">TIKTOK SHOP</option>
                                <option value="LAINNYA">LAINNYA</option>
                        </select>
                    </div>
                    @error('jenis')
                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-span-2  items-center ">
                    <label for="example-text-input"
                        class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Keterangan</label>
                    <div class="relative">
                        <input name="note"
                            class="@error('note') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                            wire:model="note" type="text" placeholder="Faktur/Invoice/Resi">
                        @error('note')
                            <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                        @enderror
                    </div>
                    @error('note')
                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                    @enderror
                </div>


            </div>
        </div>
     </div>
</div>
