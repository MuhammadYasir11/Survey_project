<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Survey;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $surveys = Survey::all();
        // if ($request->has('keyword')) {
        //     $surveys = $surveys->where('survey_title', 'like', '%' . $request->input('keyword') . '%');
        // } 
        // $surveys = $surveys->paginate(10);
        return view('admin.home.list', compact('surveys'));
    }

    public function dashboard($id)
    {
        $surveyTitle = Survey::findOrFail($id)->survey_title;
        return view('admin.home.Surveydashboard', compact('surveyTitle', 'id'));
    }

    public function edit($id)
    {
        $survey = Survey::findOrFail($id);
        $categories = Category::all();
        return view('admin.survey.edit', compact('survey', 'categories'));
    }
}
