<div class="grid grid-cols-12 gap-5 ">
    @if (Carbon\Carbon::parse($date)->isSameDay(Carbon\Carbon::now()))
        @if ($user->role == 'master' || $user->role == 'admin')
                <div class="col-span-12">
                    <button wire:click="$emit('openCreateModal', {{$cabang_id}})" type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
                        <i class="bx bx-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                        <span class="px-3 leading-[2.8]">Tambah Data</span>
                    </button>
                    <button wire:click="openSetorModal" type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
                        <i class="bx bx-money-withdraw bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                        <span class="px-3 leading-[2.8]">Setoran</span>
                    </button>
                </div>
        @endif
    @endif
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="w-full overflow-x-auto">
                   <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-8 mt-4 p-2 items-end justify-between">

                        <div class="col-span-1 sm:col-span-3 ">
                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">Tanggal</label>
                            <input wire:model='date' class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="date" id="example-date-input">
                        </div>

                        <div class="col-span-1 items-center sm:col-span-3  ">
                           <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Cabang</label>
                           <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="cabang_id">
                            @if ($user->role === 'master')
                                @foreach ($cabangSelect as $cabang)
                                    <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                                @endforeach
                            @else
                                <option  value="{{$user->cabang->id}}">{{$user->cabang->name}}</option>
                            @endif

                           </select>
                       </div>
                    </div>
               </div>

               <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                   <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                       <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                           <tr>
                                <th scope="col" class="p-4 text-center ">
                                    Waktu
                                </th>
                                <th scope="col" class="p-4 text-center">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jumlah
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                            @foreach ($cashes as $cash)
                                <tr>
                                    <td class="p-1 text-center border-[1px] w-[200px]">
                                        {{Carbon\Carbon::parse($cash->date)->format('d/m/Y H:i:s')}}
                                    </td>
                                    <td class=" p-1  border-[1px]  w-[400px]
                                    w-4">{{$cash->name}}</td>
                                    <td class=" p-1 border-[1px] w-[200px]">
                                        Rp. {{number_format($cash->total, 0, ',', '.')}}
                                    </td>
                                </tr>
                            @endforeach
                       </tbody>
                   </table>
               </div>

           </div>
           <div class="card-header border-t border-gray-50 p-5 dark:border-zinc-600 flex flex-col justify-between px-8">
                <div class="flex flex-row justify-between">
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total (Rp.)</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">{{number_format($cashSum, 0, ',', '.')}}</h5>
                </div>
            </div>
       </div>
   </div>


</div>
