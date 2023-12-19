<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\AnswerCreateRequest;
use App\Http\Requests\AnswerEditRequest;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $answers = Answer::all()->sortBy('idquestion');
        return view('answer.index', ['answers' => $answers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $questions = DB::select('SELECT question.id, question.name
                                FROM question
                                LEFT JOIN answer ON question.id = answer.idquestion
                                GROUP BY question.id, question.name
                                HAVING COUNT(answer.idquestion) < 4');
        return view('answer.create', ['questions' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnswerCreateRequest $request)
    {
        try {
            // creamos el modelo question
            $answer = new Answer($request->all());
            $otherAnswers = Answer::where('idquestion', $answer->idquestion)->where('id', '<>', $answer->id)->get();
            foreach($otherAnswers as $anss) {
                if($anss->name === $answer->name) {
                    return back()->withInput()->withErrors(['message' => 'This answer already exists']);
                }
            }
            
            // comprobamos que la pregunta asociada no tenga respuesta correcta
            if($answer->escorrecta == 1) {
                $exist = false;
                foreach($otherAnswers as $ans) {
                    if($ans->escorrecta == 1) $exist = true;
                }
                if($exist) {
                    return back()->withInput()->withErrors(['message' => 'The answer could not have two correct answers']);
                } else {
                    $answer->escorrecta = $request->escorrecta;
                }
            } else {
                $exist = false;
                foreach($otherAnswers as $ans) {
                    if($ans->escorrecta == 1) $exist = true;
                }
                if(!$exist) {
                    return back()->withInput()->withErrors(['message' => 'There must be a correct answer to this question']);
                } else {
                    $answer->escorrecta = $request->escorrecta;
                }
            }
            
            // guardamos y creamos la pregunta
            $result = $answer->save();
            
            return redirect('back/answer')->with(['message'=> 'New answer created.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'The answer could not created']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        return view('answer.show', ['answer' => $answer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        $questions = DB::select('SELECT question.id, question.name
                                FROM question
                                LEFT JOIN answer ON question.id = answer.idquestion
                                GROUP BY question.id, question.name
                                HAVING COUNT(answer.idquestion) < 4');
        return view('answer.edit', ['answer' => $answer,
                                    'questions' => $questions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnswerEditRequest $request, Answer $answer)
    {
        try {
            $answer->name = $request->name;
            $otherAnswers = Answer::where('idquestion', $answer->idquestion)->where('id', '<>', $answer->id)->get();
            
            foreach($otherAnswers as $anss) {
                if($anss->name === $answer->name) {
                    return back()->withInput()->withErrors(['message' => 'This answer already exists']);
                }
            }
            
            // comprobamos que la pregunta asociada no tenga respuesta correcta
            if($request->escorrecta == 1) {
                // OLD
                // $exist = false;
                // foreach($otherAnswers as $ans) {
                //     if($ans->escorrecta == 1) $exist = true;
                // }
                // if($exist) {
                //     return back()->withInput()->withErrors(['message' => 'The answer could not have two correct answers']);
                // } else {
                //     $answer->escorrecta = $request->escorrecta;
                // }
                
                // Añadido
                $exist = false;
                $correct = null;
                foreach($otherAnswers as $ans) {
                    if($ans->escorrecta == 1) {
                        $exist = true;
                        $correct = $ans;
                    }
                }
                if($exist) {
                    $correct->escorrecta = false;
                    $correct->save();
                    $answer->escorrecta = $request->escorrecta;
                    //return back()->withInput()->withErrors(['message' => 'The answer could not have two correct answers']);
                } else {
                    $answer->escorrecta = $request->escorrecta;
                }
            } else {
                $exist = false;
                foreach($otherAnswers as $ans) {
                    if($ans->escorrecta == 1) $exist = true;
                }
                if(!$exist) {
                    return back()->withInput()->withErrors(['message' => 'There must be a correct answer to this question']);
                } else {
                    $answer->escorrecta = $request->escorrecta;
                }
            }
            
            // guardamos y creamos la pregunta
            $result = $answer->save();
            
            return redirect('back/answer')->with(['message'=> 'New answer created.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'The answer could not created']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        try {
            $answer->delete();
            return redirect('back/answer')->with(['message'=> 'This answer has been deleted.']);
        } catch (\Exception $e) {
            return redirect('back/answer')->withErrors(['message' => 'This answer has not been deleted.']);
        }
    }
}
