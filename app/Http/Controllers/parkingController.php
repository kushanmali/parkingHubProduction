<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Parking;
use App\Models\ParkingImage;
use Illuminate\Http\Request;
use App\Models\ParkingSession;
use App\Models\ParkingLocation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $preBookedSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'preBooked')->where('date', today())
        ->get();

        $activeParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'ongoing')->where('date', today())
        ->get();

        $waitingParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'booked')->where('date', today())
        ->get();

        $finishedParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'finished')->where('date', today())
        ->get();

        return view('dashboards.owner.parking', compact('waitingParkingSessions','user', 'parking','preBookedSessions', 'activeParkingSessions', 'finishedParkingSessions'));
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
        // Set the time zone to Colombo, Asia
        date_default_timezone_set('Asia/Colombo');
    
        $customerId = $request->query('customerId');
        $parkingId = $request->query('parkingId');
    
        $customer = User::findOrFail($customerId);
        $parking = Parking::findOrFail($parkingId);
    
        // find existing parking session
        $existingSession = ParkingSession::where('customer_id', $customerId)
            ->where('parking_id', $parkingId)
            ->where('status', 'booked')
            ->orwhere('status', 'ongoing')
            ->orwhere('status', 'preBooked')
            ->where('date', today())
            ->first();
    
        if ($existingSession) {
            $session = ParkingSession::findOrfail($existingSession->id);
    
            $session->status = 'ongoing';
            $session->start_time = Carbon::now('Asia/Colombo'); // Update the start time with the Colombo time zone
    
            $session->save();
        } else {
    
            $session = new ParkingSession();
    
            // Set the attributes for the new session
            $session->customer_id = $customer->id;
            $session->parking_id = $parking->id;
            $session->start_time = Carbon::now('Asia/Colombo'); // Update the start time with the Colombo time zone
            $session->status = 'ongoing'; // Set the status to ongoing
    
            // Save the new session to the database
            $session->save();
        }
    
        $notification = [
            'message' => 'Session Started Successfully',
            'alert-type' => 'success'
        ];
    
        // Redirect the user to the parkingsessions route
        return Redirect()->route('parkingSessions', $parking->id)->with($notification);
    }
    

    public function addParkingProfile(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'pro-img' => 'required|image|mimes:jpeg,png,jpg,gif|max:1048', // adjust max file size as needed
        ]);

        // Get the user
        $parking = Parking::findOrFail($id);

        // Check if the user has a parking
        if ($parking) {
            // Delete old parking profile image if it exists
            if ($parking->profile_img_path) {
                Storage::delete($parking->profile_img_path);
            }
        }

        // Store the image
        $imagePath = $request->file('pro-img')->store('parking-profiles', 'public');

        // Update parking profile image path
        $parking->profile_img_path = $imagePath;
        $parking->save();

        return redirect()->back()->with('success', 'Parking profile image uploaded successfully.');
    }


    public function storeParkingImages(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'gallery-img.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $parking = Parking::findOrFail($id);

        // Loop through each uploaded file
        foreach ($request->file('gallery-img') as $image) {
            // Store the image
            $imagePath = $image->store('parking-images', 'public');

            // Create a new ParkingImage record
            ParkingImage::create([
                'parking_id' => $parking->id,
                'image_path' => $imagePath,
            ]);
        }

        $notification = [
            'message' => 'Gallery Updated Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification,'success', 'Images uploaded successfully.');
    }

    public function parkingSettings($id){

        $user = Auth::user();

        $parking = Parking::findOrfail($id);

        return view('owner.parkingSettings', compact('parking', 'user'));
    }
}
