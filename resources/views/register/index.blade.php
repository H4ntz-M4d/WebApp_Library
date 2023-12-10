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

        <main class="form-registration w-100 m-auto">
            <h1 class="h3 mb-3 fw-normal text-center mt-5">Registration Form</h1>
            <form action="/register" method="POST">
                @csrf

              <div class="form-floating">
                  <label for="name">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>

              <div class="form-floating">
                  <label for="username">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>

              <div class="form-floating">
                  <label for="floatingInput">Email address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>

              <div class="form-floating">
                  <label for="floatingPassword">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>


              <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Register</button>
            </form>
            <small>Already Registered? <a href="/login">Login Now!</a></small>
        </main>
    </div>
</div>

@endsection
