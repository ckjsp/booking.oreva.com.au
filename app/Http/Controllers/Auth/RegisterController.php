<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/home';

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
        // Create the new user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Call the function to set default settings for this user
        $this->createDefaultSettings($user->id);

        return $user;
    }

    /**
     * Create default settings for a new user
     *
     * @param  int  $userId
     * @return void
     */
    protected function createDefaultSettings($userId)

    {
        // Add default settings for the new user
        $defaultSettings = [
            ['setting_key' => 'logo', 'setting_value' => 'img/dashboardlogo.svg', 'user_id' => $userId],
            ['setting_key' => 'address', 'setting_value' => 'Default Address', 'user_id' => $userId],
            ['setting_key' => 'phone_number', 'setting_value' => '0000000000', 'user_id' => $userId],
        ];

        // Insert the default settings into the database
        Setting::insert($defaultSettings);
    }
}
