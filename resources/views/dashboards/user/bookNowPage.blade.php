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

    <div class="flex w-full px-4 mb-4 justify-center">
        <button id="start-button" class=" bg-gradient-to-br from-green-500 to-green-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-flag" style="color: white;"></i>Start</button>
    </div>

    <div class="flex w-full px-4 justify-center" style="display: none;">
        <button id="cancel-button" class=" bg-gradient-to-br from-fuchsia-600 to-pink-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-flag" style="color: white;"></i>Cancel</button>
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

    function startNavigation() {
        // Get the parking ID
        var parkingId = {{ $parking->id }};
        
        // AJAX request to create a new parking session
        $.ajax({
            url: "{{ route('parking.session.create', ['parking' => $parking->id]) }}",
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Parking session created:', response.session);

                // Start navigating the user in real-time
                // Add your code to navigate the user using waypoints
            },
            error: function(xhr, status, error) {
                console.error('Error creating parking session:', error);
            }
        });
    }
    
    // Add click event listener to the "Start" button
    document.getElementById('start-button').addEventListener('click', function() {
        startNavigation();
    });



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
    };
</script>


@endpush