<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route select  test from list
Route::get('/tests','TestsController@index');

// this test route
Route::get('/tests/new' ,function(){
    return view('new');
});

// Show start page selecred test
Route::get('/tests/{testId}/start','TestsController@start');

// Enter the test process and redirect to questions
Route::post('/tests/{testId}/start','TestsController@enter');

//Questions select
Route::get('/tests/{testId}/h/{index}','QuestionsController@index');

Route::post('/tests/{testId}/h/{index}','QuestionsController@post');



//Results
Route::get('/tests/{testId}/results','TestResults@index');
Route::get('/tests/{testId}/results/view','TestResults@view');



/*
 *
 *
Route::get('/questions', ['as' => 'questions', function () {
}]);
*/
//Route::get('/questions', 'QuestionsController@index')->name('questions');

#Route::get('/tests', function () {
#    return view('tests');
#});
