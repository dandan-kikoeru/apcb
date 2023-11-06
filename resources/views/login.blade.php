<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Log in or sign up</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  @vite ('resources/css/app.css')
</head>

<body>
  <div class="card w-96 bg-neutral shadow-xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
    <div class="card-body">
      <form action="/api/user/login" method="POST" class="pb-4 border-b border-accent">
        @csrf
        <h1 class="text-3xl font-semibold mb-4">Login</h1>
        <input type="text" name="name" class="input w-full my-4" placeholder="Nama">
        <input type="password" name="password" class="input w-full my-4" placeholder="Password">
        <button class="btn btn-block btn-primary normal-case mt-8">Log in</button>
      </form>
      <button class="btn btn-secondary normal-case mt-2" onclick="show()">Buat akun baru</button>
    </div>
  </div>

  <dialog id="register" class="modal">
    <div class="modal-box bg-neutral w-[28rem]">
      <form method="dialog">
        <button class="btn btn-circle btn-ghost float-right bg-neutral"><span class="material-symbols-outlined">
            close
          </span></button>
      </form>
      <form action="/api/user/register" method="POST">
        @csrf
        <h1 class="text-3xl font-semibold mb-4">Sign Up</h1>
        <input type="text" name="name" class="input w-full my-4" placeholder="Nama">
        <input type="email" name="email" class="input w-full my-4" placeholder="Email">
        <input type="password" name="password" class="input w-full my-4" placeholder="Password">
        <div class="mt-8 flex justify-center">
          <button class="btn w-2/3 btn-secondary normal-case">Sign Up</button>
        </div>
      </form>
    </div>
    <form method="dialog" class="modal-backdrop">
      <button class="cursor-default">close</button>
    </form>
  </dialog>
</body>

</html>
<script>
  function show() {
    register.showModal()
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
    inputs.forEach(input => {
      input.value = '';
    });
  }
</script>
