<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegistrationController extends Controller
{
    // public function userss()
    // {
    //     return view('dash/users');
    // }

    public function index()
    {
        $title = "Users";
        $title1 = "User";
        $users = User::get();
        return view('dash/users', compact('title', 'title1', 'users'));    #return view('name of view', compact('name of variables')); 
    }


    /**
     * Login Form
     */
    public function registrationforms()
    {
        //session()->forget('errors'); // Clear errors when loading the registration form
        return view('dash/test');
    }


    /**
     * Authenticate Registration
     */
    public function login(Request $request)
    {
        //if (isset($_POST['Login'])) {
            $credentials = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);
        

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('users');
            }
             # Redirect back to the #signin fragment with errors
                return redirect()->to('/test#signin')
                ->withErrors(['login_error' => 'The provided username or password do not match our records.'])
                ->withInput($request->only('username'));
    // # Redirect to the test route with the #signin fragment and include login errors
    //         return redirect()->route('test', ['#signin'])
    //                  ->withErrors(['login_error' => 'The provided username or password do not match our records.'])
    //                  ->withInput($request->only('username'));

            // return back()->withErrors([
            //     'username' => 'The provided username or password do not match our records.',
            // ]);
        //}
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //if (isset($_POST['Registration'])) {
            $messages = $this->errMsg();
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ],$messages);
            
            $data['active'] = true;  // Set default value for active field
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            return redirect('users')->with('success', 'User created successfully.');

             #Redirect to the test route with the #signin fragment
            //return redirect()->to('/test#signin')->with('success', 'User created successfully.');
            // # Redirect to the test route with the #signin fragment after successful registration
            // return redirect()->route('test', ['#signin'])->with('success', 'User created successfully.');
            //return redirect()->route('users')->with('success', 'User created successfully.');

        //}
    }


    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }



    /**
     * error custom message
     */
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




    // if ($request->route()->named('signup')) {
    //     $data['active'] = true;  // Set default value for active field
    // } else {
    //     $data['active'] = isset($request->active); #laravel wiil transfer if is set check boxx =1 and non = 0
    // }

}
