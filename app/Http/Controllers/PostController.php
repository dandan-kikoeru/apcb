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
      'image' => ['mimes:jpeg,png,jpg,webp,gif', 'max:2048']
    ]);

    $imageUrl = null;

    if ($request->image) {
      $imageName = Str::random(16) . '.' . $request->file('image')->extension();
      $imageUrl = "/images/$imageName";
      $request->file('image')->move(public_path('images'), $imageName);
    }

    Post::create([
      'caption' => $request->caption,
      'image' => $imageUrl,
      'user_id' => auth()->user()->id,
    ]);
    return redirect('/');
  }

  public function update($id, Request $request)
  {
    $post = Post::find($id);

    $request->validate([
      'caption' => 'required',
      'image' => ['mimes:jpeg,png,jpg,webp,gif', 'max:2048']
    ]);

    $imageUrl = null;

    if ($request->image) {
      $imageName = Str::random(16) . '.' . $request->file('image')->extension();
      $imageUrl = "/images/$imageName";
      $request->file('image')->move(public_path('images'), $imageName);
    }

    $post->caption = $request->caption;
    $post->image = $imageUrl;
    $post->save();
    return redirect('/');
  }

  public function delete(Post $id)
  {
    $id->delete();
    return redirect('/');
  }

}
