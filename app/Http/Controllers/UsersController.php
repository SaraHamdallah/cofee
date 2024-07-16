<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Users";
        $title1 = "User";
        $users = User::get();
        return view('dash/users', compact('title', 'title1', 'users'));    #return view('name of view', compact('name of variables')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Users";
        $title1 = "User";
        return view('dash/addUser', compact('title', 'title1')); //name of the form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = $this->errMsg();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ],$messages);

            // Convert 'active' checkbox value to boolean
            $data['active'] = isset($request->active); #laravel wiil transfer if is set check boxx =1 and non = 0
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            return redirect('users')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Users";
        $title1 = "User";
        $user = User::findOrFail($id);
        return view('dash.editUser', compact('title', 'title1', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = $this->errMsg();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'active'=>'required|boolean|in:1,0',// Validate the 'active' field as boolean
                'password' => 'required|string|min:8',
            ],$messages);

            $data['active'] = (bool)$data['active'];
            // Hash the password only if it is provided
            if ($request->filled('password')) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

        # Update user  data
        User::where('id', $id)->update($data);
        return redirect('users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function errMsg(){
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'password.required' => 'The password field is required.',
            //'password.confirmed' => 'The password confirmation does not match.',
            'terms.required' => 'You must agree to the terms and conditions.',     

        ];
    }
}
