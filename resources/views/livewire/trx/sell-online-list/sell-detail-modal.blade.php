<div class="modal relative z-50 {{$show ? '' : 'hidden'}}"  aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 overflow-y-auto">
       <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
       <div class="animate-translate p-4 sm:max-w-4xl mx-auto">
           <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
               <div class="bg-white dark:bg-zinc-700">
                   <div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
                       <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
                           Detail Pesanan
                       </h3>
                       <button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
                           <i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
                       </button>
                   </div>
                   <div class="p-6 space-y-6 ltr:text-left rtl:text-right">
                        <div class="relative overflow-x-auto overflow-y-auto">

                            <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                                <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                                    <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Nama Barang
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Jumlah
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                 Harga Satuan
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Diskon
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-center">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $key => $detail)
                                            <tr >
                                                <td class="w-4 p-4 text-center border-[1px] ">
                                                    {{$detail->item->name}}
                                                </td>
                                                <td class="w-4 p-4 text-center border-[1px] ">
                                                    <button type="button" class="btn text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 dark:bg-gray-500/20 dark:focus:ring-gray-500/10 dark:border-transparent w-full">
                                                        {{$detail->quantity}} {{$detail->satuan->name}} ({{$detail->qty_satuan}})
                                                    </button>
                                                </td>
                                                <td class="w-4 p-4 text-center border-[1px] ">
                                                    Rp. {{number_format($detail->price, 0, ',', '.')}}
                                                </td>
                                                <td class="w-4 p-4 text-center border-[1px] ">
                                                    <button type="button" class="btn text-red-500 bg-red-50 border-red-50 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600 dark:focus:ring-red-500/10 dark:bg-red-500/20 dark:border-transparent">Rp. {{number_format($detail->discount, 0, ',', '.')}}</button>
                                                </td>
                                                <td class="w-4 p-4 text-center border-[1px] ">
                                                    <button type="button" class="btn text-purple-500 bg-purple-50 border-purple-50 hover:text-white hover:bg-purple-600 hover:border-purple-600 focus:text-white focus:bg-purple-600 focus:border-purple-600 focus:ring focus:ring-purple-500/30 active:bg-purple-600 active:border-purple-600 dark:focus:ring-purple-500/10 dark:bg-purple-500/20 dark:border-transparent">Rp. {{number_format($detail->grand_price, 0, ',', '.')}}</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   </div>
                   <!-- Modal footer -->
                   <div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
                       <button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Tutup</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
