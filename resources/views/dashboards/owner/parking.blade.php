@extends('layouts.owner.app')

@section('content')

<div class="w-full p-6 mx-auto">
    <div class="relative flex flex-col flex-auto min-w-0 p-4 mb-4 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border" id="profile">
        <div class="flex flex-wrap items-center justify-between -mx-3">
            <div class="w-full  max-w-full px-3 my-auto flex justiy-between items-center">
                <div class="h-full w-6/12">
                    <h5 class="mb-1 font-bold dark:text-white">Parking</h5>
                    <p class="mb-0 font-semibold leading-normal text-sm">My parkings / Parking</p>
                </div>

                <div class="flex w-6/12 items-center px-2 gap-2 justify-end max-w-full md:flex-0 shrink-0">
                    <button type="button" data-toggle="modal" data-target="#qrModal" class="whitespace-nowrap font-bold flex items-center gap-2 text-lg text-center uppercase align-middle transition-all bg-transparent border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:text-blue-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-orange-500 active:bg-orange-500 active:text-white hover:active:border-orange-500 hover:active:bg-transparent hover:active:text-orange-500 hover:active:opacity-75"> <span class="font-bold text-sm">SCAN QR</span><i class="fas p-4 bg-white rounded-full text-6 fa-qrcode" style="color: black;"></i></button>
                </div>  
            </div>
        </div>
    </div>



    <div class="flex flex-wrap mt-6 -mx-3">

         <div class="w-full max-w-full px-3 md:w-6/12 md:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
              <div class="pt-6 pb-6 px-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
                <div class="flex-auto p-4">
                    <div class="flex flex-wrap -mx-3">
                      <div class="w-6/12 max-w-full px-3 mb-4 text-center flex-0 lg:w-6/12">
                        <a href="{{route('parkingActiveSessions', $parking->id)}}">
                        <div class="py-4 border border-dashed rounded-lg border-slate-400">
                          <h6 class="relative mb-0 text-transparent z-1 bg-clip-text bg-gradient-to-tl from-purple-700 to-pink-500">Active Sessions</h6>
                          <h4 class="font-bold dark:text-white">
                            <span id="state1">{{count($activeParkingSessions)}}</span>
                          </h4>
                        </a>
                        </div>
                      </div>
                      
                      <div class="w-6/12 max-w-full mb-4 px-3 text-center flex-0 lg:w-6/12">
                        <div class="py-4 border border-dashed rounded-lg border-slate-400">
                          <h6 class="relative mb-0 text-transparent z-1 bg-clip-text bg-gradient-to-tl from-purple-700 to-pink-500">active Slots</h6>
                          <h4 class="font-bold dark:text-white">
                            <span id="state2">1</span>
                          </h4>
                        </div>
                      </div>
                      <div class="w-6/12 max-w-full px-3 mt-6 text-center flex-0 lg:w-6/12 lg:mt-0">
                        <div class="py-4 border border-dashed rounded-lg border-slate-400">
                          <h6 class="relative mb-0 text-transparent z-1 bg-clip-text bg-gradient-to-tl from-purple-700 to-pink-500">Monthly Earning</h6>
                          <h4 class="font-bold dark:text-white">
                            <span id="state3">1</span>
                          </h4>
                        </div>
                      </div>
                      <div class="w-6/12 max-w-full px-3 mt-6 text-center flex-0 lg:w-6/12 lg:mt-0">
                        <div class="py-4 border border-dashed rounded-lg border-slate-400">
                          <h6 class="relative mb-0 text-transparent z-1 bg-clip-text bg-gradient-to-tl from-purple-700 to-pink-500">All time earning</h6>
                          <h4 class="font-bold dark:text-white">
                            <span >1</span>
                          </h4>
                        </div>
                      </div>
                    </div>         
                </div>
              </div>
            </div>
          </div>


        <div class="w-full max-w-full px-3 shrink-0 lg:flex-0 lg:w-6/12">
            
            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">

                <form class="relative mb-32" action="{{ route('updateParking', $user->id) }}" method="post">
                    @csrf

                    <div active form="user" class="absolute top-0 left-0 flex flex-col visible w-full h-auto min-w-0 p-4 break-words bg-white border-0 opacity-100 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                    <h5 class="mb-0 font-bold dark:text-white">update {{$parking->parking_name}} Parking Space</h5>
                    <p class="mb-0 leading-normal text-sm">Parking basic details</p>
                        <div>
                            <div class="flex flex-wrap mt-4 -mx-3">
                                <div class="w-full max-w-full px-3 flex-0 lg:w-6/12">
                                    <label class="mt-6 mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="parkingName">Parking Name</label>
                                    <input type="text" name="parkingName" value="{{$parking->parking_name}}" placeholder="parking name" class="{{ $errors->has('parkingName') ? 'border-red-500' : 'border-gray-300' }}  focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" value="{{ old('UserName') }}"/>
                                    @error('parkingName')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full max-w-full px-3 flex-0 lg:w-6/12">
                                    <label class="mt-6 mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="slotCount">Available Slots</label>
                                    <input type="number" name="slotCount" value="{{$parking->slot_count}}" placeholder="count" class="{{ $errors->has('slotCount') ? 'border-red-500' : 'border-gray-300' }}  focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" value="{{ old('UserName') }}"/>
                                    @error('slotCount')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="w-full max-w-full px-3 flex-0">
                                    <label class="mt-6 mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="slotCount">Price For Slot (Hour)</label>
                                    <input type="number" step="any" name="price" value="{{$parking->price}}" placeholder="LKR" class="{{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }}  focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-black focus:outline-none" value="{{ old('UserName') }}"/>
                                    @error('price')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <div class="flex flex-wrap mt-4 -mx-3">
                                    <div class="w-full max-w-full px-3 flex-0">
                                        <label class="mb-2 ml-1 font-bold text-xs text-slate-700 dark:text-white/80" for="address-input">Address</label>
                                        <input type="text" id="address-input" value="{{$parking->location->address_address}}" name="address_address" class="focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none map-input">
                                        <input type="hidden" name="address_latitude" value="{{$parking->location->address_latitude}}" id="address-latitude">
                                        <input type="hidden" name="address_longitude" value="{{$parking->location->address_longitude}}" id="address-longitude">
                                    </div>                                    
                                </div>
                                <div class="flex flex-wrap mt-4 -mx-3">
                                    <div class="w-full max-w-full px-3 flex-0">
                                        <div id="address-map-container" style="width:100%;height:200px; ">
                                            <div style="width: 100%; height: 100%" id="address-map"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex mt-6">
                                <button type="submit" class="inline-block px-6 py-3 mb-0 ml-auto font-bold text-right text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs dark:bg-gradient-to-tl dark:from-slate-850 dark:to-gray-850 bg-gradient-to-tl from-gray-900 to-slate-800 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25">Submit</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div form="address" class="absolute top-0 left-0 flex flex-col invisible w-full h-0 min-w-0 p-4 break-words bg-white border-0 opacity-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                    <h5 class="font-bold dark:text-white">Address</h5>
                    
                    </div>
                </form>
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

            <div class="flex py-2 w-full justify-center">
                <button id="start" class="bg-blue-500 w-6/12 py-2 rounded-12 text-white font-bold"><i class="fas mr-2 fa-qrcode" style="color: white;"></i>Scan QR</button>
           </div>
            <div class="qr-scan-container">
                <video id="qr-video" width="100%" height="100%" autoplay></video>
                <canvas id="qr-canvas" style="display: none;"></canvas>
            </div>
           
        </div>
    </div>
</div>


@endsection


@push('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Function to initialize the map and form inputs with existing values
        function initialize() {
            // Get the existing location inputs and initialize autocompletes
            const locationInputs = document.getElementsByClassName("map-input");
            const autocompletes = [];

            for (let i = 0; i < locationInputs.length; i++) {
                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

                // Create map for each input
                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: { lat: latitude, lng: longitude },
                    zoom: 13
                });

                // Create marker for each input
                const marker = new google.maps.Marker({
                    map: map,
                    position: { lat: latitude, lng: longitude },
                    draggable: true
                });

                // Initialize autocomplete for each input
                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;

                // Push to autocompletes array
                autocompletes.push({ input: input, map: map, marker: marker, autocomplete: autocomplete });
            }

            // Listen for autocomplete place changes
            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }

                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                    // Update location coordinates
                    setLocationCoordinates(autocomplete.key, place.geometry.location.lat(), place.geometry.location.lng());
                });
            }
        }

        // Function to set location coordinates in hidden inputs
        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-latitude");
            const longitudeField = document.getElementById(key + "-longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }

        // Initialize the map and form when the window loads
        initialize();
    });
</script>

<script>
    // Function to start QR code scanning
    function startScan(parkingId) {
        // Access video element
        const video = document.getElementById('qr-video');

        // Check if video stream is available
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            // Access user's camera
            navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
                .then(function(stream) {
                    // Display video stream in the video element
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.error('Error accessing user media:', error);
                });
        }

        // Set up a loop to continuously capture video frames and attempt to decode QR codes
        const scanningInterval = setInterval(function() {
            // Access video element and canvas
            const video = document.getElementById('qr-video');
            const canvas = document.getElementById('qr-canvas');
            const context = canvas.getContext('2d');

            // Set canvas dimensions to match video dimensions
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw current video frame on canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Get image data from canvas
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

            // Decode QR code from image data
            const code = jsQR(imageData.data, imageData.width, imageData.height);

            // If QR code is found, take appropriate action
            if (code) {
                console.log('QR Code detected:', code.data);
                
                // Perform action with the detected QR code (e.g., initiate AJAX request)
                initiateSession(code.data, parkingId);

                // Stop scanning after detecting a QR code
                clearInterval(scanningInterval);
                
                // Stop video stream after 15 seconds
                setTimeout(function() {
                    stopVideoStream(video);
                }, 15000); // 15 seconds in milliseconds

            }
        }, 100); // Adjust interval as needed

        // Automatically stop scanning after 15 seconds
        setTimeout(function() {
            clearInterval(scanningInterval);
            console.log('Scanning stopped after 15 seconds');
            // Stop video stream after 15 seconds even if QR code is not detected
            stopVideoStream(video);
        }, 15000); // 15 seconds in milliseconds
    }

    // Function to stop video stream
    function stopVideoStream(videoElement) {
        const stream = videoElement.srcObject;
        const tracks = stream.getTracks();

        tracks.forEach(function(track) {
            track.stop();
        });

        videoElement.srcObject = null;
    }

    // Function to initiate session with customer ID and parking ID
    function initiateSession(customerId, parkingId) {
        // Construct the URL with the customer ID and parking ID
        const url = `/start-session?customerId=${encodeURIComponent(customerId)}&parkingId=${encodeURIComponent(parkingId)}`;
        
        // Redirect the user to the start-session URL
        window.location.href = url;
    }

    // Attach event listener to start button to trigger scanning
    document.getElementById('start').addEventListener('click', function() {
        // Retrieve parking ID from a data attribute or any other method you're using to pass it to the JavaScript function
        const parkingId = {!! json_encode($parking->id) !!};
        startScan(parkingId);
    });
</script>


@endpush