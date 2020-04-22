<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;

class SurveyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $surveyId = Survey::getSurveyId($request);

        $surveyCollection = Survey::latest()->orderBy('created_at')->paginate(5);

        return view('survey.index', compact('surveyCollection', 'surveyId'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('survey.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required'
        ]);

        $survey = Survey::create($request->all());
        $request->session()->put('surveyId', $survey->id);

        return redirect()->route('survey.index')
                        ->with('success', 'Survey created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey) {

        $questionArray = array();
        $answerArray = array();
        $questionQty = 1;
        foreach ($survey->question as $question) {
            $questionQty++;
            $questionArray[$question->id] = $question;
            foreach ($question->answer as $answer) {
                $answerArray[$answer->questionId][$answer->id] = $answer;
            }
        }

        $objectArray = array(
            'survey' => $survey->getAttributes(),
            'question' => $questionArray
        );

        /**
         * Adding additional ingredients
         */
        $objectArray['survey']['questionQty'] = $questionQty;
        /**
         *  Summary Question
         */
        $objectArray['question'][$questionQty]['id'] = $questionQty;
        $objectArray['question'][$questionQty]['surveyId'] = $survey->id;
        $objectArray['question'][$questionQty]['name'] = 'Summary';
        $objectArray['question'][$questionQty]['type'] = 100;
        $objectArray['question'][$questionQty]['detail'] = 'Summary Text';

        /**
         * Preparing json object
         */
        $jsonObject = json_encode($objectArray);

        return view('survey.show', compact('survey', 'jsonObject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey) {
        return view('survey.edit', compact('survey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey) {
        $request->validate([
            'name' => 'required'
        ]);

        $survey->update($request->all());
        $request->session()->put('surveyId', $survey->id);

        return redirect()->route('survey.index')
                        ->with('success', 'Survey updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey) {
        $survey->delete();

        return redirect()->route('survey.index')
                        ->with('success', 'Survey deleted successfully');
    }

    public function surveySave(Request $request) {

        $surveyId = Survey::getSurveyId($request);
        $userId = 67;

        dump('$surveyId ' . $surveyId);
        dd($request);
    }

}
