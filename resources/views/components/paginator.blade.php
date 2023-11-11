@if ($paginate->lastPage() > 1)
  <div class="join absolute left-1/2 -translate-x-1/2 pb-4">
    @if ($paginate->previousPageUrl())
      <a class="join-item btn material-symbols-outlined btn-neutral"
        href="{{ $paginate->previousPageUrl() }}">keyboard_double_arrow_left</a>
    @endif
    <a class="join-item btn font-bold w-16 btn-neutral" href="">{{ $paginate->currentPage() }}</a>
    @if ($paginate->nextPageUrl())
      <a class="join-item btn material-symbols-outlined btn-neutral"
        href="{{ $paginate->nextPageUrl() }}">keyboard_double_arrow_right</a>
    @endif
  </div>
@endif
