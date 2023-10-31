<div class="grid grid-cols-12 gap-5">
    <div class="col-span-12">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800">
            <div class="card-body">
                <div class="w-full overflow-x-auto">
                    <div class="mb-8 mt-4 grid grid-cols-1 items-end justify-between gap-4 p-2 sm:grid-cols-6">

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
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Status
                                Transfer</label>
                            <select id="countries"
                                class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                wire:model="status">
                                <option value="0">Belum Di Proses</option>
                                <option value="1">Sudah Diterima</option>
                                <option value="2">Sudah Ditolak</option>

                            </select>
                        </div>

                        <div class="col-span-1 items-center sm:col-span-3">
                            <label for="countries"
                                class="mb-2 mr-3 block text-sm font-medium text-gray-900 dark:text-white">Cabang
                                Penerima</label>
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

                    </div>
                </div>


                <div class="relative overflow-x-auto overscroll-x-auto" x-data='overscroll'
                    x-on:mouseover="enableHorizontalScroll($el)" x-on:mouseout="disableHorizontalScroll($el)">
                    <table class="w-full text-left text-sm text-gray-500" style="min-width: max-content">
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
                                    Jumlah
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Di Transfer
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Dari
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Ke
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Di Terima/Di Tolak
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($items->isEmpty())
                                <tr
                                    class="border-b border-zinc-100 bg-white hover:bg-zinc-100/50 dark:border-zinc-600 dark:bg-zinc-700/50">
                                    <td colspan="9" class="w-4 p-4 text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($items as $key => $item)
                                    @php
                                        $tableNumber = ($page - 1) * $items->perPage() + $loop->index + 1;
                                    @endphp
                                    <tr>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            {{ $tableNumber }}
                                        </td>
                                        <td class="w-[350px] border-[1px] px-6 py-4 dark:text-zinc-100/80">
                                            <button type="button"
                                                class="btn w-full border-gray-500 text-start text-gray-500 hover:border-gray-600 hover:bg-gray-600 hover:text-white focus:border-gray-600 focus:bg-gray-600 focus:text-white focus:ring focus:ring-gray-500/30 active:border-gray-600 active:bg-gray-600">{{ $item->item->barcode }}
                                                - {{ $item->item->name }}
                                            </button>
                                        </td>
                                        <td class="border-[1px] px-6 py-4 text-center dark:text-zinc-100/80">
                                            {{ $item->item->has_expired && $item->stock->expired_date != null ? Carbon\Carbon::parse($item->stock->expired_date)->format('d/m/Y ') : '-' }}
                                        </td>

                                        <td class="border-[1px] px-6 py-4 text-center dark:text-zinc-100/80">
                                            <button type="button"
                                                class="btn w-full border-neutral-50 bg-neutral-50 text-neutral-800 hover:border-neutral-900 hover:bg-neutral-900 hover:text-white focus:border-neutral-900 focus:bg-neutral-900 focus:text-white focus:ring focus:ring-neutral-500/30 active:border-neutral-900 active:bg-neutral-900 dark:border-transparent dark:bg-neutral-500/20 dark:focus:ring-neutral-500/10">{{ $item->quantity }}
                                            </button>
                                        </td>
                                        <td class="border-[1px] px-6 py-4 text-center dark:text-zinc-100/80">
                                            {{ Carbon\Carbon::parse($item->created_at)->format('d/m/Y ')}}
                                        </td>
                                        <td class="border-[1px] px-6 py-4 text-center dark:text-zinc-100/80">
                                            {{ $item->fromCabang->name}}
                                        </td>
                                        <td class="border-[1px] px-6 py-4 text-center dark:text-zinc-100/80">
                                            {{ $item->toCabang->name}}
                                        </td>
                                        <td class="border-[1px] px-6 py-4 text-center dark:text-zinc-100/80">
                                            {{ $item->is_acc ? Carbon\Carbon::parse($item->updated_at)->format('d/m/Y ') : '-'}}
                                        </td>
                                        <td class="border-[1px] px-6 py-4 text-center dark:text-zinc-100/80">
                                            @if($item->is_acc == false)
                                                @if ($item->is_reject == false)
                                                    <button wire:click="openAccModal({{ $item->id }})"
                                                        type="button"
                                                        class="btn border-green-500 bg-green-500 text-white hover:border-green-600 hover:bg-green-600 focus:border-green-600 focus:bg-green-600 focus:ring focus:ring-green-500/30 active:border-green-600 active:bg-green-600">
                                                        <i class="bx bx-check text-16 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                        <span class="align-middle">Terima</span>
                                                    </button>
                                                @endif
                                            @else
                                                <button
                                                    type="button"
                                                    class="btn border-green-300 bg-green-300 text-white hover:border-green-300 hover:bg-green-300 focus:border-green-300 focus:bg-green-300 focus:ring focus:ring-green-300/30 active:border-green-300 active:bg-green-300">
                                                    <i class="bx bx-check text-16 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                    <span class="align-middle">Sudah Diterima</span>
                                                </button>
                                            @endif

                                            @if($item->is_reject == false)
                                                @if ($item->is_acc == false)
                                                    <button wire:click="openRejectModal({{ $item->id }})"
                                                        type="button"
                                                        class="btn border-red-500 bg-red-500 text-white hover:border-red-600 hover:bg-red-600 focus:border-red-600 focus:bg-red-600 focus:ring focus:ring-red-500/30 active:border-red-600 active:bg-red-600">
                                                        <i class="bx bx-x-circle text-16 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                        <span class="align-middle">Tolak</span>
                                                    </button>
                                                @endif
                                            @else
                                                <button
                                                    type="button"
                                                    class="btn border-red-300 bg-red-300 text-white hover:border-red-300 hover:bg-red-300 focus:border-red-300 focus:bg-red-300 focus:ring focus:ring-red-300/30 active:border-red-300 active:bg-red-300">
                                                    <i class="bx bx-x-circle text-16 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                    <span class="align-middle">Sudah Ditolak</span>
                                                </button>
                                            @endif

                                            {{-- <button wire:click="openRejectModal({{ $item->id }})"
                                                type="button"
                                                class="btn border-red-500 bg-red-500 text-white hover:border-red-600 hover:bg-red-600 focus:border-red-600 focus:bg-red-600 focus:ring focus:ring-red-500/30 active:border-red-600 active:bg-red-600">
                                                <i class="bx bx-check text-16 align-middle ltr:mr-1 rtl:ml-1"></i>
                                                <span class="align-middle">Tolak</span>
                                            </button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="mt-8 flex w-full justify-center">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>



</div>
