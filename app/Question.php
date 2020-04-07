<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

    protected $table = 'questions';
    protected $fillable = [
        'id', 'surveyId', 'name', 'type', 'detail'
    ];

    /**
     * Laravel Relations
     */
    public function survey() {
        return $this->hasOne('App\Survey', 'id', 'surveyId');
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
     * @return string
     */
    public function questionTypeToHuman() {

        $returnValue = '';

        if (array_key_exists($this->type, self::$questionType)) {
            $returnValue = self::$questionType[$this->type];
        } else {
            $returnValue = 'Not Set';
        }

        return $returnValue;
    }

}
