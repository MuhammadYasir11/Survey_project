<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class SurveyController extends Controller
{

    public function index(Request $request)
    {

        $survey = Survey::select('survey.*', 'survey.survey_title as surveyName')
            ->latest('survey.id')
            ->leftJoin('category', 'category.id', 'survey.category_id');
        if (!empty($request->get('keyword'))) {
            $survey = $survey->where('survey.survey_title', 'like', '%' . $request->get('keyword') . '%');
            $survey = $survey->orwhere('category.name', 'like', '%' . $request->get('keyword') . '%');
        }
        $survey =  $survey->paginate(10);
        return view('admin.Survey.List', compact('survey'));
    }

    public function create()
    {
        $category = Category::orderBy('title', 'ASC')->get();
        return view('admin.Survey.create', compact('category'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'survey_title' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->passes()) {

            $survey = new Survey();
            $survey->survey_title = $request->survey_title;
            $survey->category_id = $request->category_id;
            $survey->save();

            Session::flash('success', 'Survey Title added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Survey Title added successfully '
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, request $request)
    {

        $survey = Survey::find($id);
        if (empty($survey)) {
            session()->flash('error', 'Record Not Found');
            return redirect()->route('admin.Survey.list');
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;
        $data['survey'] = $survey;
        return view('admin.Survey.edit', $data);
    }

    public function update($id, Request $request)
    {

        $survey = Survey::find($id);

        if (empty($survey)) {
            session()->flash('error', 'Record Not Found');
            return response([
                'status' => false,
                'notFound' => true,
                'message' => 'Survey Not Found'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'survey_title' => 'required',
            'category_id' => 'required',

        ]);

        if ($validator->passes()) {

            $survey->survey_title = $request->survey_title;
            $survey->category_id = $request->category_id;
            $survey->save();

            session()->flash('success', 'Survey Updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Survey Updated successfully '
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($categoryId, request $request)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {

            session()->flash('error', 'Category Not Found');
            return response()->json([
                'status' => true,
                'message' => 'Category Not Found'
            ]);
            //return redirect()->response('categories.index');

        }

        $category->delete();
        session()->flash('delete', 'Category has been deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Category has been deleted successfully'
        ]);
    }

    public function redirectToQuestionPage($surveyId)
    {
        // Retrieve the survey data based on the survey ID
        $survey = Survey::find($surveyId);

        // Redirect to the question page with the survey ID and title as parameters
        return redirect()->route('admin.question.create', ['surveyId' => $surveyId, 'surveyTitle' => $survey->survey_title]);
    }
}
