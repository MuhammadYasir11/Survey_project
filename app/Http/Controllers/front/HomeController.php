<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $surveys = Survey::with('questions')->get();
        return view('front.Survey.view', compact('surveys'));
    }
}
