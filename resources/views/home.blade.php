<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Creative Post</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite (['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  <x-navbar />
  <x-createpost />
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
</body>

</html>
