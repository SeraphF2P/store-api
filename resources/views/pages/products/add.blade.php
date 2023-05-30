@extends('layout.dashboard')

@section('title', 'add new product')

@section('main')
  <form class="mx-4 flex flex-col rounded shadow dark:bg-gray-600 sm:mx-8" enctype="multipart/form-data" method="POST"
    action="{{ route('store.store') }}">
    @csrf
    <div class="flex gap-4 p-2">

      <div class="flex w-full flex-col gap-4">
        <input name="name" type="text" placeholder="name">
        <input name="price" type="number" placeholder="price">
        <select id="" name="category">
          <option value="shoes">shoes</option>
          <option value="accessories">accessories</option>
          <option value="electronics">electronics</option>
          <option value="jewelrys">jewelrys</option>
          <option value="men's clothing">men's clothing</option>
          <option value="women's clothing">women's clothing</option>
        </select>
        <input name="description" type="text" placeholder="description">
      </div>
      <div class="flex w-full flex-col gap-4">
        <input name="color" type="text" placeholder="color">
        <input class="form-input p-0 file:border-none file:p-2 file:hover:cursor-pointer" name="image" type="file"
          placeholder="image">
        <input name="in_stock" type="number" placeholder="in_stock">
        <select class="form-select" name="seller_id">
          <option disabled selected>seller</option>
          @foreach ($sellers as $seller)
            <option value="{{ $seller->id }}">{{ $seller->name }}</option>
          @endforeach
        </select>
        <div class="form-input flex w-full items-center justify-between gap-2 accent-fuchsia-500">
          <input class="h-3 w-full rounded-md" name="rating" type="range" min="0" max="5" step="0.1"
            oninput="ratingOutput.value = rating.value">
          <output class="w-8 whitespace-nowrap" name="ratingOutput"></output>
        </div>
      </div>

    </div>

    <button class="btn btn-success my-2 mx-8" type="submit">add</button>

  </form>
@endsection
