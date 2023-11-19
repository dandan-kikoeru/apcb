<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Hasil Pencarian | Creative Post</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite ('resources/css/app.css')
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
  <div class="drawer xl:drawer-open z-[1]">
    <input id="drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
      <x-navbar>
        <div class="flex-none xl:hidden bg-neutral">
          <label for="drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
            <span class="material-symbols-outlined">menu</span>
          </label>
        </div>
      </x-navbar>
      <div>
        @foreach ($results as $result)
          @if ($result instanceof \App\Models\Post)
            <x-post :post=$result />
          @elseif ($result instanceof \App\Models\User)
            <div class="card card-body bg-neutral my-4 w-96 sm:w-[36rem] mx-auto p-4">
              <div class="flex gap-2">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                  <div class="w-10 rounded-full">
                    <a href="/{{ $result->id }}">
                      <img src="{{ $result->avatar }}" />
                    </a>
                  </div>
                </label>
                <div>
                  <a href="/{{ $result->id }}"
                    class="self-center text-lg font-semibold hover:underline">{{ $result->name }}</a>
                  <p class="text-sm">Joined {{ $result->created_at->format('F Y') }}</p>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
    <div class="drawer-side">
      <label for="drawer" aria-label="close sidebar" class="drawer-overlay"></label>
      <ul class="menu p-4 w-80 min-h-full bg-neutral text-base-content border-accent border fixed top-16">
        <h1 class="text-2xl font-bold border-b pb-4 border-accent">Hasil pencarian</h1>
        <p class="text-lg my-2 font-semibold">Saringan</p>
        <li>
          <a href="/search/all/?q={{ request('q') }}"
            class="{{ Request::is('search/all*') ? 'bg-accent' : '' }} h-12 flex">
            <span class="material-symbols-outlined">package_2</span>Semua
          </a>
        </li>
        <li>
          <a href="/search/posts/?q={{ request('q') }}"
            class="{{ Request::is('search/posts*') ? 'bg-accent' : '' }} h-12 flex">
            <span class="material-symbols-outlined">post</span>Postingan
          </a>
        </li>
        <li>
          <a href="/search/users/?q={{ request('q') }}"
            class="{{ Request::is('search/users*') ? 'bg-accent' : '' }} h-12 flex">
            <span class="material-symbols-outlined">person</span>Orang
          </a>
        </li>
      </ul>
    </div>
  </div>
</body>

</html>
