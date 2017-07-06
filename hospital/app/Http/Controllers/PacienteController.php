<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use Auth;
use Session;

class PacienteController extends Controller
{
    public function __construct() {
        $this->middleware(['auth', 'clearance'])->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('pacientes.index', compact('pacientes'));
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
            'rut'=>'required|max:12|unique', // Acá verificar R.U.T. con método e ingresarlo como corresponde...
            'nombre' =>'required|max:255',
            'fecha_nacimiento' =>'required|date',
            'sexo' =>'required',
            'direccion' =>'required|max:255',
            'telefono' =>'required|max:255',
            ]);

        $rut = $request['rut'];
        $nombre = $request['nombre'];
        $fecha_nacimiento = $request['fecha_nacimiento'];
        $sexo = $request['sexo'];
        $direccion = $request['direccion'];
        $telefono = $request['telefono'];

        $paciente = Paciente::create($request->only('rut', 'nombre', 'fecha_nacimiento', 'sexo', bcrypt('direccion'), 'telefono'));

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
            'rut'=>'required|max:12|unique', // Acá verificar R.U.T. con método e ingresarlo como corresponde...
            'nombre' =>'required|max:255',
            'fecha_nacimiento' =>'required|date',
            'sexo' =>'required',
            'direccion' =>'required|max:255',
            'telefono' =>'required|max:255',
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->rut = $request->input('rut');
        $paciente->nombre = $request->input('nombre');
        $paciente->fecha_nacimiento = $request->input('fecha_nacimiento');
        $paciente->sexo = $request->input('sexo');
        $paciente->direccion = $request->bcrypt(input('direccion'));
        $paciente->telefono = $request->input('telefono');
        $paciente->save();

        return redirect()->route('pacientes.show', 
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
