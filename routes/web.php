<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController as Auths;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

Route::get('/', function () {
    return Redirect::route('dashboard');
});

// Route Auth
Route::get('/auth/login', [Auths::class, 'index']);
Route::post('/auth/login', [Auths::class, 'login'])->name('login');
Route::get('/auth/logout', [Auths::class, 'logout'])->name('logout');

// Route Admin
Route::group(['prefix' => '',  'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth']], function () {
    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::group(['prefix' => '/classes'], function () {
            Route::get('/', 'ClassesController@index')->name('classes');
            Route::get('/data', 'ClassesController@data')->name('classes.data');
            Route::post('/store', 'ClassesController@store')->name('classes.store');
            Route::get('/{id}/edit', 'ClassesController@edit')->name('classes.edit');
            Route::put('/{id}', 'ClassesController@update')->name('classes.update');
            Route::delete('/{id}', 'ClassesController@destroy')->name('classes.delete');
        });

        Route::group(['prefix' => '/evaluations'], function () {
            Route::get('/', 'EvaluationController@index')->name('evaluations');
            Route::get('/data', 'EvaluationController@data')->name('evaluations.data');
            Route::post('/store', 'EvaluationController@store')->name('evaluations.store');
            Route::get('/{id}/edit', 'EvaluationController@edit')->name('evaluations.edit');
            Route::put('/{id}', 'EvaluationController@update')->name('evaluations.update');
            Route::delete('/{id}', 'EvaluationController@destroy')->name('evaluations.delete');
        });

        Route::group(['prefix' => '/fuzzy-mamdani'], function () {
            Route::get('/', 'FuzzyMamdaniController@index')->name('fuzzy-mamdani');
            Route::get('/data', 'FuzzyMamdaniController@data')->name('fuzzy-mamdani.data');
            Route::get('/export', 'FuzzyMamdaniController@export')->name('fuzzy-mamdani.export');
        });

        Route::group(['prefix' => '/penilaian'], function () {
            Route::get('/', 'PenilaianController@index')->name('penilaian');
            Route::get('/data', 'PenilaianController@data')->name('penilaian.data');
            Route::get('/export', 'PenilaianController@export')->name('penilaian.export');
        });

        Route::group(['prefix' => '/profile'], function () {
            Route::get('/', 'ProfileController@index')->name('profile');
        });

        Route::group(['prefix' => '/school-years'], function () {
            Route::get('/', 'SchoolYearController@index')->name('school-years');
            Route::get('/data', 'SchoolYearController@data')->name('school-years.data');
            Route::post('/store', 'SchoolYearController@store')->name('school-years.store');
            Route::get('/{id}/edit', 'SchoolYearController@edit')->name('school-years.edit');
            Route::put('/{id}', 'SchoolYearController@update')->name('school-years.update');
            Route::delete('/{id}', 'SchoolYearController@destroy')->name('school-years.delete');
        });

        Route::group(['prefix' => '/users'], function () {
            Route::get('/', 'UserController@index')->name('users');
            Route::get('/data', 'UserController@data')->name('users.data');
            Route::post('/store', 'UserController@store')->name('users.store');
            Route::get('/{id}/edit', 'UserController@edit')->name('users.edit');
            Route::put('/{id}', 'UserController@update')->name('users.update');
            Route::delete('/{id}', 'UserController@destroy')->name('users.delete');
        });

        Route::group(['prefix' => '/students'], function () {
            Route::get('/', 'StudentController@index')->name('students');
            Route::get('/data', 'StudentController@data')->name('students.data');
            Route::post('/store', 'StudentController@store')->name('students.store');
            Route::post('/store/eval', 'StudentController@evaluation')->name('students.evaluation');
            Route::get('/{id}/edit', 'StudentController@edit')->name('students.edit');
            Route::put('/{id}', 'StudentController@update')->name('students.update');
            Route::delete('/{id}', 'StudentController@destroy')->name('students.delete');
            Route::get('/{id}/eval', 'StudentController@student_evaluation_show')->name('students.student_evaluation_show');
            Route::put('/{id}/eval', 'StudentController@student_evaluation_update')->name('students.student_evaluation_update');
        });
    });
});

// Route Error Handling
Route::get('unauthorized', function ($title = null) {
    $this->response['code'] = "401";
    $this->response['message'] = "unauthorized access permission";
    return view('errors.message', ['message' => $this->response]);
})->name('unauthorized');

// Route Artisan
Route::get('/cc', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
});
