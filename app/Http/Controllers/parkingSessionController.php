<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Parking;
use App\Models\CancelReason;
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

        // Check if the user already has an ongoing booking for the given parking
        $existingSession = ParkingSession::where('customer_id', $customer->id)
            ->where('parking_id', $parking->id)
            ->where('status', 'booked')->orwhere('status', 'ongoing')
            ->first();

        // If the user has an ongoing booking, return a response indicating the existing session
        if ($existingSession) {
            return redirect()->route('bookNowPage', $parking->id)->with('faild', 'booking faild');
        }

        // Create a new parking session
        $session = ParkingSession::create([
            'customer_id' => $customer->id,
            'parking_id' => $parking->id,
            'status' => 'booked',
            'date' => today() 
        ]);

        return redirect()->route('bookNowPage', $parking->id)->with('success', 'booking is succcessfull');
    }

    public function cancelPage($id){

        $user = Auth::user();

        $parking = Parking::findOrfail($id);

        return view('dashboards.user.cancelPage', compact('user', 'parking'));
    }


    public function cancelParking(Request $request, $parkingId)
    {

        $user = Auth::user();

        $request->validate([
            'cancelReason' => 'required|string',
        ]);

        // Find the parking session
        $parkingSession = ParkingSession::where('parking_id', $parkingId)
            ->where('status', 'booked')->where('customer_id', $user->id)
            ->first();

        if (!$parkingSession) {
            return redirect()->route('setDashboard')->with('fail', 'Parking session not found or already cancelled.');
        }

        // Create the cancel reason
        CancelReason::create([
            'session_id' => $parkingSession->id,
            'reason' => $request->input('cancelReason'),
        ]);

        // Update the status of the parking session to 'cancelled'
        $parkingSession->update(['status' => 'cancelled']);

        return redirect()->route('setDashboard')->with('success', 'Parking session cancelled successfully.');
    }

    public function Parkinglater(Request $request, $id)
    {
        $user = Auth::user();

        // Validate the incoming request data
        $request->validate([
            'setDate' => 'required|date', // Validate that the setDate field is required and is a valid date
        ]);

        // Create the parking session
        $parkingSession = ParkingSession::create([
            'customer_id' => $user->id,
            'parking_id' => $id,
            'date' => $request->input('setDate'), // Set the date from the request
            'status' => 'preBooked',
        ]);


        // Redirect back with success message or any other action you want to take
        return redirect()->route('myBookings')->with('success', 'Parking session booked successfully.');
    }



    public function finishSession(Request $request, $id)
    {
        $session = ParkingSession::findOrFail($id);
    
        // Update the end time and status of the parking session
        $session->end_time = Carbon::now('Asia/Colombo'); // Set end time to current time
        $session->status = 'finished';
    
        // Calculate the duration of the parking session in hours
        $startTime = new DateTime($session->start_time);
        $endTime = new DateTime($session->end_time);
        $duration = $endTime->diff($startTime)->h;
    
        // Retrieve the hourly rate of the parking
        $parking = $session->parking;
        $hourlyRate = $parking->price;
    
        // Calculate the billing price based on the duration and hourly rate
        if ($duration < 1) {
            // If duration is less than 1 hour, set billing price to one-hour price
            $billingPrice = $hourlyRate;
        } else {
            // Otherwise, calculate the billing price based on the duration
            $billingPrice = $duration * $hourlyRate;
        }
    
        // Update the parking session with the calculated billing price
        $session->billing_price = $billingPrice;
        $session->save();
    
        // Redirect or return a response as needed
        $notification = [
            'message' => 'Session Finished Successfully',
            'alert-type' => 'success'
        ];
    
        // Redirect the user to the parkingsessions route
        return redirect()->route('parkingSessions', $parking->id)->with($notification);
    }
    

    
}

