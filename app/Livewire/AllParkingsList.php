<?php

namespace App\Livewire;

use App\Models\Parking;
use Livewire\Component;

class AllParkingsList extends Component
{
    public $search = '';

    public function render()
    {
        $parkings = Parking::with('location')
            ->where('parking_name', 'like', '%' . $this->search . '%')
            ->orWhereHas('location', function ($query) {
                $query->where('address_address', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.all-parkings-list', ['parkings' => $parkings]);
    }
}