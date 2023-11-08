<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Settings</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite ('resources/css/app.css')
</head>

<body>
  <x-navbar />
  <div>
    <div
      class="bg-neutral shadow-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 p-8 rounded-2xl flex flex-col gap-4">
      <form action="/api/user/update/name" method="POST">
        <label class="flex">Ganti nama</label>
        @csrf
        <div class="join w-80 mt-2 mb-8">
          <input type="text" name="name" class="input w-full join-item" value="{{ auth()->user()->name }}"
            placeholder="{{ auth()->user()->name }}">
          <button class="btn join-item btn-secondary ">
            <span class="material-symbols-outlined">chevron_right</span>
          </button>
        </div>
      </form>
      <div class="flex gap-4">
        <button class="input bg-accent w-full normal-case" onclick="avatar.showModal()">
          Upload Avatar
        </button>
        <button class="input bg-accent w-full normal-case" onclick="banner.showModal()">
          Upload Banner
        </button>
      </div>
    </div>
    <dialog id="avatar" class="modal">
      <div class="modal-box bg-neutral w-[28rem] shadow-center">
        <form method="dialog">
          <button class="btn btn-circle btn-ghost float-right bg-neutral"><span class="material-symbols-outlined">
              close
            </span></button>
        </form>
        <h1 class="text-3xl font-semibold mb-4">Upload Avatar</h1>
        <form action="/api/user/update/avatar" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" class="file-input w-full file:normal-case mt-2" name="avatar" />
          <button class="btn btn-primary btn-block normal-case mt-2">Upload</button>
        </form>
      </div>
      <form method="dialog" class="modal-backdrop">
        <button class="cursor-default">close</button>
      </form>
    </dialog>
    <dialog id="banner" class="modal">
      <div class="modal-box bg-neutral w-[28rem] shadow-center">
        <form method="dialog">
          <button class="btn btn-circle btn-ghost float-right bg-neutral"><span class="material-symbols-outlined">
              close
            </span></button>
        </form>
        <h1 class="text-3xl font-semibold mb-4">Upload Banner</h1>
        <form action="/api/user/update/banner" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" class="file-input w-full file:normal-case mt-2" name="banner" />
          <button class="btn btn-primary btn-block normal-case mt-2">Upload</button>
        </form>
      </div>
      <form method="dialog" class="modal-backdrop">
        <button class="cursor-default">close</button>
      </form>
    </dialog>
    <dialog id="tutupAkun" class="modal">
      <div class="modal-box bg-neutral w-[28rem] shadow-center">
        <form method="dialog">
          <button class="btn btn-circle btn-ghost float-right bg-neutral">
            <span class="material-symbols-outlined">close</span>
          </button>
        </form>
        <h1 class="text-3xl font-semibold mb-4">Yakin mau tutup akun?</h1>
        <form action="/api/user/delete" method="POST" enctype="multipart/form-data">
          @csrf
          <button class="btn btn-error btn-block normal-case mt-2">Ya</button>
        </form>
      </div>
      <form method="dialog" class="modal-backdrop">
        <button class="cursor-default">close</button>
      </form>
    </dialog>
  </div>

</body>

</html>
