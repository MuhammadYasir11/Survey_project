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


    public function editQuestion($id, Survey $survey, User $user)
    {
       // Fetch the question, user, and options
       $question = Question::findOrFail($id);
       $user = Auth::user();
       $options = $question->options;
       return view('admin.home.edit', compact('question', 'user', 'options'));
    }


    public function updateQuestion(Request $request, $id)
    {
        $rules = [
            'question' => 'required|string',
            'type' => 'required|in:mcq,text-box,radio,customRange',
        ];
        $messages = [
            'type.in' => 'Invalid question type.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create a new Question instance
        $question = new Question();
        $question->question = $request->input('question');
        $question->question_type = $request->input('type');
        if ($request->input('type') == 'text-box') {
            $question->answer = $request->input('add_text');
        }
        $question->survey_id = $request->input('survey_id');
        $question->user_id = $request->input('user_id');
        $question->save();

        // Store data when question_type == mcq
        if ($request->input('type') == 'mcq') {
            // Save the options
            if ($request->has('options')) {
                $options = $request->input('options');
                foreach ($options as $optionText) {
                    // Create a new Option instance for each option
                    $option = new Option();
                    $option->option = $optionText; // Save the option text
                    $option->question_id = $question->id; // Associate option with question
                    $option->save();
                }
            }
        }

        // Check if the question type requires additional checks (custom range)
        if ($request->input('type') == 'customRange') {
            // Ensure all necessary input fields are present
            if ($request->has('min') && $request->has('max') && $request->has('mid')) {
                $min = $request->input('min');
                $max = $request->input('max');
                $mid = $request->input('mid');

                // Create a new Option instance
                $option = new Option();
                // Assign min, max, and mid values to the corresponding attributes
                $option->min = $min;
                $option->max = $max;
                $option->mid = $mid;
                // Associate option with the question
                $option->question_id = $question->id;
                // Save the option
                $option->save();
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
        }

        // Store data when question_type == radio
        if ($request->input('type') == 'radio') {
            $optionRadio1 = $request->input('radiobtn');
            $optionRadio2 = $request->input('radiobtn1');

            // Concatenate both options
            $options = $optionRadio1 . ', ' . $optionRadio2;

            $option = new Option();
            $option->option = $options;
            $option->question_id = $question->id; // Associate option with question
            $option->save();
        }

        session()->flash('success', 'Question Added successfully');
        return response()->json([
            'status' => true,
            'message' => 'Question Added successfully'
        ]);
    }

    public function deleteSurvey($id)
    {
        // Find survey by ID and delete it
        $survey = Survey::findOrFail($id);
        $survey->delete();
        return redirect()->route('admin.index')->with('success', 'Survey deleted successfully');
    }
}
