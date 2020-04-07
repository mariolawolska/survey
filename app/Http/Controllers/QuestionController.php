<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $survey = Survey::findOrFail($request->surveyId);
        $request->session()->put('surveyId', $request->surveyId);

        $questionCollection = Question::latest()->where('surveyId', $survey->id)->paginate(5);

        return view('question.index', compact('questionCollection', 'survey'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $questionType = Question::$questionType;
        $surveyId = $request->session()->get('surveyId');

        return view('question.create', compact('questionType', 'surveyId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $surveyId = $request->session()->get('surveyId');
        $request->surveyId = $surveyId;

        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'type' => 'required',
        ]);

        Question::create($request->all());

        return redirect()->route('question.index', ['surveyId' => $request->surveyId])
                        ->with('success', 'Question created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question) {

        return view('question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(question $question) {

        $questionType = Question::$questionType;
        return view('question.edit', compact('question', 'questionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question) {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'type' => 'required',
        ]);

        $surveyId = $request->session()->get('surveyId');
        $request->surveyId = $surveyId;

        $question->update($request->all());

        return redirect()->route('question.index', ['surveyId' => $surveyId])
                        ->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Question $question) {
        $question->delete();

        $surveyId = $request->session()->get('surveyId');

        return redirect()->route('question.index', ['surveyId' => $surveyId])
                        ->with('success', 'Question deleted successfully');
    }

}
