 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-sider border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10" >
    
    <div data-simplebar class="h-full">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu">Menu</li>
                <li >
                    <a href="{{route('admin.dashboard')}}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                
                {{-- START TRANSAKSI --}}
                <li >
                    <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="shopping-cart"></i>
                        <span >Transaksi</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.trx.sellEntry')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Entry Penjualan</a>
                        </li>
                        <li>
                            <a href="{{route('admin.trx.sellList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Penjualan</a>
                        </li>
                        <li>
                            <a href="{{route('admin.trx.buyEntry')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Entry Pembelian</a>
                        </li>
                        <li>
                            <a href="{{route('admin.trx.buyList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Pembelian</a>
                        </li>
                        <li>
                            <a href="{{route('admin.trx.sellEntryOnline')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Entry Penjualan Online</a>
                        </li>
                         <li>
                            <a href="{{route('admin.trx.debtList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Hutang</a>
                        </li>
                        <li>
                            <a href="{{route('admin.trx.piutangList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Piutang</a>
                        </li>
                    </ul>
                </li>
                {{-- END TRANSAKSI --}}

                {{-- START TRANSAKSI --}}
                <li >
                    <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="dollar-sign"></i>
                        <span>Cash</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.cash.inOut')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Cash In/Out</a>
                        </li>
                    </ul>
                </li>
                {{-- END TRANSAKSI --}}


                 {{-- START MASTER DATA --}}
                 <li >
                    <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="list"></i>
                        <span >Data Master</span>
                    </a>
                    <ul>
                        <li>
                            <a href="/sdfdfs"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Data Toko</a>
                        </li>
                        <li>
                            <a href="{{route('admin.master.cabang')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Data Cabang</a>
                        </li>
                        <li>
                            <a href="{{route('admin.master.category')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Data Category</a>
                        </li>
                        <li>
                            <a href="{{route('admin.master.item')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Data Barang & Harga</a>
                        </li>
                        <li>
                            <a href="{{route('admin.master.multiPrice')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Harga Multi</a>
                        </li>
                        <li>
                            <a href="{{route('admin.master.supplier')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Supplier</a>
                        </li>
                        <li>
                            <a href="{{route('admin.master.customer')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Pelanggan</a>
                        </li>
                    </ul>
                </li>
                {{-- END MASTER DATA --}}


                {{-- START MASTER DATA --}}
                <li >
                    <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="package"></i>
                        <span>Gudang</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.gudang.stock')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Stok Barang</a>
                        </li>
                        <li>
                            <a href="{{route('admin.gudang.expired')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Expired Date</a>
                        </li>
                        <li>
                            <a href="{{route('admin.gudang.stockOpname')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Stock Opname</a>
                        </li>
                         <li>
                            <a href="{{route('admin.gudang.verifStockOpname')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Verifikasi Stock Opname</a>
                        </li>
                        <li>
                            <a href="{{route('admin.gudang.manageItem')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Atur Barang</a>
                        </li>
                        <li>
                            <a href="{{route('admin.gudang.transferStock')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Transfer Stok</a>
                        </li>
                    </ul>
                </li>
                {{-- END MASTER DATA --}}


                {{-- START USER --}}
                <li >
                    <a href="javascript: void(0);"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="users"></i>
                        <span data-key="t-dashboard">Penguna</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.manageUser')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Pengguna</a>
                        </li>
                        <li>
                            <a href="/dsfdsfsd" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">User Log</a>
                        </li>
                    </ul>
                </li>
                {{-- END USER --}}
                <li>
                    <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="user"></i>
                        <span data-key="t-apps">Akun</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('profile')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Profile</a>
                        </li>
                        <li>
                            <a href="{{route('changePassword')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Ubah Password</a>
                        </li>
                        <li>
                            <a href="{{route('logout')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Logout</a>
                        </li>

                    </ul>
                </li>
            </ul>

            {{-- <div class="sidebar-alert text-center mx-5 my-12">
                <div class="card-body bg-primary rounded bg-violet-50/50 dark:bg-zinc-700/60">
                    <img src="assets/images/giftbox.png" alt="" class="block mx-auto">
                    <div class="mt-4">
                        <h5 class="text-violet-500 mb-3 font-medium">Unlimited Access</h5>
                        <p class="text-slate-600 text-13 dark:text-gray-50">Upgrade your plan from a Free trial, to select ‘Business Plan’.</p>
                        <a href="#!" class="btn bg-violet-500 text-white border-transparent mt-6">Upgrade Now</a>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->