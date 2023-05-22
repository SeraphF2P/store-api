@extends('layout.master')

@section('title', 'add new theme')
@section('main')
  <form class="mx-4 flex max-w-xs flex-col gap-4 rounded px-4 py-2 shadow dark:bg-gray-600 sm:mx-8" method="post"
    enctype="multipart/form-data" action="{{ route('themes.store') }}">
    @csrf
    <input class="form-input" name="color" type="text" placeholder="color">
    <input class="form-input p-0 file:border-none file:p-2 file:hover:cursor-pointer" name="image" type="file"
      placeholder="image">
    <input class="form-input" name="in_stock" type="number" placeholder="in_stock">
    <input class="form-input" name="seller_name" type="text">
    <input name="product_id" type="hidden" value="{{ $product_id }}">

    <button class="rounded bg-teal-500 px-4 py-2" type="submit">add</button>
  </form>
@endsection
