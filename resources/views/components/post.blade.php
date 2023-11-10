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
            <li><button><span class="material-symbols-outlined">delete</span>Hapus</button>
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
          <h1 class="text-3xl font-semibold mb-4">Edit Postingan</h1>
          <form action="/api/post/update/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea class="outline-none bg-neutral w-full h-32" placeholder="Apa yang Anda pikirkan, {{ Auth()->user()->name }}?"
              name="caption"></textarea>
            <div class="relative flex mx-auto justify-center flex-col w-fit my-2">
              <img class="rounded-lg cursor-pointer" id="imagePreview" src="{{ $post->image }}"
                onclick="openImage({{ $post->id }})">
              <div class="btn btn-ghost btn-circle absolute btn-sm right-0 top-0 {{ $post->image ? '' : 'hidden' }}"
                id="imageButton" onclick="resetImage({{ $post->id }})">
                <span class="material-symbols-outlined">close</span>
              </div>
            </div>
            <input type="file" class="hidden file-input w-full file:normal-case mt-2" name="image" id="imageInput"
              onchange="handleImagePreview({{ $post->id }})" />
            <input type="hidden" name="updateImage" value="1">
            <div class="btn btn-ghost btn-circle  {{ $post->image ? 'hidden' : '' }}"
              onclick="openImage({{ $post->id }})" id="add"><span
                class="material-symbols-outlined">add_a_photo</span>
            </div>
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
            <li><button><span class="material-symbols-outlined">delete</span>Hapus</button>
            </li>
          </form>
        </ul>
      </div>
    @endif
  </div>
  {!! nl2br($post->caption) !!}
  @if ($post->image)
    <img src="{{ $post->image }}" class="rounded-lg">
  @endif
</div>
<script>
  async function showEdit(id) {
    const dialog = document.getElementById('editPost-' + id);

    if (dialog) {
      dialog.showModal();

      try {
        const response = await fetch(`/api/posts/${id}`);
        const postData = await response.json();

        dialog.querySelector('textarea[name="caption"]').value = postData.data.caption;
      } catch (error) {
        console.error('Error fetching post data:', error);
      }
    }
  }

  function resetImage(id) {
    const dialog = document.getElementById('editPost-' + id);
    dialog.querySelector('input[name="updateImage"]').value = '0';
    dialog.querySelector('input[type="file"]').value = '';
    dialog.querySelector('#imagePreview').classList.add('hidden');
    dialog.querySelector('#imageButton').classList.add('hidden');
    dialog.querySelector('#add').classList.remove('hidden');
  }

  function openImage(id) {
    const dialog = document.getElementById('editPost-' + id);
    dialog.querySelector('input[type="file"]').click();
  }

  function handleImagePreview(id) {
    const dialog = document.getElementById('editPost-' + id);
    let selectedFile = dialog.querySelector('input[type="file"]').files[0];
    if (selectedFile) {
      let reader = new FileReader();

      reader.onload = function(e) {
        dialog.querySelector('#imagePreview').src = e.target.result;
        dialog.querySelector('#imagePreview').classList.remove('hidden');
        dialog.querySelector('#imageButton').classList.remove('hidden');
        dialog.querySelector('#add').classList.add('hidden');
      };

      reader.readAsDataURL(selectedFile);
    }
  }
</script>
