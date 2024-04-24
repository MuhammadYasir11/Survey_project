<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Admin Login Routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {

        Route::get('/login', [AdminLoginController::class, 'login'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });
    Route::group(['middleware' => 'admin.auth'], function () {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');
    });
});

Route::get('layouts', [DashboardController::class, 'layout'])->name('layouts.app');
// Route::get('dashboard', [DashboardController::class,'dashboard'])->name('admin.dashboard');

//Category Routes
Route::get('list', [CategoryController::class, 'index'])->name('admin.Category.list');
Route::get('category/create', [CategoryController::class, 'create'])->name('admin.Category.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.Category.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.delete');

//Survey Routes
Route::get('survey/list', [SurveyController::class, 'index'])->name('admin.Survey.list');
Route::get('survey/create', [SurveyController::class, 'create'])->name('admin.Survey.create');
Route::post('/survey', [SurveyController::class, 'store'])->name('Survey.store');
Route::get('/survey/{id}/edit', [SurveyController::class, 'edit'])->name('admin.Survey.edit');
Route::put('/survey/{surveys}', [SurveyController::class, 'update'])->name('Survey.update');

Route::get('/admin/question-create/{surveyId}/{survey_title}', [SurveyController::class, 'redirectToQuestionPage'])->name('admin.Question.create');



//Question Routes
Route::get('question/create/{survey}', [QuestionController::class, 'create'])->name('admin.Question.create');
Route::post('/question', [QuestionController::class, 'store'])->name('question.store');

// Home Routes
Route::get('home/list', [HomeController::class, 'index'])->name('admin.home.list');
Route::get('home/dashboard/{id}', [HomeController::class, 'dashboard'])->name('admin.home.Surveydashboard');
Route::get('survey/{id}/edit', [HomeController::class, 'edit'])->name('admin.Survey.edit');
