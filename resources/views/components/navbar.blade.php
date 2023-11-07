<div class="navbar bg-neutral border-b border-accent sticky top-0 z-10">
  <div class="flex-1">
    <a class="btn btn-primary btn-circle normal-case text-xl mx-2" href="/">CP</a>
    <form action="/api/post/read" method="post">
      @csrf
      <div class="w-64 sm:w-96 bg-accent rounded-full flex p-2 gap-1">
        <span class="material-symbols-outlined">search</span>
        <input type="text" placeholder="Cari CP" class="w-full bg-transparent outline-none" name="search" />
      </div>
    </form>
  </div>
  <div class="flex-none gap-2">
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img src="{{ Auth()->user()->avatar }}" />
        </div>
      </label>
      <ul tabindex="0" class="dropdown-content z-[1] menu p-2 bg-neutral rounded-box w-64 mt-4 shadow-center">
        <li><a href="/{{ auth()->user()->id }}"><span class="material-symbols-outlined">
              account_circle
            </span>{{ Auth()->user()->name }}</a></li>
        <li><a href="/settings"><span class="material-symbols-outlined">
              settings
            </span>Settings</a></li>
        <form action="/api/user/logout" method="post">
          <li>
            @csrf
            <button><span class="material-symbols-outlined">
                logout
              </span>Log out</button>
          </li>
        </form>
      </ul>
    </div>
  </div>
</div>
