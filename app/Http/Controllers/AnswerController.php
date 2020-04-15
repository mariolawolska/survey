<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $question = Question::findOrFail($request->questionId);
        $survey = Survey::findOrFail($question->surveyId);

        $request->session()->put('questionId', $request->questionId);
        $request->session()->put('surveyId', $question->surveyId);

        $answerCollection = Answer::latest()->where('questionId', $question->id)->orderBy('created_at')->paginate(5);

        return view('answer.index', compact('answerCollection', 'question', 'survey'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        if ($request->questionId) {
            $questionId = $request->questionId;
        } else {
            $questionId = $request->session()->get('questionId');
        }

        $question = Question::findOrFail($questionId);

        return view('answer.create', compact('questionType', 'question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        if ($request->questionId) {
            $questionId = $request->questionId;
        } else {
            $questionId = $request->session()->get('questionId');
        }
        $request->questionId = $questionId;

        $request->validate([
            'name' => 'required'
        ]);

        Answer::create($request->all());

        return redirect()->route('answer.index', ['questionId' => $request->questionId])
                        ->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer) {

        return view('answer.show', compact('answer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer) {

        return view('answer.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer) {
        $request->validate([
            'name' => 'required'
        ]);

        $questionId = $request->session()->get('questionId');
        $request->questionId = $questionId;

        $answer->update($request->all());

        return redirect()->route('answer.index', ['questionId' => $questionId])
                        ->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Answer $answer) {
        $question->delete();

        $questionId = $request->session()->get('questionId');

        return redirect()->route('answer.index', ['questionId' => $questionId])
                        ->with('success', 'Question deleted successfully');
    }

}
