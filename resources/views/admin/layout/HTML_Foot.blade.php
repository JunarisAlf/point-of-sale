    <script>

        if (!localStorage.getItem('sidebar')) {
            localStorage.setItem('sidebar', 'true');

        }
        let sidebarBtn = document.getElementById('vertical-menu-btn');
        sidebarBtn.addEventListener('click', function(){
            let sidebar = localStorage.getItem('sidebar');
            localStorage.setItem('sidebar', sidebar == 'true' ? 'false' : 'true');
        })

        let body = document.getElementById('body');
        if (localStorage.getItem('sidebar') == 'false') {
            body.setAttribute('data-sidebar-size', 'sm')
        }else{
            body.setAttribute('data-sidebar-size', 'lg')
        }
    </script>
    <script src="{{asset('mania/libs/@popperjs/core/umd/popper.min.js')}}"></script>
    <script src="{{asset('mania/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('mania/libs/metismenujs/metismenujs.min.js')}}"></script>
    <script src="{{asset('mania/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('mania/libs/feather-icons/feather.min.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- apexcharts -->
    {{-- <script src="{{asset('mania/libs/apexcharts/apexcharts.min.js')}}"></script> --}}
    <!-- Plugins js-->
    <script src="{{asset('mania/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('mania/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>

    <script src="{{asset('mania/js/pages/nav&tabs.js')}}"></script>
    <script src="{{asset('mania/libs/swiper/swiper-bundle.min.js')}}"></script>
    {{-- <script src="{{asset('mania/js/pages/login.init.js')}}"></script> --}}
    <script src="{{asset('mania/js/app.js')}}"></script>
    <script src="{{asset('js/custome.js')}}"></script>
    @livewireScripts
    @yield('page_script')

</body>
</html>
