<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite('resources/css/app.css')
  <title>@yield('title')</title>
</head>

<body class="h-screen w-full antialiased dark:bg-gray-700">

  <main class="inline-flex w-full [grid-template:'1fr_1fr']">
    <section
      class="nav top-0 left-0 flex h-screen w-full max-w-xs translate-x-0 flex-col justify-center divide-y-4 bg-slate-100 shadow transition-transform duration-700">
      <button class="absolute top-0 right-0 h-8 w-8 -translate-x-10 duration-300 hover:scale-105"
        onclick="
     const nav = document.querySelector('.nav');
     const navbtn = document.querySelector('.navbtn');
     const navbtnbg = document.querySelector('.navbtnbg');
     const mainContain = document.querySelector('.main-contain');
     nav.classList.toggle('!-translate-x-[calc(100%-32px)]');
     navbtn.classList.toggle('!-rotate-[135deg]');
     navbtnbg.classList.toggle('!translate-x-8');

      ">

        <div class="navbtnbg absolute rounded-full border-4 border-amber-400 bg-amber-300 p-4 transition-transform">
          <div
            class="navbtn h-6 w-6 rotate-45 rounded border-4 border-t-0 border-r-0 border-black transition-transform duration-300">
          </div>
        </div>
      </button>
      {{-- </div> --}}
      <a class="relative bg-fuchsia-600 bg-opacity-30 p-4 transition-colors hover:bg-opacity-100"
        href="{{ route('store.create') }}">add new product</a>
      <a class="relative bg-fuchsia-600 bg-opacity-30 p-4 transition-colors hover:bg-opacity-100"
        href="{{ route('store.index') }}">show products</a>
      <a class="relative bg-fuchsia-600 bg-opacity-30 p-4 transition-colors hover:bg-opacity-100"
        href="{{ route('users.index') }}">users</a>
      <a class="relative bg-fuchsia-600 bg-opacity-30 p-4 transition-colors hover:bg-opacity-100"
        href="{{ route('users.create') }}">create new user</a>
      <a class="relative bg-fuchsia-600 bg-opacity-30 p-4 transition-colors hover:bg-opacity-100"
        href="{{ route('logout') }}">log out</a>


    </section>
    <div class=" w-full">
      <section class="flex h-20 w-full items-center justify-center bg-stone-100">
        <h1 class=" font-bold text-4xl capitalize ">@yield('title')</h1>
      </section>
      <section
        class="remove-scroll-bar max-h-[calc(100vh-80px)] w-full overflow-y-scroll  bg-slate-300 p-1 sm:p-4">
        @yield('main')
      </section>
    </div>



  </main>



  <ul
    class="toast-container remove-scroll-bar pointer-events-none fixed top-0 right-0 isolate flex h-screen flex-col gap-4 overflow-hidden overflow-y-scroll pt-8 pr-8">
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
