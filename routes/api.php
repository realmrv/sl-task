<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::middleware('auth:sanctum')->get('/user', static function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(static function () {
    Route::apiResources([
        'comments' => CommentController::class,
        'posts' => PostController::class,
        'users' => UserController::class,
    ]);
});

Route::any('{any?}', static function () {
    return response()->json([
        'message' => 'Not Found',
    ], Response::HTTP_NOT_FOUND);
})->where('any', '.*?');
