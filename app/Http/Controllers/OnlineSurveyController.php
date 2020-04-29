<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Question;
use App\Answer;
use App\SurveyResults;
use Illuminate\Http\Request;

class OnlineSurveyController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        return view('onlineSurvey.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $surveyName
     * @return \Illuminate\Http\Response
     */
    public function onlineSurvey(Request $request, $surveyName) {

        $survey = Survey::where('name', $surveyName)->firstOrFail();
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

    public function surveySave(Request $request) {
        $surveyId = Survey::getSurveyId($request);
        $userId = 102;

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

        return redirect()->route('onlineSurvey.index')
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
