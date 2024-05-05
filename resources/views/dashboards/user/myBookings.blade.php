@extends('layouts.user.app')

@section('content')


<div class=" max-w-7xl -mt-16 mx-auto">

    <div class="p-3">
        <h1 class="text-black pb-4 text-xl">My Bookings</h1>
    
        {{-- <div class="pt-0">
            <div class="flex pb-8 w-full justify-between items-center">
                <div class="relative w-full">
                    <input wire:model.debounce.300ms="search" type="text" placeholder="Search Parkings" class="pl-10 pr-4 py-2 w-full border  font-inter rounded-2 focus:outline-none focus:border-blue-500">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>       
            </div>
        </div> --}}
    
        @if($sessions->count() > 0)
            @foreach($sessions as $session)
            <a href="{{route('viewUserParking', $session->parking->id)}}">
                <div class="p-4 shadow-soft-lg rounded-4">
                    <!-- Parking details -->
                    <div class="flex lg:w-6/12 pb-4 w-full">
                        <!-- Parking image -->
                        <div class="w-4/12 lg:w-5/12">
                            <img src="{{ asset('/storage/'.$session->parking->profile_img_path) }}" alt="Parking Image" class="inline-flex items-center justify-center w-full object-cover text-white transition-all duration-200 text-base ease-soft-in-out rounded-4">
                        </div>
                        <!-- Parking information -->
                        <div class="w-8/12 lg:w-7/12 pl-3">
                            <h5 class="mt-0 mb-2 dark:text-white">{{ $session->parking->parking_name }}</h5>
                            <p class="leading-normal text-sm dark:text-white dark:opacity-60">
                                <i class="fas fa-map-marker-alt  text-xl text-blue-500"></i> 
                                {{ \Illuminate\Support\Str::limit($session->parking->location->address_address, 55) }}
                            </p>

                            @if ($session->status == 'booked')
                                <span class="m-2 inline-block rounded-full border text-center w-8/12 px-2.5 py-1 text-xs font-medium bg-gradient-to-tl from-blue-600 to-cyan-400 text-white">booked</span>
                            @elseif ($session->status == 'preBooked')
                                <span class="m-2 inline-block rounded-full border text-center w-8/12 px-2.5 py-1 text-xs font-medium bg-gradient-to-tl from-blue-600 to-cyan-400 text-white">pre Booked</span>
                            @elseif($session->status == 'ongoing')
                                <span class="m-2 inline-block rounded-full border text-center w-8/12 px-2.5 py-1 text-xs font-medium bg-gradient-to-tl from-fuchsia-500 to-pink-400 text-white">Ongoing</span>
                            @elseif($session->status == 'cancelled')
                                <span class="m-2 inline-block rounded-full border text-center w-8/12 px-2.5 py-1 text-xs font-medium bg-gradient-to-tl from-red-500 to-pink-400 text-white">cancelled</span>
                            @elseif($session->status == 'finished')
                                <span class="m-2 inline-block rounded-full border text-center w-8/12 px-2.5 py-1 text-xs font-medium bg-gradient-to-tl from-green-500 to-lime-400 text-white">Finished</span>
                            @endif
                        </div>
                    </div>
                    <!-- Distance and Estimated Time -->
                    @if($session->status == 'cancelled')
                        <div class="flex gap-2  w-full p-2">
                            <div class="w-full">
                                <div class="px-4 py-3 flex items-center gap-2 bg-gray-200">
                                    <p class="mb-0 text-xs text-black font-bold">Reason: {{$session->cancelReason->reason}}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($session->status == 'preBooked')

                    <div class="flex gap-2  w-full p-2">
                        <div class="w-full">
                            <div class="px-4 py-3 flex items-center gap-2 bg-gray-200">
                                <p class="mb-0 text-xs text-black font-bold">Booked Date: {{$session->date}}</p>
                            </div>
                        </div>
                    </div>


                    <div class="w-full">
                        <div class="px-1 py-2 flex items-center gap-2 bg-gray-50">
                            <a href="{{route('bookNowPage', $session->parking->id)}}" class=" bg-gradient-to-br from-blue-500 to-cyan-400 text-center text-sm w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-car" style="color: white;"></i>Go To MAp</a>
                        </div>
                    </div>
                    @endif

                    @if($session->status == 'booked')
                        <div class="w-full">
                            <div class="px-1 py-2 flex items-center gap-2 bg-gray-50">
                                <a href="{{route('bookNowPage', $session->parking->id)}}" class=" bg-gradient-to-br from-blue-500 to-cyan-400 text-center text-sm w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-car" style="color: white;"></i>Go To MAp</a>
                            </div>
                        </div>
                    @endif
                </div>
            </a>
            @endforeach
        @else
            <div class="m-4 p-4 rounded-2 flex items-center bg-red-100">
                <h3 class="text-sm mb-0 text-center text-red-500 font-semibold px-2">No available Parkings</h3>
            </div>
        @endif
    </div>
    

</div>


@endsection
