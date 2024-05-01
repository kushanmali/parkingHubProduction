<!DOCTYPE html>
<html lang="en">

@include('dashboards.admin.includes.headerlinks')

<body class="m-0 font-sans antialiased font-normal text-left leading-default text-base dark:bg-slate-950 bg-gray-50 text-slate-500 dark:text-white">


    @include('dashboards.admin.includes.sidebar')

    <main class="relative h-full max-h-screen transition-all duration-200 ease-soft-in-out xl:ml-68 rounded-xl">

        @include('dashboards.admin.includes.nav')

        @yield('content')

    </main>
    
    @include('dashboards.admin.includes.slider')

</body>


@include('dashboards.admin.includes.footerlinks')
@stack('scripts')

</html>