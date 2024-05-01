<!DOCTYPE html>
<html lang="en">

@include('dashboards.owner.includes.headerlinks')

<body class="m-0 font-sans antialiased font-normal text-left leading-default text-base dark:bg-slate-950 bg-gray-50 text-slate-500 dark:text-white">


    @include('dashboards.owner.includes.sidebar')

    <main class="relative h-full max-h-screen transition-all duration-200 ease-soft-in-out xl:ml-68 rounded-xl">

        @include('dashboards.owner.includes.nav')

        @yield('content')

    </main>
    
    @include('dashboards.admin.includes.slider')

</body>

@stack('scripts')
@include('dashboards.owner.includes.footerlinks')
@stack('scripts')


</html>