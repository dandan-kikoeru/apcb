<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function setadmin(Request $request)
  {
    $user = Auth()->user();
    $secretPassword = env('SECRET_PASSWORD');
    if ($request->input("secret") === $secretPassword) {
      $user->is_admin = true;
      $user->save();
      return redirect("/");
    }
    $user->is_admin = false;
    $user->save();
    return redirect("/");

  }
}
