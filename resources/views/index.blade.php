@extends('layouts/main')

@section('container')
        <section class="vh-100" style="background-color: #508bfc;">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
          
                      <h3 class="mb-5">N Parking Input Page</h3>
                      <div class="form ">
                        @auth
                          
                        <form action="/input" method="post">
                            @csrf
                            Input Plate
                            <input type="text" name="plate" id=""
                            class="form-control @error('plate') is-invalid @enderror">
                            @error('plate')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                            @enderror
                            <button type="submit">Submit</button>
                        </form>
                        @if (session()->has('code'))
                            {{ session('code') }}
                        @endif
                        <form action="/cost" method="post">
                            @csrf
                            <input type="text" name="code" id=""
                            class="form-control @error('code') is-invalid @enderror">
                            <button type="submit">Evaluate Cost</button>
                        </form>
                        <hr class="border-top"/>
                        @if (session()->has('return_info'))
                            Cost:{{ session('return_info')['cost'] }}
                            Code:{{ session('return_info')['code'] }}
                              <form action="/record" method="post">
                                  @csrf
                                  Plate Number
                                  <input type="text" name="plate" id="" readonly class="form-control form-control-lg"
                                  value="{{ session('return_info')['plate'] }}">                    
                                  Unique Code
                                  <input type="text" name="code" id="" readonly class="form-control form-control-lg"
                                  value="{{ session('return_info')['code'] }}">
                                  Parking Cost
                                  <input type="text" name="parking_cost" id="" readonly class="form-control form-control-lg"
                                  value="{{ session('return_info')['cost'] }}">
                                  Amount Paid
                                  <input type="text" name="amount_paid" id="" class="form-control form-control-lg"
                                  >
                                  <button type="submit">Input Record</button>
                              </form>
                        @endif
                        @else
                            <a href="/login">Sign in</a> to access
                        @endauth
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
@endsection