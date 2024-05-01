<?php

namespace App\Livewire;

use App\Models\Parking;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MyParkingsMap extends Component
{

    public $parkings;
    public $user;

    public function mount()
    {
        $this->parkings = Parking::all();

    }
    
    public function render()
    {
        return view('livewire.my-parkings-map');
    }
}
