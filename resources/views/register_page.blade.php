@extends('layouts/main')

@section('container')
        <div class="form ">
                <form action="/register" method="post">
                    @csrf
                    Email
                    <input type="text" name="email" id=""
                    value="{{ old('email') }}">                    
                    Password
                    <input type="password" name="password" id="">

                    <button type="submit">Register</button>
                </form>
        </div>
@endsection