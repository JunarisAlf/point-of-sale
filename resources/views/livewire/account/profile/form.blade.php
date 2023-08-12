<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="w-full overflow-x-auto">
                   <div class="grid grid-cols-1 sm:grid-cols-12 gap-12 mb-8 mt-4 p-2  justify-between">
                       <div class="col-span-3 flex flex-col gap-2 text-md">
                           <img class="md:w-[80%] mx-auto" src="{{asset('storage/profile/' . $profile_img)}}" alt="">
                           <span class="mt-4 font-bold text-xl text-center">{{$user->full_name}}</span>
                       </div>
                       <div class="col-span-9">
                           <div class="card border-gray-500 dark:bg-zinc-800">
                               <div class="p-5 border-b border-gray-500">
                                   <h5 class="text-gray-500 text-17">Update Informasi Diri</h5>
                               </div>
                               <div class="card-body">
                                   <div class="mb-4">
                                       <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="user_avatar">Foto Profile</label>
                                       <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" wire:model="file">
                                       @error('file')
                                           <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                       @enderror
                                   </div>


                                   <div class="mb-4">
                                       <label for="example-text-input"
                                           class="mb-2 block font-medium text-gray-700 dark:text-gray-100">Nama</label>
                                       <div class="relative">
                                           <input name="name"
                                               class="@error('name') border-red-500 @enderror w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-gray-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                                               wire:model="name" type="text">
                                           @error('name')
                                               <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                           @enderror
                                       </div>
                                       @error('name')
                                           <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                       @enderror
                                   </div>
                                 
                                   <div class="mb-4 mt-2">
                                       <button wire:click="update" type="button" class="btn border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600"><i class="bx bx-smile bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Simpan</span></button>
                                   </div>
                                   
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
   

 
</div>