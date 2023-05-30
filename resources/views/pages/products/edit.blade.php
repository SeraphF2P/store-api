@extends('layout.dashboard')

@section('title', 'edit product')

@section('main')
  <form class="mx-4 flex flex-col gap-4 rounded px-4 py-2 shadow dark:bg-gray-600 sm:mx-8" method="POST"
    action="{{ route('store.update', $product->id) }}">
    @csrf
    @method('PUT')
    <div class="flex gap-4">
      <input class="w-full" name="name" type="text" value="{{ $product->name }}" placeholder="name">
      <input class="w-full" name="price" type="number" value="{{ $product->price }}" placeholder="price">
    </div>
    <div class="flex gap-4">
      <input class="w-full" name="category" type="text" value="{{ $product->category }}" placeholder="category">
      <input class="w-full" name="description" type="text" value="{{ $product->description }}"
        placeholder="description">

    </div>
    <input name="seller_name" type="hidden" value="{{ $product->seller_name }}">
    <button class="rounded bg-teal-500 px-4 py-2" type="submit">add</button>
  </form>
@endsection
