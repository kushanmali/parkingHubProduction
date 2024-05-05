@extends('layouts.user.app')

@section('content')

<div class="-mt-28 lg:-mt-16">
    <div class="relative">
        <div style="height: 100vh;">
            <div id="map" style="width: 100%; height: 100%;"></div>
        </div>
    </div>    
</div>

<div class="animate-fade-up fixed bottom-0 right-0 left-0 pb-5 rounded-t-5 bg-white">
    <div class="">
        @livewire('slot-manager', ['parking' => $parking], key($parking->id))
    </div>

    @if (!$existingSession)
        <div class="flex w-full px-4 mb-4 justify-center">
            <a href="{{ route('parking.session.create', ['parking' => $parking->id]) }}" id="start-button" class=" bg-gradient-to-br text-center from-green-500 to-green-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-flag" style="color: white;"></i>Start</a>
        </div>
    @endif

    @if ($existingSession)
        @if ($existingSession->status == 'booked' || $existingSession->status == 'preBooked')
            <div class="flex w-full px-4 mb-4 justify-center">
                <button id="start-button" type="button" data-toggle="modal" data-target="#qrModal" class=" bg-gradient-to-br from-blue-500 to-cyan-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-qrcode" style="color: white;"></i>Scan Qr Code</button>
            </div>
        @endif
    @endif

    <div class="flex w-full px-4 justify-center">
        <a href="{{route('cancelPage', $parking->id)}}" id="cancel-button" class=" bg-gradient-to-br from-red-600 text-center to-pink-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-times" style="color: white;"></i>Cancel</a>
    </div>
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

<!-- JavaScript -->
<script>
    var map; // Declare map variable globally
    
    // Function to initialize the map
    function initMap() {
        // Create a new map instance
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12, // Zoom level

            center: { lat: parseFloat({{ $parking->location->address_latitude }}), lng: parseFloat({{ $parking->location->address_longitude }}) }, // Center map on parking location
        });
    }
    
    // Function to handle the click event of the "Book Now" button
    function bookNow() {
        // Get the parking location coordinates
        var parkingLocation = { lat: parseFloat({{ $parking->location->address_latitude }}), lng: parseFloat({{ $parking->location->address_longitude }}) };
        
        // Get the user's current location using the Geolocation API
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Calculate the route from user's location to parking location
                var directionsService = new google.maps.DirectionsService();
                var directionsRenderer = new google.maps.DirectionsRenderer();
                
                directionsRenderer.setMap(map);
                
                var request = {
                    origin: userLocation,
                    destination: parkingLocation,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                
                directionsService.route(request, function(result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsRenderer.setDirections(result);
                    } else {
                        console.error('Error fetching directions:', status);
                    }
                });
            }, function(error) {
                console.error('Error getting user location:', error);
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
        }
    }

    function startNavigation() {
        // Get user's current location
        navigator.geolocation.getCurrentPosition(function(position) {
            var userLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            // Calculate route
            var request = {
                origin: userLocation,
                destination: { lat: parseFloat({{ $parking->location->address_latitude }}), lng: parseFloat({{ $parking->location->address_longitude }}) },
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    // Display the route on the map
                    directionsRenderer.setDirections(result);

                    // Update the route periodically
                    setInterval(function() {
                        updateRoute(userLocation);
                    }, 10000); // Update every 10 seconds (adjust as needed)
                } else {
                    console.error('Error calculating route:', status);
                }
            });
        }, function(error) {
            console.error('Error getting user location:', error);
        });
    }



    function updateRoute(userLocation) {
        // Recalculate route
        var request = {
            origin: userLocation,
            destination: { lat: parseFloat({{ $parking->location->address_latitude }}), lng: parseFloat({{ $parking->location->address_longitude }}) },
            travelMode: 'DRIVING'
        };

        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                // Update the route on the map
                directionsRenderer.setDirections(result);
            } else {
                console.error('Error updating route:', status);
            }
        });
    }
    
    // Call initMap() function when the page finishes loading
    window.onload = function() {
        initMap();
        bookNow();
        startNavigation();
    };
</script>


@endpush