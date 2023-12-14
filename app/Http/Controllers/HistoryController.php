<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use App\Http\Requests\HistoryEditRequest;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = History::all();
        return view('history.index', ['histories' => $history]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('history.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        return view('history.show', ['history' => $history]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        return view('history.edit', ['history' => $history]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HistoryEditRequest $request, History $history)
    {
        try {
            $history->alias = $request->alias;
            $history->escorrecta = $request->escorrecta;
            
            // guardamos y creamos la pregunta
            $result = $history->save();
            
            return redirect('back/history')->with(['message'=> 'History entry updated succesfully.']);
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(['message' => 'The history entry could not update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        try {
            $history->delete();
            return redirect('back/history')->with(['message'=> 'This history entry has been deleted.']);
        } catch (\Exception $e) {
            return redirect('back/history')->withErrors(['message' => 'This history entry has not been deleted.']);
        }
    }
}
