<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Option;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $surveys = Survey::all();
        $users = User::all();
        return view('admin.home.list', compact('surveys', 'users'));
    }

    public function dashboard($id)
    {
        $surveyTitle = Survey::findOrFail($id)->survey_title;
        $questions = Question::where('survey_id', $id)->get();

        // Fetch options for all questions
        $options = Option::whereIn('question_id', $questions->pluck('id'))->get();

        return view('admin.home.Surveydashboard', compact('surveyTitle', 'id', 'questions', 'options'));
    }


    public function editQuestion($id, Survey $survey, User $user)
    {
        // Fetch the question, user, and options
        $question = Question::findOrFail($id);
        $user = Auth::user();
        $options = $question->options;
        $question_type = $question->question_type;

        // Fetch the survey associated with the question
        $survey = Survey::findOrFail($question->survey_id);
        $surveyTitle = $survey->survey_title;

        return view('admin.home.edit', compact('question', 'user', 'options', 'question_type', 'surveyTitle', 'id'));
    }



    public function updateQuestion(Request $request, $id)
    {
        // Validation rules
        $rules = [
            'question' => 'required|string',
            'type' => 'required|in:mcq,text-box,radio,customRange',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the question by ID
        $question = Question::findOrFail($id);

        // Update basic question details
        $question->question = $request->input('question');
        $question->question_type = $request->input('type');
        $question->answer = $request->input('add_text') ?? null; // Ensure null if not provided
        $question->save();

        // Store options based on question type
        if ($request->input('type') === 'mcq') {
            $options = $request->input('options', []);
            $question->options()->delete(); // Delete existing options
            foreach ($options as $optionText) {
                $question->options()->create(['option' => $optionText]);
            }
        } elseif ($request->input('type') === 'radio') {
            // Handle radio button options
            $optionRadio1 = $request->input('radiobtn', '');
            $optionRadio2 = $request->input('radiobtn1', '');
            $options = $optionRadio1 . ', ' . $optionRadio2;
            $question->options()->delete(); // Delete existing options
            $question->options()->create(['option' => $options]);
        } elseif ($request->input('type') === 'customRange') {
            // Handle custom range options
            $min = $request->input('min');
            $max = $request->input('max');
            $mid = $request->input('mid');
            $question->options()->delete(); // Delete existing options
            $question->options()->create(['min' => $min, 'max' => $max, 'mid' => $mid]);
        }

        // Flash success message and redirect
        session()->flash('success', 'Question updated successfully');
        return redirect()->route('admin.home.Surveydashboard', ['id' => $id]);
    }



    public function deleteSurvey($id)
    {
        // Find survey by ID and delete it
        $survey = Survey::findOrFail($id);
        $survey->delete();
        return redirect()->route('admin.index')->with('success', 'Survey deleted successfully');
    }
}
