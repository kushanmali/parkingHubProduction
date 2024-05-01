@extends('layouts.user.app')

@section('content')
<div class="-mt-32 lg:-mt-24">
    <div class="relative">
        <div style="height: 100vh;">
            <div id="map" style="width: 100%; height: 100%;"></div>
        </div>
    </div>    
</div>

<div class="absolute bottom-0 m-0 p-2 w-full ">

    <div class="flex items-center px-2 gap-2 justify-start mb-4 max-w-full md:flex-0 shrink-0">
        <button type="button" data-toggle="modal" data-target="#qrModal" class="whitespace-nowrap font-bold flex items-center gap-2 text-lg text-center uppercase align-middle transition-all bg-transparent border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:text-blue-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-orange-500 active:bg-orange-500 active:text-white hover:active:border-orange-500 hover:active:bg-transparent hover:active:text-orange-500 hover:active:opacity-75"><i class="fas p-4 bg-white rounded-full text-6 fa-qrcode" style="color: black;"></i>  <span class="font-bold text-sm">SCAN QR</span></button>
    </div>  

    <div class="flex w-full flex-wrap bg-white p-3 rounded-4 justify-between">
        <div class="px-2 mb-4 w-full">

          <div class="flex w-full mb-4 items-center justify-center gap-4">
            <div id="distance-cn" style="display: none;" class="flex items-center mr-2">
               <div class="flex items-center gap-2">
                <i class="fas fa-road" style="color: blue;">
                </i> <p class="mb-0" id="distance" ></p>
               </div>
            </div>
            <div id="time-cn" style="display: none;" class="flex items-center" >
                <div class="flex items-center gap-2">
                    <i class="fas fa-clock" style="color: blue;"></i> 
                    <p class="mb-0" id="estimated-time" ></p></div>
                </div>
          </div>

          <div class="flex w-full justify-end">
            <button type="button"  class="inline-block px-4 w-6/12 py-2 mb-0 font-bold text-center text-black uppercase align-middle transition-all cursor-pointer hover:scale-102 active:opacity-85  dark:bg-gradient-to-tl leading-pro text-sm ease-soft-in tracking-tight-soft border-r border-black  bg-150 bg-x-25"><span>10</span> Slots</button>
            <button type="button"  class="inline-block px-4 w-6/12 py-2 mb-0 font-bold text-center text-black uppercase align-middle transition-all border-0  cursor-pointer hover:scale-102 active:opacity-85 dark:bg-gradient-to-tl leading-pro text-sm ease-soft-in tracking-tight-soft  bg-150 bg-x-25"><i class="fas fa-cash-register" style="color: green;"></i> Cash</button>
          </div>
        </div>

        <div class="text-center w-full flex-wrap flex justify-start items-center">
           <div class="flex justify-end w-full gap-2 items-center">
            <button id="go" class="bg-blue-500  w-6/12 py-2 text-white font-bold" onclick="startGuidance()" style="display: none;">Go</button>
            <button id="cancel" class="bg-red-500 w-6/12 py-2 text-white font-bold" onclick="cancelDirections()" style="display: none;">Cancel</button>
           </div> 
        </div>
    </div> 
</div>

<div class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto transition-opacity ease-linear opacity-0 z-sticky outline-0" id="qrModal" aria-hidden="true">
    <div class="relative w-auto h-screen transition-transform duration-300 pointer-events-none sm:m-7 sm:max-w-125 sm:mx-auto lg:mt-24 ease-soft-out -translate-y-13">
        <div class="relative flex flex-col w-full bg-white border border-solid pointer-events-auto dark:bg-gray-950 bg-clip-padding border-black/20 lg:rounded-4 outline-0">
            <div class="flex items-center justify-between p-4 border-b border-solid shrink-0 border-slate-100 rounded-t-xl">
                <h5 class="mb-0 leading-normal mr-2 dark:text-white" id="ModalLabel">Welcome {{$user->name}}</h5>
                <button type="button" data-toggle="modal" data-target="#qrModal" class="fa fa-close w-4 h-4 ml-auto box-content p-2 text-black dark:text-white border-0 rounded-1.5 opacity-50 cursor-pointer -m-2 " data-dismiss="modal"></button>
            </div>

            <a class="flex justify-center items-center mt-12 text-sm whitespace-nowrap text-slate-700 dark:text-white" href="{{route('index')}}">
                <img src="{{asset('assets/img/pHub-ico.webp')}}" class="inline-block h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:hidden" alt="main_logo" />
                <img src="{{asset('assets/img/pHub-ico.webp')}}" class="hidden h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:inline-block" alt="main_logo" />
                <h4 class="font-bold text-4xl mb-0">Parking <span class="bg-gradient-to-tl from-green-600 to-teal-400 bg-clip-text text-transparent text-4xl">HUB</span></h4>
            </a>

            <div class="animate-fade-down animate-once animate-duration-1000">
                <div class="grid grid-cols-1 justify-end">
                    <li class="list-none text-center">
                      <img class=" w-screen lg:w-fit" src="{{ url('storage/' . $qrCode->qr_code_path) }}" alt="qr-code">
                    </li>
                </div>
              </div>
           
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    var map;
    var infoWindow;
    var userLocationMarker;
    var userLocation;
    var directionsRenderer;
    var selectedParkingLatLng;
    var watchID;

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize the map with user's location and nearby parkings
        getUserLocation();
    });

    function getUserLocation() {
        // Check if geolocation is supported by the browser
        if (navigator.geolocation) {
            // Get user's current position
            navigator.geolocation.getCurrentPosition(function(position) {
                var userLatLng = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                userLocation = userLatLng;
                // Initialize the map centered at user's location
                initializeMap(userLatLng);
                // Fetch and display nearby parkings based on user's location
                fetchNearbyParkings(userLatLng);
            }, function(error) {
                // Handle errors, such as user denying permission
                console.error('Error getting user location:', error);
                // Initialize the map with default center if geolocation fails
                initializeMap({ lat: 0, lng: 0 });
            });
        } else {
            // Geolocation is not supported, initialize map with default center
            console.error('Geolocation is not supported.');
            initializeMap({ lat: 0, lng: 0 });
        }
    }

    function initializeMap(centerLatLng) {
        var mapOptions = {
            center: centerLatLng, // Center the map at user's location
            zoom: 12, // Initial zoom level
            fullscreenControl: false, // Hide fullscreen control
            mapTypeControl: false // Hide map type control
        };
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        infoWindow = new google.maps.InfoWindow();
        directionsRenderer = new google.maps.DirectionsRenderer();
        directionsRenderer.setMap(map);

        // Add marker for user's location
        userLocationMarker = new google.maps.Marker({
            position: centerLatLng,
            map: map,
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 10,
                fillColor: 'blue',
                fillOpacity: 1,
                strokeColor: 'white',
                strokeWeight: 2,
            },
            draggable: false,
            animation: google.maps.Animation.DROP,
            title: 'Your Location'
        });
    }

    function fetchNearbyParkings(centerLatLng) {
        // Make an AJAX request to your server to fetch nearby parkings
        $.ajax({
            type: 'GET',
            url: '/parkings/nearby', // Update the URL to match your endpoint
            data: {
                lat: centerLatLng.lat,
                lng: centerLatLng.lng
            },
            success: function (data) {
                // Display nearby parkings on the map
                displayParkingsOnMap(data.parkings);
            },
            error: function () {
                alert('Error fetching nearby parkings.');
            }
        });
    }

    function displayParkingsOnMap(parkings) {
        var bounds = new google.maps.LatLngBounds(); // Create bounds object

        if (parkings.length === 0) {
            // Display a message for no parkings
            var noParkingsContent = '<div class="text-center font-bold "><i class="fas fa-exclamation-circle p-4 text-4xl text-red-500"></i><h1 class="text-red text-xl font-bold">Oops...</h1><p class="text-center font-semibold text-lg text-black">No parkings available.</p></div>';
            infoWindow.setContent(noParkingsContent);
            infoWindow.setPosition(map.getCenter());
            infoWindow.open(map);
            return;
        }

        for (var i = 0; i < parkings.length; i++) {
            var parking = parkings[i];
            var parkingLatLng = new google.maps.LatLng(parking.location.address_latitude, parking.location.address_longitude);
            var marker = new google.maps.Marker({
                position: parkingLatLng,
                map: map,
                title: parking.parking_name,
            });

            // Extend the bounds to include this marker's position
            bounds.extend(parkingLatLng);

            // Create info window content for each marker
            var contentString = '<div class="p-4">' +
            '<h2 class="text-sm mb-0 font-semibold">' + parking.parking_name + '</h2>' +
            '<p class="text-sm mb-1">Slot Count: ' + parking.slot_count + '</p>' +
            '<button class="bg-blue-500 rounded-4 text-sm text-white px-4 py-2 mt-4" onclick="showDirections(' + parking.location.address_latitude + ', ' + parking.location.address_longitude + ')">Show Directions</button>' +
            '</div>';

            // Add event listener to display info window when marker is clicked
            google.maps.event.addListener(marker, 'click', (function (marker, contentString, lat, lng) {
                return function () {
                    infoWindow.setContent(contentString);
                    infoWindow.open(map, marker);
                    selectedParkingLatLng = new google.maps.LatLng(lat, lng); // Corrected assignment
                };
            })(marker, contentString, parking.location.address_latitude, parking.location.address_longitude));
        }

        // Fit the map to the calculated bounds
        map.fitBounds(bounds);

        // Set a minimum zoom level (e.g., 12)
        if (map.getZoom() > 12) {
            map.setZoom(12);
        }
    }

    function showDirections(destLat, destLng) {

        document.getElementById('go').style.display = 'inline-block';
        document.getElementById('cancel').style.display = 'inline-block';

        var directionsService = new google.maps.DirectionsService();
        var request = {
            origin: userLocation,
            destination: { lat: destLat, lng: destLng },
            travelMode: 'DRIVING' // Specify the travel mode as "DRIVING"
        };

        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(result);
                // Adjust the map viewport to show the route with the driving direction
                var bounds = result.routes[0].bounds;
                var mapCenter = bounds.getCenter();
                var northEast = bounds.getNorthEast();
                var northWest = new google.maps.LatLng(mapCenter.lat(), northEast.lng());
                bounds.extend(northWest);
                var heading = google.maps.geometry.spherical.computeHeading(mapCenter, northWest);
                map.fitBounds(bounds, { heading: heading });
            } else {
                console.error('Directions request failed due to ' + status);
            }
        });
    }

    function startGuidance() {
        // Close the info window
        infoWindow.close();

        // Show the distance and time display
        document.getElementById('distance-cn').style.display = 'inline-block';
        document.getElementById('time-cn').style.display = 'inline-block';

        // Start watching the user's position
        watchID = navigator.geolocation.watchPosition(function(position) {
            var userLatLng = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // Update the user's location marker
            userLocationMarker.setPosition(userLatLng);

            // Calculate and display real-time distance and estimated time
            var distance = google.maps.geometry.spherical.computeDistanceBetween(userLatLng, selectedParkingLatLng);
            document.getElementById('distance').innerText = distance.toFixed(2) + ' m';

            var duration = distance / (position.coords.speed || 1); // Assuming speed is in meters per second
            document.getElementById('estimated-time').innerText = (duration / 60).toFixed(2) + ' min'; // Convert duration to minutes

            // Update the route
            var directionsService = new google.maps.DirectionsService();
            var request = {
                origin: userLatLng,
                destination: selectedParkingLatLng,
                travelMode: 'DRIVING'
            };

            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    // Update the directions on the map
                    directionsRenderer.setDirections(result);
                    
                    // Adjust the map viewport to show the route with the driving direction
                    var bounds = result.routes[0].bounds;
                    var mapCenter = bounds.getCenter();
                    var northEast = bounds.getNorthEast();
                    var northWest = new google.maps.LatLng(mapCenter.lat(), northEast.lng());
                    bounds.extend(northWest);
                    var heading = google.maps.geometry.spherical.computeHeading(mapCenter, northWest);
                    map.fitBounds(bounds, { heading: heading });

                    // Rotate the map to the user's heading direction
                    map.setHeading(position.coords.heading || 0);
                } else {
                    console.error('Directions request failed due to ' + status);
                }
            });

            // Center the map at the user's location
            map.setCenter(userLatLng);

            // Zoom in more
            map.setZoom(8); // Adjust the zoom level as needed
        }, function(error) {
            console.error('Error getting user location:', error);
        }, {
            enableHighAccuracy: true, // Use high accuracy mode
            maximumAge: 0, // Force to always get the latest location
            timeout: Infinity // Wait indefinitely for the location
        });
    }




    function cancelDirections() {
        // Hide the Go and Cancel buttons
        document.getElementById('go').style.display = 'none';
        document.getElementById('cancel').style.display = 'none';
        document.getElementById('distance-cn').style.display = 'none';
        document.getElementById('time-cn').style.display = 'none';

        // Clear the watch position
        navigator.geolocation.clearWatch(watchID);

        // Remove the route from the map
        directionsRenderer.setMap(null);

        // Refetch and display nearby parkings based on the user's location
        getUserLocation();
    }

</script>

@endpush
