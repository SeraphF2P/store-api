@extends('layout.dashboard')

@section('title', 'product themes')

@section('main')

  @if (isset($themes))
    <table class="w-full">
      <thead class="sticky top-0 bg-slate-200">
        <tr>
          <th class="p-1 py-3 sm:p-4">id</th>
          <th class="p-1 py-3 sm:p-4">color</th>
          <th class="p-1 py-3 sm:p-4">image</th>
          <th class="p-1 py-3 sm:p-4">in_stock</th>
          <th class="p-1 py-3 sm:p-4">rating</th>
          <th class="p-1 py-3 sm:p-4">action</th>
        </tr>
        <div class="flex w-full items-center justify-center p-2">
          <a class="whitespace-nowrap rounded bg-teal-500 px-4 py-2 shadow transition-all duration-200 hover:scale-105 hover:overflow-auto hover:bg-teal-400 active:scale-95 active:bg-teal-400"
            href="{{ route('themes.add', $products_id) }}">add
            theme</a>
        </div>
      </thead>
      <tbody>
        @foreach ($themes as $t)
          <tr>
            <th class="p-1 py-3 sm:p-4">{{ $t->id }}</th>

            <td class="p-1 py-3 sm:p-4">{{ $t->color }}</td>
            <td class="p-1 py-3 sm:p-4">
              <div class="relative h-16">
                <img class="absolute top-0 left-0 h-full w-full max-w-full object-cover"
                  src="{{ asset('storage/' . $t->image) }}" alt="">
              </div>
              {{-- <span class="max-w-[60px] truncate hover:overflow-visible">{{ $t->image }}</span> --}}
            </td>


            <td class="p-1 py-3 sm:p-4">{{ $t->in_stock }}</td>
            <td class="p-1 py-3 sm:p-4">{{ $t->rating }}</td>

            <td class="flex gap-2 p-1 py-3 sm:p-4">
              <a class="btn btn-info" href="{{ route('themes.edit', $t->id) }}">edit</a>
              <form action="{{ route('themes.destroy', $t->id) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">delete</button>
              </form>
            </td>


          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p class="bg-red-400 p-8">No themes found.</p>
  @endif

@endsection
