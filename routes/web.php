<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

Route::middleware(['guest'])->group(function () {
  Route::post("/cp/user/register", [UserController::class, "register"]);
  Route::post("/cp/user/login", [UserController::class, "login"]);
});

Route::middleware(["auth"])->group(function () {
  Route::post("/cp/user/logout", [UserController::class, "logout"]);

  Route::post("/cp/post/create", [PostController::class, "create"]);
  Route::post("/cp/post/update/{id}", [PostController::class, "update"]);
  Route::post("/cp/post/delete/{id}", [PostController::class, "delete"]);

  Route::post("/cp/search", [SearchController::class, "search"]);

  Route::post("/cp/user/update/name", [UserController::class, "updateName"]);
  Route::post("/cp/user/update/avatar", [UserController::class, "updateAvatar"]);
  Route::post("/cp/user/update/banner", [UserController::class, "updateBanner"]);
  Route::get("/cp/posts/{id}", function ($id) {
    if ($post = Post::find($id)) {
      return new PostResource($post);
    }
    return abort(404);
  });
  // Route::get("/cp/posts", function () {
  //   $posts = Post::latest()->paginate(10);
  //   return PostResource::collection($posts);
  // });
});



Route::middleware(['guest'])->group(function () {
  Route::get('/login', function () {
    return view('login');
  })->name('login');
});



Route::middleware(["auth"])->group(function () {
  Route::get('/', function (Request $request) {
    $posts = Post::latest()->paginate(25);
    $lastPage = $posts->lastPage();

    if ($request->input('page') > $lastPage) {
      return redirect("/?page=$lastPage");
    }

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

  Route::get("/{id}", function ($id, Request $request) {
    if ($user = User::find($id)) {
      $posts = Post::latest()->where("user_id", $user->id)->paginate(25);
      $lastPage = $posts->lastPage();

      if ($request->input('page') > $lastPage) {
        return redirect("/$id/?page=$lastPage");
      }

      return view("profile", [
        "posts" => PostResource::collection($posts),
        "profile" => $user,
      ]);
    }
    return abort(404);
  });
});
