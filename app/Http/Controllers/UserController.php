<?php

namespace App\Http\Controllers;

use App\Models\User;
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
      "name" => ['required'],
      "password" => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect("/");
    }
    return redirect("https://youtu.be/UIp6_0kct_U");
    // return back()->withErrors(['messages' => 'Invalid credentials']);
  }
}
