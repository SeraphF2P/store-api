@extends('layout.master')

@section('title', 'edit product')

@section('main')
    <form class="mx-4 flex max-w-xs flex-col gap-4 rounded px-4 py-2 shadow dark:bg-gray-600 sm:mx-8" method="POST"
        action="{{ route('store.update', $product->id) }}">
        @csrf
        @method('PUT')
        <input name="name" type="text" value="{{ $product->name }}" placeholder="name">
        <input name="price" type="number" value="{{ $product->price }}" placeholder="price">
        <input name="category" type="text" value="{{ $product->category }}" placeholder="category">
        <input name="description" type="text" value="{{ $product->description }}" placeholder="description">
        <input name="seller_name" type="hidden" value="{{ $product->seller_name }}">
        {{-- <input name="_method" type="hidden" value="PATCH"> --}}
        <button class="rounded bg-teal-500 px-4 py-2" type="submit">add</button>
    </form>
@endsection
