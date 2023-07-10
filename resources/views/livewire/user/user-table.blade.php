<div class="grid grid-cols-12 gap-5">
    <div class="col-span-12">
        <button wire:click="$emit('openCreateModal')" type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
            <i class="bx bx-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
            <span class="px-3 leading-[2.8]">Tambah Pengguna</span>
        </button>

    </div>
    
    <div class="col-span-12">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body pb-0">
                <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">Daftar Pengguna</h6>
            </div>
            <div class="card-body">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                            <tr>
                                <th scope="col" class="p-4">
                                    Nomor
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Position
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                <td class="w-4 p-4">
                                   1
                                </td>
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
                                <img class="w-10 h-10 rounded-full" src="{{asset('mania/images/users/avatar-1.jpg')}}" alt="Jese image">
                                    <div class="ltr:pl-3 rtl:pr-3 ltr:text-left rtl:text-right">
                                        <div class="text-base font-semibold dark:text-gray-100">Mark</div>
                                        <div class="font-normal text-gray-500 dark:text-zinc-100/80">mark@snowball.com</div>
                                    </div>  
                                </th>
                                <td class="px-6 py-4 dark:text-zinc-100/80">
                                    React Developer
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center dark:text-zinc-100/80">
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 ltr:mr-2 rtl:ml-2"></div> Online
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 hover:underline">Edit user</a>
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    {{-- <div class="col-span-12">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body pb-0">
                <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">tambahkan Pengguna</h6>
            </div>
            <div class="card-body">
                <div class="relative overflow-x-auto">
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
                </div>
            </div>
        </div>
    </div> --}}
</div>