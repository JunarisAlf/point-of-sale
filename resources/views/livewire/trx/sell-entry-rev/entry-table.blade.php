<div class="grid grid-cols-12 gap-5">
    <div class="col-span-12">
        <div class="card dark:border-zinc-600 dark:bg-zinc-800">
            <div class="card-body">
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
                                    Nama Barang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Stok Gudang
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Jumlah Pembelian
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Satuan
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Harga Satuan (Rp.)
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
                                <tr
                                    class="border-b border-zinc-100 bg-white hover:bg-zinc-100/50 dark:border-zinc-600 dark:bg-zinc-700/50">
                                    <td colspan="7" class="w-4 p-4 text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td class="border-[1px] p-2 text-center">
                                            {{ $key + 1 }}
                                        </td>
                                        <td class="border-[1px] p-4 text-center font-bold">
                                            {{ $item['name'] }}
                                        </td>
                                        <td class="border-[1px] p-4 text-center font-bold">
                                            <span class="text-pink-500 mt-2 text-lg">{{@$item['stock']}}</span>
                                        </td>
                                        <td class="w-[150px] border-[1px] text-center">
                                            <div>
                                                <input name="quantity"
                                                    class="@error('quantity-{{ $key }}') border-red-500 @enderror w-[80px] rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100"
                                                    wire:model="items.{{ $key }}.quantity" type="number"
                                                    min="1">
                                                <span class="text-pink-500 font-bold text-lg pl-2">{{$item['converted_qty']}}</span>
                                                @error('quantity-{{ $key }}')
                                                    <i
                                                        class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                                @enderror
                                                <br>

                                            </div>
                                            @error('quantity-{{ $key }}')
                                                <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td class="w-[150px] border-[1px] p-4 text-center">
                                            @php
                                                $qtyAliases = App\Models\QtyConverter::where('item_id', $item['id'])
                                                    ->orderBy('quantity', 'ASC')
                                                    ->get();
                                            @endphp
                                            <div class="items-center">
                                                <select
                                                    class="block w-full rounded-lg border border-gray-300 bg-white p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                                    wire:model="items.{{ $key }}.satuan_id">
                                                    <option selected value="">-</option>
                                                    @foreach ($qtyAliases as $alias)
                                                        <option value={{ $alias->id }}>{{ $alias->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        {{-- <td class="w-4 p-4 text-center border-[1px] ">
                                            @php
                                                $satuan = App\Models\QtyConverter::find($item['satuan_id']);
                                            @endphp
                                            <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">
                                                {{$item['quantity']}} {{$satuan->name}} ({{$item['quantity'] * $satuan->quantity}})
                                            </button>

                                        </td> --}}
                                        <td class="w-[200px] border-[1px] p-4 text-center">
                                            @php
                                                $selected_satuan = $qtyAliases->where('id', $items[$key]['satuan_id'])->first()->quantity;
                                            @endphp
                                            <span class="font-bold"> {{ number_format($item['price'] * $selected_satuan  , 0, ',', '.') }}</span>

                                            ({{ number_format($item['price'], 0, ',', '.') }})
                                        </td>
                                        <td class="w-[150px] border-[1px] p-4 text-center">
                                            <input name="discount" type="number"  id="discount_mask"
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100" wire:model="items.{{ $key }}.discount">
                                        </td>
                                        <td class="w-[250px] border-[1px] p-4 text-center font-bold">
                                            Rp. {{ number_format($item['total_price'], 0, ',', '.') }}
                                        </td>
                                        <td class="w-4 border-[1px] p-4 text-center">
                                            <button wire:click="removeItem({{ $item['id'] }})" type="button"
                                                class="btn border-red-500 bg-red-500 text-white hover:border-red-600 hover:bg-red-600 focus:border-red-600 focus:bg-red-600 focus:ring focus:ring-red-500/30 active:border-red-600 active:bg-red-600"><i
                                                class="bx bx-trash text-16 align-middle"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @if (count($items) !== 0)
                    <button type="button" wire:click="store"
                        class="btn mt-4 w-full border-violet-500 bg-violet-500 text-white hover:border-violet-600 hover:bg-violet-600 focus:border-violet-600 focus:bg-violet-600 focus:ring focus:ring-violet-500/30 active:border-violet-600 active:bg-violet-600"><i
                            class="bx bx-check-double text-16 align-middle ltr:mr-1 rtl:ml-1"></i><span
                            class="align-middle">Simpan</span></button>
                @endif
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function() {
            const discMask = document.getElementById('discount_mask');
            let discMaskObj = new IMask(discMask, {
                mask: 'Rp.  num',
                blocks: {
                    num: {
                        mask: Number,
                        thousandsSeparator: '.',
                    }
                }
            });
            // window.addEventListener('discount-updated', event => {
            //     discMaskObj.unmaskedValue = '' + @this.discount;
            // })
            // discMask.addEventListener('input', function() {
            //     Livewire.emit('discountChange', discMaskObj.unmaskedValue)
            // })

        })
    </script>

</div>
