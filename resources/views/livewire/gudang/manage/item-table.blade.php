<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12">
        <button wire:click="openCreateModal" type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
            <i class="bx bx-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
            <span class="px-3 leading-[2.8]">Tambah Stok Expired</span>
        </button>

    </div>
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="w-full overflow-x-auto">
                   <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-8 mt-4 p-2 items-end justify-between">

                       <div class="col-span-1 sm:col-span-6  min-w-max">
                           <div class="flex flex-row items-center gap-2">
                               <label>Show</label>
                               <input class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="number" name="paginate_count" wire:model.lazy="paginate_count" id="example-email-input">
                               <label>Of {{$data_count}} Entries</label>
                           </div>
                       </div>

                       <div class="col-span-1 sm:col-span-2 items-center ">
                           <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Urutkan</label>
                           <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="shortField">
                               @foreach ($shortableField as $key => $short)
                                   <option value="{{$key}}">{{$short['label']}}</option>
                               @endforeach
                           </select>
                       </div>

                       <div class="col-span-1 sm:col-span-2 ">
                           <div class="flex">
                               <button  style="z-index: 0 !important" id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">Cari</button>

                               <div class="relative w-full">
                                   <input wire:model="searchQuery" type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-r-lg border-l-zinc-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-500 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Pencarian" required>
                                   <button type="button" class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                       <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                           <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                       </svg>
                                       {{-- <span class="sr-only">Search</span> --}}
                                   </button>
                               </div>
                           </div>
                       </div>

                       <div class="col-span-1 items-center sm:col-span-2  ">
                           <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Cabang</label>
                           <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="cabang_id">
                            @if ($user->role === 'master')
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


               <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                   <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                       <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                           <tr>
                                <th scope="col" class="p-4 text-center">
                                   Nomor
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Item
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Expired Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Stock
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Modal
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                           @if ($items->isEmpty())
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="6" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else

                               @foreach ($items as $key => $item)
                                   @php
                                       $tableNumber = ($page - 1) * $items->perPage() + $loop->index + 1;
                                       $stocks_count = $item->stocks->count() == 0 ? 1 : $item->stocks->count();
                                       $has_stock = $item->stocks->count() == 0 ? false : true;
                                   @endphp
                                    <tr >
                                        <td class="w-4 p-4 text-center border-[1px] " rowspan="{{$stocks_count}}">
                                            {{$tableNumber}}
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80  w-[350px] border-[1px]" rowspan=" {{$stocks_count}}">
                                            <button type="button" class="btn text-gray-500 hover:text-white border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:text-white focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 w-full text-start">{{$item->barcode}} - {{$item->name}}</button>
                                        </td>
                                        @if ($has_stock == false)
                                            <td class="px-6 py-4 dark:text-zinc-100/80  w-[350px] border-[1px] text-center">-</td>
                                            <td class="px-6 py-4 dark:text-zinc-100/80 text-center border-[1px]">
                                                <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full">0</button>
                                            </td>
                                            <td class="px-6 py-4 dark:text-zinc-100/80 text-center border-[1px]">
                                                <button type="button" class="btn text-sky-500 hover:text-white border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:text-white focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 w-full">{{$item->buying_price}}</button>
                                            </td>
                                            <td class="w-4 p-4 text-center border-[1px] min-w-max">
                                                <div class="flex flex-row justify-center min-w-[300px]">
                                                    <button wire:click="openFillModal({{$item->id}})" type="button" class="btn border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600 scale-80"><i class="bx bx-pen bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Isi Stok</span></button>
                                                </div>
                                            </td>

                                        @endif
                                        @if ($has_stock == true && $stocks_count > 0)
                                            <td class="px-6 py-4 dark:text-zinc-100/80 text-center border-[1px]">
                                                @if ($item->has_expired == false)
                                                    <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">Non-Expiredable</button>
                                                @else
                                                    {{$item->stocks[0]->expired_date !== null ? Carbon\Carbon::parse($item->stocks[0]->expired_date)->format('d/m/Y') : '-' }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 dark:text-zinc-100/80 text-center border-[1px]">
                                                <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full">{{$item->stocks[0]->quantity}}</button>
                                            </td>
                                            <td class="px-6 py-4 dark:text-zinc-100/80 text-center border-[1px]" rowspan="{{$stocks_count}}">
                                                <button type="button" class="btn text-sky-500 hover:text-white border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:text-white focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 w-full">Rp. {{number_format($item->stocks->avg('buying_price'), 0, ',', '.')}}</button>
                                            </td>
                                            <td class="w-4 p-4 text-center border-[1px] min-w-max">
                                                <div class="flex flex-row justify-center min-w-[300px]">
                                                    <button wire:click="openEditModal({{$item->stocks[0]->id}})" type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600 scale-80"><i class="bx bx-edit bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Edit</span></button>
                                                </div>
                                            </td>
                                        @endif

                                    </tr>

                                    @if ($has_stock == true && $stocks_count > 1)
                                        @for($i = 1; $i < $stocks_count; $i++)
                                            <tr>
                                                <td class="px-6 py-4 dark:text-zinc-100/80 text-center border-[1px]">
                                                    @if ($item->has_expired == false)
                                                        <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">Non-Expiredable</button>
                                                    @else
                                                        {{$item->stocks[$i]->expired_date !== null ? Carbon\Carbon::parse($item->stocks[$i]->expired_date)->format('d/m/Y ') : '-' }}
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 dark:text-zinc-100/80 text-center border-[1px]">
                                                    <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full">{{$item->stocks[$i]->quantity}}</button>
                                                </td>

                                                <td class="w-4 p-4 text-center border-[1px] min-w-max">
                                                    <div class="flex flex-row justify-center min-w-[300px]">
                                                        <button wire:click="openEditModal({{$item->stocks[$i]->id}})" type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600 scale-80"><i class="bx bx-edit bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Edit</span></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    @endif

                               @endforeach
                           @endif

                       </tbody>
                   </table>
               </div>
               <div class="mt-8 w-full flex justify-center">
                   {{$items->links()}}
               </div>
           </div>
       </div>
   </div>
</div>
