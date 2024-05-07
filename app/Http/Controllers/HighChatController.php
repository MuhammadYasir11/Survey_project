<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighChatController extends Controller
{
    public function handleChart()
    {
        $optionData = Option::select('question_id', 'option')->get();
        return view('admin.Chart', compact('optionData'));
    }
}
