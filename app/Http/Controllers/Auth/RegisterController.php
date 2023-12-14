<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Plant;
use App\Models\Departemen;
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
        return Validator::make($data, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'level' => ['required', 'string', 'max:255'],
            'tanggal_join' => ['required'],
            'plant' => ['required'],
            'departemen' => ['required'],
            'nik' => ['required'],
            'foto' => ['nullable', 'image', 'max:2048'], // Max file size in kilobytes
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
        $userAttributes = [
            'nama' => $data['nama'],
            'plant' => $data['plant'],
            'departemen' => $data['departemen'],
            'nik' => $data['nik'],
            'password' => Hash::make($data['password']),
            'level' => $data['level'],
            'tanggal_join' => $data['tanggal_join'],
            'approved' => 0, // Default is not approved
        ];

        // Check if 'foto' is provided
        if (isset($data['foto']) && $data['foto'] instanceof UploadedFile) {
            // Store the uploaded file in the 'public' disk and get the path
            $fotoPath = $data['foto']->store('users', 'public');

            // Save the file path in the 'foto' field
            $userAttributes['foto'] = $fotoPath;
        }

        return User::create($userAttributes);
    }

    protected function showRegistrationForm()
    {
        return view('auth.register', [
            'plant' => Plant::all(),
            'departemen' => Departemen::all(),
        ]);
    }
}
