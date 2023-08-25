<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                   <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                       <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                           <tr>
                                <th scope="col" class="p-4 text-center">
                                   Nomor
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Jumlah Pembelian
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
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                           @if (count($items) == 0)
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else
                               @foreach ($items as $key => $item)
                                    <tr >
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$key+1}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$item['name']}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            @php
                                                $satuan = App\Models\QtyConverter::find($item['satuan_id']);
                                            @endphp
                                            <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">
                                                {{$item['quantity']}} {{$satuan->name}} ({{$item['quantity'] * $satuan->quantity}})
                                            </button>

                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            Rp. {{number_format($item['price'], 0, ',', '.')}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            - Rp. {{number_format($item['discount'], 0, ',', '.')}}
                                            <button type="button" class="btn text-red-500 bg-red-50 border-red-50 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600 dark:focus:ring-red-500/10 dark:bg-red-500/20 dark:border-transparent">-{{$item['percentage']}}%</button>
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            Rp. {{number_format($item['total_price'], 0, ',', '.')}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            <button wire:click="removeItem({{$item['id']}})" type="button" class="btn text-white bg-red-500 border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600"><i class="bx bx-trash text-16 align-middle"></i></button>
                                        </td>
                                    </tr>
                               @endforeach
                           @endif
                       </tbody>
                   </table>
               </div>
                @if (count($items) !== 0)
                    <button type="button" wire:click="store" class="w-full mt-4 btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600"><i class="bx bx-check-double text-16 align-middle ltr:mr-1 rtl:ml-1 "></i><span class="align-middle">Simpan</span></button>
                @endif
           </div>
       </div>
   </div>
</div>
