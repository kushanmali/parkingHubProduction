@extends('layouts.owner.app')

@section('content')

<div class="w-full p-6 mx-auto">

    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3 flex-0">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 dark:bg-gray-950 dark:shadow-soft-dark-xl shadow-soft-xl rounded-2xl bg-clip-border">
          <div class="border-black/12.5 rounded-t-2xl border-b-0 border-solid p-4">
            <h5 class="mb-2 dark:text-white">My Parkings</h5>
            <p class="mb-0">All active parkings</p>
          </div>
          <div class="flex-auto p-4">
            <div class="flex flex-wrap -mx-3">

              @foreach ($parkings as $parking)
                <div class="w-full max-w-full px-3 text-center flex-0 lg:w-3/12">
                  <a href="{{route('viewParking', $parking->id)}}">
                    <div class="py-4 border border-dashed rounded-lg border-slate-400">
                      <h6 class="relative mb-0 text-transparent z-1 bg-clip-text bg-gradient-to-tl from-purple-700 to-pink-500">{{$parking->parking_name}}</h6>
                      <h4 class="font-bold text-xs dark:text-white">
                        <span id="state1">  
                          @php
                              $address = $parking->location->address_address;
                              echo strlen($address) > 30 ? substr($address, 0, 30) . '...' : $address;
                          @endphp
                      </span>
                      </h4>
                    </div>
                  </a>
                </div>
              @endforeach
              
              
            </div>

            <div class="flex flex-wrap mt-12 -mx-3">
              <div class="w-full max-w-full">
                <div class="">
                    <div id="my-map" style="height: 400px;"></div>
                </div>
              </div>
            </div>           
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
      map = new google.maps.Map(document.getElementById('my-map'), mapOptions);
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
        '<a class="bg-blue-500 rounded-4 text-sm text-white px-4 py-2 mt-4" href="/view-parking/' + parking.id + '" class="text-sm text-blue-500">View</a>' +
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
          url: '/my-parkings/all', // Update the URL to match your endpoint
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
