<div class="modal relative z-50 {{$show ? '' : 'hidden'}}"  aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 overflow-y-auto">
       <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
       <div class="animate-translate p-4 sm:max-w-4xl mx-auto">
           <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
               <div class="bg-white dark:bg-zinc-700">
                   <div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
                       <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
                           Edit Harga Multi
                       </h3>
                       <button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
                           <i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
                       </button>
                   </div>
                   <div class="p-6 space-y-6 ltr:text-left rtl:text-right">
                        <div class="relative overflow-x-auto overflow-y-auto">

                            <div class="mb-4">
                                <label for="example-text-input"
                                    class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Jumlah</label>
                                <div class="relative">
                                    <input name="quantity"
                                        class="@error('quantity') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                                        wire:model="quantity" type="number">
                                    @error('quantity')
                                        <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                    @enderror
                                </div>
                                @error('quantity')
                                    <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3" >
                                <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Harga</label>
                                <div class="relative rounded  @error('price') border-red-500 border-[0.5px]  @enderror">
                                    <input name="price" type="text"  wire:ignore
                                        class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100 "
                                        id="price_mask" value="{{ $price }}"  >
                                        @error('price')
                                            <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                        @enderror
                                </div>
                                @error('price')
                                    <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-4">
                                <label for="example-text-input"
                                    class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Persentase (-%)</label>
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

                        </div>
                   </div>
                   <!-- Modal footer -->
                   <div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
                        <button x-on:click="$wire.emit('some-event', 'foo', 'bar')" wire:click="update({{$data_id}})" type="submit" class="btn inline-flex w-full justify-center border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600">
                            <i class="bx bx-subdirectory-right  bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                            <span class="px-3 leading-[2.8]">Simpan</span>
                        </button>
                       <button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
    <script>
        document.addEventListener('livewire:load', function () {
            const editMask = document.getElementById('price_mask');
            let imaskObj = new IMask(editMask, 
                {
                    mask: 'Rp.  num',
                    blocks: {
                        num: {
                            mask: Number,
                            thousandsSeparator: '.',
                        }
                    }
                });
            let inputTimeOut = null;
            editMask.addEventListener('input', function(){
                clearTimeout(inputTimeOut); 
                inputTimeOut = setTimeout(() => {@this.price = imaskObj.unmaskedValue}, 500)
            });
            window.addEventListener('price-updated', event => {
                imaskObj.unmaskedValue = '' + @this.price;
            })
            window.addEventListener('item-changed', event => {
                imaskObj.unmaskedValue = '' + @this.price;
            })
            
        })
    </script>
</div>