<div class="flex items-center bg-yellow-50 rounded absolute top-3 simple-alert {{$show ? 'simple-alert-show' : ''}}">
    <div class="h-12 w-12 ltr:rounded-l rtl:rounded-r bg-yellow-400 text-center relative">
        <div class="after:content-[''] after:border-[6px] after:border-transparent ltr:after:border-l-yellow-400 rtl:after:border-r-yellow-400 after:absolute ltr:after:-right-3 rtl:after:-left-3 after:top-[1.15rem]"></div>
        <i class="mdi mdi-alert-outline align-middle text-white leading-[3.5]"></i>
    </div>
        <p class="text-yellow-700 ltr:ml-4 rtl:mr-4">{{$message}}</p> 
        <button class="alert-close ltr:ml-auto rtl:mr-auto text-zinc-500 text-lg ltr:pr-5 rtl:pl-5"><i class="mdi mdi-close"></i></button>
    @if ($show)
        <script>
            setTimeout(() => {
                let activeAlert = document.getElementsByClassName('simple-alert-show');
                activeAlert.forEach(element => {
                    element.classList.remove('simple-alert-show');
                });
            }, 2500);
        </script>
    @endif
</div>
