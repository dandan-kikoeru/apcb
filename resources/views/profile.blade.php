<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $profile->name }} | Creative Post</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite ('resources/css/app.css')
</head>

<body>
  <x-navbar />
  <div class="bg-neutral sm:px-16">
    @if ($profile->banner)
      <img class="w-96 sm:w-[64rem] z-10 mx-auto aspect-[3/1]" src="{{ $profile->banner }}" />
    @else
      <div class="w-96 sm:w-[64rem] z-10 mx-auto bg-black aspect-[3/1]"></div>
    @endif
  </div>
  <div class="flex flex-col items-center bg-neutral h-40 border-b border-accent relative">
    <div class="absolute -top-16 flex flex-col items-center">
      <img class="h-32 rounded-full border-4 border-neutral" src="{{ $profile->avatar }}">
      <h1 class="text-2xl">{{ $profile->name }}</h1>
      Joined {{ $profile->created_at->format('F Y') }}
    </div>
  </div>
  @if (auth()->user()->id === $profile->id)
    <x-createpost />
  @endif
  <x-posts :posts=$posts />
</body>

</html>
