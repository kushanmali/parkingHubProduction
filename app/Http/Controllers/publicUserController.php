<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;
use App\Models\ParkingSession;
use Illuminate\Support\Facades\Auth;

class publicUserController extends Controller
{
    public function myMap(){

        $user = Auth::user();

        $qrCode =  $user->qrCode;

        return view('dashboards.user.myMap', compact('user', 'qrCode'));
    }

    public function viewUserParking($id){

        $user = Auth::user();

        $parking = Parking::findOrfail($id);

        $parkingImages = $parking->images;

        $qrCode = $user->qrCode;

        return view('dashboards.user.parking', compact('parking','parkingImages', 'qrCode', 'user'));
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

    public function bookNowPage($id){

        $parking = Parking::findOrFail($id);

        $user = Auth::user();

        $existingSession = ParkingSession::where('customer_id', $user->id)
        ->where('parking_id', $parking->id)
        ->where('status', 'booked')
        ->orwhere('status', 'ongoing')
        ->orwhere('status', 'preBooked')
        ->where('date', today())
        ->first();

        $qrCode =  $user->qrCode;

        return view('dashboards.user.bookNowPage', compact('user', 'parking', 'existingSession', 'qrCode'));
    }


    public function myBookings(){

        $user = Auth::user();

        
        $sessions = ParkingSession::where('customer_id', $user->id)->latest()->get();
                
        return view('dashboards.user.myBookings', compact('user', 'sessions'));
    }

    public function bookLater($id){

        $user = Auth::user();

        $parking = Parking::findOrfail($id);

        $qrCode =  $user->qrCode;

        return view('dashboards.user.bookLater', compact('user', 'parking', 'qrCode'));
    }
}


