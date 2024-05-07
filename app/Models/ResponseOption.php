<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseOption extends Model
{
    use HasFactory;

    public function response()
    {
        return $this->belongsTo(Response::class);
    }
}
