@extends('layout.dashboard')

@section('title', 'edit user')
@section('main')
  <form class="mx-4 rounded shadow dark:bg-gray-600 sm:mx-8" method="post" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="flex gap-1 p-2">
      <div class="flex w-full flex-col gap-1">
        <input class="w-full" name="name" type="text" value="{{ $user->name }}" placeholder="name">
        <input class="w-full" name="email" type="text" value="{{ $user->email }}" placeholder="email">
        <input class="w-full" name="password" type="password" value="{{ $user->password }}" placeholder="password">
      </div>

      <div class="flex w-full flex-col gap-1">
        <div class="form-input w-full">
          <label for="isMale">is male</label>
          <input id="isMale" name="isMale" type="checkbox" value="{{ $user->isMale }}">
        </div>
        <input class="w-full" name="phone" type="text" value="{{ $user->phone }}" placeholder="phone">
        <input class="w-full" name="address" type="text" value="{{ $user->address }}" placeholder="address">
        <select class="w-full" name="role">
          <option class="w-full" value="guest" selected="{{ $user->role == 'guest' }}">guest</option>
          <option class="w-full" value="seller" selected="{{ $user->role == 'seller' }}">seller</option>
        </select>

      </div>
    </div>

    <button class="w-full rounded bg-teal-500 px-4 py-2" type="submit">add</button>


  </form>
@endsection
