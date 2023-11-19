<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Settings | Creative Post</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite ('resources/css/app.css')
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>

<body>
  <x-navbar />
  <div
    class="bg-neutral shadow-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 sm:w-[32rem] p-8 rounded-2xl flex flex-col gap-4 mt-8 z-20">
    <form action="/cp/user/update/name" method="POST">
      <label class="flex text-lg font-semibold">Ganti nama</label>
      @csrf
      <div class="join w-full mt-2 mb-8">
        <input type="text" name="name" class="input w-full join-item" value="{{ auth()->user()->name }}"
          placeholder="{{ auth()->user()->name }}">
        <button class="btn join-item btn-secondary ">
          <span class="material-symbols-outlined">chevron_right</span>
        </button>
      </div>
    </form>
    <div class="flex gap-4 flex-col">
      <div class="mb-4">
        <div class="flex justify-between items-center mb-2">
          <p class="text-lg font-semibold">Foto Profil</p>
          <button class="btn btn-ghost text-primary normal-case" onclick="openAvatar()">Edit</button>
        </div>
        <img src="{{ auth()->user()->avatar }}" id="avatarPreview"
          class="rounded-full mx-auto h-40 w-auto cursor-pointer" onclick="openBanner()"
          accept=".jpeg, .jpg, .png, .webp, .gif" />
        <form action="/cp/user/update/avatar" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" id="avatarInput" class="hidden" name="avatar" onchange="handleAvatarInput()" />
          <button class="btn btn-primary mx-auto normal-case place-self-center grid hidden mt-4"
            id="avatarButton">Simpan</button>
        </form>
      </div>
      <div class="mb-4">
        <div class="flex justify-between items-center mb-2">
          <p class="text-lg font-semibold">Foto Sampul</p>
          <button class="btn btn-ghost text-primary normal-case" onclick="openBanner()">Edit</button>
        </div>
        @if (auth()->user()->banner)
          <div class="relative aspect-[3/1] max-w-6xl mx-auto overflow-hidden rounded-md">
            <img class="object-cover w-full h-full cursor-pointer" src="{{ auth()->user()->banner }}" id="bannerPreview"
              onclick="openBanner()" />
          </div>
        @else
          <div class="relative aspect-[3/1] max-w-6xl mx-auto overflow-hidden rounded-md bg-black">
            <img id="bannerPreview" class="object-cover w-full h-full text-transparent cursor-pointer" alt=" "
              onclick="openBanner()" />
          </div>
        @endif
        <form action="/cp/user/update/banner" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" id="bannerInput" class="hidden" name="banner" onchange="handleBannerInput()"
            accept=".jpeg, .jpg, .png, .webp, .gif" />
          <button class="btn btn-primary mx-auto normal-case place-self-center grid hidden mt-4"
            id="bannerButton">Simpan</button>
        </form>
      </div>
    </div>
  </div>
  <script>
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarButton = document.getElementById('avatarButton');

    const bannerInput = document.getElementById('bannerInput');
    const bannerPreview = document.getElementById('bannerPreview');
    const bannerButton = document.getElementById('bannerButton');

    function openAvatar() {
      avatarInput.click();
    }

    function openBanner() {
      bannerInput.click();
    }

    function handleAvatarInput() {
      let selectedFile = avatarInput.files[0];
      if (selectedFile) {
        let reader = new FileReader();

        reader.onload = function(e) {
          avatarPreview.src = e.target.result;
          avatarButton.classList.remove('hidden')
        };

        reader.readAsDataURL(selectedFile);
      }
    }

    function handleBannerInput() {
      let selectedFile = bannerInput.files[0];
      if (selectedFile) {
        let reader = new FileReader();

        reader.onload = function(e) {
          bannerPreview.src = e.target.result;
          bannerButton.classList.remove('hidden')
        };

        reader.readAsDataURL(selectedFile);
      }
    }
  </script>
</body>

</html>
