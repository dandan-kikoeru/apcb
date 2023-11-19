<div class=" w-96 sm:w-[36rem] mx-auto p-4 pb-8 my-4 bg-neutral rounded-xl flex">
  <label tabindex="0" class="btn btn-ghost btn-circle avatar">
    <div class="w-10 rounded-full">
      <a href="{{ auth()->user()->id }}">
        <img src="{{ Auth()->user()->avatar }}" />
      </a>
    </div>
  </label>
  <button class="input rounded-full bg-accent w-full text-left normal-case ml-1" onclick="showCreate()">
    Apa yang Anda pikirkan, {{ Auth()->user()->name }}?</button>
</div>
<dialog id="createPost" class="modal">
  <div class="modal-box bg-neutral w-[28rem] shadow-center">
    <form method="dialog">
      <button class="btn btn-circle btn-ghost float-right bg-neutral"><span class="material-symbols-outlined">
          close
        </span></button>
    </form>
    <h1 class="text-3xl font-semibold mb-4">Buat Postingan</h1>
    <form action="/cp/post/create" method="POST" enctype="multipart/form-data">
      @csrf
      <textarea class="outline-none bg-neutral w-full min-h-8"
        placeholder="Apa yang Anda pikirkan, {{ Auth()->user()->name }}?" name="caption"></textarea>
      <div class="relative flex mx-auto justify-center flex-col w-fit my-2">
        <img class="rounded-lg cursor-pointer" id="imagePreview" onclick="openCreateImage()">
        <div class="btn btn-ghost btn-circle absolute btn-sm right-0 top-0 hidden" id="imageButton"
          onclick="resetCreateImage()">
          <span class="material-symbols-outlined">close</span>
        </div>
      </div>
      <div class="btn btn-ghost btn-circle" onclick="openCreateImage()" id="add"><span
          class="material-symbols-outlined">add_a_photo</span></div>
      <input type="file" class="hidden" name="image" accept=".jpeg, .jpg, .png, .webp, .gif"
        onchange="handleCreateImagePreview()" />
      <button class="btn btn-primary btn-block normal-case mt-2">Post</button>
    </form>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button class="cursor-default">close</button>
  </form>
</dialog>
<script>
  const imageInput = document.querySelector('input[type="file"]');
  const textareaInput = document.querySelector('textarea[name="caption"]');
  const imagePreview = document.getElementById('imagePreview');
  const imageButton = document.getElementById('imageButton');

  function showCreate() {
    createPost.showModal();
    imageInput.value = '';
    textareaInput.value = '';
  }

  function openCreateImage() {
    imageInput.click();
  }

  function handleCreateImagePreview() {
    let selectedFile = imageInput.files[0];
    if (selectedFile) {
      let reader = new FileReader();

      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imageButton.classList.remove('hidden')
        document.getElementById('add').classList.add('hidden');
      };

      reader.readAsDataURL(selectedFile);
    }
  }

  function resetCreateImage() {
    imagePreview.src = '';
    imageButton.classList.add('hidden')
    document.getElementById('add').classList.remove('hidden');
    imageInput.value = '';

  }
</script>
