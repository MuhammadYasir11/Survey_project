<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = ['option', 'question_id','min','max','mid']; 
    protected $table = 'option';

    
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}