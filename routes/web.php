<?php

use App\Models\Post;
use App\Models\User;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

Route::middleware(['guest'])->group(function () {
  Route::post("/api/user/register", [UserController::class, "register"]);
  Route::post("/api/user/login", [UserController::class, "login"]);
});

Route::middleware(["auth"])->group(function () {
  Route::post("/api/user/logout", [UserController::class, "logout"]);

  Route::post("/api/post/create", [PostController::class, "create"]);
  Route::post("/api/post/update/{id}", [PostController::class, "update"]);
  Route::post("/api/post/delete/{id}", [PostController::class, "delete"]);

  Route::post("/api/search", [SearchController::class, "search"]);

  Route::post("/api/user/update/name", [UserController::class, "updateName"]);
  Route::post("/api/user/update/avatar", [UserController::class, "updateAvatar"]);
  Route::post("/api/user/update/banner", [UserController::class, "updateBanner"]);
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

  Route::get('/settings', function () {
    return view('settings');
  });

  Route::get("/search/all", [SearchController::class, "all"]);
  Route::get("/search/posts", [SearchController::class, "posts"]);
  Route::get("/search/users", [SearchController::class, "users"]);

  Route::get("/posts/{id}", function ($id) {
    if ($post = Post::find($id)) {
      return view("singlepost", [
        "post" => new PostResource($post),
      ]);
    }
    return abort(404);
  });

  Route::get("/{id}", function ($id) {
    if ($user = User::find($id)) {
      $posts = Post::latest()->where("user_id", $user->id)->get();
      return view("profile", [
        "posts" => PostResource::collection($posts),
        "profile" => $user,
      ]);
    }
    return abort(404);
  });
});
