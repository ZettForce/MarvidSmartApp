<?php

namespace App\Http\Controllers;

use App\Models\configuracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function index()
    {
        // Variable para obtener divisas del api
        $jsonData = file_get_contents('https://api.hilariweb.com/divisas');
        $divisas = json_decode($jsonData, true);
        // Lógica para mostrar la configuración
        // compact('configuracion','divisas') se utiliza para enviar a la vista(envaiamos configuracion y divisas)
        $configuracion = configuracion::first();
        return view('admin.configuracion.index', compact('configuracion', 'divisas'));
    }



    public function store(Request $request)
    {
        // Lógica para almacenar la configuración
        // Validar y guardar los datos en la base de datos
        // $datos = request()->all();
        // return response()->json($datos);
        $request->validate([
            'nombre_institucion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correoElectronico' => 'required|email',
            'logo' => 'image|mimes:jpeg,png,jpg',
            'divisa' => 'required',
            'cctClave' => 'required',
            'incorporacionClave' => 'required',
            'nombreDirector' => 'required',
        ]);
        // return redirect()->route('admin.configuracion.index')->with('success', 'Configuración guardada correctamente.');
        // BUSCAR si existe la configuración
        $configuracion = configuracion::first();

        if ($configuracion) {
            //Actualizar
            $configuracion->nombre_institucion = $request->nombre_institucion;
            $configuracion->direccion = $request->direccion;
            $configuracion->telefono = $request->telefono;
            $configuracion->correoElectronico = $request->correoElectronico;
            $configuracion->web = $request->web;
            $configuracion->facebook = $request->facebook;
            $configuracion->instagram = $request->instagram;
            $configuracion->divisa = $request->divisa;
            $configuracion->cctClave = $request->cctClave;
            $configuracion->incorporacionClave = $request->incorporacionClave;
            $configuracion->nombreDirector = $request->nombreDirector;
            $configuracion->nombreSubdirector = $request->nombreSubdirector;
            $configuracion->nombreControlEscolar = $request->nombreControlEscolar;
            // Verificar si se subió un nuevo logo
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('logos'), $filename);
                $configuracion->logo = $filename;
            }
            $configuracion->save();
            return redirect()->route('admin.configuracion.index')->with('success', 'Configuración actualizada correctamente.');
        }
    }
}
