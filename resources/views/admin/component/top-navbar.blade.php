<nav
    class="fixed top-0 right-0 left-0 z-10 flex items-center border-b border-slate-100 bg-white dark:border-zinc-700 dark:bg-zinc-800 print:hidden">
    <div class="flex w-full items-center justify-between">
        {{-- START And Search --}}
        <div class="topbar-brand flex items-center">
            {{-- START Navbar Brand --}}
            <div
                class="navbar-brand flex h-[70px] shrink items-center justify-between border-r border-r-gray-50 bg-slate-50 px-5 dark:border-zinc-700 dark:bg-zinc-800">
                <a href="#" class="flex items-center text-lg font-bold dark:text-white">
                    <img src="{{asset('mania/images/logo-sm.svg')}}" alt="" class="mt-1 inline-block h-6 ltr:mr-2 rtl:ml-2" />
                    <span class="hidden align-middle xl:block">Juna POS</span>
                </a>
            </div>
            {{-- END Navbar Brand --}}
            <button type="button"
                class="vertical-menu-btn h-[70px] text-gray-600 ltr:-ml-10 ltr:mr-6 rtl:-mr-10 rtl:ml-10 dark:text-white"
                id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            {{-- START SEARCH --}}
            <form class="app-search hidden px-5 xl:block">
                <div class="relative inline-block">
                    <input type="text"
                        class="rounded border-0 bg-gray-50/30 px-4 placeholder:text-sm focus:ring-0 dark:border-zinc-700 dark:bg-zinc-700/50 dark:text-gray-100 dark:placeholder:text-gray-200"
                        placeholder="Search...">
                    <button
                        class="absolute top-1 inline-block rounded bg-violet-500 py-1.5 px-2.5 text-white shadow shadow-violet-100 ltr:right-1 rtl:left-1 rtl:right-auto dark:shadow-gray-900"
                        type="button"><i class="bx bx-search-alt align-middle"></i></button>
                </div>
            </form>
            {{-- END SEARCH --}}
        </div>
        {{-- END And Search --}}
        
        {{-- START Top Right Nav --}}
        <div class="flex items-center">
            {{-- START Darkmode --}}
            <div>
                <button type="button"
                    class="light-dark-mode hidden h-[70px] px-4 text-xl text-gray-600 dark:text-gray-100 sm:block">
                    <i data-feather="moon" class="block h-5 w-5 dark:hidden"></i>
                    <i data-feather="sun" class="hidden h-5 w-5 dark:block"></i>
            </div>
            {{-- END Darkmode --}}

            {{-- START User --}}
            <div>
                <div class="dropdown relative ltr:mr-4 rtl:ml-4">
                    <button type="button"
                        class="dropdown-toggle flex items-center border-x border-gray-50 bg-gray-50/30 px-4 py-5 dark:border-zinc-600 dark:bg-zinc-700 dark:text-gray-100"
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">
                        <img class="h-8 w-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2"
                            src="{{asset('mania/images/users/avatar-1.jpg')}}" alt="Header Avatar">
                        <span class="fw-medium hidden xl:block">Junaris Alf</span>
                        <i class="mdi mdi-chevron-down hidden align-bottom xl:block"></i>
                    </button>
                    <div class="dropdown-menu absolute top-0 z-50 hidden w-40 list-none rounded bg-white shadow ltr:-left-3 rtl:-right-3 dark:bg-zinc-800"
                        id="profile/log">
                        <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
                            <div class="dropdown-item dark:text-gray-100">
                                <a class="block px-3 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                    href="apps-contacts-profile.html">
                                    <i class="mdi mdi-face-man text-16 mr-1 align-middle"></i> Profile
                                </a>
                            </div>
                            <div class="dropdown-item dark:text-gray-100">
                                <a class="block px-3 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50"
                                    href="lock-screen.html">
                                    <i class="mdi mdi-lock text-16 mr-1 align-middle"></i> Change Password
                                </a>
                            </div>
                            <hr class="border-gray-50 dark:border-gray-700">
                            <div class="dropdown-item dark:text-gray-100">
                                <a class="block p-3 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50" href="logout.html">
                                    <i class="mdi mdi-logout text-16 mr-1 align-middle"></i> Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- END User --}}

        </div>
        {{-- END Top Right Nav --}}

    </div>
</nav>
