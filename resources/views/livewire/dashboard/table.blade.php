<div class="grid grid-cols-12 gap-5 px-6 mt-6">
    <div class="col-span-6">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
                <div class="flex flex-wrap items-center mb-2">
                    <h5 class="text-15 mr-2 text-gray-800 dark:text-gray-100 font-bold"> Daftar Hutang</h5>
                </div>
               <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                   <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                       <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                           <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Cabang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Supplier
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Tanggal Pembelian
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Harga
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                           @if (false)
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else
                            <tr >
                                <td class="w-4 p-4 text-center border-[1px] ">
                                    Cabang 1
                                </td>
                                <td class="w-4 p-4 text-center border-[1px] ">
                                    Jaya Merdeka
                                </td>
                                <td class="w-4 p-4 text-center border-[1px] ">
                                    <button type="button" class="btn text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 dark:bg-gray-500/20 dark:focus:ring-gray-500/10 dark:border-transparent w-full"> {{Carbon\Carbon::now()->format('d/m/Y')}}</button>

                                </td>

                                <td class="w-4 p-4 text-center border-[1px] ">
                                    Rp. {{number_format(12000, 0, ',', '.')}}
                                </td>
                            </tr>
                           @endif
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>

   <div class="col-span-6">
    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
        <div class="card-body">
            <div class="flex flex-wrap items-center mb-2">
                <h5 class="text-15 mr-2 text-gray-800 dark:text-gray-100 font-bold"> Daftar Piutang</h5>
            </div>
            <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                    <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                        <tr>
                             <th scope="col" class="px-6 py-3 text-center">
                                 Cabang
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                Supplier
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                Tanggal Pembelian
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                 Harga
                             </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (false)
                            <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                            </tr>
                        @else
                         <tr >
                             <td class="w-4 p-4 text-center border-[1px] ">
                                 Cabang 1
                             </td>
                             <td class="w-4 p-4 text-center border-[1px] ">
                                 Jaya Merdeka
                             </td>
                             <td class="w-4 p-4 text-center border-[1px] ">
                                 <button type="button" class="btn text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 dark:bg-gray-500/20 dark:focus:ring-gray-500/10 dark:border-transparent w-full"> {{Carbon\Carbon::now()->format('d/m/Y')}}</button>

                             </td>

                             <td class="w-4 p-4 text-center border-[1px] ">
                                 Rp. {{number_format(12000, 0, ',', '.')}}
                             </td>
                         </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

</div>
