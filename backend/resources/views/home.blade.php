@extends('layouts.app')

@section('content')
  <h1 class="text-center">🌤 Weather Dashboard</h1>

  <!-- Search Form -->
  <form action="/search" method="POST" class="row mt-4">
    @csrf
    <div class="col-md-4">
      <input type="text" name="city" class="form-control" placeholder="Enter city name">
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100">Search</button>
    </div>
  </form>

  <!-- Alerts -->
  @if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
  @endif

  <!-- Weather Logs -->
  <h3 class="mt-5">Recent Weather Logs</h3>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>City</th>
        <th>Temperature (°C)</th>
        <th>Recorded At</th>
        <th>Prediction</th>
      </tr>
    </thead>
    <tbody>
      @foreach($logs as $log)
        <tr>
          <td>{{ $log->city }}</td>
          <td>{{ $log->temperature }}</td>
          <td>{{ $log->recorded_at }}</td>
          <td>
            @if(session('success') && str_contains(session('success'), $log->city))
              {{ explode('Prediction: ', session('success'))[1] ?? 'N/A' }}
            @else
              N/A
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <!-- Map & Chart -->
  <div class="row mt-4">
    <div class="col-md-6">
      <div id="map" style="height: 300px;"></div>
    </div>
    <div class="col-md-6">
      <canvas id="tempChart"></canvas>
    </div>
  </div>
@endsection

