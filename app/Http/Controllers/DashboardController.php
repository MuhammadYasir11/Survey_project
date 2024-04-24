<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function layout() {
        return view('admin.layouts.app');
    }

    public function sidebar() {
        return view('admin.sidebar');
    }

    public function dashboard() {
        return view('admin.dashboard');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
