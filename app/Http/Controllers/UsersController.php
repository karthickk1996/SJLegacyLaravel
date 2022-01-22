<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    protected  $rules = [
        'name' => 'required|min:1|max:256',
        'email' => 'required|email|max:256|unique:users,email',
        'password' => 'required|confirmed|min:8|max:20',
    ];

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');
    }

    public function index()
    {
        $you = auth()->user();
        $users = User::with('roles')->paginate(7);
        return view('dashboard.admin.usersList', compact('users', 'you'));
    }


    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('dashboard.admin.userCreate', compact('roles'));
    }


    public function store(Request $request)
    {
        $role = $request->input('role_name');
        $validatedData = $request->validate($this->rules);
        $user = User::create($validatedData);

        $user->assignRole($role);
        return back()->with('success', ' New User has been created successfully');
    }


    public function show(User $user)
    {
        return view('dashboard.admin.userShow', compact('user'));
    }


    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('dashboard.admin.userEditForm', compact('user', 'roles'));
    }


    public function update(Request $request, User $user)
    {
        $role = $request->input('role_name');
        $this->rules['password'] = 'nullable|confirmed|min:8|max:20';
        $this->rules['email'] = Rule::unique('users')->ignore($user);

        $validatedData = $request->validate($this->rules);
        $user->update($validatedData);
        $user->syncRoles([$role]);

        return back()->with('success', 'User data has been updated successfully');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User has been deleted successfully');
    }
}
