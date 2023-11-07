<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hasil Pencarian | Creative Post</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite ('resources/css/app.css')
</head>

<body>
  <x-navbar />
  <x-posts :posts=$posts />
  @foreach ($users as $user)
    <div class="card card-body bg-neutral my-4 w-96 sm:w-[36rem] mx-auto p-4">
      <div class="flex gap-2">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <a href="/{{ $user->id }}">
              <img src="{{ $user->avatar }}" />
            </a>
          </div>
        </label>
        <a href="/{{ $user->id }}" class="self-center text-lg font-semibold hover:underline">{{ $user->name }}</a>
      </div>
    </div>
  @endforeach
</body>

</html>
