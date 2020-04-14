<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at'];
    protected $table = 'answer';
    protected $fillable = [
        'id', 'questionId', 'name', 'detail'
    ];

    /**
     * Laravel Relations
     */
    public function question() {
        return $this->hasOne('App\Question', 'id', 'questionId');
    }

    /**
     * Laravel Relations END
     */
}
