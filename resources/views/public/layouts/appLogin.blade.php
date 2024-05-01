<!DOCTYPE html>
<html lang="en">

    @include('public.includes.headerlinks')
        @yield('content')
    @include('public.includes.footerlinks')

    @stack('scripts')
</html>