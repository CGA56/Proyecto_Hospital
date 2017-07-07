<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Atencion;
use App\Paciente;
use App\Medico;
use Auth;
use Session;

class AtencionController extends Controller
{
   
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atenciones = Atencion::all();
        return view('atenciones.index')->with('atenciones', $atenciones);
    
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        return view('atenciones.create')->with(['pacientes'=>$pacientes , 'medicos'=>$medicos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
 
        'fecha_hora'=>'required',
        ]);
       $fechaSinFormato = $request['fecha_hora'];
       $formatoCasteada = date_create($fechaSinFormato);
       $fecha_hora = date_format($formatoCasteada, 'Y-m-d H:i:s' );


       $atencion = Atencion::create([
                
            'fecha_hora' => $fecha_hora,
            'id_paciente' => $request['id_paciente'],
            'id_medico' => $request['id_medico'],
            'estado'=>'Agendada',
           
        ]);  

       return redirect()->route('atenciones.index')->with('flash_message' , ' creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atencion = Atencion::findOrFail($id);
        return view('atenciones.show',compact('atenciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $atencion = Atencion::findOrFail($id);
        return view('atenciones.edit',compact('atenciones'));
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
         $this->validate($request,[

        'fecha'=>'required|date',
        'hora'=>'required',
        ]);

        
        $atencion = Atencion::findOrFail($id);

        // Recuperar la hora y fecha:
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $formatoHoraFecha = date_create($fecha." ".$hora);
        $fecha_hora = date_format($formatoHoraFecha, 'Y-m-d H:i:s' );

        $atencion->fecha_hora = $fecha_hora;
        $atencion->id_paciente = $request->input('paciente');
        $atencion->id_medico = $request->input('medico');
        $atencion->estado = $request->input('estado');

        $atencion->save();  
        
        return redirect()->route('atenciones.show')->with('flash_message' , 'Atención nro '. $atencion->id .' actualizada');
      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $atencion = Atencion::findOrFail($id);
        $atencion->delete();

        return redirect()->route('atenciones.index')->with('flash_message' , 'Atencion eliminada');
    }
}
