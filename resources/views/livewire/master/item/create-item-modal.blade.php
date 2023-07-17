<div id="create" class="modal {{ $show ? '' : 'hidden' }} relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 overflow-y-auto">
        <div class="modal-overlay absolute inset-0 bg-black bg-opacity-50 transition-opacity"></div>
        <div class="animate-translate mx-auto p-4 sm:max-w-4xl">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
                <div class="bg-white dark:bg-zinc-700">
                    <div class="flex items-center rounded-t border-b border-gray-50 p-4 dark:border-zinc-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
                            Tambah Data Barang
                        </h3>
                        <button
                            class="btn inline-flex items-center rounded-lg border-transparent px-2 py-1 text-sm text-gray-400 hover:bg-gray-50/50 hover:text-gray-900 ltr:ml-auto rtl:mr-auto dark:text-gray-100 dark:hover:bg-zinc-600"
                            type="button" data-tw-dismiss="modal">
                            <i class="mdi mdi-close text-xl text-gray-500 dark:text-zinc-100/60"></i>
                        </button>
                    </div>
                    <div class="space-y-6 p-6 ltr:text-left rtl:text-right">
                        <div class="relative overflow-x-auto overflow-y-auto">

                            <div class="mb-4 flex flex-row items-end justify-between">
                                <div class="flex flex-col w-[80%]">
                                    <label for="example-text-input"
                                    class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Barcode Number</label>
                                    <div class="relative">
                                        <input name="barcode"
                                            class="@error('barcode') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                                            wire:model="barcode" type="text" maxlength="13" minlength="13">
                                        @error('barcode')
                                            <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                        @enderror
                                    </div>
                                    @error('barcode')
                                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-20% ">
                                    <button wire:click="generateBarcode" type="button" class="btn inline-flex w-full justify-center border-0 bg-violet-500 p-0 align-middle text-white hover:bg-violet-600 focus:ring-2 focus:ring-violet-500/30">
                                        <i class="mdi mdi-numeric bg-white bg-opacity-20 w-8 h-full text-16 py-3 align-middle rounded-l "></i>
                                        <span class="px-3 leading-[2.8]">Generate</span>
                                    </button>
                                </div>
                               
                            </div>

                            <div class="mb-4">
                                <label for="example-text-input"
                                    class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Nama Barang</label>
                                <div class="relative">
                                    <input name="name"
                                        class="@error('name') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                                        wire:model="name" type="text">
                                    @error('name')
                                        <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                    @enderror
                                </div>
                                @error('name')
                                    <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="mb-3">
                                    <div class="mb-2">
                                        <label
                                            class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Kategori</label>
                                    </div>
                                    <div class="@error('category_id') border-red-500 border-[0.5px] @enderror rounded">
                                        <div wire:ignore>
                                            <select class="" data-trigger name="category_id"
                                                placeholder="This is a search placeholder" id="category-select"
                                                wire:model="category_id">
                                                <option selected>Pilih Kategori</option>
                                                @foreach ($categoriesSelect as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    @error('category_id')
                                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="mb-3">
                                    <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Jenis
                                        Barang</label>
                                    <select name="has_expired"
                                        class="@error('has_expired') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-800 dark:bg-zinc-700/50 dark:text-zinc-100"
                                        wire:model="has_expired">
                                        <option selected>Pilih Kategori</option>
                                        <option value="1">Bisa Expired</option>
                                        <option value="0">Tidak Bisa Expired</option>
                                    </select>
                                    @error('has_expired')
                                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4" x-data='opt'>
                                <div class="mb-3">
                                    <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Harga
                                        Jual</label>
                                    <div class="relative rounded  @error('selling_price') border-red-500 border-[0.5px]  @enderror">
                                        <input name="selling_price" type="text"  wire:ignore
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100 "
                                            id="selling_price_mask" value="{{ $selling_price }}"  x-data x-init="imaskObj = new IMask($el, imaskOpt)" x-on:input="$wire.set('selling_price', imaskObj.unmaskedValue)" >
                                            @error('selling_price')
                                                <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                            @enderror
                                    </div>
                                    @error('selling_price')
                                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center gap-3 space-x-2 rounded-b border-t border-gray-50 p-5 dark:border-zinc-600">
                        <button wire:click="store" type="submit"
                            class="btn inline-flex w-full justify-center border-0 bg-violet-500 p-0 align-middle text-white hover:bg-violet-600 focus:ring-2 focus:ring-violet-500/30">
                            <i  class="bx bx-subdirectory-right text-16 h-full w-10 rounded-l bg-opacity-20 py-3 align-middle"></i>
                            <span class="px-3 leading-[2.8]">Simpan</span>
                        </button>
                        <button type="button"
                            class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 dark:border-zinc-600 dark:bg-zinc-700 dark:text-gray-100 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20 sm:mt-0 sm:w-auto sm:text-sm"
                            data-tw-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
