@extends('admin.layout.APP')
@section('page_title', 'LOGIN')
@section('page_css')
    <link rel="stylesheet" href="{{asset('mania/libs/swiper/swiper-bundle.min.css')}}">
@endsection

@section('page_script')
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('HTML_Main')
<div class="container-fluid">
    <div class="h-screen md:overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-12 ">
            <div class="col-span-12 md:col-span-5 lg:col-span-4 xl:col-span-3 relative z-50">
                <div class="w-full bg-white xl:p-12 p-10 dark:bg-zinc-800">
                    <div class="flex h-[90vh] flex-col">
                            <div class="mx-auto">
                            <a href="index.html" class="">
                                <img src="{{asset('mania/images/logo-sm.svg')}}" alt="" class="h-8 inline"> <span class="text-xl align-middle font-medium ltr:ml-2 rtl:mr-2 dark:text-white">Juna POS</span>
                            </a>
                        </div>

                        @livewire('auth.login-page.form')

                        
                        <div class=" text-center">
                            <p class="text-gray-500 dark:text-gray-100 relative mb-5">© <script>document.write(new Date().getFullYear())</script> JunaPOS . Crafted with <i class="mdi mdi-heart text-red-400"></i> by Junaris</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-7 lg:col-span-8 xl:col-span-9">
                <div class="h-screen bg-cover relative p-5 bg-[url('../images/auth-bg.jpg')]">
                    <div class="absolute inset-0 bg-violet-500/90"></div>

                    <ul class="bg-bubbles absolute top-0 left-0 w-full h-full overflow-hidden animate-square">
                        <li class="h-10 w-10 rounded-3xl bg-white/10 absolute left-[10%] "></li>
                        <li class="h-28 w-28 rounded-3xl bg-white/10 absolute left-[20%]"></li>
                        <li class="h-10 w-10 rounded-3xl bg-white/10 absolute left-[25%]"></li>
                        <li class="h-20 w-20 rounded-3xl bg-white/10 absolute left-[40%]"></li>
                        <li class="h-24 w-24 rounded-3xl bg-white/10 absolute left-[70%]"></li>
                        <li class="h-32 w-32 rounded-3xl bg-white/10 absolute left-[70%]"></li>
                        <li class="h-36 w-36 rounded-3xl bg-white/10 absolute left-[32%]"></li>
                        <li class="h-20 w-20 rounded-3xl bg-white/10 absolute left-[55%]"></li>
                        <li class="h-12 w-12 rounded-3xl bg-white/10 absolute left-[25%]"></li>
                        <li class="h-36 w-36 rounded-3xl bg-white/10 absolute left-[90%]"></li>
                    </ul>

                    <div class="grid grid-cols-12 content-center h-screen">
                        <div class="col-span-8 col-start-3">
                            <div class="swiper login-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <i class="bx bxs-quote-alt-left text-green-600 text-5xl"></i>
                                            <h3 class="mt-4 text-white text-22">“I feel confident imposing change on myself. It's a lot more progressing fun than looking back. That's why I ultricies enim at malesuada nibh diam on tortor neaded to throw curve balls.”</h3>
                                            <div class="flex mt-6 mb-10 pt-4">
                                                <img src="{{asset('mania/images/users/avatar-1.jpg')}}" class="h-12 w-12 rounded-full" alt="...">
                                                <div class="flex-1 ltr:ml-3 rtl:mr-2 mb-4">
                                                    <h5 class="font-size-18 text-white">Pemilik Toko</h5>
                                                    <p class="mb-0 text-white/50">Owner
                                                    </p>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <i class="bx bxs-quote-alt-left text-green-600 text-5xl"></i>
                                            <h3 class="mt-4 text-white text-22">“I feel confident imposing change on myself. It's a lot more progressing fun than looking back. That's why I ultricies enim at malesuada nibh diam on tortor neaded to throw curve balls.”</h3>
                                            <div class="flex mt-6 mb-10 pt-4">
                                                <img src="assets/images/users/avatar-2.jpg" class="h-12 w-12 rounded-full" alt="...">
                                                <div class="flex-1 ltr:ml-3 rtl:mr-2 mb-4">
                                                    <h5 class="font-size-18 text-white">Mariya Willam</h5>
                                                    <p class="mb-0 text-white/50">Designer
                                                    </p>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <i class="bx bxs-quote-alt-left text-green-600 text-5xl"></i>
                                            <h3 class="mt-4 text-white text-22">“I feel confident imposing change on myself. It's a lot more progressing fun than looking back. That's why I ultricies enim at malesuada nibh diam on tortor neaded to throw curve balls.”</h3>
                                            <div class="flex mt-6 mb-10 pt-4">
                                                <img src="assets/images/users/avatar-3.jpg" class="h-12 w-12 rounded-full" alt="...">
                                                <div class="flex-1 ltr:ml-3 rtl:mr-2 mb-4">
                                                    <h5 class="font-size-18 text-white">Jiya Jons</h5>
                                                    <p class="mb-0 text-white/50">Developer
                                                    </p>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection