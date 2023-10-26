<div class="grid grid-cols-12 gap-5 ">

    <div class="col-span-12 ">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="w-full overflow-x-auto">
                   <div class="grid grid-cols-1 gap-4 mb-8 mt-4 p-2 items-end justify-between">
                       <div class="col-span-1  items-center ">
                           <label for="category-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Nama Barang</label>
                           <div wire:ignore>
                               <select   data-trigger name="item_id"   placeholder="This is a search placeholder" id="item-select" wire:model="item_id">
                                   <option  selected>Pilih Barang</option>
                                   @foreach ($itemSelect as $item)
                                       <option  value="{{$item->id}}">{{$item->name}}</option>
                                   @endforeach
                               </select>
                           </div>
                       </div>
                       @if ($itemMulti !== null)
                        <div class="col-span-1 flex justify-between items-center mt-4">
                            <div class="flex flex-col">
                                <span class="font-bold text-md">Harga Satuan</span>
                                <span class="font-bold text-xl">Rp. {{number_format($itemMulti->selling_price, 0,',', '.')}}</span>
                            </div>
                            <div class="flex flex-row gap-4">
                                <div class="max-h-min">
                                    <button wire:click="openCreateQtyConv({{$itemMulti->id}})" type="button" class="btn border-0 bg-sky-500 p-0 align-middle text-white focus:ring-2 focus:ring-sky-500/30 hover:bg-sky-600">
                                        <i class="bx bx-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                                        <span class="px-3 leading-[2.8]">Tambah Quantity Alias</span>
                                    </button>
                                </div>
                                <div class="max-h-min">
                                    <button wire:click="openCreateModal({{$itemMulti->id}})" type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
                                        <i class="bx bx-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                                        <span class="px-3 leading-[2.8]">Tambah Harga</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                       @endif

                   </div>
               </div>

               <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                   <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                       <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                           <tr>
                               <th scope="col" class="px-6 py-3 text-center">
                                   Jumlah
                               </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                   Harga Satuan
                               </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                    Harga Total
                                </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                   Persentase
                               </th>
                               <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                               </th>

                           </tr>
                       </thead>
                       <tbody>
                           @if ($itemMulti == null)
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="4" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else

                               @foreach ($itemMulti->prices->sortBy('quantity') as $key => $price)
                                   <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                        <td class="w-4 p-4 text-center">
                                            <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full"> {{$price->quantity}}</button>
                                        </td>
                                        <td class="w-4 p-4 text-center">
                                            <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full">Rp. {{number_format($price->price, 0,',', '.')}}</button>
                                        </td>
                                        <td class="w-4 p-4 text-center">
                                            <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full">Rp. {{number_format($price->price * $price->quantity, 0,',', '.')}}</button>
                                        </td>
                                        <td class="w-4 p-4 text-center">
                                            <button type="button" class="btn text-red-500 bg-red-50 border-red-50 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600 dark:focus:ring-red-500/10 dark:bg-red-500/20 dark:border-transparent">- {{$price->percentage}} %</button>

                                        </td>
                                        <td class="w-4 p-4 text-center">
                                            <button wire:click="openEditModal({{$price->id}})" type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600 scale-80"><i class="bx bx-edit bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Edit</span></button>

                                            <button wire:click="openDeleteModal({{$price->id}})" type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600 scale-80"><i class="bx bx-trash bg-white bg-opacity-20 w-10  h-full  text-16 py-3 align-middle rounded-l "></i><span class="px-3 leading-[2.8]">Hapus</span></button>
                                        </td>
                                   </tr>
                               @endforeach
                           @endif

                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </div>

   <div class="col-span-12">
    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
        <div class="card-body">
            <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                    <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                Nama Satuan
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                Jumlah
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                 Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (false)
                            <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                <td colspan="4" class="w-4 p-4 text-center">Tidak ada data</td>
                            </tr>
                        @else
                            @foreach ($qtyConverter as $key => $conv)
                                <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                     <td class="w-4 p-4 text-center">
                                         <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full"> {{$conv->name}}</button>
                                     </td>
                                     <td class="w-4 p-4 text-center">
                                        <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full"> {{$conv->quantity}}</button>
                                     </td>
                                     <td class="w-4 p-4 text-center">
                                         <button wire:click="openEditQtyConvModal({{$conv->id}})" type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600 scale-80"><i class="bx bx-edit bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Edit</span></button>

                                         <button wire:click="openDeleteQtyConvModal({{$conv->id}})" type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600 scale-80"><i class="bx bx-trash bg-white bg-opacity-20 w-10  h-full  text-16 py-3 align-middle rounded-l "></i><span class="px-3 leading-[2.8]">Hapus</span></button>
                                     </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</div>
