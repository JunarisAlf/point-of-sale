<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12 print:hidden flex flex-row gap-4">
        <button id="print-btn" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bxs-file-pdf bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">PDF</span></button>
        <button onclick="ExportToExcel('xlsx')" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bx-table bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Excel</span></button>
    </div>
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
           <div class="card-body">
               <div class="w-full overflow-x-auto print:hidden">
                   <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-8 mt-4 p-2 items-end justify-between">
                       <div class="col-span-1 sm:col-span-6  min-w-max">
                           <div class="flex flex-row items-center gap-2">
                               <label>Show</label>
                               <input class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="number" name="paginate_count" wire:model.lazy="paginate_count" id="example-email-input">
                               <label>Of {{$data_count}} Entries</label>
                           </div>
                       </div>

                       <div class="col-span-1 sm:col-span-3 items-center ">
                           <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Urutkan</label>
                           <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="shortField">
                               @foreach ($shortableField as $key => $short)
                                   <option value="{{$key}}">{{$short['label']}}</option>
                               @endforeach
                           </select>
                       </div>

                       <div class="col-span-1 items-center sm:col-span-3  ">
                           <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Cabang</label>
                           <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="cabang_id">
                               @foreach ($cabangSelect as $cabang)
                                   <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                               @endforeach
                           </select>
                       </div>

                        <div class="col-span-1 items-center sm:col-span-3" wire:ignore>
                            <label for="range" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Tanggal</label>
                            <input type="text" class="w-full border-gray-100 rounded form-control dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100" id="datepicker-range" name="range">
                        </div>

                       <div class="col-span-1 sm:col-span-3 ">
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
                    </div>
               </div>


               <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll' x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                   <table  id="tbl_exporttable_to_xls" class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                       <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                           <tr>
                                <th scope="col" class="p-4 text-center">
                                   Nomor
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Tanggal Pembelian
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jenis
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Total Bayar
                                </th>
                                <th scope="col" class="px-6 py-3 text-center  print:hidden">
                                    Aksi
                                </th>
                           </tr>
                       </thead>
                       <tbody>
                           @if ($sells->isEmpty())
                               <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                   <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                               </tr>
                           @else

                               @foreach ($sells as $key => $sell)
                                   @php
                                       $tableNumber = ($page - 1) * $sells->perPage() + $loop->index + 1;
                                   @endphp
                                    <tr >
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$tableNumber}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            <button type="button" class="btn text-gray-500 bg-gray-50 border-gray-50 hover:text-white hover:bg-gray-600 hover:border-gray-600 focus:text-white focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 dark:bg-gray-500/20 dark:focus:ring-gray-500/10 dark:border-transparent w-full"> {{Carbon\Carbon::parse($sell->date)->format('d/m/Y H:i:s')}}</button>
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            {{$sell->jenis}}
                                        </td>
                                        <td class="w-4 p-4  border-[1px] ">
                                            {{$sell->note}}
                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px] ">
                                            <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full">Rp. {{number_format($sell->total, 0, ',', '.')}}</button>

                                        </td>
                                        <td class="w-4 p-4 text-center border-[1px]  print:hidden">
                                            <div class="flex flex-row gap-2 justify-center">
                                                <button wire:click="openDetailModal({{$sell->id}})" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600"><i class="mdi mdi-eye-outline text-22 align-middle ltr:mr-1 rtl:ml-1 "></i><span class="align-middle">Detail</span></button>
                                                {{-- <div class="btn text-white bg-green-500 border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600"><i class="mdi mdi-receipt-text-check-outline text-22 align-middle ltr:mr-1 rtl:ml-1 "></i>
                                                    <a class="align-middle" href="{{route('receipt', ['id' => $sell->id ])}}" target="_blank">Struk Belanja</a>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                               @endforeach
                           @endif
                       </tbody>
                   </table>
               </div>
               <div class="mt-8 w-full flex justify-center print:hidden">
                   {{$sells->links()}}
               </div>
           </div>
           <div class="card-header border-t border-gray-50 p-5 dark:border-zinc-600 flex flex-row justify-between px-8">
                <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">Total (Rp.)</h5>
                <h5 class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">{{number_format($sells->sum('total'), 0, ',', '.') }}</h5>
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
