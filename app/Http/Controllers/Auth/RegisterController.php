<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Country;
use App\Enums\RolesEnum;
use App\Models\Language;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Services\UserSettingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Services\UserSubscriptionService;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = "api/user/channels";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        protected UserSettingService $userSettingService,
        protected UserSubscriptionService $userSubscriptionService
    )
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
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
 
        $country = Country::find($data['country_id']);
        $language = Language::find($data['language_id']) ? Language::find($data['language_id']) : Language::where('code', 'en')->first();
        
        $this->userSettingService->generateDefault($user, $country, $language);
        $this->userSubscriptionService->generateDefault($user);
       
        $user->createToken('auth-tokenn');

        // Get or create a role named 'user' (you can adjust the role name based on your needs)
        // $role = app(Role::class)->findOrCreate(RolesEnum::USER->value, 'web');
        // $user->assignRole(RolesEnum::PREMIUM);

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

    protected function registered(Request $request, $user)
    {
        $message = 'Registration successful';
        return response()->json([
            'message' => $message,
            'token' => $user->tokens->first()->token,
            'name' => $user->name
        ],200);
    }

    // protected function authenticated(Request $request, $user)
    // {
    //     return response()->json(['message' => 'Authentication successful']);
    // }
}
