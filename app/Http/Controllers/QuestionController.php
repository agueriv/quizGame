<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionCreateRequest;
use App\Http\Requests\QuestionEditRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return view('question.index', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionCreateRequest $request)
    {
        try {
            // creamos el modelo question
            $question = new Question();
            // introducimos en el modelo los datos de la pregunta (name)
            $question->name = $request->name;
            // guardamos y creamos la pregunta
            $result = $question->save();
            
            if($result) {
                // cogemos el id de la pregunta que acabamos de guardar
                $idpregunta = $question->id;
                // llamamos al metodo 
                $answer1 = new Answer();
                $answer2 = new Answer();
                $answer3 = new Answer();
                $answer4 = new Answer();
                
                // introducimos el id de la pregunta
                $answer1->idquestion = $idpregunta;
                $answer2->idquestion = $idpregunta;
                $answer3->idquestion = $idpregunta;
                $answer4->idquestion = $idpregunta;
                
                // introducimos el nombre de cada respuesta
                $answer1->name = $request->firstanswer;
                $answer2->name = $request->secondanswer;
                $answer3->name = $request->thirdanswer;
                $answer4->name = $request->fourthanswer;
                
                // seleccionamos cuales son falsas y cual correcta
                if($request->correctanswer == 1) {
                    $answer1->escorrecta = true;
                    $answer2->escorrecta = false;
                    $answer3->escorrecta = false;
                    $answer4->escorrecta = false;
                } else if($request->correctanswer == 2) {
                    $answer1->escorrecta = false;
                    $answer2->escorrecta = true;
                    $answer3->escorrecta = false;
                    $answer4->escorrecta = false;
                } else if($request->correctanswer == 3) {
                    $answer1->escorrecta = false;
                    $answer2->escorrecta = false;
                    $answer3->escorrecta = true;
                    $answer4->escorrecta = false;
                } else {
                    $answer1->escorrecta = false;
                    $answer2->escorrecta = false;
                    $answer3->escorrecta = false;
                    $answer4->escorrecta = true;
                }
                
                // guardamos las respuestas
                $answer1->save();
                $answer2->save();
                $answer3->save();
                $answer4->save();
            } else {
                return back()->withInput()->withErrors(['message' => 'The question could not created']);
            }
            return redirect('back/question')->with(['message'=> 'New question created.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'The question could not created']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $answers = Answer::where('idquestion', $question->id)->orderBy('id', 'asc')->get();
        return view('question.show', ['question' => $question,
                                      'answers' => $answers]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $answers = Answer::where('idquestion', $question->id)->orderBy('id', 'asc')->get();
        return view('question.edit', ['question' => $question,
                                      'answers' => $answers]);
                                      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionEditRequest $request, Question $question)
    {
        try {
            // introducimos en el modelo los datos de la pregunta (name)
            $question->name = $request->name;
            // guardamos y creamos la pregunta
            $result = $question->save();
            
            if($result) {
                // cogemos el id de la pregunta que acabamos de guardar
                $idpregunta = $question->id;
                // obtenemos las respuestas de la pregunta editada
                $answers = Answer::where('idquestion', $question->id)->orderBy('id', 'asc')->get();
                $answers[0]->name = $request->firstanswer;
                $answers[1]->name = $request->secondanswer;
                $answers[2]->name = $request->thirdanswer;
                $answers[3]->name = $request->fourthanswer;
                
                // seleccionamos cuales son falsas y cual correcta
                if($request->correctanswer == 1) {
                    $answers[0]->escorrecta = true;
                    $answers[1]->escorrecta = false;
                    $answers[2]->escorrecta = false;
                    $answers[3]->escorrecta = false;
                } else if($request->correctanswer == 2) {
                    $answers[0]->escorrecta = false;
                    $answers[1]->escorrecta = true;
                    $answers[2]->escorrecta = false;
                    $answers[3]->escorrecta = false;
                } else if($request->correctanswer == 3) {
                    $answers[0]->escorrecta = false;
                    $answers[1]->escorrecta = false;
                    $answers[2]->escorrecta = true;
                    $answers[3]->escorrecta = false;
                } else {
                    $answers[0]->escorrecta = false;
                    $answers[1]->escorrecta = false;
                    $answers[2]->escorrecta = false;
                    $answers[3]->escorrecta = true;
                }
                
                // guardamos las respuestas
                $answers[0]->save();
                $answers[1]->save();
                $answers[2]->save();
                $answers[3]->save();
            } else {
                return back()->withInput()->withErrors(['message' => 'The question could not updated']);
            }
            return redirect('back/question')->with(['message'=> 'New question updated.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'The question could not updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        try {
            $answers = Answer::where('idquestion', $question->id)->get();
            
            foreach($answers as $answer) {
                $answer->delete();
            }
            
            $question->delete();
            return redirect('back/question')->with(['message'=> 'This question has been deleted.']);
        } catch (\Exception $e) {
            return redirect('back/question')->withErrors(['message' => 'This question has not been deleted.']);
        }
    }
}
