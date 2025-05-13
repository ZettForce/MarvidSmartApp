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
        $request->validate([
            'nombre_institucion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'correoElectronico' => 'required|email',
            'divisa' => 'required',
            'cctClave' => 'required',
            'incorporacionClave' => 'required',
            'nombreDirector' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg',
        ]);
        //Buscar si existe configuracion
        $configuracion = Configuracion::first();

        if ($configuracion) {

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

            if ($request->hasFile('logo')) {
                if ($configuracion->logo) {
                    unlink(public_path($configuracion->logo));
                }
                $logoPath = $request->file('logo')->store('logos' . 'public');
                $configuracion->logo = '/storage/' . $logoPath;
            }

            $configuracion->save();
            return redirect()->route('admin.configuracion.index')->with('success', 'Configuración guardada correctamente.');
        } else {
            //Crear nueva configuracion

            $configuracion = new configuracion();
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

            if ($request->hasFile('logo')) {
                //Guardar nuevo logo
                $logoPath = $request->file('logo');
                $nombreArchivo = time() . '_' . $logoPath->getClientOriginalName();
                $rutaDestino = public_path('uploads/logos');
                $logoPath->move($rutaDestino, $nombreArchivo);
                $configuracion->logo = 'uploads/logos/' . $nombreArchivo;
            }
            $configuracion->save();
            return redirect()->route('admin.configuracion.index')->with('success', 'Configuración guardada correctamente.');
        }
    }
}
