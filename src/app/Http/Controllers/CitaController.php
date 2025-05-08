<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
class CitaController extends Controller
{

   //muestro las citas
   public function index()
   {

      //obtengo todas las citas con el role taller
      if (Auth::user()->role === 'taller') {

         $citas = Cita::with('user')->get();
      } else {
         // si no obten los citas segun el id del user del login
         //cargo las citas relacionadas con el usuario
         $citas = Cita::with('user')->where('user_id', Auth::id())->get();

      }
      //variable $citas y es la que se usa para recorrer los datos en html 
      return view('citas.show', compact('citas'));
   }

   public function filtrar(Request $request){
      //OBTENgo el estado del select
      $estado = $request->input('estado');

      //carga los datos de las citas y los datos relacionados de los usuarios con esas citas
      $query = Cita::with('user');
  
      if ($estado === 'sincita') {
          $query->whereNull('fecha')
                ->whereNull('hora')
                ->whereNull('duracion');
      } elseif ($estado === 'concita') {
          $query->whereNotNull('fecha')
                ->whereNotNull('hora')
                ->whereNotNull('duracion');
      }
  
      //obtengo los datos
      $citas = $query->get();
      
      //paso las citas y el estado
      return view('citas.show', compact('citas','estado'));
   }


   /**
    * vista para crear citas
    * Summary of create
    * @return \Illuminate\Contracts\View\View
    */
   public function create()
   {

      return view('citas.nueva-cita');

   }



   //las guardo
   public function store(Request $request)
   {

      $rules = [
         'marca' => 'required|string',
         'modelo' => 'required|string',
         'matricula' => 'required|string',
      ];


      //solo si el usuario tiene rol de taller si no sera null los valores
      
      if (Auth::user()->role === 'taller') {
         $rules['fecha'] = 'required|date';
         $rules['hora'] = 'required';
         $rules['duracion'] = 'required';

      }

      $request->validate($rules);

    
      //creo la cita

      try {
         //con create inserto en la bd
         $cita = Cita::create([
            'user_id' => Auth::id(),
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => strtoupper($request->input('matricula')),
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'duracion' => $request->duracion,
         ]);


         return redirect()->route('citas.index')
            ->with('success', 'Cita creada correctamente');
      } catch (Exception $e) {

         return redirect()->route('citas.index')
            ->with('error', 'Hubo un problema al crear la cita' . $e->getMessage());
      }

   }


   public function edit($id)
   {
      $cita = Cita::findOrFail($id);
      return view('citas.modificar-cita', compact('cita'));
   }

   public function update(Request $request, $id)
{
   //obtengo los datos del formulario 'rquest'
    $request->validate([   
      'fecha'=>'required|date',
      'hora'=>'required',
      'duracion'=>'required'

    ]);
    $cita = Cita::findOrFail($id);

    //actualizo los campos fecha,hora y duracion
    $cita->update([
      'fecha'=>$request->fecha,
      'hora'=>$request->hora,
      'duracion'=>$request->duracion
    ]);

    return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente');
}

   public function destroy($id)
   {
      $cita = Cita::findOrFail($id);
      $cita->delete();
      return redirect()->route('citas.index');
   }

}
