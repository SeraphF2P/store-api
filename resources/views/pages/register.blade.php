@extends('layout.master')

@section('title', 'register')

@section('main')
  <div>
    <form class="flex flex-col items-center justify-center gap-4 bg-slate-100 p-4 shadow" action="/login" method="post">
      <h1>register</h1>
      @csrf
      <div class="form-group">
        <label class="sr-only" for="name">Name:</label>
        <input id="name" name="name" type="text"
          title="Please enter a valid name (letters and spaces only) with a length between 3 and 20 characters"
          min="3" max="20" pattern="[A-Za-z\s]{3,20}" placeholder="Name">
      </div>
      <div class="form-group">
        <label class="sr-only" for="password">Password:</label>
        <input id="password" name="password" type="password"
          title="Please enter a valid password with at least one letter, one number and a length between 8 and 12 characters"
          min="8" max="12" placeholder="Password">
      </div>
      <button class="btn btn-success" type="submit">Submit</button>
    </form>
  </div>
@endsection
