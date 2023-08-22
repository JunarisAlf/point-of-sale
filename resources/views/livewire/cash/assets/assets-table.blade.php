<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="w-full overflow-x-auto">
                   <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-8 mt-4 p-2 items-end justify-between">

                       <div class="col-span-1 items-center sm:col-span-3  ">
                           <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Cabang</label>
                           <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="cabang_id">
                                <option  value="all">Semua Cabang</option>
                               @foreach ($cabangSelect as $cabang)
                                   <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                               @endforeach
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
                                    Nama
                                </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                   Stock
                               </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                   Modal
                               </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                   Harga Jual
                               </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                    Sub Modal
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jual Total
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                           @if ($items->isEmpty())
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else

                               @foreach ($items as $key => $item)
                                   <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                       <td class="w-4 p-4 text-center">
                                           {{$key+1}}
                                       </td>
                                       <td class="px-6 py-4 dark:text-zinc-100/80  w-[350px]">
                                           <button type="button" class="btn text-gray-500 hover:text-white border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:text-white focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 w-full text-start">{{$item->name}}</button>
                                       </td>

                                       <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                           <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full"> {{$item->quantity_sum}}</button>
                                       </td>

                                       <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                            @php
                                                $cbModal = 0;
                                                    $cbGroup = $item->stocks->groupBy('cabang_id');
                                                    foreach ($cbGroup as $key => $cbItem) {
                                                        $cbModal += $cbItem->avg('buying_price') * $cbItem->sum('quantity');
                                                    }
                                                $sumModal = $cbModal / $item->stocks->sum('quantity');
                                            @endphp
                                           <button type="button" class="btn text-sky-500 hover:text-white border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:text-white focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 w-full">Rp. {{number_format($sumModal, 0, ',', '.')}}</button>
                                       </td>
                                       <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                           <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full flex flex-row items-start justify-center">
                                               Rp. {{number_format($item->selling_price, 0, ',', '.')}}
                                               <span class="text-red-500 text-xs">
                                                   +{{intVal(($item->selling_price - $item->stocks->avg('buying_price')) / $item->stocks->avg('buying_price') * 100)}}%
                                               </span>
                                           </button>
                                       </td>
                                       <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                        <button type="button" class="btn text-sky-500 hover:text-white border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:text-white focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 w-full">Rp. {{number_format($sumModal * $item->quantity_sum, 0, ',', '.')}}</button>
                                    </td>
                                    <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                        <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full flex flex-row items-start justify-center">
                                            Rp. {{number_format($item->selling_price * $item->quantity_sum, 0, ',', '.')}}
                                        </button>
                                    </td>
                                   </tr>
                               @endforeach
                           @endif

                       </tbody>
                   </table>
               </div>
           </div>
            <div class="card-header border-t border-gray-50 p-5 dark:border-zinc-600 flex flex-col  px-8">
                <div class="flex flex-row justify-between">
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total Asset (Rp.)</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">{{number_format($totalAssets, 0, ',', '.') }}</h5>
                </div>
                <div class="flex flex-row justify-between">
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Prediksi Pendapatan (Rp.)</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">{{number_format($incomePred, 0, ',', '.') }}</h5>
                </div>
                <div class="flex flex-row justify-between">
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Prediksi Keuntungan (Rp.)</h5>
                    <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">
                        {{number_format($profit, 0, ',', '.') }}
                        ( {{round($percentage,2) }} % )
                    </h5>
                </div>
            </div>
       </div>
   </div>

</div>
