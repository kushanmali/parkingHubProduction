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

    @if($errors->any())
        <div class="bg-red-500 text-white rounded-3 p-6 my-5">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-wrap w-full">
        <div class="flex w-full lg:w-4/12">
            <div class="max-w-sm w-full bg-white shadow-sm rounded-lg overflow-hidden my-4">
                <div id="img-placeholder" class="w-full bg-black max-w-full !flex justify-start">
                    @if($parking->profile_img_path)
                        <img class="w-full h-56 object-cover object-center" src="{{ asset('/storage/'.$parking->profile_img_path) }}" alt="avatar">
                    @else
                        <img class="w-full h-56 object-cover object-center" src="" alt="avatar">
                    @endif
                </div>
                <div class="flex justify-end -mt-5 items-start">
                    <div class="">
                        <div class="flex w-6/12 items-center px-2 gap-2 justify-end max-w-full md:flex-0 shrink-0">
                            <button type="button" data-toggle="modal" data-target="#uploadProfileModal" class="whitespace-nowrap  font-bold flex items-center gap-2 text-lg text-center uppercase align-middle transition-all bg-transparent border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:text-blue-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-blue-500 active:bg-blue-500 active:text-white hover:active:border-blue-500 hover:active:bg-transparent hover:active:text-blue-500 hover:active:opacity-75"> <span class="font-bold text-sm"></span><i class="fas px-3 py-3 bg-gradient-to-tr from-blue-500 to-cyan-400 rounded-full text-4 fa-pen" style="color: rgb(255, 255, 255);"></i></button>
                        </div>  
                    </div>
                </div>

                <div class="py-4 px-6">
                    <h1 class="text-2xl font-semibold text-gray-800"></h1>
                    <div class="flex items-center mt-4 text-gray-700">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 512 512">
                            <path d="M239.208 343.937c-17.78 10.103-38.342 15.876-60.255 15.876-21.909 0-42.467-5.771-60.246-15.87C71.544 358.331 42.643 406 32 448h293.912c-10.639-42-39.537-89.683-86.704-104.063zM178.953 120.035c-58.479 0-105.886 47.394-105.886 105.858 0 58.464 47.407 105.857 105.886 105.857s105.886-47.394 105.886-105.857c0-58.464-47.408-105.858-105.886-105.858zm0 186.488c-33.671 0-62.445-22.513-73.997-50.523H252.95c-11.554 28.011-40.326 50.523-73.997 50.523z"/><g><path d="M322.602 384H480c-10.638-42-39.537-81.691-86.703-96.072-17.781 10.104-38.343 15.873-60.256 15.873-14.823 0-29.024-2.654-42.168-7.49-7.445 12.47-16.927 25.592-27.974 34.906C289.245 341.354 309.146 364 322.602 384zM306.545 200h100.493c-11.554 28-40.327 50.293-73.997 50.293-8.875 0-17.404-1.692-25.375-4.51a128.411 128.411 0 0 1-6.52 25.118c10.066 3.174 20.779 4.862 31.895 4.862 58.479 0 105.886-47.41 105.886-105.872 0-58.465-47.407-105.866-105.886-105.866-37.49 0-70.427 19.703-89.243 49.09C275.607 131.383 298.961 163 306.545 200z"/></g>
                        </svg>
                        <h1 class="px-2 mb-0 text-sm">{{$parking->parking_name}}</h1>
                    </div>
                    <div class="flex items-center mt-4 text-gray-700">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 512 512">
                            <path d="M437.332 80H74.668C51.199 80 32 99.198 32 122.667v266.666C32 412.802 51.199 432 74.668 432h362.664C460.801 432 480 412.802 480 389.333V122.667C480 99.198 460.801 80 437.332 80zM432 170.667L256 288 80 170.667V128l176 117.333L432 128v42.667z"/>
                        </svg>
                        <h1 class="px-2 mb-0 text-sm">{{$parking->owner->email}}</h1>
                    </div>
                    <div class="flex items-center mt-4 text-gray-700">
                        <svg class="h-10 w-10 fill-current" viewBox="0 0 512 512">
                            <path d="M256 32c-88.004 0-160 70.557-160 156.801C96 306.4 256 480 256 480s160-173.6 160-291.199C416 102.557 344.004 32 256 32zm0 212.801c-31.996 0-57.144-24.645-57.144-56 0-31.357 25.147-56 57.144-56s57.144 24.643 57.144 56c0 31.355-25.148 56-57.144 56z"/>
                        </svg>
                        <h1 class="px-2 mb-0 text-sm">{{ $parking->location->address_address ? $parking->location->address_address : 'N/A' }}</h1>
                    </div>
                    <div class="flex items-center mt-4 text-gray-700">
                        <svg class="h-4 w-4 fill-current" viewBox="0 0 19 19" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#000000" fill-rule="evenodd" d="M207.960546,159.843246 L210.399107,161.251151 C210.637153,161.388586 210.71416,161.70086 210.580127,161.933013 C210.442056,162.172159 210.144067,162.258604 209.899107,162.117176 L207.419233,160.68542 C207.165323,160.8826 206.846372,161 206.5,161 C205.671573,161 205,160.328427 205,159.5 C205,158.846891 205.417404,158.291271 206,158.085353 L206,153.503423 C206,153.22539 206.231934,153 206.5,153 C206.776142,153 207,153.232903 207,153.503423 L207,158.085353 C207.582596,158.291271 208,158.846891 208,159.5 C208,159.6181 207.986351,159.733013 207.960546,159.843246 Z M206.5,169 C211.746705,169 216,164.746705 216,159.5 C216,154.253295 211.746705,150 206.5,150 C201.253295,150 197,154.253295 197,159.5 C197,164.746705 201.253295,169 206.5,169 Z" transform="translate(-197 -150)"/>
                        </svg>
                        <h1 class="px-2 mb-0 text-sm">{{ $parking->slot_count ? $parking->slot_count : 'N/A' }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:w-8/12 w-full overflow-x-auto px-5">
            @if($parking->images !== null)
                <div class="grid gap-2 p-4 grid-cols-2 lg:grid-cols-2">
                    @foreach ($parking->images as $image)
                        <div id="img-placeholder" class="w-full bg-black max-w-full !flex justify-start">
                            <img class="w-full h-56 object-cover object-center" src="{{ asset('/storage/'.$image->image_path) }}" alt="avatar">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="m-4 p-4 rounded-2 flex items-center  bg-red-100">
                    <h3 class="text-sm mb-0 text-center text-red-500 font-semibold px-2">Image Gallery Is Empty</h3>
                </div>
            @endif
            <form class="relative mb-32"  enctype="multipart/form-data" action="{{ route('storeParkingImages', $parking->id) }}" method="post">
                @csrf

                <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:bg-opacity-20 dark:backdrop-blur-xl dark:shadow-soft-dark-xl rounded-2xl bg-clip-border">
                
                <div class="flex-auto p-6">
                    <div class="flex flex-wrap items-center  -mx-3">
                        <div class="w-full flex items-end  px-2 max-w-full ">
                            <div class=" w-full max-w-full">
                                <div dropzone class="dropzone !min-h-fit focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-border px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" id="dropzone">
                                    <input type="file" name="gallery-img[]" multiple onchange="previewImageFile()" />
                                </div>
                            </div>
                        </div>              
                    </div>
                </div>
                
           
                <div class="flex py-6 w-full px-4 justify-center">
                    <button id="start" class="bg-blue-500 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-upload" style="color: white;"></i>Sync Gallery</button>
                </div>

            </form>
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



    <div class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto transition-opacity ease-linear opacity-0 z-sticky outline-0" id="uploadProfileModal" aria-hidden="true">
        <div class="relative w-auto min-h-screen transition-transform duration-300 pointer-events-none sm:m-7 sm:max-w-125 sm:mx-auto lg:mt-24 ease-soft-out -translate-y-13">
            <div class="relative min-h-screen flex flex-col w-full bg-white border border-solid pointer-events-auto dark:bg-gray-950 bg-clip-padding border-black/20 lg:rounded-4 outline-0">
                <div class="flex items-center justify-between p-4 border-b border-solid shrink-0 border-slate-100 rounded-t-xl">
                    <h5 class="mb-0 leading-normal mr-2 dark:text-white" id="ModalLabel">Edit Parking Profile</h5>
                    <button type="button" data-toggle="modal" data-target="#uploadProfileModal" class="fa fa-close w-4 h-4 ml-auto box-content p-2 text-black dark:text-white border-0 rounded-1.5 opacity-50 cursor-pointer -m-2 " data-dismiss="modal"></button>
                </div>
    
                <form class="relative mb-32"  enctype="multipart/form-data" action="{{ route('addParkingProfile', $parking->id) }}" method="post">
                    @csrf
    
                    <div class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:bg-opacity-20 dark:backdrop-blur-xl dark:shadow-soft-dark-xl rounded-2xl bg-clip-border">
                    
                    <div class="flex-auto p-6">
                        <div class="flex flex-wrap items-center  -mx-3">
                                <div id="img-placeholder" class="w-full pb-4 max-w-full !flex justify-center">
                                    <img id="previewImage" class=" w-44 mt-4 object-cover"  src="{{ asset('assets/img/parking-hub-icon.jpg') }}" alt="">
                                </div>
    
                            <div class="w-full flex items-end  px-2 max-w-full ">
                                <div class=" w-full max-w-full">
                                    <div dropzone class="dropzone !min-h-fit focus:shadow-soft-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-border px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" id="dropzone">
                                        <input type="file" name="pro-img" multiple onchange="previewFile()" />
                                    </div>
                                </div>
                            </div>              
                        </div>
                    </div>
                    
               
                    <div class="flex py-6 w-full px-4 justify-center">
                        <button id="start" class="bg-blue-500 w-full py-3 rounded-12 text-white font-bold"><i class="fas mr-2 fa-upload" style="color: white;"></i>Upload File</button>
                    </div>
    
                </form>
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
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to preview the selected file or webcam capture
    
            const fileInput = document.querySelector('input[name="pro-img"]');
            fileInput.addEventListener('change', previewFile);
    
            function previewFile() {
                const placeholder = document.getElementById('img-placeholder');
                const webcamPreview = document.getElementById('webcamPreview');
                const previewImage = document.getElementById('previewImage');
    
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    previewImage.src = URL.createObjectURL(file);
                    placeholder.style.display = 'block'; // Show the image placeholder
                } else if (webcamPreview.srcObject) {
                    placeholder.style.display = 'block';
                } else {
                    previewImage.src = "{{ asset('assets/img/upload-default.png') }}";
                    placeholder.style.display = 'none'; // Hide the image placeholder
                }
            }
    
           
            // Add an event listener to the "Create Student" button
            const submitButton = document.getElementById('submit-fr');
            submitButton.addEventListener('click', function (event) {
                // Prevent the default form submission
                event.preventDefault();
    
                // Call the function to handle form submission
                handleFormSubmission();
            });
        });
    </script>
    
    
@endpush