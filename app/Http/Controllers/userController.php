<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Events\SendPasswordViaEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordEmail;

class userController extends Controller
{
    public function getNewUser() {

        $user = Auth::user();

        return view('dashboards.admin.newUser', compact('user'));
    }


    public function storeUser(Request $request)
    {
        // validate request

        $validatedData = $request->validate([
            'UserName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6|confirmed',
            'reset_password' => 'nullable|boolean',
            'send_password_email' => 'nullable|boolean',

            // checking roles
            'roles' => ['array', 'required', function ($attribute, $value, $fail) {
                if (empty($value)) {
                    $fail('Please select at least one role.');
                }
            }],

        ]);

        
        $tempPass = $validatedData['password'];

        $user = new User();
        $user->name = $validatedData['UserName'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        // Update pass_reset if the checkbox is selected
        if (isset($validatedData['reset_password']) && $validatedData['reset_password']) {
            $user->update(['pass_reset' => 1]);
        }


        // Sync roles with the user
        if (!empty($validatedData['roles'])) {
            $roleIds = Role::whereIn('name', $validatedData['roles'])->pluck('id')->toArray();
            $user->roles()->sync($roleIds);
        }

        // send email
        if (isset($validatedData['send_password_email']) && $validatedData['send_password_email']) {
            Mail::to($user->email)->send(new SendPasswordEmail($user, $validatedData['password']));
        }

        $notification = [
            'message' => 'user created succesfully',
            'alert-type' => 'success'
        ];

        if (!Auth::check()) {
            Auth::login($user);
    
            return redirect()->route('setDashboard');
        }

        return redirect()->route('showPass', ['id' => $user->id, 'tempPass' => $tempPass])->with($notification);
    }

    public function showPass($id, $tempPass){

        $user = User::findOrFail($id);

        $password =  $tempPass;

        return view('dashboards.admin.showPass', compact('user', 'password'));
    }

    public function sysUsers(){

        $authUser = Auth::user();

        // If the authenticated user is a Manager, get specific roles
        if ($authUser->hasRole('Admin')) {
            $allowedRoles = ['Admin'];
            $users = User::role($allowedRoles)->get();
        }

        // If the authenticated user has a different role, show a message
        else {
            $users = collect(); // or any default behavior you want
            $message = 'You do not have permission to view this page.';
            $notification = [
                'message' => $message,
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }

        return view('dashboards.admin.allUsers', compact('users'));
    }

    public function getUpdateUser($id){

        $user = User::findOrfail($id);
        $userRoles = $user->roles->pluck('name')->toArray();

        return view('dashboards.admin.updateUser', compact('user', 'userRoles'));
    }


    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'UserName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'roles' => 'array|required',
            // Add any other validation rules as needed
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->input('UserName'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        // Sync roles with the user
        $roleNames = $request->input('roles');
        $roleIds = Role::whereIn('name', $roleNames)->pluck('id')->toArray();
        $user->roles()->sync($roleIds);

        $notification = [
            'message' => 'User updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function updateUserPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'reset_password' => 'nullable|boolean',
            'send_password_email' => 'nullable|boolean',
        ]);

        $user = User::findOrFail($id);

        $userpass = $request->input('reset_password');
        $userEmailSet = $request->input('send_password_email');
        $tempPass = $request->input('password');

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->input('password')),
        ]);

        if (isset($userpass) && $userpass) {
            $user->update(['pass_reset' => 1]);
        }

        if (isset($userEmailSet) && $userEmailSet) {
            Mail::to($user->email)->send(new SendPasswordEmail($user, $userpass));
        }

        $notification = [
            'message' => 'Password updated successfully',
            'alert-type' => 'success',
        ];

        $authUser = Auth::user();

        if($user->id == $authUser->id){
            return redirect()->route('home')->with($notification);
        }

        return redirect()->back()->with($notification);
    }

    public function deleteUser($id){

        $user = User::findOrFail($id);

        if ($user->hasRole('Admin') && User::role('Admin')->count() === 1) {
            $notification = [
                'message' => 'Cannot delete the last admin. At least one admin should be present.',
                'alert-type' => 'error'
            ];
    
            return back()->with($notification);
        }

        $user->delete();

        $notification = [
            'message' => 'user delete successfully',
            'alert-type' => 'error'
        ];

        return back()->with($notification);
    }


}
