<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\User;
use App\Models\Option;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function create(Survey $survey, User $user)
    {
        // Initialize variables
        $survey_title = null;
        $survey_id = null;

        // Check if the survey title attribute exists in the $survey object
        if ($survey->survey_title) {
            $survey_title = $survey->survey_title;
            $survey_id = $survey->id;
        } elseif ($user->id) {
            // If survey title not found, try to retrieve survey ID based on user ID
            $survey = Survey::where('user_id', $user->id)->first();
            if ($survey) {
                $survey_title = $survey->survey_title;
                $survey_id = $survey->id;
            }
        } else {
            // If neither survey title nor user ID is found, return an error
            return redirect()->back()->with('error', 'Survey title not found');
        }
        // Retrieve questions related to the survey or user
        $questions = Question::where(function ($query) use ($survey_id, $user) {
            $query->where('survey_id', $survey_id);
            $query->orWhere('user_id', $user->id);
        })->get();
        $user = User::first();

        // Pass the survey, survey_title, and questions, user to the view
        return view('admin.Question.create', compact('survey', 'survey_title', 'questions', 'user'));
    }

    public function store(Request $request)
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
        // store data to question_type == text
        $question = new Question();
        $question->question = $request->input('question');
        $question->question_type = $request->input('type');
        if ($request->input('type') == 'text-box') {
            $question->answer = $request->input('add_text');
        }
        $question->survey_id = $request->input('survey_id');
        $question->user_id = $request->input('user_id');
        $question->save();

        session()->flash('success', 'Question Added successfully');
        return response()->json([
            'status' => true,
            'message' => 'Question Added successfully'
        ]);

        // store data to question_type == mcq
        if ($request->input('type') == 'mcq') {
            $optionText1 = $request->input('txtoption');
            $optionText2 = $request->input('txtoption1');

            // Concatenate both options
            $options = $optionText1 . ', ' . $optionText2;

            $option = new Option();
            $option->option = $options;
            $option->question_id = $question->id; // Associate option with question
            $option->save();

            session()->flash('success', 'Question Added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Question Added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Check if the question type requires additional checks custome range
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

                session()->flash('success', 'Question Added successfully');
                return response()->json([
                    'status' => true,
                    'message' => 'Question Added successfully'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
        }

        // store data to question_type == radio
        if ($request->input('type') == 'radio') {
            $optionRadio1 = $request->input('radiobtn');
            $optionRadio2 = $request->input('radiobtn1');

            // Concatenate both options
            $options = $optionRadio1 . ', ' . $optionRadio2;

            $option = new Option();
            $option->option = $options;
            $option->question_id = $question->id; // Associate option with question
            $option->save();

            session()->flash('success', 'Question Added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Question Added successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function show(Request $request, $surveyId, $surveyTitle)
    {
        // Retrieve questions related to the survey ID
        $questions = Question::where('survey_id', $surveyId)->get();
        return view('admin.Question.create', ['surveyTitle' => $surveyTitle, 'questions' => $questions]);
    }
}
