<div class="grid grid-cols-12 gap-5 print:hidden">
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
        <div class="card-body pb-0">
            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100 font-bold">Tanggal Stock Opname</h6>
        </div>
           <div class="card-body">
               <div class="w-full overflow-x-auto">
                   <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-8 mt-4 p-2 items-end justify-between">
                        <div class="col-span-1 sm:col-span-6 ">
                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="date" wire:model="opname_date">
                        </div>

                        <div class="col-span-1 sm:col-span-6">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Cabang</label>
                            <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="cabang_id">
                                @if ($user->role === 'master')
                                    <option  selected>Pilih Cabang</option>
                                    @foreach ($cabangSelect as $cabang)
                                        <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                                    @endforeach
                                @else
                                    <option  selected ="{{$user->cabang->id}}">{{$user->cabang->name}}</option>
                                @endif
                            </select>
                        </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
