<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\History;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Crypt;


class HomeController extends Controller
{
    function front() {
        $alias = session('aliase', false);
        if($alias) {
            return view('landing.frontindex');
        } else {
            return view('landing.frontloginindex');
        }
    }
    
    function frontlogin(Request $request) {
        session(['frontAlias' => $request->alias]);
        session(['aliase' => true]);
        return redirect('/');
    }
    
    function forgetAlias(Request $request) {
        $request->session()->forget('aliase');
        return redirect('/');
    }
    
    // Método para mostrat el historial de un alias
    function aliashistory($alias) {
        $historyentries = History::where('alias', $alias)->get();
        return view('front.history', ['entries' => $historyentries]);
    }
    
    function back(Request $request) {
        $check = session('check', false);
        if ($check) {
            return view('landing.backindex');
        } else {
            return view('landing.backlogin');
        }
    }
    
    function login(Request $request) {
        // Al hacer este if podemos controlar y hacer el funcionamiento de cuando te logueas
        try {
            if ($request->username != null) {
                // Sacamos todos los usuarios admin
                $admins = Admin::pluck('password', 'username');
                // Guardamos las credenciales que introduce el usuario
                $user = $request->username;
                $passwd = $request->password;
                
                // Recorremos los admins
                foreach($admins as $username => $password) {
                    // Buscamos coincidencias de usuario y contraseña encriptadas
                    if($username == $user && password_verify($passwd, $password)) {
                        $admin = Admin::where('username', $username)->where('password', $password)->get();
                        session(['check' => true]);
                        session(['userSesion' => $admin[0]->username]);
                        session(['urlUserSesion' => 'back/admin/'.$admin[0]->id]);
                        session(['userPhoto' => $admin[0]->photo]);
                        $request->session()->forget('badlogin');
                        $request->session()->forget('userDeleted');
                        return redirect('back');
                    }
                }
                session(['check' => false,
                         'badlogin' => 'Usuario y/o contraseña incorrectos.']);
                return back()->withInput()->withErrors(['message' => 'Usuario y/o contraseña incorrectos.']);
            } else {
                session(['check' => false,
                         'badlogin' => 'Usuario y/o contraseña incorrectos.']);
                return back()->withInput()->withErrors(['message' => 'Usuario y/o contraseña incorrectos.']);
            }
        } catch(\Exception $e) {
            session(['check' => false,
                         'badlogin' => 'Usuario y/o contraseña incorrectos error sesion.']);
            return back()->withInput()->withErrors(['message' => 'Usuario y/o contraseña incorrectos.']);
        }
    }
    
    function logout(Request $request) {
        $request->session()->forget('check');
        $request->session()->forget('userSesion');
        $request->session()->forget('urlUserSesion');
        $request->session()->forget('userPhoto');
        return redirect('back');
    }
    
    // Método para mostrar el juego en sí
    function game() {
        // Buscamos 5 preguntas random de la base de datos
        $questions = Question::orderByRaw('RAND()')->has('answers', 4)->limit(5)->get();
        if(sizeof($questions) < 5) {
            return back()->withInput()->withErrors(['message' => 'Not enough questions']);
        } else {
            session(['questions' => $questions]);
            $cont = 0;
            $points = 0;
            // Terminamos devolviendo la vista que mostrará las preguntas
            return view('front.game', ['questions' => $questions,
                                       'number' => $cont,
                                       'points' => $points,
                                       'finish' => false]);
        }
    }
    
    function checktry(Request $request) {
        try {
            // lista de preguntas de la partida
            $questions = session('questions');
            // pregunta respondida en ese intento
            $questionAnswered = $request->idquestion;
            // id de la respuesta del usuario
            $answers = Answer::where('id', $request->q_answer)->get();
            $answer = $answers[0];
            // numero de pregunta -1 por el que va el usuario
            $number = $request->number;
            // puntos del jugador
            $points = $request->points;
            
            // comprobar si la respuesta es correcta
            if($answer->escorrecta) {
                $points += 1;
            }
            // introducir la entrada en el historial
            $entry = new History();
            $entry->idquestion = $questionAnswered;
            $entry->idanswer = $answer->id;
            $entry->alias = session('frontAlias');
            $entry->escorrecta = $answer->escorrecta;
            $entry->save();
            
            // comprobar que number no sea 4 (si es 4 es que esa es la ultima pregunta)
            if($number < 4) {
                $number += 1;
                return view('front.game', ['questions' => $questions,
                                          'number' => $number,
                                        'points' => $points,
                                        'finish' => false]);
            } else {
                $request->session()->forget('questions');
                // el juego termina y mostramos el resultado
                return view('front.game', ['points' => $points,
                                           'finish' => true]);
            }
        } catch(\Exception $e) {
            return back();
        }
    }
}
