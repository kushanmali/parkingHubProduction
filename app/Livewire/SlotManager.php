<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ParkingSession;

class SlotManager extends Component
{
    public $parking;
    public $totalSlots;
    public $availableSlots;

    public function mount($parking)
    {
        $this->parking = $parking;
        $this->calculateSlots();
    }

    public function calculateSlots()
    {
        // Calculate total slots for the parking
        $this->totalSlots = $this->parking->slot_count;

        // Calculate available slots by counting ongoing parking sessions
        $ongoingSessionsCount = ParkingSession::where('parking_id', $this->parking->id)
            ->where('status', 'ongoing')->orWhere('status', 'booked')
            ->count();
            
        $this->availableSlots = $this->totalSlots - $ongoingSessionsCount;
    }

    public function render()
    {
        return view('livewire.slot-manager');
    }
}
