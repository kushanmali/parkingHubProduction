<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;
use App\Models\ParkingSession;
use Illuminate\Support\Facades\Auth;

class parkingSessionController extends Controller
{
    public function parkingSessions($id){

        $user = Auth::user();

        $parking = Parking::findOrFail($id);

        $activeParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'ongoing')
        ->get();

        $finishedParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'finished')
        ->get();

        return view('dashboards.owner.parkingSessions', compact('activeParkingSessions','finishedParkingSessions', 'user'));
    }

    public function activeSessions() {
        $user = Auth::user();
        
        // Get the parkings belonging to the authenticated user
        $parkings = $user->parkings;
    
        // Array to store active sessions for each parking
        $activeSessions = [];
    
        // Loop through each parking
        foreach ($parkings as $parking) {
            // Get all sessions for the current parking
            $parkingSessions = $parking->sessions;
        
            // Check if $parkingSessions is not null before filtering
            if ($parkingSessions) {
                // Filter active sessions (status = 'ongoing')
                $ongoingSessions = $parkingSessions->where('status', 'ongoing');
                
                // Add active sessions to the array
                $activeSessions[$parking->id] = $ongoingSessions;

            } else {
                // If $parkingSessions is null, set an empty collection
                $activeSessions[$parking->id] = collect();
            }
        }        
        
        return view('dashboards.owner.activeSessions', compact('user', 'activeSessions'));
    }

    public function parkingActiveSessions($id){

        $user = Auth::user();

        $parking = Parking::findOrFail($id);

        $activeParkingSessions = ParkingSession::where('parking_id', $parking->id)
        ->where('status', 'ongoing')
        ->get();

        return view('dashboards.owner.parkingSessions', compact('user', 'activeParkingSessions'));
    }


    public function create(Parking $parking)
    {
        // Assuming the authenticated user is the customer
        $customer = auth()->user();

        // Create a new parking session
        $session = ParkingSession::create([
            'customer_id' => $customer->id,
            'parking_id' => $parking->id,
            'start_time' => now(), 
            'status' => 'ongoing', 
        ]);

        return response()->json(['session' => $session], 200);
    }

    
    
}

