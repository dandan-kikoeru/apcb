<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function create(Request $request)
  {

    $post = $request->validate([
      "caption" => ["required"],
      "image" => ['sometimes', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
    ]);
    $imageName = Str::random(16) . '.' . $request->file('image')->extension();
    return $post;
  }
}
