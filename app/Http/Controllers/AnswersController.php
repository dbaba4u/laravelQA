<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Question $question, Request $request)
    {
        $request->validate(['body'=>'required']);
        $question->answers()->create(['body'=>$request->body, 'user_id'=>\Auth::id() ]);
        return redirect()->back()->with('success', "Your answer has been submitted successfully!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Question $question
     * @param \App\Models\Answer $answer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        return view('answers.edit', compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Question $question
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Answer $answer
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Question $question, Request $request, Answer $answer)
    {
        $this->authorize('update',$answer);
        $answer->update($request->validate([
            'body'=>'required'
        ]));
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param \App\Models\Answer $answer
     * @return void
     */
    public function destroy(Question $question, Answer $answer)
    {
        
    }
}
