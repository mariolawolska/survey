<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

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
