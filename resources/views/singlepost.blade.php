<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $post->user->name }} – {{ $post->caption }} | CreativePost</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite ('resources/css/app.css')
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
  <x-navbar />
  <x-post :post=$post />
</body>

</html>
