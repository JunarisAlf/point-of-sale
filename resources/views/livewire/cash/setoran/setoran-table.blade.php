<div class="grid grid-cols-12 gap-5">
    <div class="col-span-12 flex flex-row gap-4 print:hidden">
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
                    <div
                        class="mb-8 mt-4 grid grid-cols-1 items-end justify-between gap-4 p-2 print:hidden sm:grid-cols-6">
                        <div class="col-span-1 min-w-max sm:col-span-6">
                            <div class="flex flex-row items-center gap-2">
                                <label>Show</label>
                                <input
                                    class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100"
                                    type="number" name="paginate_count" wire:model.lazy="paginate_count"
                                    id="example-email-input">
                                <label>Of {{ $data_count }} Entries</label>
                            </div>
                        </div>

                        <div class="col-span-1 items-center sm:col-span-3">
                            <label for="countries"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Cabang</label>
                            <select id="countries"
                                class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                wire:model="cabang_id">
                                @if ($user->role === 'master')
                                    <option value="all">Semua Cabang</option>
                                    @foreach ($cabangSelect as $cabang)
                                        <option value="{{ $cabang->id }}">{{ $cabang->name }}</option>
                                    @endforeach
                                @else
                                    <option selected ="{{ $user->cabang->id }}">{{ $user->cabang->name }}</option>
                                @endif

                            </select>
                        </div>

                        <div class="col-span-1 items-center sm:col-span-3" wire:ignore>
                            <label for="range"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                            <input type="text"
                                class="form-control w-full rounded border-gray-100 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-gray-100"
                                id="datepicker-range" name="range">
                        </div>


                    </div>
                </div>


                <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll'
                    x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                    <table id="tbl_exporttable_to_xls" class="w-full min-w-max text-left text-sm text-gray-500">
                        <thead
                            class="bg-gray-50/50 text-xs uppercase text-gray-700 dark:bg-zinc-700 dark:text-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Tanggal Setoran
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Cabang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Keterangan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                   Jumlah Storan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jumlah Tercatan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center print:hidden">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($setorans->isEmpty())
                                <tr
                                    class="border-b border-zinc-100 bg-white hover:bg-zinc-100/50 dark:border-zinc-600 dark:bg-zinc-700/50">
                                    <td colspan="9" class="w-4 p-4 text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($setorans as $key => $setoran)
                                    <tr>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            <button type="button"
                                                class="btn w-full border-gray-50 bg-gray-50 text-gray-500 hover:border-gray-600 hover:bg-gray-600 hover:text-white focus:border-gray-600 focus:bg-gray-600 focus:text-white focus:ring focus:ring-gray-500/30 active:border-gray-600 active:bg-gray-600 dark:border-transparent dark:bg-gray-500/20 dark:focus:ring-gray-500/10">
                                                {{ Carbon\Carbon::parse($setoran->created_at)->format('d/m/Y H:i:s') }}</button>
                                        </td>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            {{$setoran->cabang->name}}
                                        </td>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            {{ $setoran->user->full_name }}
                                        </td>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            {{ $setoran->note }}
                                        </td>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            <button type="button"
                                                class="btn w-full border-violet-500 text-violet-500 hover:border-violet-600 hover:bg-violet-600 hover:text-white focus:border-violet-600 focus:bg-violet-600 focus:text-white focus:ring focus:ring-violet-500/30 active:border-violet-600 active:bg-violet-600">Rp.
                                                {{ number_format($setoran->total, 0, ',', '.') }}</button>
                                        </td>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            <button type="button"
                                                class="btn w-full border-red-500 text-red-500 hover:border-red-600 hover:bg-red-600 hover:text-white focus:border-red-600 focus:bg-red-600 focus:text-white focus:ring focus:ring-red-500/30 active:border-red-600 active:bg-red-600">Rp.
                                                {{ number_format($setoran->total_system, 0, ',', '.') }}</button>
                                        </td>
                                        <td class="w-4 min-w-max border-[1px] p-4 text-center print:hidden">
                                            <div class="flex flex-row gap-2">
                                                 <button wire:click="$emit('openEditModal', {{ $setoran->id }})"
                                                    type="button" class="btn border-yellow-500 bg-yellow-500 text-white hover:border-yellow-600 hover:bg-yellow-600 focus:border-yellow-600 focus:bg-yellow-600 focus:ring focus:ring-yellow-500/30 active:border-yellow-600 active:bg-yellow-600">
                                                    <i class="mdi mdi-pencil text-22 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                    <span class="align-middle">Edit</span>
                                                </button>
                                                <a target="_blank" href="{{route('admin.cash.setoranDetail', ['id' => $setoran->id])}}" class="btn border-green-500 bg-green-500 text-white hover:border-green-600 hover:bg-green-600 focus:border-green-600 focus:bg-green-600 focus:ring focus:ring-green-500/30 active:border-green-600 active:bg-green-600">
                                                    <i class="mdi mdi-eye text-22 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                    <span class="align-middle">Laporan</span>
                                                </a>
                                                <button wire:click="$emit('openDeleteModal', {{ $setoran->id }})"
                                                    type="button" class="btn border-red-500 bg-red-500 text-white hover:border-red-600 hover:bg-red-600 focus:border-red-600 focus:bg-red-600 focus:ring focus:ring-red-500/30 active:border-red-600 active:bg-red-600">
                                                    <i class="mdi mdi-delete text-22 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                    <span class="align-middle">Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-8 flex w-full justify-center print:hidden">
                    {{ $setorans->links() }}
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
                XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
        }
    </script>


</div>
