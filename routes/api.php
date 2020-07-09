<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function() {
    Route::get('tasks', function() {
        return App\Task::latest()->orderBy('created_at', 'desc')->get();
    });

    Route::get('tasks/{id}', function($id) {
        return App\Task::findOrFail($id);
    });

    Route::post('tasks/store', function(Request $request) {
        return App\Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => $request->status_id,
        ]);
    });
    
    Route::patch('tasks/{id}', function(Request $request, $id) {
        App\Task::findOrFail($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'status_id' => $request->status_id,
        ]);
    });

    Route::delete('tasks/{id}', function($id) {
        return App\Task::destroy($id);
    });

    Route::get('status', function() {
        return App\Status::orderBy('order', 'asc')->get();
    });
});
