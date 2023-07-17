<div class="grid grid-cols-12 gap-5">
    <div class="col-span-12">
        <button wire:click="$emit('openCreateModal')" type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
            <i class="bx bx-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
            <span class="px-3 leading-[2.8]">Tambah Data Barang</span>
        </button>

    </div>
     <div class="col-span-12">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body pb-0">
                <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">Daftar Data Barang</h6>
            </div>
            <div class="card-body">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500" style="min-width: max-content">
                        <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                            <tr>
                                <th scope="col" class="p-4 text-center">
                                    Nomor
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Kategori
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Tanggal Expired
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Countdown
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Stock
                                </th>
                                <th scope="col" class="px-6 py-3 text-center" style="width: 350px">
                                    Aksi
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
                                    <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                        <td class="w-4 p-4 text-center">
                                            {{$key+1}}
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full text-start">{{$item->name}}</button>
                                            
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-green-500 hover:text-white border-green-500 hover:bg-green-600 hover:border-green-600 focus:bg-green-600 focus:text-white focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 w-full">{{$item->category->name}}</button>
                                            
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                            @if ($item->has_expired)
                                                <button type="button" class="btn text-green-500 bg-green-50 border-green-50 hover:text-white hover:bg-green-600 hover:border-green-600 focus:text-white focus:bg-green-600 focus:border-green-600 focus:ring focus:ring-green-500/30 active:bg-green-600 active:border-green-600 dark:focus:ring-green-500/10 dark:bg-green-500/20 dark:border-transparent w-full">Expired</button>
                                            @else
                                                <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">Non-Expired</button>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 w-full">Rp. {{number_format($item->selling_price, 0, ',', '.')}}</button>
                                        </td>

                                        <td class="px-6 py-4 text-center" >
                                            <button wire:click="$emit('openEditModal', {{$item->id}})" type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600 scale-80"><i class="bx bx-edit bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Edit</span></button>

                                            <button wire:click="$emit('openDeleteModal', {{$item->id}})" type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600 scale-80" ><i class="bx bx-trash bg-white bg-opacity-20 w-10  h-full  text-16 py-3 align-middle rounded-l "></i><span class="px-3 leading-[2.8]">Hapus</span></button>
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