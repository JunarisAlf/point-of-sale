<div class="grid grid-cols-12 gap-5">
    
    <div class="col-span-12">
        <div class="card dark:bg-zinc-800 dark:border-zinc-600">
            <div class="card-body pb-0">
                <div class="flex flex-row items-center gap-2 mb-4">
                    <label>Show</label>
                    <input class="w-16 rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="number" name="paginate_count" wire:model.lazy="paginate_count" id="example-email-input">
                    <label>Of {{$data_count}} Entries</label>
                </div>
            </div>
            <div class="card-body px-0">
                <div class="px-3" data-simplebar="init" style="max-height: 352px;"><div class="simplebar-wrapper" style="margin: 0px -12px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: -16.6667px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden scroll;"><div class="simplebar-content" style="padding: 0px 12px;">
                    <ul class="overflow-hidden">
                        @foreach ($loginLogs as $log)
                            <li class="flex pl-12 pb-6 relative w-full">
                                <div class="absolute left-0 z-40">
                                    <div class="h-10 w-10 bg-violet-50 rounded-full text-center">
                                        <img src="{{asset('storage/profile/'. $log->user->profile_image)}}" alt="">
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div class="flex">
                                        <div class="grow mr-4 ml-2 overflow-hidden w-72">
                                            <h5 class="text-sm mb-1 text-gray-700 dark:text-gray-100">{{$log->created_at}}</h5>
                                            <p class="text-13 overflow-hidden text-ellipsis whitespace-nowrap text-gray-500 dark:text-zinc-100">{{$log->user->full_name}}</p>
                                        </div>
                                        <div class="shrink-0 text-end mr-1 w-20">
                                            <h6 class="mb-1 text-gray-700 dark:text-gray-100"></h6>
                                            <div class="text-13 dark:text-zinc-100">{{$log->user->cabang?->name !== null ? $log->user->cabang?->name : "-" }}</div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="after:contant-[] after:absolute after:h-20 after:border-l-2 after:border-dashed after:border-gray-100 after:left-5 after:z-0 dark:after:border-zinc-600"></div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="w-full  flex justify-center my-8">
                        {{$loginLogs->links()}}
                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="simplebar-placeholder" style="width: auto; height: 408px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 303px; transform: translate3d(0px, 0px, 0px); display: block;"></div></div></div>
            </div>
        </div>
    </div>
    
</div>