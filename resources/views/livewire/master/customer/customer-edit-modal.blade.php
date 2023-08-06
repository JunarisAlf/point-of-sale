<div class="modal relative z-50 {{$show ? '' : 'hidden'}}"  aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 overflow-y-auto">
       <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
       <div class="animate-translate p-4 sm:max-w-4xl mx-auto">
           <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
               <div class="bg-white dark:bg-zinc-700">
                   <div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
                       <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
                           Edit Customer
                       </h3>
                       <button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
                           <i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
                       </button>
                   </div>
                   <div class="p-6 space-y-6 ltr:text-left rtl:text-right">
                        <div class="relative overflow-x-auto overflow-y-auto">
                            <div class="mb-4">
                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Nama Pelanggan</label>
                                <div class="relative">
                                    <input name="name" class="w-full rounded border-gray-100 @error('name') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="name" type="text">
                                    @error('name')
                                        <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                                    @enderror
                                </div>
                                @error('name')
                                    <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="mb-3">
                                    <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Jenis
                                        Barang</label>
                                    <select name="gender"
                                        class="@error('gender') border-red-500 @enderror w-full rounded border-gray-100 p-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-700 dark:bg-zinc-800 dark:bg-zinc-700/50 dark:text-zinc-100"
                                        wire:model="gender">
                                        <option  selected>Pilih Kategori</option>
                                        <option  value="male">Pria</option>
                                        <option  value="female">Wanita</option>
                                    </select>
                                    @error('gender')
                                        <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-4">
                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Alamat Pelanggan</label>
                                <div class="relative">
                                    <input name="address" class="w-full rounded border-gray-100 @error('address') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="address" type="text">
                                    @error('address')
                                        <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                                    @enderror
                                </div>
                                @error('address')
                                    <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Telepone Supplier</label>
                                <div class="relative">
                                    <input name="telp" class="w-full rounded border-gray-100 @error('wa') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="wa" type="text">
                                    @error('wa')
                                        <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                                    @enderror
                                </div>
                                @error('wa')
                                    <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                                @enderror
                            </div>
                            
                        </div>
                   </div>
                   <!-- Modal footer -->
                   <div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
                        <button wire:click="update({{$data_id}})" type="submit" class="btn inline-flex w-full justify-center border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600">
                            <i class="bx bx-subdirectory-right  bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                            <span class="px-3 leading-[2.8]">Simpan</span>
                        </button>
                       <button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>