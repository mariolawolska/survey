<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyResults extends Model {

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];
    protected $table = 'survey_results';
    protected $fillable = [
        'id', 'surveyId', 'questionId', 'answer', 'userId'
    ];

    /**
     * Laravel Relations
     */
    /**
     * Laravel Relations END
     */
}
