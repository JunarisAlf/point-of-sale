@include('admin.layout.HTML_Head')


@livewire('utils.alert.success-alert')
@livewire('utils.alert.danger-alert')
@livewire('utils.alert.warning-alert')
@livewire('utils.alert.info-alert')


@include('admin.component.top-navbar')
@include('admin.component.left-sidebar')

<div class="main-content dark:bg-zinc-700 min-h-screen">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <div class="grid grid-cols-1 mb-5">
                <div class="flex items-center justify-between">
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">@yield('menu_title')</h4>
                </div>
            </div>
            
            @yield('HTML_Main')

        </div>
    </div>
    @include('admin.component.footer')
</div>
@include('admin.layout.HTML_Foot')
