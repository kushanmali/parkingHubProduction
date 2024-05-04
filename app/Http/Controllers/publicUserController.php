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


        return view('dashboards.user.parking');
    }
}
