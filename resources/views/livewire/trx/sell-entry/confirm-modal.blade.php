<div class="modal relative z-50 {{$show ? '' : 'hidden'}}"  aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 z-50 overflow-y-auto">
       <div class="absolute inset-0 bg-black bg-opacity-50 transition-opacity modal-overlay"></div>
       <div class="animate-translate p-4 sm:max-w-4xl mx-auto">
           <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all dark:bg-zinc-600">
               <div class="bg-white dark:bg-zinc-700">
                   <div class="flex items-center p-4 border-b rounded-t border-gray-50 dark:border-zinc-600">
                       <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 ">
                           Konfirmasi Pembelian
                       </h3>
                       <button class="btn text-gray-400 border-transparent hover:bg-gray-50/50 hover:text-gray-900 dark:text-gray-100 rounded-lg text-sm px-2 py-1 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600" type="button" data-tw-dismiss="modal">
                           <i class="mdi mdi-close  text-xl text-gray-500 dark:text-zinc-100/60"></i>
                       </button>
                   </div>
                   <div class="p-6 space-y-6 ltr:text-left rtl:text-right">

                        <table class="w-full">
                            <tr class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">
                                <td class="w-1/2 ">Sub Total</td>
                                <td class="w-1/2 text-end">Rp. {{number_format($sub_total, 0, ',', '.')}}</td>
                            </tr>
                            <tr class="uppercase text-gray-600 dark:text-gray-100 font-bold text-md">
                                <td class="w-1/2">Diskon</td>
                                <td class="w-1/2 text-end">Rp. {{number_format($discount + $globalDisc, 0, ',', '.')}}</td>
                            </tr>
                            <tr class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">
                                <td class="w-1/2">Total</td>
                                <td class="w-1/2 text-end">Rp. {{number_format($grand_total - $globalDisc , 0, ',', '.')}}</td>
                            </tr>
                        </table>

                        @if ($customer_id !== null)
                           <div class="mb-3">
                                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white mr-3">Pembayaran</label>
                                <select id="countries" class="bg-white border border-gray-300 @error('is_paid') border-red-500 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-zinc-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="is_paid">
                                    <option  value="1">Lunas</option>
                                    <option  value="0" >Terhutang</option>
                                </select>
                                @error('is_paid')
                                    <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div> 
                        @endif
                        
                        @if ($is_paid)
                            <div class="mb-3" >
                                <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Bayar</label>
                                <div class="relative rounded  @error('pay') border-red-500 border-[0.5px]  @enderror">
                                    <input name="pay" type="text"  wire:ignore
                                        class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100 "
                                        id="pay_mask" value="{{ $pay }}"  >
                                        @error('pay')
                                            <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                        @enderror
                                </div>
                                @error('pay')
                                    <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                       

                        <div class="mb-3" >
                            <label class="mb-2 block font-medium text-gray-700 dark:text-zinc-100">Diskon</label>
                            <div class="relative rounded  @error('global_discount') border-red-500 border-[0.5px]  @enderror">
                                <input name="global_discount" type="text"  wire:ignore
                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:border-zinc-600 dark:bg-zinc-700/50 dark:text-zinc-100 dark:placeholder:text-zinc-100 "
                                    id="global_discount_mask" value="{{ $globalDisc }}"  >
                                    @error('global_discount')
                                        <i class='bx bx-error-circle absolute top-2 text-xl text-red-500 ltr:right-2 rtl:left-2'></i>
                                    @enderror
                            </div>
                            @error('global_discount')
                                <div class="mt-2 text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        @if ($is_paid)
                            <table class="w-full">
                                <tr class="uppercase text-gray-600 dark:text-gray-100 font-bold text-lg">
                                    <td class="w-1/2">Kembalian</td>
                                    <td class="w-1/2 text-end">Rp. {{number_format($change, 0, ',', '.')}}</td>
                                </tr>
                            </table>
                        @endif
                        
                   </div>
                   <!-- Modal footer -->
                   <div class="flex items-center p-5 gap-3 space-x-2 border-t rounded-b border-gray-50 dark:border-zinc-600">
                        <button wire:click="store" type="submit" class="btn inline-flex w-full justify-center border-0 bg-violet-500 p-0 align-middle text-white focus:ring-2 focus:ring-violet-500/30 hover:bg-violet-600">
                            <i class="bx bx-subdirectory-right  bg-opacity-20 w-10 h-full text-16 py-3 align-middle rounded-l"></i>
                            <span class="px-3 leading-[2.8]">Simpan</span>
                        </button>   
                        <button type="button" class="btn inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 dark:text-gray-100 shadow-sm hover:bg-gray-50/50 focus:outline-none focus:ring-2 focus:ring-gray-500/30 sm:mt-0 sm:w-auto sm:text-sm dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:bg-zinc-600 dark:focus:ring-zinc-700 dark:focus:ring-gray-500/20" data-tw-dismiss="modal">Tutup</button>
                       
                   </div>
               </div>
           </div>
       </div>
   </div>
   <script>
        document.addEventListener('livewire:load', function () {
            const payMask = document.getElementById('pay_mask');
            let payMaskObj = new IMask(payMask, 
                {
                    mask: 'Rp.  num',
                    blocks: {
                        num: {
                            mask: Number,
                            thousandsSeparator: '.',
                        }
                    }
                });
            payMask.addEventListener('input', function(){
                Livewire.emit('payChange', payMaskObj.unmaskedValue)
            });
            window.addEventListener('pay-updated', event => {
                payMaskObj.unmaskedValue = '' + @this.pay;
            })
         
            const globalDiscMask = document.getElementById('global_discount_mask');
            let globalDiscObj = new IMask(globalDiscMask, 
                {
                    mask: 'Rp.  num',
                    blocks: {
                        num: {
                            mask: Number,
                            thousandsSeparator: '.',
                        }
                    }
                });
            globalDiscMask.addEventListener('input', function(){
                Livewire.emit('globalDiscChange', globalDiscObj.unmaskedValue)
            });
            window.addEventListener('globalDisc-updated', event => {
                globalDiscObj.unmaskedValue = '' + @this.globalDisc;
            })
            
        })
    </script>
</div>