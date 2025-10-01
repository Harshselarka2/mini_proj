@extends('layouts.app')

@section('content')
  <h2>Search Weather</h2>
  <form action="#" method="GET">
    <div class="input-group">
      <input type="text" name="city" class="form-control" placeholder="Enter city">
      <button class="btn btn-success">Search</button>
    </div>
  </form>

  <div class="mt-4 alert alert-info">
    Dummy Result: Showing weather for <strong>Mumbai</strong> 🌤
  </div>
@endsection

