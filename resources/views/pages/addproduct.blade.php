@extends('layout.master')

@section('title', 'add new product')

@section('main')
  <form class="mx-4 flex flex-col rounded shadow dark:bg-gray-600 sm:mx-8" enctype="multipart/form-data" method="POST"
    action="{{ route('store.store') }}">
    @csrf
    <div class="flex gap-4 p-2">
      <div class="flex flex-col gap-4">
        <input class="form-input" name="name" type="text" placeholder="name">
        <input class="form-input" name="price" type="number" placeholder="price">
        <input class="form-input" name="category" type="text" placeholder="category">
        <input class="form-input" name="description" type="text" placeholder="description">
      </div>
      <div class="flex flex-col gap-4">
        <input class="form-input" name="color" type="text" placeholder="color">
        <input class="form-input p-0 file:border-none file:p-2 file:hover:cursor-pointer" name="image" type="file"
          placeholder="image">
        <input class="form-input" name="in_stock" type="number" placeholder="in_stock">
        <input class="form-input" name="seller_name" type="text">
      </div>
    </div>

    <button class="btn btn-success my-2 mx-8" type="submit">add</button>

  </form>
@endsection
