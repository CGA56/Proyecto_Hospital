<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medico;
use Auth;
use Session;

class MedicoController extends Controller
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
        $medicos = Medico::orderby('id', 'desc')->paginate(5); //show only 5 items at a time in descending order

        return view('medicos.index', compact('medicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicos.create');
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
            'fecha_contratacion' =>'required|date',
            'especialidad' =>'required|max:255',
            'valor_consulta' =>'required|max:255',
            ]);

        $rut = $request['rut'];
        $nombre = $request['nombre'];
        $fecha = $request['fecha_contratacion'],
        $date = date_create($fecha),
        $fecha_contratacion = date_format($date, 'Y-m-d'),    
        $especialidad = $request['especialidad'];
        $valor_consulta = $request['valor_consulta'];

        $medico = Medico::create($request->only('rut', 'nombre', 'fecha_contratacion', 'especialidad', 'valor_consulta'));

        //Display a successful message upon save
        return redirect()->route('medicos.index')
            ->with('flash_message', 'Médico '. $medico->nombre.' registrado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medico = Medico::findOrFail($id); //Find medico of id = $id

        return view ('medicos.show', compact('medico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medico = Medico::findOrFail($id);

        return view('medicos.edit', compact('medico'));
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
            'fecha_contratacion' =>'required|date',
            'especialidad' =>'required|max:255',
            'valor_consulta' =>'required|max:255',
        ]);

        $medico = Medico::findOrFail($id);
        $medico->rut = $request->input('rut');
        $medico->nombre = $request->input('nombre');
        $medico->fecha_contratacion = $request->input('fecha_contratacion');
        $medico->save();

        return redirect()->route('medicos.show', 
            $medico->id)->with('flash_message', 
            'Médico '. $medico->nombre.' actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return redirect()->route('medicos.index')
            ->with('flash_message',
             'Médico eliminado con éxito.');
    }
}
