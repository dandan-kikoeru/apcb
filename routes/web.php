<?php

use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(function () {
  Route::post("/api/user/register", [UserController::class, "register"]);
  Route::post("/api/user/login", [UserController::class, "login"]);

});

Route::middleware(["auth"])->group(function () {
  Route::post("/api/user/logout", [UserController::class, "logout"]);
  Route::post("/api/post/create", [PostController::class, "create"]);
});

Route::middleware(['guest'])->group(function () {
  Route::get('/login', function () {
    return view('login');
  })->name('login');
});

Route::middleware(["auth"])->group(function () {
  Route::get('/', function () {
    $posts = Post::latest()->get();

    return view('home', [
      'posts' => PostResource::collection($posts),
    ]);
  });
});

