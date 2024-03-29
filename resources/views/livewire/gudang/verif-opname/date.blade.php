<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12 print:hidden">
        <button id="print-btn" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bxs-file-pdf bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">PDF</span></button>
        <button onclick="ExportToExcel('xlsx')" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bx-table bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Excel</span></button>
    </div>
    <div class="col-span-12">
       <div class="card dark:bg-zinc-800 dark:border-zinc-600">
        <div class="card-body pb-0">
            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100 font-bold">Tanggal Stock Opname</h6>
        </div>
        <div class="card-body">
            <div class="w-full overflow-x-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 mb-8 mt-4 p-2 items-end justify-between print:hidden">

                    <div class="col-span-1  min-w-max">
                        <div class="flex flex-row items-center gap-2">
                            <label>Show</label>
                            <input class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="number" name="paginate_count" wire:model.lazy="paginate_count" id="example-email-input">
                            <label>Of {{$data_count}} Entries</label>
                        </div>
                    </div>

                    <div class="col-span-1 items-center ">
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
                <table id="tbl_exporttable_to_xls" class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                    <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                        <tr>
                             <th scope="col" class="p-4 text-center">
                                Nomor
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                Tanggal Opname
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                 Total Check
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                ACC
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                Non-ACC
                             </th>
                             <th scope="col" class="px-6 py-3 text-center">
                                Kerugian Total
                             </th>
                             <th scope="col" class="px-6 py-3 text-center print:hidden">
                                 Aksi
                             </th>

                        </tr>
                    </thead>
                    <tbody>
                        @if ($opnames->isEmpty())
                            <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                <td colspan="6" class="w-4 p-4 text-center">Tidak ada data</td>
                            </tr>
                        @else

                            @foreach ($opnames as $key => $opname)
                                @php
                                    $tableNumber = ($page - 1) * $opnames->perPage() + $loop->index + 1;
                                @endphp
                                 <tr >
                                     <td class="w-4 p-4 text-center border-[1px] ">
                                         {{$tableNumber}}
                                     </td>

                                     <td class="px-6 py-4 dark:text-zinc-100/80  w-[350px] border-[1px]">
                                         <button type="button" class="btn text-gray-500 hover:text-white border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:text-white focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 w-full text-start">{{Carbon\Carbon::parse($opname->date)->format('d/m/Y')}}</button>
                                     </td>

                                     <td class="px-6 py-4 dark:text-zinc-100/80  border-[1px]">
                                        <button type="button" class="btn text-sky-500 hover:text-white border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:text-white focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 w-full text-center text-center">{{$opname->item_checked}}</button>
                                     </td>

                                     <td class="px-6 py-4 dark:text-zinc-100/80  border-[1px]">
                                        <button type="button" class="btn text-green-500 hover:text-white border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:text-white focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 w-full text-center">{{$opname->is_acc_true}}</button>
                                     </td>

                                     <td class="px-6 py-4 dark:text-zinc-100/80  border-[1px]">
                                        <button type="button" class="btn text-red-500 hover:text-white border-red-500 hover:bg-red-600 hover:border-red-600 focus:bg-red-600 focus:text-white focus:border-red-600 focus:ring focus:ring-red-500/30 active:bg-red-600 active:border-red-600 w-full text-center">{{$opname->is_acc_false}}</button>
                                     </td>
                                     <td class="px-6 py-4 dark:text-zinc-100/80  border-[1px]">
                                        @if ($opname->diff_price_total >= 0 )
                                            <button type="button" class="btn text-green-800 bg-green-50 hover:text-white border-green-50 hover:bg-green-900 focus:text-white hover:border-green-900 focus:bg-green-900 focus:border-green-900 focus:ring focus:ring-green-500/30 active:bg-green-900 active:border-green-900 dark:focus:ring-green-500/10 dark:bg-green-500/20 dark:border-transparent w-full">{{number_format($opname->diff_price_total, 0, ',', '.')}}</button>
                                        @else
                                            <button type="button" class="btn text-red-800 bg-red-50 hover:text-white border-red-50 hover:bg-red-900 focus:text-white hover:border-red-900 focus:bg-red-900 focus:border-red-900 focus:ring focus:ring-red-500/30 active:bg-red-900 active:border-red-900 dark:focus:ring-red-500/10 dark:bg-red-500/20 dark:border-transparent w-full">{{number_format($opname->diff_price_total, 0, ',', '.')}}</button>
                                        @endif
                                     </td>
                                     <td class="px-6 py-4 dark:text-zinc-100/80  border-[1px] flex flex-row justify-center print:hidden">
                                        <button wire:click="detail('{{$opname->date}}')" type="button" class="btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600"><i class="mdi mdi-eye-outline text-16 align-middle ltr:mr-1 rtl:ml-1 "></i><span class="align-middle">Detail</span></button>
                                     </td>

                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
            <div class="mt-8 w-full flex justify-center print:hidden">
                {{$opnames->links()}}
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
                XLSX.writeFile(wb, fn || ('Verif Opname.' + (type || 'xlsx')));
        }
    </script>
</div>
