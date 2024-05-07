<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function layout()
    {
        return view('admin.layouts.app');
    }

    public function sidebar()
    {
        return view('admin.sidebar');
    }

    public function dashboard()
    {
        // return view('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function index(  User $user)
    {
        $userCount = User::count();
        $surveyCount = Survey::count(); // Fetch the count of users
        return view('admin.dashboard', compact('userCount','surveyCount')); // Pass the user count to the view
    }

}
