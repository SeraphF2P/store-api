@extends('layout.master')

@section('title', 'add new theme')
@section('main')
  <form class="mx-4 flex max-w-xs flex-col gap-4 rounded px-4 py-2 shadow dark:bg-gray-600 sm:mx-8" method="POST"
    enctype="multipart/form-data" action="{{ route('themes.update', $theme->id) }}">
    @csrf

    <input name="color" type="text" value="{{ $theme->color }}" placeholder="color">
    <input name="product_image_url" type="file"  placeholder="product_image_url">
    <input name="in_stock" type="number" value="{{ $theme->in_stock }}" placeholder="in_stock">
    <input name="product_id" type="hidden" value="{{ $theme->product_id }}">
    <input name="_method" type="hidden" value="PATCH">
    <button class="rounded bg-teal-500 px-4 py-2" type="submit">save</button>
  </form>
@endsection
