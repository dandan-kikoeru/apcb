<div class="navbar bg-neutral border-b border-accent sticky top-0 z-10">
  <div class="flex-1">
    {{ $slot }}
    <a class="btn btn-primary btn-circle normal-case text-xl mx-2 no-animation" href="/" id="logo">CP</a>
    <a class="btn btn-ghost btn-circle mx-2 hidden no-animation" id="back">
      <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <form action="/api/search" method="post">
      @csrf
      <div class="relative flex items-center overflow-hidden rounded-full">
        <input type="text"
          class="text-accent focus:text-white sm:text-white bg-accent outline-none rounded-full peer pl-2 focus:pr-10 w-10 focus:w-full sm:pr-4 sm:pl-8 py-2 sm:w-full transition-all duration-300 sm:focus:pl-2 cursor-pointer focus:cursor-text sm:cursor-text"
          name="q" value="{{ request('q') }}" autocomplete="off" id="search" oninput="handleInput()"
          onfocus="handleFocus(this)" onblur="handleBlur()" />
        <span
          class="material-symbols-outlined pointer-events-none absolute ml-2 peer-focus:-translate-x-8 peer-focus:opacity-0 transition-all duration-300">search</span>
        <span
          class="absolute placeholder transition-all duration-300 pointer-events-none opacity-0 -ml-12 sm:opacity-100 peer-focus:opacity-100 sm:ml-8 peer-focus:ml-2"
          id="placeholder">Cari
          CP</span>
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
<script>
  const search = document.getElementById('search');
  const placeholder = document.getElementById('placeholder');
  const logo = document.getElementById('logo');
  const back = document.getElementById('back');
  if (search.value) {
    handleInput()
  }

  function handleInput() {
    if (search.value) {
      placeholder.classList.remove('peer-focus:opacity-100', 'sm:opacity-100')
      return placeholder.classList.add('peer-focus:opacity-0 ')
    }
    placeholder.classList.remove('peer-focus:opacity-0')
    return placeholder.classList.add('peer-focus:opacity-100', 'sm:opacity-100')
  }

  function handleFocus(input) {
    input.setSelectionRange(input.value.length, input.value.length);
    logo.classList.add('hidden')
    back.classList.remove('hidden')
  }

  function handleBlur() {
    logo.classList.remove('hidden')
    back.classList.add('hidden')
  }
</script>
