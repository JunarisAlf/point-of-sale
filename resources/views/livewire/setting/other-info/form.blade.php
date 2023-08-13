<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">


                <div class="mb-4">
                    <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Login Text</label>
                    <div class="relative">
                        <input name="login_text" class="w-full rounded border-gray-100 @error('login_text') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="login_text" type="text">
                        @error('login_text')
                            <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                        @enderror
                    </div>
                    @error('login_text')
                        <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Running Text</label>
                    <div class="relative">
                        <input name="runing_text" class="w-full rounded border-gray-100 @error('runing_text') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="runing_text" type="text">
                        @error('runing_text')
                            <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                        @enderror
                    </div>
                    @error('runing_text')
                        <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                    @enderror
                </div>
                <button wire:click="update" type="submit" class="btn inline-flex w-full justify-center border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600">
                    <i class="bx bx-subdirectory-right  bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                    <span class="px-3 leading-[2.8]">Update</span>
                </button>
                
           </div>
       </div>
   </div>
   

 
</div>