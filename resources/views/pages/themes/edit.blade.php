@extends('layout.dashboard')

@section('title', 'edit theme')
@section('main')
  <form class="flex flex-col gap-4 rounded px-4 py-2 shadow dark:bg-gray-600 sm:mx-8" method="POST"
    enctype="multipart/form-data" action="{{ route('themes.update', $theme->id) }}">
    @csrf

    <input class="w-full" name="color" type="text" value="{{ $theme->color }}" placeholder="color">
    <input class="form-input w-full p-0 pr-5 file:border-none file:p-2 file:hover:cursor-pointer" name="image"
      name="image" type="file" placeholder="image">
    <input class="w-full" name="in_stock" type="number" value="{{ $theme->in_stock }}" placeholder="in_stock">
    <div class="form-input flex w-full items-center justify-between gap-2 accent-fuchsia-500">
      <input class="h-3 w-full rounded-md" name="rating" type="range" min="0" max="5" step="0.1"
        oninput="ratingOutput.value = rating.value">
      <output class="w-8 whitespace-nowrap" name="ratingOutput"></output>
    </div>
    <input name="product_id" type="hidden" value="{{ $theme->products_id }}">
    <input name="_method" type="hidden" value="PATCH">
    <button class="rounded bg-teal-500 px-4 py-2" type="submit">save</button>
  </form>
@endsection
