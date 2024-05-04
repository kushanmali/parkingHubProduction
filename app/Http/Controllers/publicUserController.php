<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class publicUserController extends Controller
{
    public function myMap(){

        $user = Auth::user();

        $qrCode =  $user->qrCode;

        return view('dashboards.user.myMap', compact('user', 'qrCode'));
    }

    public function viewUserParking($id){


        $parking = Parking::findOrfail($id);

        $parkingImages = $parking->images;

        return view('dashboards.user.parking', compact('parking','parkingImages'));
    }

    public function getUserLocation(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        
        // You can process the latitude and longitude here as needed
        return response()->json(['latitude' => $latitude, 'longitude' => $longitude]);
    }

    public function getParkingLocation($id)
    {
        // Retrieve the parking record by ID
        $parking = Parking::findOrFail($id);

        // Extract the location data
        $location = [
            'latitude' => $parking->location->address_latitude,
            'longitude' => $parking->location->address_longitude,
            'name' => $parking->parking_name, // You can use any other property as the name
        ];

        // Return the location data as JSON response
        return response()->json($location);
    }
}
