<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'question_type', 'answer','survey_id','user_id']; // Add 'type' to the fillable attributes

    public function answers()
	{
		return $this->hasMany(Answer::class);
	}

}
