<div class="grid grid-cols-1">
    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
        <div class="card-body">
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-12 ">
                    <form wire:submit.prevent="submitForm">
                        <div class="mb-4">
                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Password Lama</label>
                            <div class="relative">
                                <input name="old_password" class="w-full rounded border-gray-100 @error('old_password') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="old_password" type="password">
                                @error('old_password')
                                    <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                                @enderror
                            </div>
                            @error('old_password')
                                <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Password Baru</label>
                            <div class="relative">
                                <input name="new_password" class="w-full rounded border-gray-100 @error('new_password') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="new_password" type="password">
                                @error('new_password')
                                    <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                                @enderror
                            </div>
                            @error('new_password')
                                <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Password Lama</label>
                            <div class="relative">
                                <input name="new_password_confirmation" class="w-full rounded border-gray-100 @error('new_password_confirmation') border-red-500 @enderror placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100" wire:model="new_password_confirmation" type="password">
                                @error('new_password_confirmation')
                                    <i class='bx bx-error-circle absolute text-xl text-red-500 ltr:right-2 rtl:left-2 top-2'></i>
                                @enderror
                            </div>
                            @error('new_password_confirmation')
                                <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600">
                            <i class="bx bx-subdirectory-right bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                            <span class="px-3 leading-[2.8]">Simpan</span>
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>