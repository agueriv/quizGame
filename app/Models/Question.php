<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $table = 'question';
    protected $fillable = ['name'];
    
    // Establecemos la relacion 1 a muchos de la tabla pregunta con la respuesta
    function answers() {
        return $this->hasMany('App\Models\Answer', 'idquestion');
    }
    // Relacion con la tabla history?
    function historys() {
        return $this->hasMany('App\Models\History', 'idquestion');
    }
}
