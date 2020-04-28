<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use App\Answer;
use App\SurveyResults;
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
    public function show(Survey $survey, Request $request) {

        $request->session()->put('surveyId', $survey->id);

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

        $surveyRequest['surveyId'] = $surveyId;
        $surveyRequest['userId'] = $userId;

        foreach ($_POST as $question => $answer) {

            $questionAnswerArray = $this->getQuestionAnswer($question, $answer);

            if ($questionAnswerArray) {

                $surveyRequest['questionId'] = $questionAnswerArray['question'];
                $surveyRequest['answer'] = $questionAnswerArray['answer'];

                $surveyResults = SurveyResults::create($surveyRequest);
            }
        }

        return redirect()->route('survey.index')
                        ->with('success', 'Survey deleted successfully');
    }

    /**
     * @param type $question
     * @param type $answer
     * 
     * @return boolean
     */
    private function getQuestionAnswer($question, $answer) {

        $questionArray = $questionAnswerArray = array();

        if (strpos($question, 'questionId') !== false) {
            $questionArray = explode("##", $question);
        }

        if (empty($questionArray)) {
            return false;
        } else {

            /**
             * Multiple choice (checkboxes)
             */
            if (is_array($answer)) {
                $questionAnswerArray['question'] = $questionArray[1];
                $questionAnswerArray['answer'] = implode(',', $answer);
                return $questionAnswerArray;
            } else {
                /**
                 * All other types of questions
                 */
                $questionAnswerArray['question'] = $questionArray[1];
                $questionAnswerArray['answer'] = $answer;
                return $questionAnswerArray;
            }
        }
    }

}
