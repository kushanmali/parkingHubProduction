<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use App\Models\QrCode;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function getAdminDashboard(){

        $user = Auth::user();

        $ownerRole = Role::where('name', 'Owner')->first();

        $owners = $ownerRole->users;

        $parkings = Parking::get();

        return view('dashboards.admin.dashboard', compact('user', 'owners', 'parkings'));
    }

    public function ownerDashboard(){

        $user = Auth::user();

        $parkings = $user->parkings;

        return view('dashboards.owner.dashboard', compact('user', 'parkings'));
    }

    public function userDashboard(){

        $user = Auth::user();

        $qrCode =  $user->qrCode;

        $home = true;

        return view('dashboards.user.dashboard', compact('user', 'qrCode', 'home'));
    }

}
