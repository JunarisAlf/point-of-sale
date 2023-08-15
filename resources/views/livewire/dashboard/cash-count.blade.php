<div class="grid grid-cols-12">
    <div class="col-span-12 md:col-span-6  px-6">
        <div class="shadow-soft-xl relative mb-6 flex w-full min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-lg">
            <div class="flex flex-row p-4">
                <div class="flex flex-col gap-4 justify-between mt-2 mb-4 w-full">
                    <div wire:ignore id="sell-range" style="background: #fff; cursor: pointer; width: 100%">
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                    <div class="w-2/3 max-w-full flex-none">
                        <div>
                            <p class="mb-0 font-sans text-md font-semibold leading-normal">Penjualan</p>
                            <h5 class="mb-0 font-bold text-xl">
                                Rp. {{number_format($sellSum, 0, '.', ',')}}
                                <span class="font-weight-bolder text-sm leading-normal text-lime-500">{{$percentage > 0 ? "+" .$percentage : $percentage}} % Dari Sebelumnya</span>
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="h-full aspect-square text-right">
                    <div class="h-full shadow-soft-2xl inline-block h-12 w-12 rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 text-center">
                        <i class="mdi mdi-cash-plus  text-[2rem] text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-span-12 md:col-span-6  px-6">
        <div class="shadow-soft-xl relative mb-6 flex w-full min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-lg">
            <div class="flex flex-row p-4">
                <div class="flex flex-col gap-4 justify-between mt-2 mb-4 w-full">
                    <div wire:ignore id="cash-out-range" style="background: #fff; cursor: pointer; width: 100%">
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                    <div class="w-2/3 max-w-full flex-none">
                        <div>
                            <p class="mb-0 font-sans text-md font-semibold leading-normal">Pengeluaran</p>
                            <h5 class="mb-0 font-bold text-xl">
                                Rp. {{number_format($cashOutSum, 0, '.', ',')}}
                                <span class="font-weight-bolder text-sm leading-normal text-lime-500">
                                    {{$cashOutPercentage > 0 ? "+" . $cashOutPercentage : $cashOutPercentage}} % Dari Sebelumnya
                                </span>
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="h-full aspect-square text-right">
                    <div class="h-full shadow-soft-2xl inline-block h-12 w-12 rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 text-center">
                        <i class="mdi mdi-cash-minus  text-[2rem] text-white" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
