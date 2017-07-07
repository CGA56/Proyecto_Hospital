<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use Auth;
use Session;

class PacienteController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index')->with('pacientes', $pacientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validando...
        $this->validate($request, [
            'rut'=>'required|max:12', // Acá verificar R.U.T. con método e ingresarlo como corresponde...
            'nombre' =>'required|max:255',
            'fecha_nacimiento' =>'required|date',
            'sexo' =>'required',
            'direccion' =>'required|max:255',
            'telefono' =>'required|max:11',
            ]);

            $paciente = Paciente::create([          
            'rut' => $request['rut'],
            'nombre' => $request['nombre'],
            $fecha = $request['fecha_nacimiento'],
            $date = date_create($fecha),
            'fecha_nacimiento' => date_format($date, 'Y-m-d' ),            
            'sexo' => $request['sexo'],
            'direccion' => \Illuminate\Support\Facades\Crypt::encrypt(($request['direccion'])),
            'telefono' => $request['telefono'],
        ]); 

        //Display a successful message upon save
        return redirect()->route('pacientes.index')
            ->with('flash_message', 'Paciente '. $paciente->nombre.' registrado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id); //Find paciente of id = $id

        return view ('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'rut'=>'required|max:12', // Acá verificar R.U.T. con método e ingresarlo como corresponde...
            'nombre' =>'required|max:255',
            'fecha_nacimiento' =>'required|date',
            'sexo' =>'required',
            'direccion' =>'required|max:255',
            'telefono' =>'required|max:11',
        ]);

        // Recuperar la fecha:
        $fecha = $request->input('fecha_nacimiento');
        $date = date_create($fecha);
        $fecha_nacimiento = date_format($date, 'Y-m-d' );

        $paciente = Paciente::findOrFail($id);
        $paciente->rut = $request->input('rut');
        $paciente->nombre = $request->input('nombre');
        $paciente->fecha_nacimiento = $fecha_nacimiento;
        $paciente->sexo = $request->input('sexo');
        $paciente->direccion = \Illuminate\Support\Facades\Crypt::encrypt($request->input('direccion'));
        $paciente->telefono = $request->input('telefono');
        $paciente->save();

        return redirect()->route('pacientes.index', 
            $paciente->id)->with('flash_message', 
            'Paciente '. $paciente->nombre.' actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')
            ->with('flash_message',
             'Paciente eliminado con éxito.');
    }
}
