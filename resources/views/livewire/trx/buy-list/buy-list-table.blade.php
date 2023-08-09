<div class="grid grid-cols-12 gap-5 ">
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

                       <div class="col-span-1 items-center sm:col-span-2" wire:ignore>
                            <label for="range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Tanggal</label>
                            <input type="text" class="w-full border-gray-100 rounded form-control dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100" id="datepicker-range" name="range">
                        </div>

                       <div class="col-span-1 sm:col-span-2 ">
                           <div class="flex">
                               <button  style="z-index: 0 !important" id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">Cari
                               </button>
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
                               @foreach ($cabangSelect as $cabang)
                                   <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                               @endforeach
                           </select>
                       </div>

                       <div class="col-span-1 items-center sm:col-span-2  ">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Status Barang</label>
                            <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="is_arrived">
                                <option  selected value="all">Semua</option>
                                <option  value="0">Belum Tiba</option>
                                <option  value="1">Telah Tiba</option>
                            </select>
                        </div>

                       <div class="col-span-1 items-center sm:col-span-2  ">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Status Pembayaran</label>
                            <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="is_paid">
                                <option  selected value="all">Semua</option>
                                <option  value="0">Terhutang</option>
                                <option  value="1">Lunas</option>
                            </select>
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
                                   Supplier
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Tanggal Pembelian
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Status Barang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Pembayaran
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Harga
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                           @if ($buys->isEmpty())
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else
                               
                               @foreach ($buys as $key => $buy)
                                   @php
                                       $tableNumber = ($page - 1) * $buys->perPage() + $loop->index + 1;
                                   @endphp
                                    <tr >
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$tableNumber}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$buy->supplier->name}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            <button type="button" class="btn text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 dark:bg-gray-500/20 dark:focus:ring-gray-500/10 dark:border-transparent w-full"> {{Carbon\Carbon::parse($buy->date)->format('d/m/Y')}}</button>
                                           
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            @if ($buy->is_arrived)
                                                <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">Sudah Tiba</button>
                                            @else
                                                <button type="button" class="btn text-yellow-500 bg-yellow-50 hover:text-white border-yellow-50 hover:bg-yellow-600 focus:text-white hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-500/30 active:bg-yellow-600 active:border-yellow-600 dark:focus:ring-yellow-500/10 dark:bg-yellow-500/20 dark:border-transparent">Belum Tiba</button>
                                            @endif
                                            
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            @if ($buy->is_paid)
                                                <button type="button" class="btn text-green-500 bg-green-50 border-green-50 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 dark:focus:ring-green-500/10 dark:bg-green-500/20 dark:border-transparent">Lunas</button>
                                            @else
                                                <button type="button" class="btn text-red-500 bg-red-50 border-red-50 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600 dark:focus:ring-red-500/10 dark:bg-red-500/20 dark:border-transparent">Terhutang</button>
                                            @endif
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            Rp. {{number_format($buy->price_sum, 0, ',', '.')}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            <div class="flex flex-row gap-2 min-w-max">
                                                <button wire:click="$emit('openDetailModal', {{$buy->id}})" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600"><i class="mdi mdi-eye-outline text-22 align-middle ltr:mr-1 rtl:ml-1 "></i><span class="align-middle">Detail</span></button>
                                                @if (!$buy->is_paid)
                                                    <button {{$buy->is_paid ? 'disabled' : ''}} wire:click="$emit('openMarkPaidModal', {{$buy->id}})" type="button" class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600"><i class="mdi mdi-cash-check text-22 align-middle ltr:mr-1 rtl:ml-1 "></i><span class="align-middle">Tandai Lunas</span></button>
                                                @endif
                                                @if (!$buy->is_arrived)
                                                    <button {{$buy->is_arrived ? 'disabled' : ''}} wire:click="$emit('openExpiredModal', {{$buy->id}})" type="button" class="btn text-white bg-yellow-500 border-yellow-500 hover:bg-yellow-600 hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-500/30 active:bg-yellow-600 active:border-yellow-600"><i class="mdi mdi-package-variant-closed-check text-22 align-middle ltr:mr-1 rtl:ml-1 "></i><span class="align-middle">Tandai Tiba</span></button>
                                                @endif
                                                
                                            </div>
                                           
                                        </td>
                                    </tr>
                               @endforeach
                           @endif
                       </tbody>
                   </table>
               </div>
               <div class="mt-8 w-full flex justify-center">
                   {{$buys->links()}}
               </div>
           </div>
           <div class="card-header border-t border-gray-50 p-5 dark:border-zinc-600 flex flex-row justify-between px-8">
                <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total (Rp.)</h5>
                <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">{{number_format($buys->sum('price_sum'), 0, ',', '.') }}</h5>
            </div>
       </div>
   </div>
   

 
</div>