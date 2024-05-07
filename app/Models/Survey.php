<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Survey extends Model
{
    use HasFactory;

    protected $table = 'survey';
    protected $fillable = ['survey_title'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function isPublishedToStudents()
    {
        return $this->students()->exists();
    }

    public function isPublishedToTeachers()
    {
        return $this->teachers()->exists();
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'survey_user', 'survey_id', 'user_id')->where('role', 2);
    }

}
