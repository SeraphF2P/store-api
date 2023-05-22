@extends('layout.master')


@section('main')
    <main class="h-screen w-full">
        <section class="fixed top-0 right-0 h-screen w-full max-w-xs bg-indigo-400">
            <ul class="w-full divide-y-4 divide-indigo-500 pt-8">
                <li class="relative bg-red-400 p-4">
                    <span class="absolute top-0 left-0 h-full w-2 bg-red-500"></span>
                    <a href="{{ route('store.create') }}">add new product</a>
                </li>
                <li class="relative bg-red-400 p-4">
                    <span class="absolute top-0 left-0 h-full w-2 bg-red-500"></span>
                    <a href="{{ route('store.index') }}">show products</a>
                </li>
                <li class="relative bg-red-400 p-4">
                    <span class="absolute top-0 left-0 h-full w-2 bg-red-500"></span>
                    <a href="{{ route('logout') }}">log out</a>
                </li>
            </ul>
        </section>
        @if (session()->has('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </main>
@endsection
