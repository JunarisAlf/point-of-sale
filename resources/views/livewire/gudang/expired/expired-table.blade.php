<div class="grid grid-cols-12 gap-5">
    <div class="col-span-12 print:hidden">
        <button id="print-btn" type="button"
            class="btn border-0 bg-gray-50 p-0 align-middle text-black hover:bg-neutral-800 focus:ring-2 focus:ring-neutral-500/30"><i
                class="bx bxs-file-pdf text-16 h-full w-14 rounded-l bg-black bg-opacity-10 py-3 align-middle"></i><span
                class="px-3 leading-[2.8]">PDF</span></button>
        <button onclick="ExportToExcel('xlsx')" type="button"
            class="btn border-0 bg-gray-50 p-0 align-middle text-black hover:bg-neutral-800 focus:ring-2 focus:ring-neutral-500/30"><i
                class="bx bx-table text-16 h-full w-14 rounded-l bg-black bg-opacity-10 py-3 align-middle"></i><span
                class="px-3 leading-[2.8]">Excel</span></button>
    </div>
    <div class="col-span-12">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800">
            <div class="card-body">
                <div class="w-full overflow-x-auto">
                    <div class="mb-8 mt-4 grid grid-cols-1 items-end justify-between gap-4 p-2 print:hidden sm:grid-cols-8">
                        <div class="col-span-1 min-w-max sm:col-span-8">
                            <div class="flex flex-row items-center gap-2">
                                <label>Show</label>
                                <input
                                    class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100"
                                    type="number" name="paginate_count" wire:model.lazy="paginate_count"
                                    id="example-email-input">
                                <label>Of {{ $data_count }} Entries</label>
                            </div>
                        </div>

                        <div class="col-span-1 items-center sm:col-span-2">
                            <label for="countries"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Urutkan</label>
                            <select id="countries"
                                class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                wire:model="shortField">
                                @foreach ($shortableField as $key => $short)
                                    <option value="{{ $key }}">{{ $short['label'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-1 sm:col-span-2">
                            <div class="flex">
                                <button style="z-index: 0 !important" id="dropdown-button"
                                    data-dropdown-toggle="dropdown"
                                    class="z-10 inline-flex flex-shrink-0 items-center rounded-l-lg border border-gray-300 bg-white px-4 py-2.5 text-center text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-zinc-700 dark:text-white dark:hover:bg-zinc-600 dark:focus:ring-gray-700"
                                    type="button">{{ $searchableField[$searchField]['label'] }}<svg
                                        class="ml-2.5 h-2.5 w-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <div id="dropdown"
                                    class="z-10 hidden w-44 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700">
                                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdown-button">
                                        @foreach ($searchableField as $key => $field)
                                            <li>
                                                <button wire:click="searchFieldChange('{{ $key }}')"
                                                    type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $field['label'] }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="relative w-full">
                                    <input wire:model="searchQuery" type="search" id="search-dropdown"
                                        class="z-20 block w-full rounded-r-lg border border-l-2 border-gray-300 border-l-zinc-100 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:border-l-gray-700 dark:bg-zinc-500 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500"
                                        placeholder="Pencarian" required>
                                    <button type="button"
                                        class="absolute right-0 top-0 h-full rounded-r-lg border border-blue-700 bg-blue-700 p-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                        {{-- <span class="sr-only">Search</span> --}}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1 items-center sm:col-span-2">
                            <label for="countries"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Cabang</label>
                            <select id="countries"
                                class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                wire:model="cabang_id">
                                @if ($user->role === 'master')
                                    @foreach ($cabangSelect as $cabang)
                                        <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                                    @endforeach
                                @else
                                    <option selected ="{{ $user->cabang->id }}">{{ $user->cabang->name }}</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-span-2 items-center sm:col-span-2">
                            <label for="countries"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Hitung
                                Mundur</label>
                            <select
                                class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                wire:model="countdown">
                                @foreach ($countDowns as $countDown)
                                    <option value="{{ $countDown['days'] }}">{{ $countDown['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll'
                    x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                    <table id="tbl_exporttable_to_xls" class="w-full text-left text-sm text-gray-500"
                        style="min-width: max-content">
                        <thead
                            class="bg-gray-50/50 text-xs uppercase text-gray-700 dark:bg-zinc-700 dark:text-gray-100">
                            <tr>
                                <th scope="col" class="p-4 text-center">
                                    Nomor
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Item
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Expired Date
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Hitung Mundur
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Total Stock
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($items->isEmpty())
                                <tr
                                    class="border-b border-zinc-100 bg-white hover:bg-zinc-100/50 dark:border-zinc-600 dark:bg-zinc-700/50">
                                    <td colspan="6" class="w-4 p-4 text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($items as $key => $item)
                                    @php
                                        $tableNumber = ($page - 1) * $items->perPage() + $loop->index + 1;
                                        $stocks_count = $item->stocks->count();
                                    @endphp
                                    <tr>
                                        <td class="w-4 border-[1px] p-4 text-center"
                                            rowspan="{{ $item->stocks->count() }}">
                                            {{ $tableNumber }}
                                        </td>
                                        <td class="w-[350px] border-[1px] px-2 dark:text-zinc-100/80"
                                            rowspan="{{ $item->stocks->count() }}">
                                            <button type="button"
                                                class="btn w-full border-gray-500 text-start text-gray-500 hover:border-gray-600 hover:bg-gray-600 hover:text-white focus:border-gray-600 focus:bg-gray-600 focus:text-white focus:ring focus:ring-gray-500/30 active:border-gray-600 active:bg-gray-600">{{ $item->name }}</button>
                                        </td>
                                        @if ($stocks_count > 0)
                                            <td class="border-[1px] px-2 text-center dark:text-zinc-100/80">
                                                @if ($user->role == 'master' || $user->role == 'gudang')
                                                    <div wire:click="$emit('openExpDateEditModal', {{ $item->stocks[0]->id }})"
                                                        class="mr-2 inline cursor-pointer rounded-sm bg-yellow-500 p-1 hover:bg-yellow-600 print:hidden">
                                                        <span class="mdi mdi-calendar-edit text-white"></span>
                                                    </div>
                                                @endif
                                                {{ $item->stocks[0]->expired_date != null ? Carbon\Carbon::parse($item->stocks[0]->expired_date)->format('d/m/Y ') : '-' }}
                                            </td>
                                            <td class="border-[1px] px-2 text-center dark:text-zinc-100/80">
                                                <div class="flex items-center dark:text-zinc-100/80">
                                                    @php
                                                        $diffMonth = Carbon\Carbon::parse($item->stocks[0]->expired_date)->diffInMonths();
                                                    @endphp
                                                    @if ($item->stocks[0]->expired_date != null)
                                                        @if ($diffMonth <= 1)
                                                            <div
                                                                class="h-2.5 w-2.5 rounded-full bg-red-500 ltr:mr-2 rtl:ml-2 print:hidden">
                                                            </div>
                                                        @elseif($diffMonth > 1 && $diffMonth < 3)
                                                            <div
                                                                class="h-2.5 w-2.5 rounded-full bg-yellow-500 ltr:mr-2 rtl:ml-2 print:hidden">
                                                            </div>
                                                        @elseif($diffMonth >= 3)
                                                            <div
                                                                class="h-2.5 w-2.5 rounded-full bg-green-500 ltr:mr-2 rtl:ml-2 print:hidden">
                                                            </div>
                                                        @endif
                                                        {{ Carbon\Carbon::parse($item->stocks[0]->expired_date)->diffForHumans() }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="border-[1px] text-center dark:text-zinc-100/80">
                                                <button type="button"
                                                    class="btn w-full border-neutral-50 bg-neutral-50 text-neutral-800 hover:border-neutral-900 hover:bg-neutral-900 hover:text-white focus:border-neutral-900 focus:bg-neutral-900 focus:text-white focus:ring focus:ring-neutral-500/30 active:border-neutral-900 active:bg-neutral-900 dark:border-transparent dark:bg-neutral-500/20 dark:focus:ring-neutral-500/10">{{ $item->stocks[0]->quantity }}</button>
                                            </td>
                                        @endif
                                        <td class="border-[1px] px-4 dark:text-zinc-100/80"
                                            rowspan="{{ $item->stocks->count() }}">
                                            @if ($item->quantity_sum <= 10)
                                                <button type="button"
                                                    class="btn w-full border-red-500 text-center text-red-500 hover:border-red-600 hover:bg-red-600 hover:text-white focus:border-red-600 focus:bg-red-600 focus:text-white focus:ring focus:ring-red-500/30 active:border-red-600 active:bg-red-600">{{ $item->quantity_sum }}</button>
                                            @elseif($item->quantity_sum > 10 && $item->quantity_sum < 50)
                                                <button type="button"
                                                    class="btn w-full border-yellow-500 text-center text-yellow-500 hover:border-yellow-600 hover:bg-yellow-600 hover:text-white focus:border-yellow-600 focus:bg-yellow-600 focus:text-white focus:ring focus:ring-yellow-500/30 active:border-yellow-600 active:bg-yellow-600">{{ $item->quantity_sum }}</button>
                                            @elseif($item->quantity_sum >= 50)
                                                <button type="button"
                                                    class="btn w-full border-sky-500 text-center text-sky-500 hover:border-sky-600 hover:bg-sky-600 hover:text-white focus:border-sky-600 focus:bg-sky-600 focus:text-white focus:ring focus:ring-sky-500/30 active:border-sky-600 active:bg-sky-600">{{ $item->quantity_sum }}</button>
                                            @endif

                                        </td>
                                    </tr>
                                    @if ($stocks_count > 1)
                                        @for ($i = 1; $i < $stocks_count; $i++)
                                            </tr>
                                            <td class="border-[1px] px-2 text-center dark:text-zinc-100/80">
                                                @if ($user->role == 'master' || $user->role == 'gudang')
                                                    <div wire:click="$emit('openExpDateEditModal', {{ $item->stocks[$i]->id }})"
                                                        class="mr-2 inline cursor-pointer rounded-sm bg-yellow-500 p-1 hover:bg-yellow-600 print:hidden">
                                                        <span class="mdi mdi-calendar-edit text-white"></span>
                                                    </div>
                                                @endif
                                                {{ $item->stocks[$i]->expired_date != null ? Carbon\Carbon::parse($item->stocks[$i]->expired_date)->format('d/m/Y ') : '-' }}
                                            </td>
                                            <td class="border-[1px] px-2 text-center dark:text-zinc-100/80">
                                                <div class="flex items-center dark:text-zinc-100/80">
                                                    @php
                                                        $diffMonth = Carbon\Carbon::parse($item->stocks[$i]->expired_date)->diffInMonths();
                                                    @endphp
                                                    @if ($item->stocks[$i]->expired_date != null)
                                                        @if ($diffMonth <= 1)
                                                            <div
                                                                class="h-2.5 w-2.5 rounded-full bg-red-500 ltr:mr-2 rtl:ml-2 print:hidden">
                                                            </div>
                                                        @elseif($diffMonth > 1 && $diffMonth < 3)
                                                            <div
                                                                class="h-2.5 w-2.5 rounded-full bg-yellow-500 ltr:mr-2 rtl:ml-2 print:hidden">
                                                            </div>
                                                        @elseif($diffMonth >= 3)
                                                            <div
                                                                class="h-2.5 w-2.5 rounded-full bg-green-500 ltr:mr-2 rtl:ml-2 print:hidden">
                                                            </div>
                                                        @endif
                                                        {{ Carbon\Carbon::parse($item->stocks[$i]->expired_date)->diffForHumans() }}
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="border-[1px] text-center dark:text-zinc-100/80">
                                                <button type="button"
                                                    class="btn w-full border-neutral-50 bg-neutral-50 text-neutral-800 hover:border-neutral-900 hover:bg-neutral-900 hover:text-white focus:border-neutral-900 focus:bg-neutral-900 focus:text-white focus:ring focus:ring-neutral-500/30 active:border-neutral-900 active:bg-neutral-900 dark:border-transparent dark:bg-neutral-500/20 dark:focus:ring-neutral-500/10">{{ $item->stocks[$i]->quantity }}</button>
                                            </td>
                                            </tr>
                                        @endfor
                                    @endif
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="mt-8 flex w-full justify-center print:hidden">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        let printBtn = document.getElementById('print-btn');
        printBtn.addEventListener('click', function() {
            window.print();
        })

        function ExportToExcel(type, fn, dl) {
            let elt = document.getElementById('tbl_exporttable_to_xls');
            let wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Expired Date.' + (type || 'xlsx')));
        }
    </script>

</div>
