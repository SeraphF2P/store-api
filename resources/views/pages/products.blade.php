@extends('layout.master')

@section('title', 'products')

@section('main')
  <main>
    @if (isset($products))
      <div>
        <div class="sm:nx-4 remove-scroll-bar mx-2 max-h-[70vh] overflow-y-scroll rounded bg-slate-300 p-1 sm:p-4">
          <table>
            <thead class="sticky top-0 bg-slate-200">
              <tr>
                <th class="p-1 py-3 sm:p-4">id</th>
                <th class="p-1 py-3 sm:p-4">name</th>
                <th class="p-1 py-3 sm:p-4">price</th>
                <th class="p-1 py-3 sm:p-4">category</th>
                <th class="p-1 py-3 sm:p-4">seller_name</th>
                <th class="p-1 py-3 sm:p-4">description</th>
                <th class="p-1 py-3 sm:p-4">action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $p)
                <tr>
                  <th class="p-1 py-3 sm:p-4">{{ $p->id }}</th>
                  <td class="p-1 py-3 sm:p-4">{{ $p->name }}</td>
                  <td class="p-1 py-3 sm:p-4">{{ $p->price }}</td>
                  <td class="p-1 py-3 sm:p-4">{{ $p->category }}</td>
                  <td class="p-1 py-3 sm:p-4">{{ $p->seller_name }}</td>
                  <td class="truncate p-1 hover:overflow-auto sm:p-4">{{ $p->description }}</td>
                  <td class="flex justify-center gap-2 whitespace-nowrap p-1 py-3 sm:p-4">
                    <a class="btn btn-success" href="{{ route('themes.show', $p->id) }}">themes</a>

                    <a class="btn btn-info" href="{{ route('store.edit', $p->id) }}">edit</a>

                    <form action="{{ route('store.destroy', (int) $p->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">delete</button>

                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @else
      <p class="bg-red-400 p-8">No products found.</p>
    @endif

  </main>
@endsection
