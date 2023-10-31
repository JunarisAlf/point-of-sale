<div class="modal relative z-50  {{$show ? '' : 'hidden'}}" id="modal-id" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 overflow-hidden">
        <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
        <div class="animate-translate p-4 text-center sm:max-w-lg mx-auto">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-700">
                <div class="bg-white dark:bg-zinc-600">
                     <div class="sm:flex sm:items-start p-5">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-50 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="mdi mdi-alert-outline text-xl text-red-500"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 ltr:sm:ml-4 rtl:sm:mr-4 ltr:sm:text-left rtl:sm:text-right">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100" id="modal-title">Konfirmasi Batal Retur!</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-zinc-100/80">Apakah kamu yakin akan menghapus data ini?</p>
                            </div>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 font-bold dark:text-zinc-100/80">Pembatalan retur ke supplier akan menambahkan barang ke stok gudang</p>
                                <p class="text-sm text-gray-500 font-bold dark:text-zinc-100/80">Pembatalan retur dari customer akan mengurangi stok di gudang</p>
                            </div>
                        </div>
                     </div>
                     <div  class="bg-gray-50 px-4 py-3 sm:flex ltr:sm:flex-row-reverse sm:px-6 dark:bg-zinc-700">
                        <button  wire:click='destroy({{$data_id}})' type="button" class="btn inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm dark:focus:ring-red-500/30">Hapus</button>
                        <button type="button" class="btn mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
