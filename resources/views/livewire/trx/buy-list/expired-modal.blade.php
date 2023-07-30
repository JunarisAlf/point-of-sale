<div class="modal relative z-50 {{$show ? '' : 'hidden'}}"  id="expired-modal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 overflow-y-auto">
       <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
       <div class="animate-translate p-4 sm:max-w-4xl mx-auto">
           <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
               <div class="bg-white dark:bg-zinc-700">
                   <div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
                       <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
                           Isi Expired Date
                       </h3>
                       <button wire:click="$set('show', false)" class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
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
                                                 Expired Date
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
                                                    <button type="button" class="btn text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 dark:bg-gray-500/20 dark:focus:ring-gray-500/10 dark:border-transparent w-full"> {{$detail->quantity}}</button>
                                                </td>
                                               
                                                <td class="w-4 p-4 text-center border-[1px] ">
                                                    @if ($detail->item->has_expired)
                                                        <input wire:model="date" wire:change="dateInputed({{$detail->item_id}})" class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="date" id="example-date-input">
                                                    @else
                                                        <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">Non-Expiredable</button>
                                                    @endif
                                        
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @error('expired_dates.*.expired_date')
                                <div class="text-xs text-red-500 mt-2">{{$message}}</div>
                            @enderror
                        </div>
                   </div>
                   <!-- Modal footer -->
                   <div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
                    <button wire:click="submit({{$data_id}})" type="submit" class="btn inline-flex w-full justify-center border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600">
                        <i class="bx bx-subdirectory-right  bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                        <span class="px-3 leading-[2.8]">Simpan</span>
                    </button>   
                    <button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Tutup</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>