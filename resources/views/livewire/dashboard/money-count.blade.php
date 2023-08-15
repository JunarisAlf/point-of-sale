<div class="grid grid-cols-12 mt-4">
    <div class="col-span-12 md:col-span-4  px-6">
        <div class="shadow-soft-xl relative mb-6 flex w-full min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-lg">
            <div class="flex flex-row p-4">
                <div class="flex flex-col gap-4 justify-between mt-2 mb-4 w-full">
                    <div class="w-2/3 max-w-full flex-none">
                        <div>
                            <p class="mb-0 font-sans text-md font-semibold leading-normal">Total Asset</p>
                            <h5 class="mb-0 font-bold text-xl">
                                Rp. {{number_format($assetSum, 0, ',', '.')}}
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-4  px-6">
        <div class="shadow-soft-xl relative mb-6 flex w-full min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-lg">
            <div class="flex flex-row p-4">
                <div class="flex flex-col gap-4 justify-between mt-2 mb-4 w-full">
                    <div class="w-2/3 max-w-full flex-none">
                        <div>
                            <p class="mb-0 font-sans text-md font-semibold leading-normal">Total Hutang</p>
                            <h5 class="mb-0 font-bold text-xl">
                                Rp. {{number_format($debtSum, 0, ',', '.')}}
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-4  px-6">
        <div class="shadow-soft-xl relative mb-6 flex w-full min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-lg">
            <div class="flex flex-row p-4">
                <div class="flex flex-col gap-4 justify-between mt-2 mb-4 w-full">
                    <div class="w-2/3 max-w-full flex-none">
                        <div>
                            <p class="mb-0 font-sans text-md font-semibold leading-normal">Total Piutang</p>
                            <h5 class="mb-0 font-bold text-xl">
                                Rp. {{number_format($piutangSum, 0, ',', '.')}}
                            </h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




</div>
