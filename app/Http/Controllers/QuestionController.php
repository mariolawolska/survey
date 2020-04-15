<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;

class QuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $surveyId = Survey::getSurveyId($request);
        $questionId = Question::getQuestionId($request);

        $survey = Survey::findOrFail($surveyId);
        $request->session()->put('surveyId', $survey->id);

        $questionCollection = Question::latest()->where('surveyId', $survey->id)->orderBy('created_at')->paginate(5);

        return view('question.index', compact('questionCollection', 'survey', 'questionId'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $surveyId = Survey::getSurveyId($request);

        $survey = Survey::findOrFail($surveyId);
        $questionType = Question::$questionType;

        return view('question.create', compact('questionType', 'survey'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $surveyId = Survey::getSurveyId($request);
        $request->surveyId = $surveyId;

        $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $question = Question::create($request->all());
        $request->session()->put('questionId', $question->id);

        if (in_array($question->type, Question::$questionsByDefault)) {

            $questionType = Question::questionTypeToHuman($question->type);
            $questionArray = array(
                'questionId' => $question->id,
                'name' => $questionType,
                'detail' => $questionType);

            Answer::create($questionArray);
        }


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
            'type' => 'required',
        ]);

        $surveyId = Survey::getSurveyId($request);
        $request->surveyId = $surveyId;

        $question->update($request->all());
        $request->session()->put('questionId', $question->id);

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

        $surveyId = Survey::getSurveyId($request);

        return redirect()->route('question.index', ['surveyId' => $surveyId])
                        ->with('success', 'Question deleted successfully');
    }

}
