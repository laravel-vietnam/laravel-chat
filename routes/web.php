<?php

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('chat', function () {
    return view('chat');
});

Route::post('message', function (Request $request) {
    broadcast(new MessageSent(auth()->user(), $request->input('message')));

    return $request->input('message');
});

Route::get('login/{id}', function ($id) {
    Auth::loginUsingId($id);

    return back();
});

Route::get('logout', function () {
    Auth::logout();

    return back();
});
