<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite ('resources/css/app.css')
</head>
<body>
    <div class="navbar bg-base-100">
        <div class="flex-1">
          <a class="btn btn-ghost normal-case text-xl">MINIMAL MAKSIMAL</a>
        </div>
        <div class="flex-none gap-2">
          <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
              <div class="w-10 rounded-full">
                <img src="/avatars/guest.webp" />
              </div>
            </label>
            <ul tabindex="0" class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
              <li>
                <a class="justify-between">
                  Profile
                </a>
              </li>
              <li><a>Settings</a></li>
              <li>
                <form action="/api/user/logout" method="post">
                @csrf
                <button>Logout</button>
                </form></li>
            </ul>
          </div>
        </div>
      </div>
</body>
</html>
