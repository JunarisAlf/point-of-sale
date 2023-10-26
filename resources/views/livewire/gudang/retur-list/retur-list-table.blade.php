<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12 print:hidden flex flex-row gap-4">
        <button id="print-btn" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bxs-file-pdf bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">PDF</span></button>
        <button onclick="ExportToExcel('xlsx')" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bx-table bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Excel</span></button>
    </div>
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="w-full overflow-x-auto ">
                   <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-8 mt-4 p-2 items-end justify-between print:hidden">
                       <div class="col-span-1 sm:col-span-6  min-w-max">
                           <div class="flex flex-row items-center gap-2">
                               <label>Show</label>
                               <input class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="number" name="paginate_count" wire:model.lazy="paginate_count" id="example-email-input">
                               <label>Of {{$data_count}} Entries</label>
                           </div>
                       </div>


                       <div class="col-span-1 items-center sm:col-span-2" wire:ignore>
                            <label for="range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Tanggal</label>
                            <input type="text" class="w-full border-gray-100 rounded form-control dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100" id="datepicker-range" name="range">
                        </div>

                       <div class="col-span-1 items-center sm:col-span-2  ">
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

                       <div class="col-span-1 items-center sm:col-span-2  ">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Jenis Retur</label>
                            <select  class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="type">
                                <option  value="ke-supplier">Retur Ke Supplier</option>
                                <option  value="dari-customer">Retur Dari Customer</option>
                            </select>
                        </div>
               </div>


               <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                   <table id="tbl_exporttable_to_xls" class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                       <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                           <tr>
                                <th scope="col" class="p-4 text-center">
                                    Jenis
                                </th>
                                <th scope="col" class="p-4 text-center">
                                   Catatan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Cabang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center print:hidden">
                                    Aksi
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                           @if ($returs->isEmpty())
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else

                               @foreach ($returs as $key => $retur)
                                   @php
                                       $tableNumber = ($page - 1) * $returs->perPage() + $loop->index + 1;
                                   @endphp
                                    <tr >
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            @if ($retur->type == 'ke-supplier')
                                                <button type="button" class="btn text-red-500 bg-red-50 border-red-50 hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600 dark:focus:ring-red-500/10 dark:bg-red-500/20 dark:border-transparent">Retur Ke Supplier</button>
                                            @else
                                                <button type="button" class="btn text-yellow-500 bg-yellow-50 hover:text-white border-yellow-50 hover:bg-yellow-600 focus:text-white hover:border-yellow-600 focus:bg-yellow-600 focus:border-yellow-600 focus:ring focus:ring-yellow-500/30 active:bg-yellow-600 active:border-yellow-600 dark:focus:ring-yellow-500/10 dark:bg-yellow-500/20 dark:border-transparent">Retur Dari Customer</button>
                                            @endif
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$retur->note}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            <button type="button" class="btn text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 dark:bg-gray-500/20 dark:focus:ring-gray-500/10 dark:border-transparent w-full"> {{Carbon\Carbon::parse($retur->created_at)->format('d/m/Y H:i')}}</button>
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$retur->cabang->name}}
                                        </td>



                                        <td class="w-4 p-4 text-center border-[1px] print:hidden">
                                            <div class="flex flex-row gap-2 min-w-max">
                                                <button wire:click="$emit('openDetailModal', {{$retur->id}})" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600"><i class="mdi mdi-eye-outline text-22 align-middle ltr:mr-1 rtl:ml-1 "></i><span class="align-middle">Detail</span></button>
                                            </div>
                                        </td>
                                    </tr>
                               @endforeach
                           @endif
                       </tbody>
                   </table>
               </div>
               <div class="mt-8 w-full flex justify-center">
                   {{$returs->links()}}
               </div>
           </div>
       </div>
   </div>
   <script>
    let printBtn = document.getElementById('print-btn');
        printBtn.addEventListener('click', function(){
            window.print();
        })
        function ExportToExcel(type, fn, dl) {
            let elt = document.getElementById('tbl_exporttable_to_xls');
            let wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
            return dl ?
                XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
                XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
    </script>


</div>
