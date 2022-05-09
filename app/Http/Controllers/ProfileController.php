<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    protected function edit()
    {
        $user = auth()->user();
        $role = User::find($user->id)->with('roles')->firstOrFail();
        return view('dashboard.profile.profileEdit', compact('user', 'role'));
    }

    public function update(Request $request,  $user_id)
    {
        $user = User::find($user_id)->firstOrFail();
        $rules = [
            'name' => 'required|min:1|max:256',
            'email' => 'required|email|max:256|unique:users,email',
            'password' => 'nullable|confirmed|min:8|max:20',
            ];

        $rules['email'] = Rule::unique('users')->ignore($user);

        $validatedData = $request->validate($rules);
        $user->update($validatedData);

        return back()->with('success', 'Profile has been updated successfully');
    }
}
