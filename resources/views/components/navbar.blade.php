<div class="navbar bg-neutral border-b border-accent">
  <div class="flex-1">
    <a class="btn btn-ghost normal-case text-xl">MINIMAL MAKSIMAL</a>
  </div>
  <div class="flex-none gap-2">
    <div class="dropdown dropdown-end">
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="{{ Auth()->user()->avatar }}" />
          </div>
        </label>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-neutral rounded-box w-64">
          <li><a>{{ Auth()->user()->name }}</a></li>
          <li><a>Settings</a></li>
          <form action="/api/user/logout" method="post">
            <li>
              @csrf
              <button>Log out</button>
            </li>
          </form>
        </ul>
      </div>
    </div>
  </div>
</div>
