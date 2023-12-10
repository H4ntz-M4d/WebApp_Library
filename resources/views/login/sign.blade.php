@extends('bukus.layout')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <main class="form-signin w-100 m-auto">
            <form action="/login" method="POST">
                @csrf
              <h1 class="h3 mb-3 fw-normal text-center mt-5">Please sign in</h1>

              <div class="form-floating">
                  <label for="email">Email address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>

              <div class="form-floating">
                  <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              </div>


              <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            </form>
            <small>Not Registered? <a href="/register">Register Now!</a></small>
        </main>
    </div>
</div>

@endsection
