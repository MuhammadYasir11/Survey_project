<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Option;
use App\Models\Question;
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
        $questions = Question::where('survey_id', $id)->get();
        
        // Fetch options for all questions
        $options = Option::whereIn('question_id', $questions->pluck('id'))->get();
        
        return view('admin.home.Surveydashboard', compact('surveyTitle', 'id', 'questions', 'options'));
    }
    

    public function editSurvey($id)
    {
        $survey = Survey::findOrFail($id);
        $questions = Question::where('id', $id)->get();
        return view('admin.home.edit', compact('survey', 'questions'));
    }

    public function updateSurvey(Request $request, $id)
    {
        // Validation and updating logic
        $survey = Survey::findOrFail($id);
        // Update survey with data from $request
        return redirect()->route('admin.dashboard', ['id' => $id])->with('success', 'Survey updated successfully');
    }
    
    public function deleteSurvey($id)
    {
        // Find survey by ID and delete it
        $survey = Survey::findOrFail($id);
        $survey->delete();
        return redirect()->route('admin.index')->with('success', 'Survey deleted successfully');
    }
}
