<?php

use App\Http\Controllers\AdminController;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Models\User;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::middleware(['guest'])->group(function () {
  Route::post("/api/user/register", [UserController::class, "register"]);
  Route::post("/api/user/login", [UserController::class, "login"]);

});

Route::middleware(["auth"])->group(function () {
  Route::post("/api/user/logout", [UserController::class, "logout"]);

  Route::post("/api/post/create", [PostController::class, "create"]);
  Route::post("/api/post/read", [PostController::class, "read"]);
  Route::post("/api/post/update/{id}", [PostController::class, "update"]);
  Route::post("/api/post/delete/{id}", [PostController::class, "delete"]);

  Route::post("/api/admin/setadmin", [AdminController::class, "setadmin"]);
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

  Route::get('/getadmin', function () {
    return view('admin');
  });

  Route::get("/search/{query}", function (Request $request, $query) {
    $posts = Post::where('caption', 'like', '%' . $query . '%')->get();
    $users = User::where('name', 'like', '%' . $query . '%')->get();

    return view('search', [
      'posts' => PostResource::collection($posts),
      'users' => UserResource::collection($users),
    ]);
  });
});
