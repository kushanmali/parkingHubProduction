@extends('layouts.admin.app')

@section('content')

<div class="w-full p-6 mx-auto">
  
        <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full max-w-full px-3 flex-0 md:w-6/12 lg:w-3/12">
            <div class="shadow-soft-xl dark:bg-gray-950 dark:shadow-soft-dark-xl border-black/12.5 bg-gradient-to-tl from-slate-600 to-slate-300 relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-clip-border dark:bg-none">
              <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                  <div class="w-8/12 max-w-full px-3 flex-0">
                    <div>
                      <p class="mb-0 font-semibold leading-normal text-white capitalize text-sm opacity-70">Total Earnings</p>
                      <h5 class="mb-0 font-bold text-white">N/A</h5>
                    </div>
                  </div>
                  <div class="w-4/12 max-w-full px-3 text-right flex-0">
                    <div class="inline-block w-12 h-12 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none shadow-soft-2xl">
                      <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-slate-700"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mt-6 flex-0 md:w-6/12 md:mt-0 lg:w-3/12">
            <div class="shadow-soft-xl dark:bg-gray-950 dark:shadow-soft-dark-xl border-black/12.5 bg-gradient-to-tl from-slate-600 to-slate-300 relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-clip-border dark:bg-none">
              <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                  <div class="w-8/12 max-w-full px-3 flex-0">
                    <div>
                      <p class="mb-0 font-semibold leading-normal text-white capitalize text-sm opacity-70">Owners</p>
                      <h5 class="mb-0 font-bold text-white">{{count($owners)}}</h5>
                    </div>
                  </div>
                  <div class="w-4/12 max-w-full px-3 text-right flex-0">
                    <div class="inline-block w-12 h-12 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none shadow-soft-2xl">
                      <i class="ni leading-none ni-controller text-lg relative top-3.5 text-slate-700"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mt-6 lg:mt-0 flex-0 md:w-6/12 lg:w-3/12">
            <div class="shadow-soft-xl dark:bg-gray-950 dark:shadow-soft-dark-xl border-black/12.5 bg-gradient-to-tl from-slate-600 to-slate-300 relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-clip-border dark:bg-none">
              <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                  <div class="w-8/12 max-w-full px-3 flex-0">
                    <div>
                      <p class="mb-0 font-semibold leading-normal text-white capitalize text-sm opacity-70">Parkings</p>
                      <h5 class="mb-0 font-bold text-white">{{count($parkings)}}</h5>
                    </div>
                  </div>
                  <div class="w-4/12 max-w-full px-3 text-right flex-0">
                    <div class="inline-block w-12 h-12 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none shadow-soft-2xl">
                      <i class="ni leading-none ni-delivery-fast text-lg relative top-3.5 text-slate-700"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full max-w-full px-3 mt-6 lg:mt-0 flex-0 md:w-6/12 lg:w-3/12">
            <div class="shadow-soft-xl dark:bg-gray-950 dark:shadow-soft-dark-xl border-black/12.5 bg-gradient-to-tl from-slate-600 to-slate-300 relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-clip-border dark:bg-none">
              <div class="flex-auto p-4">
                <div class="flex flex-wrap -mx-3">
                  <div class="w-8/12 max-w-full px-3 flex-0">
                    <div>
                      <p class="mb-0 font-semibold leading-normal text-white capitalize text-sm opacity-70">Users</p>
                      <h5 class="mb-0 font-bold text-white">N/A</h5>
                    </div>
                  </div>
                  <div class="w-4/12 max-w-full px-3 text-right flex-0">
                    <div class="inline-block w-12 h-12 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none shadow-soft-2xl">
                      <i class="ni leading-none ni-note-03 text-lg relative top-3.5 text-slate-700"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full max-w-full px-3 flex-0">
            <div class="shadow-soft-xl dark:bg-gray-950 dark:shadow-soft-dark-xl border-black/12.5 bg-gradient-to-tl from-gray-900 to-slate-800 relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-clip-border dark:bg-none">
              <div class="border-b-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-transparent p-6">
                <div class="flex flex-wrap -mx-3">
                  <div class="w-full max-w-full px-3 flex-0 md:w-6/12 lg:w-4/12">
                   
                  </div>
                  <div class="w-full max-w-full px-3 my-auto ml-auto flex-0 md:w-6/12 lg:w-6/12">
                    {{-- for a button  --}}
                  </div>
                </div>
                <hr class="h-px bg-gradient-to-r from-transparent via-white to-transparent" />
              </div>
              <div class="flex-auto p-0">
                <livewire:my-parkings-map />
              </div>
              <div class="border-t-black/12.5 mt-0 rounded-b-2xl border-t-0 border-solid bg-transparent p-6">
                
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

  document.addEventListener('DOMContentLoaded', function () {
      // Initialize the map with all parkings on page load
      initializeMap();
  });

  function initializeMap() {
      var mapOptions = {
          center: { lat: 0, lng: 0 }, // Default center
          zoom: 12, // Initial zoom level
      };
      map = new google.maps.Map(document.getElementById('map'), mapOptions);
      infoWindow = new google.maps.InfoWindow();

      // Fetch and display all parkings on page load
      fetchAllParkings();
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
        var contentString = '<div>' +
        '<h2 class="text-sm mb-0 font-semibold">' + parking.parking_name + '</h2>' +
        '<p class="text-sm mb-1">' + parking.location.address_address + '</p>' +
        '<a class="bg-blue-500 rounded-4 text-sm text-white px-4 py-2 mt-4" href="/parkings/' + parking.id + '" class="text-sm text-blue-500">View</a>' +
        '</div>';

        // Add event listener to display info window when marker is clicked
        google.maps.event.addListener(marker, 'click', (function (marker, contentString) {
            return function () {
                infoWindow.setContent(contentString);
                infoWindow.open(map, marker);
            };
        })(marker, contentString));
    }

    // Fit the map to the calculated bounds
    map.fitBounds(bounds);

    // Set a minimum zoom level (e.g., 12)
    if (map.getZoom() > 12) {
        map.setZoom(12);
    }
}


  function fetchAllParkings() {
      // Make an AJAX request to your server to fetch all parkings
      $.ajax({
          type: 'GET',
          url: '/parkings/all', // Update the URL to match your endpoint
          success: function (data) {
              // Display all parkings on the map
              if (!map) {
                  initializeMap();
              }

              displayParkingsOnMap(data.parkings);
          },
          error: function () {
              alert('Error fetching all parkings.');
          }
      });
  }
</script>

    
@endpush