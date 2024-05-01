<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Parking;
use Illuminate\Http\Request;
use App\Models\ParkingSession;
use App\Models\ParkingLocation;
use Illuminate\Support\Facades\Auth;

class parkingController extends Controller
{
    public function newParking(){

        $user = Auth::user();

        return view('dashboards.owner.newParking', compact('user'));
    }

    public function storeParking(Request $request, $id)
    {
        $validatedData = $request->validate([
            'parkingName' => 'required|string|max:255',
            'slotCount' => 'required|numeric|max:255',
            'price' => 'required|numeric', // Validate the price input
            'address_address' => 'required|string|max:255',
            'address_latitude' => 'required|numeric',
            'address_longitude' => 'required|numeric',
        ]);
    
        $owner = User::findOrFail($id);
    
        $parking = Parking::create([
            'parking_name' => $validatedData['parkingName'],
            'slot_count' => $validatedData['slotCount'],
            'price' => $validatedData['price'], // Store the price
            'owner_id' => $owner->id,
        ]);
    
        $parking->location()->create([
            'address_address' => $validatedData['address_address'],
            'address_latitude' => $validatedData['address_latitude'],
            'address_longitude' => $validatedData['address_longitude'],
        ]);
    
        $notification = [
            'message' => 'Parking Created Successfully',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('myParkings')->with($notification);
    }
    


    public function myParkings(){

        $user = Auth::user();

        $parkings = $user->parkings;

        return view('dashboards.owner.myparkings', compact('user', 'parkings'));
    }


    public function getAllParkings()
    {
        // Fetch all parkings with their location details
        $parkings = Parking::with('location')->get();

        // Return the parkings as JSON response
        return response()->json(['parkings' => $parkings]);
    }

    public function getMyAllParkings()
    {
        $user = Auth::user();

        // Fetch all parkings with their location details
        $parkings = Parking::where('owner_id', $user->id)->with('location')->get();

        // Return the parkings as JSON response
        return response()->json(['parkings' => $parkings]);
    }


    public function deleteParking($id){

        $parking = Parking::findOrFail($id);

        $parking->delete();

        return redirect()->route('myParkings')->with('success', 'Song deleted successfully');
    }

    public function viewParking($id){

        $user = Auth::user();

        $parking = Parking::findOrFail($id);

        $activeParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'ongoing')
        ->get();

        $finishedParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'finished')
        ->get();

        return view('dashboards.owner.parking', compact('user', 'parking', 'activeParkingSessions', 'finishedParkingSessions'));
    }

    
    public function updateParking(Request $request, $id)
    {
        $validatedData = $request->validate([
            'parkingName' => 'required|string|max:255',
            'slotCount' => 'required|numeric|max:255',
            'price' => 'required|numeric',
            'address_address' => 'required|string|max:255',
            'address_latitude' => 'required|numeric',
            'address_longitude' => 'required|numeric',
        ]);

        $parking = Parking::findOrFail($id);

        // Update parking details
        $parking->update([
            'parking_name' => $validatedData['parkingName'],
            'slot_count' => $validatedData['slotCount'],
            'price' => $validatedData['price'],
        ]);

        // Update parking location
        $parking->location->update([
            'address_address' => $validatedData['address_address'],
            'address_latitude' => $validatedData['address_latitude'],
            'address_longitude' => $validatedData['address_longitude'],
        ]);

        $notification = [
            'message' => 'Parking Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('myParkings')->with($notification);
    }


    public function findNearbyParkings(Request $request)
    {
        // Validate the latitude and longitude
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);
    
        // Get latitude and longitude from the request
        $latitude = $request->input('lat');
        $longitude = $request->input('lng');
    
        // Define the radius for nearby parkings (you can adjust this value as needed)
        $radius = 5; // in kilometers
    
        // Query nearby parkings using Haversine formula or any other method
        $nearbyParkings = Parking::with('location')
            ->select('parkings.id', 'parkings.parking_name', 'parking_locations.address_latitude', 'parking_locations.address_longitude', 'parking_locations.address_address')
            ->join('parking_locations', 'parkings.id', '=', 'parking_locations.parking_id')
            ->whereRaw("6371 * acos(cos(radians(?)) * cos(radians(parking_locations.address_latitude)) * cos(radians(parking_locations.address_longitude) - radians(?)) + sin(radians(?)) * sin(radians(parking_locations.address_latitude))) <= ?", [$latitude, $longitude, $latitude, $radius])
            ->get();
    
        // Return nearby parkings as JSON response
        return response()->json(['parkings' => $nearbyParkings]);
    }


    public function startSession(Request $request)
    {
        $customerId = $request->query('customerId');
        $parkingId = $request->query('parkingId');

        $customer = User::findOrFail($customerId);
        $parking = Parking::findOrFail($parkingId);

        // Create a new ParkingSession instance
        $session = new ParkingSession();
        
        // Set the attributes for the new session
        $session->customer_id = $customer->id;
        $session->parking_id = $parking->id;
        $session->start_time = now(); // Assuming you want to start the session immediately
        $session->status = 'ongoing'; // Set the status to ongoing
        
        // Save the new session to the database
        $session->save();


        $notification = [
            'message' => 'Session Started Successfully',
            'alert-type' => 'success'
        ];

        // Redirect the user to the parkingsessions route
        return Redirect()->route('parkingSessions', $parking->id)->with($notification);
    }
}
