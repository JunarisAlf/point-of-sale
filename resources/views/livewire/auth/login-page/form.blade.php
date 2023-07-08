<div class="my-auto">
    <div class="text-center">
        <h5 class="text-gray-600 dark:text-gray-100">Welcome Back !</h5>
        <p class="text-gray-500 dark:text-gray-100/60 mt-1">Sign in to continue to Dashboard.</p>
    </div>

    <form class="mt-4 pt-2" action="index.html" wire:submit.prevent="login">
        <div class="mb-4">
            <label class="text-gray-600 dark:text-gray-100 font-medium mb-2 block">Username</label>
            <input wire:model="username" name="username" type="text" class="w-full rounded placeholder:text-sm py-2 border-gray-100 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" id="username" placeholder="Masukan username" required>
        </div>

        {{-- <div class="mb-4">
            <label class="text-gray-600 dark:text-gray-100 font-medium mb-2 block">Password</label>
            <input wire:model="password" type="password" class="w-full rounded placeholder:text-sm py-2 border-gray-100 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" id="username" placeholder="Masukan Password" required>
        </div> --}}
        <div class="mb-3">
            <div class="flex">
                <div class="flex-grow-1">
                    <label class="text-gray-600 dark:text-gray-100 font-medium mb-2 block">Password</label>
                </div>
            </div>
            
            <div class="flex" x-data="{ showPassword: false }">
                <input x-bind:type="showPassword ? 'text' : 'password'" wire:model="password" name="password" type="password" class="w-full rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-2 border-gray-100 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                <button @click="showPassword = !showPassword" class="bg-gray-50 px-4 rounded ltr:rounded-l-none rtl:rounded-r-none border border-gray-100 ltr:border-l-0 rtl:border-r-0 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            </div>
        </div>
       
        <div class="mb-3">
            <button class="btn border-transparent bg-violet-500 w-full py-2.5 text-white w-100 waves-effect waves-light shadow-md shadow-violet-200 dark:shadow-zinc-600" type="submit">Log In</button>
        </div>
    </form>
    @if (session()->has('error'))
        <div class="relative px-5 py-3 border-2 bg-red-50 text-red-700 border-red-100 rounded">
            <p>{{session('error')}}</p>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="relative px-5 py-3 border-2 bg-green-50 text-green-700 border-green-100 rounded mb-3">
            <p>{{session('success')}}</p>
        </div>
    @endif
    
</div>