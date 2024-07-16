<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $casts = [
        'itens' => 'array'
    ];

    protected $fillable = [
        'nome',
        'descricao',
        'data',
        'itens',
        'local',
        'imagem',
        'id_user' 
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_user'); 
    }

    public function users() {
        return $this->belongsToMany('App\Models\User'); 
    }
    
}
