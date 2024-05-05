@extends('layouts.user.app')

@section('content')

<div class=" max-w-7xl -mt-24 mx-auto">
    <div class="p-3">
        <div class="-mt-10 m-auto">
            <div id="default-carousel" class="relative mt-4" data-carousel="static">
              <!-- Carousel wrapper -->
              <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 2xl:h-96">
                   <!-- Item 1 -->
                   @foreach ($parkingImages as $image)
                   <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                        <img src="{{ asset('/storage/'.$image->image_path) }}" class="block absolute top-1/2 bg-blend-overlay left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>
                   @endforeach
              </div>
              <!-- Slider indicators -->
              <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                  <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                  <button type="button" class="w-3 h-3  rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                  <button type="button" class="w-3 h-3  rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
              </div>
              <!-- Slider controls -->
              <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
                  <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-green-500 dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                      <svg class="w-5 h-5 text-green-500 sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                      <span class="hidden">Previous</span>
                  </span>
              </button>
              <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
                  <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-green-500 dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                      <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                      <span class="hidden">Next</span>
                  </span>
              </button>
          </div>
          </div>
    </div>
    

        <div class="px-2 rounded-4">

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


            <!-- Parking details -->
            <div class="flex lg:w-6/12 pb-4 w-full">
                <!-- Parking image -->
                <!-- Parking information -->
                <div class="w-full lg:w-7/12 pl-3">
                    <h5 class="mt-0 mb-2 dark:text-white">{{ $parking->parking_name }}</h5>
                    <p class="leading-normal text-sm dark:text-white dark:opacity-60">
                        <i class="fas fa-map-marker-alt  text-xl text-blue-500"></i> 
                        {{ $parking->location->address_address}}
                    </p>
                </div>
            </div>
            
            <!-- Distance and Estimated Time -->
            <div class="flex flex-wrap mb-44 -mx-3">
                <div class="w-full max-w-full px-3 flex-0">
                    <div id="address-map-container" style="width:100%;height:200px; ">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                    </div>
                </div>
            </div>
        </div>

</div>

<div class="animate-fade-up fixed bottom-0 right-0 left-0 pb-5 rounded-t-5 bg-white">
    <div class="">
        @livewire('slot-manager', ['parking' => $parking], key($parking->id))
    </div>

    <div class="flex w-full px-4 justify-center">
        <button id="select-type" class=" bg-gradient-to-br from-green-500 to-green-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-user" style="color: white;"></i>Book A Slot</button>
    </div>

    <div class="flex w-full p-2 hidden animate-fade-up" id="button-container">
        <div class="w-6/12">
            <div class="px-2 py-3 flex items-center gap-2 bg-gray-50">
                <button type="button" data-toggle="modal" data-target="#qrModal" class=" bg-gradient-to-br from-fuchsia-500 text-center to-purple-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-clock" style="color: white;"></i>For Later</button>
            </div>
        </div>
    
        <div class="w-6/12">
            <div class="px-2 py-3 flex items-center gap-2 bg-gray-50">
                <a href="{{route('bookNowPage', $parking->id)}}" class=" bg-gradient-to-br from-blue-500 to-cyan-400 text-center w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-car" style="color: white;"></i>For Now</a>
            </div>
        </div>
    </div>
</div>



 


<div class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto transition-opacity ease-linear opacity-0 z-sticky outline-0" id="qrModal" aria-hidden="true">
    <div class="relative w-auto min-h-screen transition-transform duration-300 pointer-events-none sm:m-7 sm:max-w-125 sm:mx-auto lg:mt-24 ease-soft-out -translate-y-13">
        <div class="relative flex flex-col w-full bg-white border border-solid pointer-events-auto dark:bg-gray-950 bg-clip-padding border-black/20 lg:rounded-4 outline-0">
            <div class="flex items-center justify-between p-4 border-b border-solid shrink-0 border-slate-100 rounded-t-xl">
                <h5 class="mb-0 leading-normal mr-2 dark:text-white" id="ModalLabel">Book Slot For Later</h5>
                <button type="button" data-toggle="modal" data-target="#qrModal" class="fa fa-close w-4 h-4 ml-auto box-content p-2 text-black dark:text-white border-0 rounded-1.5 opacity-50 cursor-pointer -m-2 " data-dismiss="modal"></button>
            </div>

            <div class="px-3 py-6">
                <h3 class="text-lg text-start"></h3>
            </div>

            <div class="flex p-3 rounded-8 flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-0">
                    <div id="address-map-container" style="width:100%;height:380px; ">
                        <div style="width: 100%; height: 100%" id="direction-map"></div>
                    </div>
                </div>
            </div>

            <div class="animate-fade-down pt-5 animate-once animate-duration-1000">
                <form  id="main-form"  action="{{ route('Parkinglater', $parking->id) }}" method="post">
                    @csrf
            
                        <div class="w-full max-w-full flex items-center px-6 pb-4 flex-0 lg:w-4/12">
                            <input datetimepicker name="setDate"  id="setDate" class="focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" type="text" placeholder="Please select a date" />
                        </div>
            
                        <div class="flex w-full px-4 mb-4 justify-center">
                            <button class=" bg-gradient-to-br from-green-500 to-green-400 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-flag" style="color: white;"></i>Book Slot</button>
                        </div>
            
                </form>
            </div>
           
        </div>
    </div>
</div>

@endsection


@push('scripts')


<script>
    // Function to toggle the visibility of the button-container
    function toggleButtonContainer() {
        var buttonContainer = document.getElementById('button-container');
        // Toggle the 'hidden' class to show/hide the container
        buttonContainer.classList.toggle('hidden');
    }

    // Add click event listener to the select-type button
    document.getElementById('select-type').addEventListener('click', function() {
        // Call the toggleButtonContainer function to show/hide the container
        toggleButtonContainer();
    });
</script>

<script>
    calculateDistanceAndTime("{{ $parking->location->address_address }}", {{ $parking->id }});

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

<!-- JavaScript -->
<script>
    // Function to initialize the map
    function initMap() {
        // Create a new map instance
        var map = new google.maps.Map(document.getElementById('address-map'), {
            zoom: 14, // Zoom level
            center: {lat: 0, lng: 0}, // Default center
            disableDefaultUI: true // Disable default UI controls
        });

        // Retrieve the parking ID from Blade template
        var parkingId = {{ $parking->id }};

        // AJAX request to fetch parking location using Laravel route
        $.ajax({
            url: "{{ route('parking.location', ['id' => $parking->id]) }}",
            method: 'GET',
            dataType: 'json',
            success: function(location) {
                // Parse latitude and longitude values as numbers
                var latitude = parseFloat(location.latitude);
                var longitude = parseFloat(location.longitude);

                // Check if latitude and longitude are valid numbers
                if (!isNaN(latitude) && !isNaN(longitude)) {
                    // Create a marker for the parking location
                    var marker = new google.maps.Marker({
                        position: {lat: latitude, lng: longitude},
                        map: map,
                        title: location.name, // Parking name
                    });

                    // Center the map on the parking location
                    map.setCenter(marker.getPosition());
                } else {
                    console.error('Invalid latitude or longitude values:', location.latitude, location.longitude);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching parking location:', error);
            }
        });
    }


    function initDirectionMap() {
        // Create a new map instance
        var directionMap = new google.maps.Map(document.getElementById('direction-map'), {
            zoom: 12, // Zoom level
            center: { lat: 0, lng: 0 }, // Center map (this will be updated with the route)
            disableDefaultUI: true
        });

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
                var directionsRenderer = new google.maps.DirectionsRenderer({
                    map: directionMap,
                });
                
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

    // Call initMap() function when the page loads
    $(document).ready(function() {
        initMap();
        initDirectionMap();
    });
</script>


@endpush