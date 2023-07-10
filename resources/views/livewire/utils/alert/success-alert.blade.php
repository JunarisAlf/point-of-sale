<div class="flex items-center bg-green-50 rounded absolute top-3 simple-alert {{$show ? 'simple-alert-show' : ''}}">
    <div class="h-12 w-12 ltr:rounded-l rtl:rounded-r bg-green-400 text-center relative">
        <div class="after:content-[''] after:border-[6px] after:border-transparent ltr:after:border-l-green-400 rtl:after:border-r-green-400 after:absolute ltr:after:-right-3 rtl:after:-left-3 after:top-[1.15rem]">
        </div>
        <i class="mdi mdi-check-all align-middle text-white leading-[3.5] alert-close"></i>
    </div>
    <p class="text-green-700 ltr:ml-4 rtl:mr-4">{{$message}}</p> 
    <button class="alert-close ltr:ml-auto rtl:mr-auto text-zinc-500 text-lg ltr:pr-5 rtl:pl-5"><i class="mdi mdi-close"></i></button>
</div>