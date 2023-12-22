<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    { 
        $secret_key = env('SECRET_KEY');
        if ($data['secret_key'] != $secret_key) {
            return response()->json([
                'message' => 'Secret key is not valid'
            ], 401);
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->createToken('auth-tokenn');

        return $user;

        // return response()->json([
        //     // 'token' => $token,
        //     'name' => $user->name,
        //     'email' => $user->email,
        // ]);
    
    }

    public function login(Request $request)
    {
        // Your login logic
        $authenticated = Auth::attempt($request->only('email', 'password'));
        $message = 'Loginsdasd successful' . request('name');
        return response()->json(['message' => $message],404);
        if ($authenticated) {
            // User is authenticated
            $user = Auth::user();
            $user->createToken('auth-tokenn');

            $message = 'Login successful';
            return response()->json([
                'message' => $message,
                'token' => $user->tokens->first()->token,
                'name' => $user->name
            ],200);
        } else {
            // User is not authenticated
            $message = 'Login failed';
            return response()->json([
                'message' => $message,
            ],401);
        }
    }

    protected function registered()
    {
        $user = Auth::user();
 
        $message = 'Registration successful';
        return response()->json([
            'message' => $message,
            'token' => $user->tokens->first()->token,
            'name' => $user->name
        ],200);
    }
}
