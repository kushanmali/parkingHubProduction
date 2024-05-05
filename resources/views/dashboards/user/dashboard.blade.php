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


    @if(session('success'))
        <div id="success-message" class="bg-green-500 mx-4 text-white rounded-3 p-6 my-5">
            {{ session('success') }}
        </div>
    @endif

    @if(session('fail'))
        <div id="fail-message" class="bg-red-500 mx-4 text-white rounded-3 p-6 my-5">
            {{ session('fail') }}
        </div>
    @endif


    <div class="p-3">
        <h1 class="text-black pb-4 text-xl">All Parkings</h1>
    
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
    
        @if($parkings->count() > 0)
            @foreach($parkings as $parking)
            <a href="{{route('viewUserParking', $parking->id)}}">
                <div class="p-2 shadow-soft-lg rounded-4">
                    <!-- Parking details -->
                    <div class="flex lg:w-6/12 pb-4 w-full">
                        <!-- Parking image -->
                        <div class="w-4/12 lg:w-5/12">
                            <img src="{{ asset('/storage/'.$parking->profile_img_path) }}" alt="Parking Image" class="inline-flex items-center justify-center w-full object-cover text-white transition-all duration-200 text-base ease-soft-in-out rounded-4">
                        </div>
                        <!-- Parking information -->
                        <div class="w-8/12 lg:w-7/12 pl-3">
                            <h5 class="mt-0 mb-2 dark:text-white">{{ $parking->parking_name }}</h5>
                            <p class="leading-normal text-sm dark:text-white dark:opacity-60">
                                <i class="fas fa-map-marker-alt  text-xl text-blue-500"></i> 
                                {{ \Illuminate\Support\Str::limit($parking->location->address_address, 55) }}
                            </p>
                        </div>
                    </div>
                    <!-- Distance and Estimated Time -->
                    <div class="flex gap-2  w-full p-2">
                        <div class="w-6/12">
                            <div class="px-4 py-3 flex items-center gap-2 bg-gray-200">
                                <i class="fas text-xl fa-road" style="color: blue;"></i> 
                                <p class="mb-0 text-xs text-black font-bold" id="distance_{{ $parking->id }}">Cal...</p>
                            </div>
                        </div>
                    
                        <div class="w-6/12">
                            <div class="px-4 py-3 flex items-center gap-2 bg-gray-200">
                                <i class="fas text-xl fa-clock" style="color: blue;"></i> 
                                <p class="mb-0 text-xs text-black font-bold" id="est-time_{{ $parking->id }}">Cal...</p>
                            </div>
                        </div>
                    </div>
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

<div class="relative max-w-7xl -mt-24 mx-auto">
    
</div>

<div class=" fixed bottom-3 right-6 flex items-center px-2 gap-2 justify-start mb-4 max-w-full md:flex-0 shrink-0">
    <button type="button" data-toggle="modal" data-target="#qrModal" class="whitespace-nowrap font-bold flex items-center gap-2 text-lg text-center uppercase align-middle transition-all bg-transparent border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:text-blue-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-orange-500 active:bg-orange-500 active:text-white hover:active:border-orange-500 hover:active:bg-transparent hover:active:text-orange-500 hover:active:opacity-75"><i class="fas p-4 bg-white rounded-full text-6 fa-qrcode" style="color: black;"></i>  <span class="font-bold text-sm">SCAN QR</span></button>
</div>  


<div class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto transition-opacity ease-linear opacity-0 z-sticky outline-0" id="qrModal" aria-hidden="true">
    <div class="relative w-auto min-h-screen transition-transform duration-300 pointer-events-none sm:m-7 sm:max-w-125 sm:mx-auto lg:mt-24 ease-soft-out -translate-y-13">
        <div class="relative flex flex-col w-full bg-white border border-solid pointer-events-auto dark:bg-gray-950 bg-clip-padding border-black/20 lg:rounded-4 outline-0">
            <div class="flex items-center justify-between p-4 border-b border-solid shrink-0 border-slate-100 rounded-t-xl">
                <h5 class="mb-0 leading-normal mr-2 dark:text-white" id="ModalLabel"></h5>
                <button type="button" data-toggle="modal" data-target="#qrModal" class="fa fa-close w-4 h-4 ml-auto box-content p-2 text-black dark:text-white border-0 rounded-1.5 opacity-50 cursor-pointer -m-2 " data-dismiss="modal"></button>
            </div>

            <div class="animate-fade-down animate-once animate-duration-1000">
                <div class="grid grid-cols-1 justify-end">
                    <li class="list-none text-center">
                      <img class=" w-56 lg:w-fit" src="{{ url('storage/' . $qrCode->qr_code_path) }}" alt="qr-code">
                    </li>
                </div>
            </div>

            <div class="w-screen px-5 pb-44">
                <div class="flex w-full pb-3 pt-12 justify-center">
                    <div class="w-6/12">
                        <p class="text-sm mb-0">User Name</p>
                        <h3 class="text-lg font-bold">{{$user->name}}</h3>
                    </div>
                    <div class="w-6/12">
                        <p class="text-sm mb-0">User Email</p>
                        <h3 class="text-lg font-bold">{{$user->email}}</h3>
                    </div>
                </div>
                <div class="flex w-full pt-12 justify-center">
                    <div class="w-6/12">
                        <p class="text-sm mb-0">User Address</p>
                        <h3 class="text-lg font-bold">{{$user->name}}</h3>
                    </div>
                    <div class="w-6/12">
                        <p class="text-sm mb-0">User Name</p>
                        <h3 class="text-lg font-bold">{{$user->name}}</h3>
                    </div>
                </div>
                <div class="flex w-full pt-12 justify-center">
                    <div class="w-6/12">
                        <p class="text-sm mb-0">User Name</p>
                        <h3 class="text-lg font-bold">{{$user->name}}</h3>
                    </div>
                    <div class="w-6/12">
                        <p class="text-sm mb-0">User Name</p>
                        <h3 class="text-lg font-bold">{{$user->name}}</h3>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>

@endsection


@push('scripts')

<script>
    // Function to hide success or fail message after 10 seconds
    function hideMessage() {
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }

            var failMessage = document.getElementById('fail-message');
            if (failMessage) {
                failMessage.style.display = 'none';
            }
        }, 10000); // Hide after 10 seconds (adjust as needed)
    }

    // Call hideMessage function on page load
    window.onload = function() {
        hideMessage();
    };
</script>

<script>
    @foreach($parkings as $parking)
        calculateDistanceAndTime("{{ $parking->location->address_address }}", {{ $parking->id }});
    @endforeach

    function calculateDistanceAndTime(destination, parkingId) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var origin = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix(
                    {
                        origins: [origin],
                        destinations: [destination],
                        travelMode: 'DRIVING',
                    },
                    function(response, status) {
                        if (status !== 'OK') {
                            console.log('Error:', status);
                        } else {
                            var element = document.getElementById("distance_" + parkingId);
                            var element2 = document.getElementById("est-time_" + parkingId);
                            if (response.rows && response.rows.length > 0 && response.rows[0].elements && response.rows[0].elements.length > 0) {
                                element.innerText = response.rows[0].elements[0].distance.text || 'Distance not available';
                                element2.innerText = response.rows[0].elements[0].duration.text || 'Duration not available';
                            } else {
                                element.innerText = 'Distance not available';
                                element2.innerText = 'Duration not available';
                            }
                        }
                    }
                );
            });
        } else {
            console.log('Geolocation is not supported by this browser.');
        }
    }
</script>
    
@endpush