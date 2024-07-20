<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $title;
    protected $redirectTo = 'admin/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->title = 'Register Page';
    }

    /**
    * @return \Illuminate\View\View
    */
   public function showRegistrationForm()
   {
    return redirect()->to('/login#signup')->with('title', $this->title);
        //    return view('auth.login', ['title' => $this->title]);
   }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = $this->errMsg();
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => 'required|string|max:255|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'active' => true,  # Set default value for active field
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // $this->validator($request->all())->validate();
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect('/login#signup')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = $this->create($request->all());

        # Log the user in
        $this->guard()->login($user);

        # Apply the session to use the name and username
        Session::put('name', $user->name);

        return redirect($this->redirectPath());
    }


    

    protected function errMsg(){
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'username.required' => 'The username field is required.',
            'username.unique' => 'The username has already been taken.',
            'password.required' => 'The password field is required.',
        ];
    }
}


// return redirect()->to('/login#signup')->with([
//     'name.required' => 'The name field is required.',
//     'email.required' => 'The email field is required.',
//     'email.email' => 'The email must be a valid email address.',
//     'email.unique' => 'The email has already been taken.',
//     'username.required' => 'The username field is required.',
//     'username.unique' => 'The username has already been taken.',
//     'password.required' => 'The password field is required.',
// ]);