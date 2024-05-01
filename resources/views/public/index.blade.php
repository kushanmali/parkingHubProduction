@extends('public.layouts.appLogin')

@section('content')

<div class="min-h-screen flex-col animate-pulse animate-duration-[3000ms] items-center bg-white justify-center">
    <a class="flex min-h-screen justify-center items-center m-0 text-sm whitespace-nowrap text-slate-700 dark:text-white" href="{{route('index')}}">
        <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="inline-block h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:hidden" alt="main_logo" />
        <img src="{{asset('assets/img/parking-hub-icon.jpg')}}" class="hidden h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:inline-block" alt="main_logo" />
        <h4 class="font-bold ml-2 text-4xl mb-0">Parking <span class="bg-gradient-to-tl from-green-600 to-teal-400 bg-clip-text text-transparent text-4xl">HUB</span></h4>
    </a>
</div>

@endsection

@push('scripts')

<script>
    // Wait for the document to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Set a timeout to redirect after 4 seconds
        setTimeout(function() {
            window.location.href = '{{ route("publicUserLogin") }}';
        }, 4000); // 4 seconds (4000 milliseconds)
    });
</script>

    
@endpush