<!DOCTYPE html>
<html lang="en">

@include('dashboards.user.includes.headerlinks')
@livewireStyles
<body onload="getLocation()" class="m-0 font-sans antialiased font-normal text-left leading-default text-base dark:bg-slate-950 bg-gray-50 text-slate-500 dark:text-white">


    @include('dashboards.user.includes.sidebar')

    <main class="relative h-full max-h-screen transition-all duration-200 ease-soft-in-out xl:ml-68 rounded-xl">

        @include('dashboards.user.includes.nav')

        @yield('content')

    </main>
    
    @include('dashboards.admin.includes.slider')

</body>

@include('dashboards.admin.includes.footerlinks')
@stack('scripts')
@livewireScripts
</html>