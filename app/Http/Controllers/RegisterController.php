<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        //Modificar el request
        $request->request->add(['username'=> Str::slug($request->username)]);

        //Validacion
        $this->validate($request, [
            'name'=> 'required|max:25',
            'username'=> 'required|max:25|min:3|unique:users',
            'email'=> 'required|unique:users|email|max:50',
            'password' => 'required|confirmed|min:6'
        ]);

        //Creacion
        User::create([
            'name'=>$request->name,
            'username'=> $request->username,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);

        //Autenticar un usuario
      /*  auth()->attempt([
           'email' => $request->email,
           'password' => $request->password,
        ]);
      */

        //Otra forma de Autenticar
        auth()->attempt($request->only('email', 'password'));


        //Redireccion
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
