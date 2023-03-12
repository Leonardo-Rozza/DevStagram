<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Esta es la informacion que se va a llevar a la base de datos.
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }
}
