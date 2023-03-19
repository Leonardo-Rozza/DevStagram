<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username'=> Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'max:25', 'min:3','unique:users']
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);

            //Guardar los cambios
            $usuario = User::find(auth()->user()->id);
            $usuario->username = $request->username;
            $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
            $usuario->save();

            //Redireccionar al usuario
            return redirect()->route('posts.index', $usuario->username);
        }
    }
}
