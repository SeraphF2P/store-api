@extends('layout.dashboard')

@section('title', 'users')

@section('main')

  @if (isset($users))

    <table class="w-full">
      <thead class="sticky top-0 bg-slate-200">
        <tr>
          <th class="p-1 py-3 sm:p-4">id</th>
          <th class="p-1 py-3 sm:p-4">name</th>
          <th class="p-1 py-3 sm:p-4">role</th>
          <th class="p-1 py-3 sm:p-4">email</th>
          {{-- <th class="p-1 py-3 sm:p-4">email_verified_at</th> --}}
          <th class="p-1 py-3 sm:p-4">gender</th>
          <th class="p-1 py-3 sm:p-4">phone</th>
          <th class="p-1 py-3 sm:p-4">address</th>
          <th class="p-1 py-3 sm:p-4">action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <th class="p-1 py-3 sm:p-4">{{ $user->id }}</th>
            <td class="p-1 py-3 sm:p-4">{{ $user->name }}</td>
            <td class="p-1 py-3 sm:p-4">{{ $user->role }}</td>
            <td class="p-1 py-3 sm:p-4">{{ $user->email }}</td>
            {{-- <td class="p-1 py-3 sm:p-4">{{ $user->email_verified_at ?? '#####' }}</td> --}}
            <td class="p-1 py-3 sm:p-4">{{ $user->isMale ? 'male' : 'female' }}</td>
            <td class="truncate p-1 hover:overflow-auto sm:p-4">{{ $user->phone ?? '00000' }}</td>
            <td class="truncate p-1 hover:overflow-auto sm:p-4">{{ $user->address ?? '-' }}</td>
            <td class="flex justify-center gap-2 whitespace-nowrap p-1 py-3 sm:p-4">


              <a class="btn btn-info" href="{{ route('users.edit', $user->id) }}">edit</a>

              <form action="{{ route('users.destroy', (int) $user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">delete</button>

              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p class="bg-red-400 p-8">No users found.</p>
  @endif


@endsection
