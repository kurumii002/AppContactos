<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consultar a la BD
        $datos['contactos'] = Contacto::paginate(3);

        return view('contacto.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $campos = [
            'Nombre'=>'required|string|max:50',
            'Apellido'=>'required|string|max:50',
            'Correo'=>'required|email',
            'Telefono'=>'required|string|max:9',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        ];

        //que valide los datos
        $this->validate($request, $campos, $mensaje);

        //recolecta los datos del form menos el token
        $datosContacto = request()->except('_token');

        if($request->hasFile('Foto')){ //si es que hay una foto
            //altera el campo y luego se utiliza el nombre de ese campo y se inserta en public
            $datosContacto['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }
        Contacto::insert($datosContacto); //inserta a la BD

        //return response()->json($datosContacto);
        return redirect('contacto')->with('mensaje', 'Contacto registrado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function show(Contacto $contacto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //busca los datos x id
        $contacto = Contacto::findOrFail($id);

        return view('contacto.edit', compact('contacto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'Nombre'=>'required|string|max:50',
            'Apellido'=>'required|string|max:50',
            'Correo'=>'required|email',
            'Telefono'=>'required|string|max:9',
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido',
        ];

        if($request->hasFile('Foto')){ //el usuario no necesariamente tiene que adjuntar otra foto, solo se valia cuando la foto exista
            $campos = ['Foto'=>'required|max:10000|mimes:jpeg,png,jpg',]; 
            $mensaje = ['Foto.required'=>'La foto es requerida'];
        }

        //que valide los datos
        $this->validate($request, $campos, $mensaje);


        $datosContacto = request()->except(['_token', '_method']);
        
        if($request->hasFile('Foto')){ //si es que hay una foto
            $contacto = Contacto::findOrFail($id);
            
            //borra la foto
            Storage::delete('public/'.$contacto->Foto);

            //altera el campo y luego se utiliza el nombre de ese campo y se inserta en public
            $datosContacto['Foto'] = $request->file('Foto')->store('uploads', 'public');
        }
        
        Contacto::where('id', '=', $id)->update($datosContacto);

        $contacto = Contacto::findOrFail($id);

        //return view('contacto.edit', compact('contacto'));
        return redirect('contacto')->with('mensaje', 'Contacto editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contacto  $contacto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacto = Contacto::findOrFail($id);

        if(Storage::delete('public/'.$contacto->Foto)){
            Contacto::destroy($id);
        }

        return redirect('contacto')->with('mensaje', 'Contacto eliminado');
    }
}
