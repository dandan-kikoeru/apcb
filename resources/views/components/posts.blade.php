<div class=" w-96 sm:w-[36rem] mx-auto p-4 pb-8 my-4 bg-neutral rounded-lg flex">
  <label tabindex="0" class="btn btn-ghost btn-circle avatar">
    <div class="w-10 rounded-full">
      <img src="{{ Auth()->user()->avatar }}" />
    </div>
  </label>
  <button class="input rounded-full bg-accent w-full text-left normal-case" onclick="show()">
    Apa yang Anda pikirkan, {{ Auth()->user()->name }}?</button>
</div>

<dialog id="createPost" class="modal">
  <div class="modal-box bg-neutral w-[28rem]">
    <form method="dialog">
      <button class="btn btn-circle btn-ghost float-right bg-neutral"><span class="material-symbols-outlined">
          close
        </span></button>
    </form>
    <h1 class="text-3xl font-semibold mb-4">Create Post</h1>
    <form action="/api/post/create" method="POST">
      @csrf
      <textarea class="outline-none bg-neutral w-full min-h-8"
        placeholder="Apa yang Anda pikirkan, {{ Auth()->user()->name }}?" name="caption"></textarea>
      <input type="file" class="file-input w-full file:normal-case" name="image" />
      <button class="btn btn-primary btn-block normal-case mt-2">Post</button>
    </form>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button class="cursor-default">close</button>
  </form>
</dialog>
</div>

@foreach (posts as post)
  {{-- ntar --}}
@endforeach

<script>
  function show() {
    createPost.showModal()
    document.querySelector('input[type="file"]').value = '';
    document.querySelector('textarea[name="caption"]').value = '';
  }
</script>
