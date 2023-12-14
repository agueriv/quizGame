<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    
    protected $table = 'answer';
    
    protected $fillable = ['idquestion', 'name', 'escorrecta'];
    
    // Definimos la relación entre respuesta y pregunta (1 - 1)
    // Una respuesta solo es de una pregunta
    function question() {
        return $this->belongsTo('App\Models\Question', 'idquestion');
    }
    
    // Relacion con tabla history?
    function historys() {
        return $this->hasMany('App\Models\History', 'idanswer');
    }
}
