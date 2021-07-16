<?php

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

Route::get('/init', 'MeetingController@init');

Route::get('/', function () { return view('index'); });
Route::get('/overview', function() { return view('overview'); });
Route::get('/bookEditor', function() { return view('book'); });
// 로그인
Route::get('/login', function() { return view('login'); });
Route::get('/register', function() { return view('register'); });
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::resource('/register', 'UserController', ['only' => ['index', 'store', 'edit']]);
// 독자와의 만남
Route::get('/meeting', 'MeetingController@meetingPage');
Route::post('/meeting', 'MeetingController@meetingCon');
Route::get('/meeting/check', 'MeetingController@meetingCheckPage');
Route::delete('/meeting/delete/{meeting}', 'MeetingController@meetingDelete');
// 관리자 페이지
Route::get('/event/list', 'AdminController@eventList');
Route::get('/event/register', 'AdminController@eventReg');
Route::post('/event/register', 'AdminController@eventRegProcess');
Route::get('/event/update', 'AdminController@eventUpdate');
Route::post('/event/update', 'AdminController@eventUpdateProcess');
Route::delete('/event/delete/{id}', 'AdminController@eventDelete');
Route::get('/meeting/check/admin', 'AdminController@meetingCheckAdmin');
Route::post('/stateUpdate/{id}', 'AdminController@stateUpdate');
// 이미지
Route::get('/images/{imgfile}', function($imgfile = null) {
    $path = storage_path() . '/app/imgs/' . $imgfile;
    if (file_exists($path)) return response()->file($path);
});
