@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="p-5 mt-5 mb-4 bg-light border rounded-3">
            <div class="container-fluid py-5">
              <h1 class="display-5 fw-bold">{{ \App\Models\Setting::where('setting_key', 'shop_name')->first()->setting_value }}</h1>
              <p class="col-md-8 fs-4">Make running your retail business a breeze!</p>
              <a class="btn btn-primary btn-lg" href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>
@endsection