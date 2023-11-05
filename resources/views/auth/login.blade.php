<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite ('resources/css/app.css')
</head>

<body>
    <div class="card w-96 bg-base-100 shadow-xl absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
        <div class="card-body">
            <form action="/api/user/login" method="POST">
                @csrf
                <h1 class="text-3xl font-semibold mb-4">Login</h1>
                <input type="text" name="name" class="input input-primary w-full my-2" placeholder="Nama">
                <input type="password" name="password" class="input input-bordered w-full my-2" placeholder="Password">
                <div class="w-full flex justify-end">
                    <a href="/register" class="link">Belum Punya Akun?</a>
                </div>
                <button class="btn btn-block normal-case mt-8">Login</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>
