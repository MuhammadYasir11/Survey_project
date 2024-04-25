<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\User;
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

        $question = new Question();
        $question->question = $request->input('question');
        $question->question_type = $request->input('type');

        if ($request->input('type') == 'mcq' || $request->input('type') == 'radio') {
            $options = $request->only(['txtoption', 'txtoption1']); // Adjust based on your form structure
            $question->answer = json_encode($options);
        } else {
            $question->answer = ''; // For text-box and customRange types
        }

        $question->survey_id = $request->input('survey_id');
        $question->user_id = $request->input('user_id');
        $question->save();

        return redirect()->back()->with('success', 'Question created successfully.');
    }

    public function show(Request $request, $surveyId, $surveyTitle)
    {
        // Retrieve questions related to the survey ID
        $questions = Question::where('survey_id', $surveyId)->get();
        return view('admin.Question.create', ['surveyTitle' => $surveyTitle, 'questions' => $questions]);
    }
}
