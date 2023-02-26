@extends('layouts/main')

@section('container')
    <body class="container">
        <section class="vh-100" style="background-color: #508bfc;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
          
                      <h3 class="mb-5">N Parking Input Page</h3>
                      <div class="form ">
                        <form action="/login" method="post">
                            @csrf
                            Email
                            <input type="text" name="email" id=""
                            class="form-control @error('email') is-invalid @enderror">
                            @error('email')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                            Password
                            <input type="password" name="password" id=""
                            class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                            <button type="submit">Sign In</button>
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </body>
@endsection
