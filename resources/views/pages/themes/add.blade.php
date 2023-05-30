@extends('layout.dashboard')

@section('title', 'add new theme')
@section('main')
  <form class="mx-4 flex flex-col gap-4 rounded bg-gray-600 px-4 py-2 shadow sm:mx-8" method="post"
    enctype="multipart/form-data" action="{{ route('themes.store') }}">
    @csrf
    <div class="flex gap-4">
      <div class="form-input w-full">
        <input class="w-full" name="color" type="color" placeholder="color">

      </div>
      <input class="form-input w-full p-0 pr-5 file:border-none file:p-2 file:hover:cursor-pointer" name="image"
        type="file">
    </div>
    <div class="flex gap-4">
      <input class="w-full" name="in_stock" type="number" placeholder="in_stock">
      <input class="w-full" name="seller_name" type="hidden" value="{{ $seller_name }}">
   
      <input name="products_id" type="hidden" value="{{ $products_id }}">
    </div>

    <button class="rounded bg-teal-500 px-4 py-2" type="submit">add</button>
  </form>
@endsection
