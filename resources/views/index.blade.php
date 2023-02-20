<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}
        ">
    
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <body class="container">
        Nv
        <div class="form ">
            <form action="/input" method="post">
                @csrf
                <input type="text" name="plate" id="">
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
            @if (session()->has('return_info'))
                {{ session('return_info')['cost'] }}
                {{ session('return_info')['code'] }}
            @endif
            //form insert ke record
        </div>
    </body>
</html>
