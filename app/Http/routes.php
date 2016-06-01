<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::group(['middleware' => ['web']], function () {
 Route::auth();
    Route::get('/', function () {
        return view('auth/login');
    })->middleware('guest');
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');
    Route::controller('students', 'StudentController', [
        'anyData' => 'students.data',
        'getIndex' => 'students',
    ]);

    // routes for learning
    Route::get('autocomplete', 'SearchController@index');
    Route::get('clone', function () {
        return view('clone');
    });

    Route::controller('/banks', 'BankController', [
        'anyData' => 'banks.data',
        'getIndex' => 'banks',
        
    ]);
    Route::get('/create_bank', 'BankController@form');
    Route::post('/create_bank', 'BankController@store');
    Route::get('/edit_bank/{id}/id', 'BankController@edit');
    Route::post('/edit_bank/{id}/id', 'BankController@update');
    
    // fees route
    Route::controller('/view_fees', 'FeeController', [
        'anyData' => 'view_fees.data',
        'getIndex' => 'view_fees',
        
    ]);
    Route::get('/create_fees', 'FeeController@createform');
    Route::post('/create_fees', 'FeeController@store');
    Route::get('/upload_fees', 'FeeController@showUpload');
    Route::post('/upload_fees', 'FeeController@storeUpload');
    Route::delete('/delete_fees', 'FeeController@destroy');
     
    Route::get('/run_bill/{id}/id', 'FeeController@approve');
     
    Route::get('/pay_fees', 'FeeController@showPayform');
    Route::post('/pay_fees', 'FeeController@showStudent');
    Route::post('/processPayment', 'FeeController@processPayment');
    Route::get('/printreceipt/{receiptno}', 'FeeController@printreceipt');
    Route::controller('/view_payments', 'PaymentController', [
        'anyData' => 'view_payments.data',
        'getIndex' => 'view_payments',
        
    ]);
     Route::get('/view_payments_master', 'FeeController@masterLedger');
     Route::get('/fee_summary', 'FeeController@masterLedger');
     Route::get('/owing_paid', 'FeeController@owingAndPaid');
     Route::post('/fireOwingSMS', 'FeeController@sendFeeSMS');
    Route::get('search/autocomplete', 'SearchController@autocomplete');
    Route::get('/show_student/{id}/id', 'StudentController@show');
    
    
    
    // hospital records
     Route::get('/student_medicals', 'PatientController@showMedicalForm');
    Route::post('/student_medicals', 'PatientController@processMedicalForm');
    Route::post('/store_medicals', 'PatientController@storeMedicals');
    Route::get('/search_folder', 'PatientController@searchFolder');
    Route::get('/new_visit', 'PatientController@showVisitForm');
    Route::post('/search_folder', 'PatientController@displayFolder');
});
