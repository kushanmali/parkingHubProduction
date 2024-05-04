@extends('layouts.user.app')

@section('content')

<div class=" max-w-7xl -mt-24 mx-auto">
    <div class="p-3">
        <div class="bg-black rounded-8 bg-cover lg:bg-center" style="background-image: url({{asset('assets/img/happy-woman-hanging-out-car-window.webp')}})">
            <div class="px-5 bg-gradient-to-br rounded-6 from-black  to-bg-transparent pb-4 pt-36">
                <h1 class="text-green-400 mb-0 text-3xl">Parking made <br> easy .</h1>
                <p class="text-lg text-gray-50 font-bold">book ahead, park stress-free.</p>
            </div>
        </div>
    </div>

   @livewire('all-parkings-list')

</div>

<div class="relative max-w-7xl -mt-24 mx-auto">
    
</div>

@endsection