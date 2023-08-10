<div class="grid grid-cols-12 gap-5 ">
    <div class="col-span-12">
        <button wire:click="$emit('openCreateModal')" type="button" class="btn border-0 bg-green-500 p-0 align-middle text-white focus:ring-2 focus:ring-green-500/30 hover:bg-green-600">
            <i class="bx bx-plus bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
            <span class="px-3 leading-[2.8]">Tambah Data Customer</span>
        </button>
    </div>
     <div class="col-span-12">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body">
                <div class="w-full overflow-x-auto">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8 mt-4 p-2 items-end justify-between">
                        
                        <div class="col-span-1 sm:col-span-1  min-w-max">
                            <div class="flex flex-row items-center gap-2">
                                <label>Show</label>
                                <input class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="number" name="paginate_count" wire:model.lazy="paginate_count" id="example-email-input">
                                <label>Of {{$data_count}} Entries</label>
                            </div>
                        </div>

                        <div class="col-span-1 sm:col-span-1">
                            <div class="flex">
                                <button  style="z-index: 0 !important" id="dropdown-button" data-dropdown-toggle="dropdown" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-zinc-200 border border-gray-300 rounded-l-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600 " type="button">Cari
                                </button>
                               
                                <div class="relative w-full">
                                    <input wire:model="searchQuery" type="search" id="search-dropdown" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-white rounded-r-lg border-l-zinc-100 border-l-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-500 dark:border-l-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Nama, Telp, Alamat" required>
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
                    <table class="w-full text-sm text-left text-gray-500 " style="min-width: max-content">
                        <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700">
                            <tr>
                                <th scope="col" class="p-4 text-center">
                                    Nomor
                                </th>
                                <th scope="col" class="p-4 text-center">
                                    Nama Customer
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Telp.
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Alamat
                                </th>
                                <th scope="col" class="px-6 py-3 text-center" style="width: 350px">
                                    Total Transaksi
                                </th>
                                <th scope="col" class="px-6 py-3 text-center" style="width: 350px">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($customers->isEmpty())
                                <tr class="bg-white border-b border-zinc-100 hover:bg-zinc-100/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                    <td colspan="6" class="w-4 p-4 text-center">Tidak ada data</td>
                                </tr>
                            @else
                                
                                @foreach ($customers as $key => $customer)
                                    @php
                                        $tableNumber = ($page - 1) * $customers->perPage() + $loop->index + 1;
                                    @endphp
                                    <tr class="bg-white border-b border-gray-50 hover:bg-gray-50/50 dark:bg-zinc-700/50 dark:border-zinc-600">
                                        <td class="w-4 p-4 text-center">
                                            {{$tableNumber}}
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 ">
                                            {{$customer->name}}
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">{{$customer->wa}}</button>
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 ">
                                            <button type="button" class="btn text-sky-500 bg-sky-50 border-sky-50 hover:text-white hover:bg-sky-600 hover:border-sky-600 focus:text-white focus:bg-sky-600 focus:border-sky-600 focus:ring focus:ring-sky-500/30 active:bg-sky-600 active:border-sky-600 dark:focus:ring-sky-500/10 dark:bg-sky-500/20 dark:border-transparent">{{$customer->address}}</button>
                                        </td>
                                        <td class="px-6 py-4 dark:text-zinc-100/80 text-center">
                                            <button type="button" class="btn text-violet-500 hover:text-white border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:text-white focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 ">Rp. {{number_format($customer->trxs()->sum('total'), 0, ',', '.')}}</button>
                                        </td>

                                        <td class="px-6 py-4 text-center" >
                                            <button wire:click="$emit('openEditModal', {{$customer->id}})" type="button" class="btn border-0 bg-yellow-500 p-0 align-middle text-white focus:ring-2 focus:ring-yellow-500/30 hover:bg-yellow-600 scale-80"><i class="bx bx-edit bg-white bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i><span class="px-3 leading-[2.8]">Edit</span></button>

                                            <button wire:click="$emit('openDeleteModal', {{$customer->id}})" type="button" class="btn border-0 bg-red-500 p-0 align-middle text-white focus:ring-2 focus:ring-red-500/30 hover:bg-red-600 scale-80" ><i class="bx bx-trash bg-white bg-opacity-20 w-10  h-full  text-16 py-3 align-middle rounded-l "></i><span class="px-3 leading-[2.8]">Hapus</span></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                           
                        </tbody>
                    </table>
                </div>
                <div class="mt-8 w-full flex justify-center">
                    {{$customers->links()}}
                </div>
            </div>
        </div>
    </div>
    

  
</div>