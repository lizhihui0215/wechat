<div class="container">
  <div class="alert alert-{{ $type }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <span aria-hidden="true">&times;</span>
      <span class="sr-only">Close</span>
    </button>
    @foreach ($message as $error)
        <li>{{ $error }}</li>
    @endforeach
  </div>
</div>
