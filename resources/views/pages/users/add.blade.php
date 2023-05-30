@extends('layout.dashboard')

@section('title', 'add new user')
@section('main')
  <form class="mx-4 rounded bg-gray-600 shadow sm:mx-8" method="post" enctype="multipart/form-data"
    action="{{ route('users.store') }}">
    @csrf
    <div class="flex gap-1 p-2">
      <div class="flex flex-col w-full gap-1">
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <input name="password_confirmation" type="password" placeholder="confirmation_password">
      </div>

      <div class="flex flex-col w-full gap-1">
        <div class="form-input">
          <label for="isMale">is male</label>
          <input id="isMale" name="isMale" type="checkbox" value="{{ true }}">
        </div>
        <input name="phone" type="text" placeholder="phone">
        <input name="address" type="text" placeholder="address">

        <select class="form-select" name="role">
          <option value="seller">seller</option>
          <option value="guest">guest</option>
        </select>

      </div>
    </div>

    <button class="btn btn-success w-full" type="submit">add</button>


  </form>
@endsection
