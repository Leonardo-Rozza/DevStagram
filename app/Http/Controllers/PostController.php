<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('dashboard', [
            'user'=> $user,
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //Validando los datos del formulario de new POST
        $this->validate($request, [
            'titulo' => 'required|max:200',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //Creando el registro (1ra forma)
//        Post::create([
//           'titulo' => $request->titulo,
//           'descripcion' => $request->descripcion,
//           'imagen' => $request->imagen,
//            'user_id'=> auth()->user()->id
//        ]);

        //Otra forma de crear el registro (2da forma)
//        $post = new Post;
//        $post->titulo = $request->titulo;
//        $post->descripcion = $request->descripcion;
//        $post->imagen = $request->imagen;
//        $post->user_id = auth()->user()->id;
//        $post->save();

        //Otra forma de crear Posts, usando las relaciones.
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id'=> auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }
}
