 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-sider border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10" >

    <div data-simplebar class="h-full">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu">Menu</li>
                @if ($user->role == 'master')
                    <li >
                        <a href="{{route('admin.dashboard')}}" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                @endif

                {{-- START Chart --}}
                @if ($user->role == 'master')
                <li >
                    <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="bar-chart-2"></i>
                        <span>Grafik</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.grafik.sell')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Grafik Penjualan</a>
                        </li>
                        <li>
                            <a href="{{route('admin.grafik.sellOnline')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Grafik Penjualan Online</a>
                        </li>
                        <li>
                            <a href="{{route('admin.grafik.buy')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Grafik Pembelian</a>
                        </li>
                        <li>
                            <a href="{{route('admin.grafik.category')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Grafik Kategori</a>
                        </li>
                        <li>
                            <a href="{{route('admin.grafik.mostSell')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Grafik Barang Terlaris</a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- END Chart --}}

                {{-- START TRANSAKSI --}}
                <li >
                    <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="shopping-cart"></i>
                        <span >Transaksi</span>
                    </a>
                    <ul>
                    @if ($user->role == 'admin')
                        <li>
                            <a href="{{route('admin.trx.sellEntry')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Entry Penjualan</a>
                        </li>
                        {{-- <li>
                            <a href="{{route('admin.trx.sellEntryOld')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Entry Penjualan Lama</a>
                        </li> --}}
                    @endif
                    @if ($user->role !== 'gudang')
                        <li>
                            <a href="{{route('admin.trx.sellList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Penjualan</a>
                        </li>
                    @endif
                    @if ($user->role == 'master' || $user->role == 'finance' || $user->role == 'gudang')
                        @if ($user->role == 'master' || $user->role == 'gudang')
                        <li>
                            <a href="{{route('admin.trx.sellEntryOnline')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Entry Penjualan Online</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{route('admin.trx.sellOnlineList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Penjualan Online</a>
                        </li>
                        <li>
                            <a href="{{route('admin.trx.buyList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Pembelian</a>
                        </li>
                    @endif
                    @if ($user->role == 'master' || $user->role == 'gudang')
                        <li>
                            <a href="{{route('admin.trx.buyEntry')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Entry Pembelian</a>
                        </li>
                    @endif

                    @if ($user->role == 'master' || $user->role == 'finance' || $user->role == 'admin')
                        <li>
                            <a href="{{route('admin.trx.debtList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Hutang</a>
                        </li>
                        <li>
                            <a href="{{route('admin.trx.piutangList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Piutang</a>
                        </li>
                    @endif
                    </ul>
                </li>
                {{-- END TRANSAKSI --}}

                {{-- START TRANSAKSI --}}
                @if ($user->role === 'master' || $user->role === 'admin' || $user->role === 'finance')
                    <li >
                        <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="dollar-sign"></i>
                            <span>Cash</span>
                        </a>
                        <ul>
                            {{-- <li>
                                <a href="{{route('admin.cash.inOut')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Cash In/Out</a>
                            </li> --}}
                            <li>
                                <a href="{{route('admin.cash.cashIn')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Cash In</a>
                            </li>
                            <li>
                                <a href="{{route('admin.cash.cashOut')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Cash Out</a>
                            </li>
                            @if ($user->role == 'master' || $user->role == 'finance')
                             <li>
                                <a href="{{route('admin.cash.setoran')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Setoran</a>
                            </li>
                            <li>
                                <a href="{{route('admin.cash.assets')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Asset</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- END TRANSAKSI --}}


                 {{-- START MASTER DATA --}}
                @if ($user->role != 'finance')
                    <li >
                        <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="list"></i>
                            <span >Data Master</span>
                        </a>
                        <ul>
                        @if ($user->role === 'master')
                            <li>
                                <a href="{{route('admin.master.cabang')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Data Cabang</a>
                            </li>
                        @endif
                        @if ($user->role === 'master' || $user->role === 'admin')
                            <li>
                                <a href="{{route('admin.master.customer')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Nama Pelanggan</a>
                            </li>
                        @endif
                        @if ($user->role === 'master' || $user->role === 'gudang')
                            <li>
                                <a href="{{route('admin.master.category')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Data Category</a>
                            </li>
                            <li>
                                <a href="{{route('admin.master.item')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Data Barang & Harga</a>
                            </li>
                            <li>
                                <a href="{{route('admin.master.multiPrice')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Harga Multi & Satuan</a>
                            </li>
                            <li>
                                <a href="{{route('admin.master.supplier')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Supplier</a>
                            </li>
                        @endif
                    </ul>
                    </li>
                @endif

                {{-- END MASTER DATA --}}


                {{-- START MASTER DATA --}}
                @if ($user->role === 'master' || $user->role === 'gudang' || $user->role === 'admin')
                    <li >
                        <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="package"></i>
                            <span>Gudang</span>
                        </a>
                        <ul>
                            @if ($user->role !== 'admin')
                            <li>
                                <a href="{{route('admin.gudang.retur')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Retur</a>
                            </li>
                            <li>
                                <a href="{{route('admin.gudang.returList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Retur</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{route('admin.gudang.stock')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Stok Barang dan Harga</a>
                            </li>
                            <li>
                                <a href="{{route('admin.gudang.expired')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Expired Date</a>
                            </li>
                            @if ($user->role !== 'admin')
                            <li>
                                <a href="{{route('admin.gudang.stockOpname')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Stock Opname</a>
                            </li>
                            @endif
                        @if ($user->role === 'master')
                            <li>
                                <a href="{{route('admin.gudang.verifStockOpname')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Verifikasi Stock Opname</a>
                            </li>
                            <li>
                                <a href="{{route('admin.gudang.manageItem')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Atur Barang</a>
                            </li>
                        @endif
                            <li>
                                <a href="{{route('admin.gudang.transferStock')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Transfer Stok</a>
                            </li>
                            <li>
                                <a href="{{route('admin.gudang.transferList')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Daftar Transfer Stok</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if ($user->role === 'general')
                <li >
                    <a href="{{route('admin.gudang.stock')}}" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="package"></i>
                        <span>Stok dan Harga</span>
                    </a>
                </li>
                @endif
                {{-- END MASTER DATA --}}


                {{-- START USER --}}
            @if ($user->role === 'master')
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
                            <a href="{{route('admin.loginLog')}}" class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Login Log</a>
                        </li>
                    </ul>
                </li>
            @endif
                {{-- END USER --}}

                {{-- START SETTING DATA --}}
            @if ($user->role === 'master')
                <li >
                    <a href="javascript: void(0);" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                        <i data-feather="settings"></i>
                        <span >Setting</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{route('admin.master.generalInfo')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Informasi Toko</a>
                        </li>
                        <li>
                            <a href="{{route('admin.master.otherInfo')}}"  class="pl-14 pr-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Setting Lainnya</a>
                        </li>
                    </ul>
                </li>
            @endif
            {{-- END SETTING DATA --}}


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

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
