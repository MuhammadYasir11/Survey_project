<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(Request $request){
        $categories = Category::all();

    //     if ($request->has('keyword')) {
    //     $categories = $categories->where('name', 'like', '%' . $request->input('keyword') . '%');
    // }

       
        return view('admin.Category.list', compact('categories'));
    }

    public function create() {
        return view('admin.Category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'title' =>'required',
        ]);

        if ($validator->passes()) {
            
            $category = new Category();
            $category->name = $request->name;
            $category->title = $request->title;
            $category->save();
        
            Session::flash('success', 'Category Submitted Successfully');
            return response()->json([
                'status' => true,
                'message' => 'Category added successfully '
            ]);

        }else{
            return response()->json([
                'status' => false, 
                'errors' =>$validator->errors()
            ]);
        }
        
    }

    public function edit($categoryId, request $request)
    {
        $category = Category::find($categoryId);
        if (empty($category)){
            return redirect()->route('admin.Category.list');
        }
        return view('admin.Category.edit', compact('category'));
    }

    public function update($categoryId, request $request)
    {
        $category = Category::find($categoryId);
        // $request->session()->flash('error','Category Not Found');

        if (empty($category)){
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'category Not Found'
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'title' =>'required',
        ]);

        if ($validator->passes()) {
            
            
            $category->name = $request->name;
            $category->title = $request->title;
            $category->save();

            session()->flash('success','Category Updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Category Updated successfully '
            ]);

        }else{
            return response()->json([
                'status' => false, 
                'errors' =>$validator->errors()
            ]);
        }
    }


    public function destroy($categoryId, request $request)
    {
        $category = Category::find($categoryId); 
        if (empty($category)){
            
            session()->flash('error','Category Not Found');
            return response()->json([
                'status' => true, 
                'message' => 'Category Not Found'
            ]);
            //return redirect()->response('categories.index');
            
        }  

        $category->delete();
        session()->flash('delete','Category has been deleted successfully');

        return response()->json([
            'status' => true, 
            'message' => 'Category has been deleted successfully'
        ]);
    }
}
