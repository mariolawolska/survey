<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    protected $table = 'question';
    protected $fillable = [
        'id', 'surveyId', 'name', 'type', 'detail'
    ];

    /**
     * Laravel Relations
     */
    public function survey() {
        return $this->hasOne('App\Survey', 'id', 'surveyId');
    }

    public function answer() {
        return $this->hasMany('App\Answer', 'questionId', 'id');
    }

    /**
     * Laravel Relations END
     */

    /**
     * Question type
     */
    public static $questionType = array(
        0 => 'Select a question type',
        1 => 'Single choice (radio buttons)',
        2 => 'Multiple choice (checkboxes)',
        3 => 'Text',
        4 => 'Classification (dependent dropdown)',
        5 => 'Email',
        6 => 'Date',
        7 => 'Slider',
        8 => 'Star rating grid',
        9 => 'Essay (long text)',
        10 => 'File upload',
    );

    /**
     * Questions answered automatically
     * 
     * @var array
     */
    public static $questionsByDefault = array(
        3, 10,
    );

    /**
     * @return string
     */
    public static function questionTypeToHuman($type = 0) {

        $returnValue = '';

        if (array_key_exists($type, self::$questionType)) {
            $returnValue = self::$questionType[$type];
        } else {
            $returnValue = 'Not Set';
        }

        return $returnValue;
    }

    /**
     * @param type $request
     * 
     * @return type
     */
    public static function getQuestionId($request) {

        if (!empty($request->questionId)) {
            $questionId = $request->questionId;
        } else {
            $questionId = $request->session()->get('questionId');
        }

        return $questionId;
    }

}
