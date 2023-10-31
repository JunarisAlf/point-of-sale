<div class="mt-5 grid grid-cols-1 gap-5 lg:grid-cols-12">
    <div class="col-span-12">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800">
            <div class="card-body flex grid grid-cols-2 flex-row gap-4">

                <div class="col-span-2 grid grid-cols-2 items-center gap-2">
                    <div class="col-span-1 mb-3">
                        <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Cabang</label>
                        <select name="cabang_id"
                            class="@error('cabang_id') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-700/50 dark:bg-zinc-800 dark:text-zinc-100"
                            wire:model="cabang_id">
                            @if ($user->role === 'master')
                                <option selected>Pilih Cabang</option>
                                @foreach ($cabangSelect as $cabang)
                                    <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                                @endforeach
                            @else
                                <option selected value="{{ $user->cabang->id }}">{{ $user->cabang->name }}</option>
                            @endif
                        </select>
                        @error('cabang_id')
                            <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-span-1 mb-3">
                        <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Jenis Retur</label>
                        <select name="type"
                            class="@error('type') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-700/50 dark:bg-zinc-800 dark:text-zinc-100"
                            wire:model="type">
                            <option value="ke-supplier">Retur Ke Supplier</option>
                            <option value="dari-customer">Retur Dari Customer</option>
                        </select>
                        @error('type')
                            <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="col-span-2 grid grid-cols-2 items-center gap-2">
                    @if ($type == 'ke-supplier')
                        <div class="col-span-1 items-center">
                            <label for="category-select"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Supplier</label>
                            <div class="@error('supplier_id') border-red-500 border-[0.5px] @enderror rounded">
                                <div>
                                    <select class="" data-trigger name="supplier_id"
                                        placeholder="This is a search placeholder" id="supplier-select"
                                        wire:model="supplier_id">
                                        <option selected>Pilih Supplier</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('supplier_id')
                                <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="col-span-1 items-center">
                            <label for="category-select"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Customer</label>
                            <div class="@error('customer_id') border-red-500 border-[0.5px] @enderror rounded">
                                <div>
                                    <select class="" data-trigger name="customer_id"
                                        placeholder="This is a search placeholder" id="customer-select"
                                        wire:model="customer_id">
                                        <option selected>Pilih Customer</option>
                                        @foreach ($customers as $customers)
                                            <option value="{{ $customers->id }}">{{ $customers->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('customer_id')
                                <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif


                    <div class="col-span-1 items-center">
                        <label for="example-text-input"
                            class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Keterangan</label>
                        <div class="relative">
                            <input name="note"
                                class="@error('note') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                                wire:model="note" type="text" placeholder="Nama Supplier/Pelanggan - Invoice/Faktur">
                            @error('note')
                                <i
                                    class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
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
    <script>
        document.addEventListener('livewire:load', function() {
            // Supplier
            $(document).ready(function() {
                $('#supplier-select').select2({
                    width: '100%'
                });
            });
            $('#supplier-select').on('change', function() {
                let selectedValue = $(this).val();
                Livewire.emit('supplierChange', selectedValue)
            });

            //  Customer
            $(document).ready(function() {
                $('#customer-select').select2({
                    width: '100%'
                });
            });
            $('#customer-select').on('change', function() {
                let selectedValue = $(this).val();
                Livewire.emit('customerChange', selectedValue)
            });
            Livewire.on('render-select2', function(supplier_id, customer_id) {
                // Supplier
                $('#supplier-select').select2({
                    width: '100%'
                });
                $('#supplier-select').on('change', function() {
                    let selectedValue = $(this).val();
                    Livewire.emit('supplierChange', selectedValue)
                });

                //  Customer
                $('#customer-select').select2({
                    width: '100%'
                });

                $('#customer-select').on('change', function() {
                    let selectedValue = $(this).val();
                    Livewire.emit('customerChange', selectedValue)
                });
            })
        })
    </script>
</div>
