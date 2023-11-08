<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function register(Request $request)
  {
    $credentials = $request->validate([
      'name' => ['required', 'string', Rule::unique('users', 'name')],
      'email' => ['required', 'string', Rule::unique('users', 'email')],
      'password' => ['required'],
    ]);
    $user = User::create($credentials);
    Auth::login($user);
    return redirect('/');
  }
  public function logout()
  {
    Auth::logout();
    return redirect('/login');
  }
  public function login(Request $request)
  {
    $credentials = $request->validate([
      "email" => ['required'],
      "password" => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect("/");
    }
    return redirect("https://youtu.be/UIp6_0kct_U");
    // return back()->withErrors(['messages' => 'Invalid credentials']);
  }

  public function updateName(Request $request)
  {
    $user = Auth::user();
    $request->validate([
      'name' => 'required'
    ]);
    $user->name = $request->name;
    $user->save();
    return redirect('/settings');
  }
  public function updateAvatar(Request $request)
  {
    $user = Auth::user();
    $request->validate([
      'avatar' => ['mimes:jpeg,png,jpg,webp,gif', 'max:2048']
    ]);

    $imageName = Str::random(16) . '.' . $request->file('avatar')->extension();
    $imageUrl = "/avatars/$imageName";
    $request->file('avatar')->move(public_path('avatars'), $imageName);

    $user->avatar = $imageUrl;
    $user->save();
    return redirect('/settings');
  }

  public function updateBanner(Request $request)
  {
    $user = Auth::user();
    $request->validate([
      'banner' => ['mimes:jpeg,png,jpg,webp,gif', 'max:2048']
    ]);

    $imageName = Str::random(16) . '.' . $request->file('banner')->extension();
    $imageUrl = "/banners/$imageName";
    $request->file('banner')->move(public_path('banners'), $imageName);

    $user->banner = $imageUrl;
    $user->save();
    return redirect('/settings');
  }
}
