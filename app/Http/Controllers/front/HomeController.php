<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Response;
use App\Models\ResponseOption;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        $surveys = Survey::with('questions')->get();
        $user = User::first();
        return view('front.Survey.view', compact('surveys', 'user'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required|integer',
            'survey_id' => 'required|integer',
        ]);
    
        // Process and store the survey responses
        $user_id = $request->user_id;
        $survey_id = $request->survey_id;
        
        // Loop through each question in the survey
        foreach ($request->question_id as $index => $question_id) {
            // Create a new response for each question
            $response = new Response();
            $response->user_id = $user_id;
            $response->survey_id = $survey_id;
            $response->question_id = $question_id;
    
            // Handle multiple choice or radio button responses
            if ($request->has("option_id.$question_id")) {
                $optionIds = $request->input("option_id.$question_id");
                $response->option_id = implode(',', $optionIds); // Convert array to comma-separated string
            }
    
            // Handle text box responses
            $textResponseKey = "text_response.$question_id";
            $response->text_response = $request->has($textResponseKey) ? $request->input($textResponseKey) : '';
    
            // Save the response
            $response->save();
        }
    
        // Optionally, you can return a response indicating success or failure
        return redirect()->back()->with('success', 'Responses submitted successfully!');
    }
    

      
}
