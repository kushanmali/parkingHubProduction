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
                    <a href="{{route('parkingSettings', $parking->id)}}" class="whitespace-nowrap font-bold flex mr-3 items-center gap-2 text-lg text-center uppercase align-middle transition-all bg-transparent border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:text-blue-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-orange-500 active:bg-orange-500 active:text-white hover:active:border-orange-500 hover:active:bg-transparent hover:active:text-orange-500 hover:active:opacity-75"> <span class="font-bold text-sm">Settings</span></a>
                    <button type="button" data-toggle="modal" data-target="#qrModal" class="whitespace-nowrap font-bold flex items-center gap-2 text-lg text-center uppercase align-middle transition-all bg-transparent border-solid rounded-lg shadow-none cursor-pointer active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:shadow-soft-xs hover:text-blue-500 hover:opacity-75 hover:shadow-none active:scale-100 active:border-orange-500 active:bg-orange-500 active:text-white hover:active:border-orange-500 hover:active:bg-transparent hover:active:text-orange-500 hover:active:opacity-75"> <span class="font-bold text-sm">SCAN QR</span><i class="fas p-4 bg-white rounded-full text-6 fa-qrcode" style="color: black;"></i></button>
                </div>  
            </div>
        </div>
    </div>
    
    <div class="flex flex-wrap mt-6 -mx-3">

         <div class="w-full max-w-full px-3 md:flex-none">
           


            @if($waitingParkingSessions->count() > 0)
            <div class="flex mt-6  flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-0">
                  <div class="relative flex flex-col min-w-0 break-words p-6 bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                      <div class="lg:flex">
                        <div>
                          <h5 class="mb-0 dark:text-white">Waiting Bookings</h5>
                        </div>
                        <div class="my-auto mt-6 ml-auto lg:mt-0">
                          {{-- <div class="my-auto ml-auto">
                            <a href="{{url('/new-parking')}}" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">+&nbsp; New Parking</a>
                          </div> --}}
                        </div>
                      </div>
                    </div>
                   
                   
                    <div class="flex-auto shadow-none bg-transparent p-6 px-0 pb-0">
                        <div class="overflow-x-auto flex flex-wrap w-full bg-transparent table-responsive">
                          @foreach($waitingParkingSessions as $session)
                          <a class="w-full lg:w-4/12" href="#">
                              <div class="p-4 bg-white w-full shadow-soft-lg rounded-4">
                                  <!-- Parking details -->
                                  <div class="flex lg:w-full pb-4 w-full">
                                      <!-- Parking information -->
                                      <div class="w-full pl-3">
                                            <h5 class="mt-0 mb-2 dark:text-white">{{$session->customer->name}}</h5>
                                            <p class="leading-normal flex items-center mb-0 text-sm font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-calendar-alt mb-0 text-xl pr-2 text-blue-500"></i> 
                                                Booked date:{{$session->date}}
                                            </p>
                                            <p class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                               Scan Users Qr To Start THe Session
                                            </p>
                                      </div>
                                    </div>                  
                              </div>
                          </a>
                          @endforeach
                        </div>
                    </div>
                  
                  </div>
                </div>
            </div>
             @endif

            @if($activeParkingSessions->count() > 0)
            <div class="flex mt-6  flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-0">
                  <div class="relative flex flex-col min-w-0 break-words p-6 bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                      <div class="lg:flex">
                        <div>
                          <h5 class="mb-0 dark:text-white">Ongoing Bookings</h5>
                        </div>
                        <div class="my-auto mt-6 ml-auto lg:mt-0">
                          {{-- <div class="my-auto ml-auto">
                            <a href="{{url('/new-parking')}}" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">+&nbsp; New Parking</a>
                          </div> --}}
                        </div>
                      </div>
                    </div>
                   
                   
                    <div class="flex-auto shadow-none bg-transparent p-6 px-0 pb-0">
                        <div class="overflow-x-auto flex flex-wrap w-full bg-transparent table-responsive">
                          @foreach($activeParkingSessions as $session)
                          <a class="w-full lg:w-4/12" href="#">
                              <div class="p-4 bg-white shadow-soft-lg rounded-4">
                                  <!-- Parking details -->
                                  <div class="flex lg:w-full pb-4 w-full">
                                      <!-- Parking information -->
                                      <div class="w-full pl-3">
                                            <h5 class="mt-0 mb-2 dark:text-white">{{$session->customer->name}}</h5>
                                            <p class="leading-normal flex items-center mb-0 text-sm font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-calendar-alt mb-0 text-xl pr-2 text-blue-500"></i> 
                                                Booked date:{{$session->date}}
                                            </p>
                                            <p class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                Start Time: {{$session->start_time ?  (new DateTime($session->start_time))->format('H:i:s') : 'N/A'}}
                                            </p>
                                            <p   class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                Elapsed Time: <span class="ml-2" id="timer-{{$session->id}}"> </span>
                                            </p>
                                            <p   class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                End Time: {{$session->end_time ? $session->end_time : 'N/A'}}
                                            </p>
                                            <p   class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                Total Price: {{$session->bill_price ? $session->bill_price : 'N/A'}}
                                            </p>

                                            <div class="flex items-center justify-end w-full">
                                                <form action="{{ route( 'finishSession', $session->id ) }}" id="finish-form-{{ $session->id }}" method="POST">
                                                    @csrf
                                                    <button  class="text-green-600 font-bold" type="submit" class="" onclick="ConfirmFinish(event, {{ $session->id }})">
                                                        <i class="fas fa-flag text-green-600 dark:text-white/70"></i> Finish
                                                    </button>
                                                </form>
                                            </div>
                                      </div>
                                    </div>                  
                              </div>
                          </a>
                          @endforeach
                        </div>
                    </div>
                  
                  </div>
                </div>
            </div>
             @endif


             @if($finishedParkingSessions->count() > 0)
             <div class="flex mt-6  flex-wrap -mx-3">
                 <div class="w-full max-w-full px-3 flex-0">
                   <div class="relative flex flex-col min-w-0 break-words p-6 bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                     <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                       <div class="lg:flex">
                         <div>
                           <h5 class="mb-0 dark:text-white">Ongoing Bookings</h5>
                         </div>
                         <div class="my-auto mt-6 ml-auto lg:mt-0">
                           {{-- <div class="my-auto ml-auto">
                             <a href="{{url('/new-parking')}}" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">+&nbsp; New Parking</a>
                           </div> --}}
                         </div>
                       </div>
                     </div>
                    
                    
                     <div class="flex-auto shadow-none bg-transparent p-6 px-0 pb-0">
                         <div class="overflow-x-auto flex flex-wrap w-full bg-transparent table-responsive">
                           @foreach($finishedParkingSessions as $session)
                           <a class="w-full lg:w-4/12" href="#">
                               <div class="p-4 bg-white shadow-soft-lg rounded-4">
                                   <!-- Parking details -->
                                   <div class="flex lg:w-full pb-4 w-full">
                                       <!-- Parking information -->
                                       <div class="w-full pl-3">
                                             <h5 class="mt-0 mb-2 dark:text-white">{{$session->customer->name}}</h5>
                                             <p class="leading-normal flex items-center mb-0 text-sm font-bold dark:text-white dark:opacity-60">
                                                 <i class="fas fa-calendar-alt mb-0 text-xl pr-2 text-blue-500"></i> 
                                                 Booked date:{{$session->date}}
                                             </p>
                                             <p class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                 <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                 Start Time: {{$session->start_time ?  (new DateTime($session->start_time))->format('H:i:s') : 'N/A'}}
                                             </p>
                                             <p   class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                 <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                 End Time: {{$session->end_time ? $session->end_time : 'N/A'}}
                                             </p>
                                             <p   class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                 <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                 Total Price: LKR.{{$session->billing_price ? $session->billing_price : 'N/A'}}
                                             </p>
 
                                             <div class="flex items-center justify-end w-full">
                                                 <form action="{{ route( 'finishSession', $session->id ) }}" id="finish-form-{{ $session->id }}" method="POST">
                                                     @csrf
                                                     <button  class="text-green-600 font-bold" type="submit" class="" onclick="ConfirmFinish(event, {{ $session->id }})">
                                                         <i class="fas fa-flag text-green-600 dark:text-white/70"></i> Finish
                                                     </button>
                                                 </form>
                                             </div>
                                       </div>
                                     </div>                  
                               </div>
                           </a>
                           @endforeach
                         </div>
                     </div>
                   
                   </div>
                 </div>
             </div>
              @endif
            


            @if($preBookedSessions->count() > 0)
            <div class="flex mt-6  flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 flex-0">
                  <div class="relative flex flex-col min-w-0 break-words p-6 bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                      <div class="lg:flex">
                        <div>
                          <h5 class="mb-0 dark:text-white">Today Pre Bookings</h5>
                        </div>
                        <div class="my-auto mt-6 ml-auto lg:mt-0">
                          {{-- <div class="my-auto ml-auto">
                            <a href="{{url('/new-parking')}}" class="inline-block px-8 py-2 m-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer ease-soft-in leading-pro tracking-tight-soft bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85">+&nbsp; New Parking</a>
                          </div> --}}
                        </div>
                      </div>
                    </div>
                   
                   
                    <div class="flex-auto shadow-none bg-transparent p-6 px-0 pb-0">
                        <div class="overflow-x-auto flex flex-wrap w-full bg-transparent table-responsive">
                          @foreach($preBookedSessions as $session)
                          <a class="w-full lg:w-4/12" href="#">
                              <div class="p-4 bg-white shadow-soft-lg rounded-4">
                                  <!-- Parking details -->
                                  <div class="flex lg:w-full pb-4 w-full">
                                      <!-- Parking information -->
                                      <div class="w-full pl-3">
                                            <h5 class="mt-0 mb-2 dark:text-white">{{$session->customer->name}}</h5>
                                            <p class="leading-normal flex items-center mb-0 text-sm font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-calendar-alt mb-0 text-xl pr-2 text-blue-500"></i> 
                                                Booked date:{{$session->date}}
                                            </p>
                                            <p class="leading-normal mb-0 text-sm flex items-center  font-bold dark:text-white dark:opacity-60">
                                                <i class="fas fa-clock text-xl mb-0 pr-2 text-blue-500"></i> 
                                                Start Time: {{$session->start_time ?  (new DateTime($session->start_time))->format('H:i:s') : 'N/A'}}
                                            </p>
                                      </div>
                                </div>                  
                              </div>
                          </a>
                          @endforeach
                        </div>
                    </div>
                  
                  </div>
                </div>
            </div>
             @endif
    </div>
</div>


<div class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto transition-opacity ease-linear opacity-0 z-sticky outline-0" id="qrModal" aria-hidden="true">
    <div class="relative w-auto h-screen transition-transform duration-300 pointer-events-none sm:m-7 sm:max-w-125 sm:mx-auto lg:mt-24 ease-soft-out -translate-y-13">
        <div class="relative flex flex-col w-full min-h-screen bg-white border border-solid pointer-events-auto dark:bg-gray-950 bg-clip-padding border-black/20 lg:rounded-4 outline-0">
            <div class="flex items-center justify-between p-4 border-b border-solid shrink-0 border-slate-100 rounded-t-xl">
                <h5 class="mb-0 leading-normal mr-2 dark:text-white" id="ModalLabel">Welcome {{$parking->parking_name}}</h5>
                <button type="button" data-toggle="modal" data-target="#qrModal" class="fa fa-close w-4 h-4 ml-auto box-content p-2 text-black dark:text-white border-0 rounded-1.5 opacity-50 cursor-pointer -m-2 " data-dismiss="modal"></button>
            </div>

            <a class="flex justify-center items-center mt-12 text-sm whitespace-nowrap text-slate-700 dark:text-white" href="{{route('index')}}">
                <img src="{{asset('assets/img/pHub-ico.webp')}}" class="inline-block h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:hidden" alt="main_logo" />
                <img src="{{asset('assets/img/pHub-ico.webp')}}" class="hidden h-full max-w-full transition-all duration-200 ease-soft-in-out max-h-10 dark:inline-block" alt="main_logo" />
                <h4 class="font-bold text-4xl mb-0">Parking <span class="bg-gradient-to-tl from-green-600 to-teal-400 bg-clip-text text-transparent text-4xl">HUB</span></h4>
            </a>

            <div class="qr-scan-container p-12">
                <video id="qr-video" width="100%" height="100%" autoplay></video>
                <canvas id="qr-canvas" style="display: none;"></canvas>
            </div>

            <div class="flex py-2 w-full justify-center">
                <button id="start" class="bg-blue-500 w-6/12 py-2 rounded-12 text-white font-bold"><i class="fas mr-2 fa-qrcode" style="color: white;"></i>Scan QR</button>
           </div>
           
           
        </div>
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

@endsection


@push('scripts')


<script>
    function ConfirmFinish(event, id) {
        event.preventDefault();
    
        // Show SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28B463',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, finish it!',
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form
                document.getElementById('finish-form-' + id).submit();
            }
        });
    }
    </script>

<script>
    // Update elapsed time for each session
    @foreach($activeParkingSessions as $session)
    updateTime({{$session->id}}, '{{$session->start_time}}');
    @endforeach

    // Function to calculate elapsed time
    function updateTime(sessionId, startTime) {
        setInterval(function() {
            var startTime = new Date('{{$session->start_time}}');
            var currentTime = new Date();
            var elapsedTime = currentTime - startTime;

            var hours = Math.floor(elapsedTime / (1000 * 60 * 60));
            var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

            var elapsedTimeString = hours + "h " + minutes + "m " + seconds + "s";

            document.getElementById('timer-' + sessionId).innerText = elapsedTimeString;
        }, 1000);
    }
</script>


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