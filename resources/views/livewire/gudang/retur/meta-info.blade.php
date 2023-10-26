<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 mt-5">
    <div class="col-span-12 ">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">

            <div class="card-body  flex flex-row gap-4 grid grid-cols-2">

                <div class="col-span-2  items-center ">
                    <div class="mb-3">
                        <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Jenis Retur</label>
                        <select name="type"
                            class="@error('type') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-800 dark:bg-zinc-700/50 dark:text-zinc-100"
                            wire:model="type">
                            <option  value="ke-supplier">Retur Ke Supplier</option>
                            <option  value="dari-customer">Retur Dari Customer</option>
                        </select>
                        @error('type')
                            <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Cabang</label>
                        <select name="cabang_id"
                            class="@error('cabang_id') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-800 dark:bg-zinc-700/50 dark:text-zinc-100"
                            wire:model="cabang_id">
                            <option selected>Pilih Cabang</option>
                                @if ($user->role === 'master')
                                    @foreach ($cabangSelect as $cabang)
                                        <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                                    @endforeach
                                @else
                                    <option  selecdted value="{{$user->cabang->id}}">{{$user->cabang->name}}</option>
                                @endif
                        </select>
                        @error('cabang_id')
                            <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-span-2  items-center ">
                    <label for="example-text-input"
                        class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Keterangan</label>
                    <div class="relative">
                        <input name="note"
                            class="@error('note') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                            wire:model="note" type="text">
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
