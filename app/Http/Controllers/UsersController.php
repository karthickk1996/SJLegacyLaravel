<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    protected $rules = [
        'name' => 'required|min:1|max:256',
        'email' => 'required|email|max:256',
        'password' => 'required|min:8|max:20',
    ];

        public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware('admin');
    }

    public function index()
    {
        $you = auth()->user();
        $users = User::paginate(4);
        return view('dashboard.admin.usersList', compact('users', 'you'));
    }


    public function create()
    {
        return view('dashboard.admin.userCreate');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate($this->rules);
        $validatedData['password'] = Hash::make($request->input('password'));
        User::create($validatedData);

        return back()->with('success', ' New User has been created successfully');
    }


    public function show(User $user)
    {
        return view('dashboard.admin.userShow', compact('user'));
    }


    public function edit(User $user)
    {
        return view('dashboard.admin.userEditForm', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $this->rules['password'] = 'nullable | min:3| max:8';
        $this->rules['email'] = Rule::unique('users')->ignore($user);

        $validatedData = $request->validate($this->rules);

        if ($validatedData['password'] === null) {
            unset($validatedData['password']);
        } else {
            $validatedData['password'] = Hash::make($request->input('password'));
        }

        $user->update($validatedData);
        return back()->with('success', 'User data has been updated successfully');
    }


    public function destroy(User $user)
    {
        if ($user) {
            $user->delete();
        }

        return redirect()->route('users.index')->with('success', 'User has been deleted successfully');
    }
}
