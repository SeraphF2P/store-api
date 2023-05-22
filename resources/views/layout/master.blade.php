<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite('resources/css/app.css')
  <title>@yield('title')</title>
</head>

<body class="flex h-screen items-center justify-center antialiased dark:bg-gray-700">
  @yield('main')

  <ul
    class="toast-container remove-scroll-bar pointer-events-none fixed top-0 right-0 isolate flex h-screen flex-col gap-4 overflow-hidden overflow-y-scroll pt-8 pr-8">
    {{-- @error('product_image_url')
      <li class="alert alert-danger">{{ $message }}</li>
    @enderror --}}
    @if (session()->has('error'))
      <li class="alert alert-danger">{{ session('error') }}</li>
    @endif
    @if (session()->has('success'))
      <li class="alert alert-success">{{ session('success') }}</li>
    @endif
    @if (session()->has('info'))
      <li class="alert alert-info">{{ session('info') }}</li>
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
