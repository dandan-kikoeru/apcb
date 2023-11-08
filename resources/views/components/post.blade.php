<div class="card card-body bg-neutral my-4 w-96 sm:w-[36rem] mx-auto p-4">
  <div class="flex gap-1">
    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
      <div class="w-10 rounded-full">
        <a href="/{{ $post->user->id }}">
          <img src="{{ $post->user->avatar }}" />
        </a>
      </div>
    </label>
    <div class="flex flex-col">
      <a href="/{{ $post->user->id }}" class="font-semibold hover:underline w-fit">{{ $post->user->name }}</a>
      <a href="/posts/{{ $post->id }}"
        class=" hover:underline text-sm w-fit">{{ $post->created_at->diffForHumans() }}</a>
    </div>
    @if (Auth()->user()->id === $post->user->id)
      <div class="dropdown dropdown-bottom dropdown-end absolute right-4">
        <label tabindex="0" class="btn btn-ghost btn-circle">
          <span class="material-symbols-outlined">more_horiz</span>
        </label>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-center mt-2 mr-4 bg-neutral rounded-box w-52">
          <li>
            <div onclick="showEdit({{ $post->id }})">
              <span class="material-symbols-outlined">edit</span>Edit
            </div>
          </li>
          <form action="/api/post/delete/{{ $post->id }}" method="POST">
            @csrf
            <li><button><span class="material-symbols-outlined">delete</span>Delete</button>
            </li>
          </form>
        </ul>
      </div>
      <dialog id="editPost-{{ $post->id }}" class="modal">
        <div class="modal-box bg-neutral w-[28rem]">
          <form method="dialog">
            <button class="btn btn-circle btn-ghost float-right bg-neutral">
              <span class="material-symbols-outlined">close</span>
            </button>
          </form>
          <h1 class="text-3xl font-semibold mb-4">Edit Post</h1>
          <form action="/api/post/update/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea class="outline-none bg-neutral w-full min-h-8"
              placeholder="Apa yang Anda pikirkan, {{ Auth()->user()->name }}?" name="caption"></textarea>
            <input type="file" class="file-input w-full file:normal-case mt-2" name="image" />
            <button class="btn btn-primary btn-block normal-case mt-2">Edit</button>
          </form>
        </div>
        <form method="dialog" class="modal-backdrop">
          <button class="cursor-default">close</button>
        </form>
      </dialog>
    @elseif (Auth()->user()->is_admin && $post->user->id !== Auth()->user()->id)
      <div class="dropdown dropdown-bottom dropdown-end absolute right-4">
        <label tabindex="0" class="btn btn-ghost btn-circle">
          <span class="material-symbols-outlined">more_horiz</span>
        </label>
        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow-center mt-2 mr-4 bg-neutral rounded-box w-52">
          <form action="/api/post/delete/{{ $post->id }}" method="POST">
            @csrf
            <li><button><span class="material-symbols-outlined">delete</span>Delete</button>
            </li>
          </form>
        </ul>
      </div>
    @endif
  </div>
  {!! nl2br($post->caption) !!}

  @if ($post->image)
    <img src="{{ $post->image }}">
  @endif
</div>
<script>
  function showEdit(id) {
    const dialog = document.getElementById('editPost-' + id);
    if (dialog) {
      dialog.showModal();
    }
    dialog.querySelector('textarea[name="caption"]').value = '';
    dialog.querySelector('input[type="file"]').value = '';
  }
</script>
