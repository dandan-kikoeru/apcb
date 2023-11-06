<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function create(Request $request)
  {
    $request->validate([
      'caption' => 'required',
    ]);

    $imageName = null;

    if ($request->image) {
      $imageName = Str::random(16) . '.' . $request->file('image')->extension();
    }

    $post = Post::create([
      'caption' => $request->caption,
      'image' => $imageName,
      'user_id' => auth()->user()->id,
    ]);
    return redirect('/');
  }
}
