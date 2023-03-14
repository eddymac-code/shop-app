@extends('layouts.guest')

@section('content')
    <div class="container">
        <div class="mx-auto my-4 col-md-4 shadow rounded">
            <div class="p-2 text-dark">
                <div class="p-2">
                    <h3>Sign In</h3>
                </div>
                @if (session('error'))
                    <div class="bg-danger text-light rounded px-4 py-3 text-center">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control @error('email')
                      border border-danger @enderror" value="{{ old('email') }}" id="email" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        @error('email')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control @error('password')
                      border border-danger @enderror" id="password">
                        @error('password')
                            <div class="text-danger mt-2 fs-6">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                      <input type="checkbox" name="remember" class="form-check-input" id="remember">
                      <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection