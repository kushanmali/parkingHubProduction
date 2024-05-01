<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class ownerController extends Controller
{
    public function newOwner(){
        
        $user = Auth::user();

        return view('dashboards.admin.newOwner', compact('user'));
    }

    public function owners(){

        $user = Auth::user();

        $ownerRole = Role::where('name', 'Owner')->first();

        $owners = $ownerRole->users;

        return view('dashboards.admin.owners', compact('user', 'owners'));
    }

    public function owner(){

        $user = Auth::user();

        return view('dashboards.admin.owner', compact('user'));
    }


    public function updateOwner($id){

        $user = Auth::user();

        $owner = User::findOrFail($id);


        return view('dashboards.admin.ownerUpdate', compact('owner', 'user'));
    }

    public function deleteOwner($id){

        $owner = User::findOrfail($id);

        $owner->delete();

        $notification = [
            'message' => 'Owner Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->route('owner')->with($notification);
        
    }
}
