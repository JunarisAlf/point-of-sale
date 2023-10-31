<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12 print:hidden">
        <button id="print-btn" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bxs-file-pdf bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">PDF</span></button>
        <button onclick="ExportToExcel('xlsx')" type="button" class="btn border-0 bg-gray-50 p-0 align-middle text-black focus:ring-2 focus:ring-neutral-500/30 hover:bg-neutral-800"><i class="bx bx-table bg-black bg-opacity-10 w-14 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Excel</span></button>
    </div>
     <div class="col-span-12">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body">
                <div class="w-full overflow-x-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-8 mt-4 p-2 items-end justify-between print:hidden">

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

                        <div class="col-span-1 sm:col-span-3 ">
                            <div class="flex">
                                <button  style="z-index: 0 !important" id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600" type="button">{{$searchableField[$searchField]['label']}}<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/> </svg>
                                </button>
                                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                                        @foreach ($searchableField as $key => $field)
                                            <li>
                                                <button wire:click="searchFieldChange('{{$key}}')" type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{$field['label']}}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
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
                                @if ($user->role === 'master')
                                    @foreach ($cabangSelect as $cabang)
                                        <option  value="{{$cabang->id}}">{{$cabang->name}}</option>
                                    @endforeach
                                @else
                                    <option  selected ="{{$user->cabang->id}}">{{$user->cabang->name}}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-span-1 sm:col-span-2 items-center ">
                            <label for="category-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Kategori</label>
                            <div wire:ignore>
                                <select  class="" data-trigger name="category_id"   placeholder="This is a search placeholder" id="category-select" wire:model="category_id">
                                    <option  selected>Pilih Kategori</option>
                                    <option  value="all">Semua Kategori</option>
                                    @foreach ($categorySelect as $category)
                                        <option  value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>


                        <div class="col-span-1 items-center sm:col-span-2  ">
                            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Expired</label>
                            <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="has_expired">
                                <option value="all">Semua</option>
                                <option value="0">Non-Expiredable</option>
                                <option value="1">Expiredable</option>
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
                                    Item
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Kategory
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jenis
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Stock
                                </th>
                                @if ($user == 'master' || $user == 'gudang')
                                <th scope="col" class="px-6 py-3 text-center">
                                    Modal
                                </th>
                                @endif
                                <th scope="col" class="px-6 py-3 text-center">
                                    Harga Jual
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($items->isEmpty())
                                <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                    <td colspan="6" class="w-4 p-4 text-center">Tidak ada data</td>
                                </tr>
                            @else

                                @foreach ($items as $key => $item)
                                    @php
                                        $tableNumber = ($page - 1) * $items->perPage() + $loop->index + 1;
                                    @endphp
                                    <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                        <td class="w-4 p-4 text-center">
                                            {{$tableNumber}}
                                        </td>
                                        <td class="px-2 dark:text-zinc-100/80  w-[350px]">
                                            <button type="button" class="btn text-gray-500 hover:text-white border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:text-white focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600 w-full text-start">{{$item->name}}</button>
                                        </td>
                                        <td class="px-2 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-green-500 hover:text-white border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:text-white focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600   w-full">{{$item->category->name}}</button>

                                        </td>
                                        <td class="px-2 dark:text-zinc-100/80 text-center">
                                            @if ($item->has_expired)
                                                <button type="button" class="btn text-green-500 bg-green-50 border-green-50 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 dark:focus:ring-green-500/10 dark:bg-green-500/20 dark:border-transparent w-full">Expiredable</button>
                                            @else
                                                <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent w-full">Non-Expiredable</button>
                                            @endif
                                        </td>
                                        <td class="px-2 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-neutral-800 bg-neutral-50 hover:text-white border-neutral-50 hover:bg-neutral-900 focus:text-white hover:border-neutral-900 focus:bg-neutral-900 focus:border-neutral-900 focus:ring focus:ring-neutral-500/30 active:bg-neutral-900 active:border-neutral-900 dark:focus:ring-neutral-500/10 dark:bg-neutral-500/20 dark:border-transparent w-full"> {{$item->quantity_sum}}</button>
                                        </td>
                                        @if ($user->role == 'master' || $user->role == 'gudang')
                                        <td class="px-2 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-sky-500 hover:text-white border-sky-500 hover:bg-sky-600 hover:border-sky-600 focus:bg-sky-600 focus:text-white focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 w-full">Rp. {{number_format($item->stocks->avg('buying_price'), 0, ',', '.')}}</button>
                                        </td>
                                        @endif
                                        <td class="px-2 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full flex flex-row items-start justify-center">
                                                Rp. {{number_format($item->selling_price, 0, ',', '.')}}
                                                @if ($user->role == 'master' || $user->role == 'gudang')
                                                <span class="text-red-500 text-xs">
                                                    +{{
                                                       intval( safeDivision($item->selling_price - $item->stocks->avg('buying_price') , $item->stocks->avg('buying_price')) * 100)
                                                        }}%
                                                </span>
                                                @endif
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="mt-8 w-full flex justify-center print:hidden">
                    {{$items->links()}}
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
                XLSX.writeFile(wb, fn || ('Stok.' + (type || 'xlsx')));
        }
    </script>


</div>
