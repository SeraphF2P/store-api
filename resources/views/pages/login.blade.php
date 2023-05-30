<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite('resources/css/app.css')
  <title>login</title>
</head>

<body class="flex h-screen items-center justify-center antialiased dark:bg-gray-700">
  <div>
    <form class="flex flex-col items-center justify-center gap-4 bg-slate-100 p-4 shadow" action="\login" method="post">
      <h1>register</h1>
      @csrf
      <div class="form-group">

        <input id="name" name="name" type="text" placeholder="Name">
      </div>
      <div class="form-group">
        <input id="password" name="password" type="password" placeholder="Password">
      </div>
      <button class="btn btn-success" type="submit">Submit</button>
    </form>
  </div>
  <ul
    class="toast-container remove-scroll-bar pointer-events-none fixed top-0 right-0 isolate flex h-screen flex-col gap-4 overflow-hidden overflow-y-scroll pt-8 pr-8">
    @if (session()->has('success'))
      <li class="alert alert-success">{{ session('success') }}</li>
    @endif
    @if ($errors->any())
      @foreach ($errors->all() as $error)
        @if ($loop->index == 5)
        @break;
      @endif
      @if ($error)
        <li class='alert alert-danger delay'>{{ $error }}</li>
      @endif
    @endforeach
  @endif
</ul>
</body>

</html>


