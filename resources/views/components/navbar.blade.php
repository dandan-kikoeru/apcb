<div class="navbar bg-neutral border-b border-accent sticky top-0 z-10">
  <div class="flex-1">
    {{ $slot }}
    <a class="btn btn-primary btn-circle normal-case text-xl mx-2" href="/">CP</a>
    <form action="/api/search" method="post">
      @csrf
      <div class="relative flex items-center overflow-hidden rounded-full">
        <input type="text" placeholder="Cari CP"
          class="placeholder:text-accent text-accent focus:text-white sm:text-white sm:placeholder-[#9ca3af] bg-accent outline-none rounded-full peer pl-2 focus:pr-10 w-10 focus:w-full sm:pr-4 sm:pl-8 py-2 sm:w-full transition-all duration-300 sm:focus:pl-2 cursor-pointer focus:cursor-text sm:cursor-text"
          name="q" value="{{ request('q') }}" autocomplete="off" />
        <span
          class="material-symbols-outlined pointer-events-none absolute ml-2 peer-focus:-translate-x-8 peer-focus:opacity-0 transition-all duration-300">search</span>
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
        <li>
          <a href="/{{ auth()->user()->id }}"
            class="{{ Request::is(auth()->user()->id) ? 'bg-accent' : '' }} h-12 flex">
            <span class="material-symbols-outlined">account_circle</span>{{ Auth()->user()->name }}
          </a>
        </li>
        <li>
          <a href="/settings" class="{{ Request::is('settings') ? 'bg-accent' : '' }} h-12 flex">
            <span class="material-symbols-outlined">settings</span>Settings
          </a>
        </li>
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
