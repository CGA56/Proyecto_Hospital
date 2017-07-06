<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Paciente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\PacienteController;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // Acá colocar las validaciones del formulario de registro para los campos del paciente...
            // R.U.T., fecha de nacimiento, etc... (lo mismo hay que ver con el controller del médico).
        ]);
    }

    /**
     * Create a new user and paciente instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         $paciente = Paciente::create([
            'rut' => $data['rut'],
            'nombre' => $data['name'],
            'fecha_nacimiento' => date_create_from_format('d/m/Y', $data['fecha_nacimiento']),
            'sexo' => $data['sexo'],
            'direccion' => bcrypt($data['direccion']),
            'telefono' => $data['telefono'],
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->assignRole('Paciente');              
        return $user;
    }
}
