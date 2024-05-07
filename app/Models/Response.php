<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $table = 'response'; // Corrected line

    protected $fillable = ['user_name', 'user_email', 'user_id', 'survey_id', 'text_response', 'question_id', 'option_id'];

    public function responseOptions()
    {
        return $this->hasMany(ResponseOption::class);
    }

}
