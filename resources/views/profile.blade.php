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
  <div class="bg-neutral">
    @if ($profile->banner)
      <div class="relative aspect-[3/1] max-w-6xl mx-auto overflow-hidden rounded-b-xl">
        <img class="object-cover w-full h-full" src="{{ $profile->banner }}" />
      </div>
    @else
      <div class="relative aspect-[3/1] max-w-6xl mx-auto overflow-hidden rounded-xl bg-black">
      </div>
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
  @if ($posts->lastPage() > 1)
    <div class="join absolute left-1/2 -translate-x-1/2 pb-4">
      @if ($posts->previousPageUrl())
        <a class="join-item btn material-symbols-outlined btn-neutral"
          href="{{ $posts->previousPageUrl() }}">keyboard_double_arrow_left</a>
      @endif
      <a class="join-item btn font-bold w-16 btn-neutral" href="">{{ $posts->currentPage() }}</a>
      @if ($posts->nextPageUrl())
        <a class="join-item btn material-symbols-outlined btn-neutral"
          href="{{ $posts->nextPageUrl() }}">keyboard_double_arrow_right</a>
      @endif
    </div>
  @endif
</body>

</html>
