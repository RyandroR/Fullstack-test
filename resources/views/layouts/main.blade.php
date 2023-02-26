<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title }}</title>
    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    </head>
    <nav class="navbar navbar-expand-lg navbar-dark p-0">
        <div class="container-fluid p-0" id="navbarNav">
          <div class="logo w-100 h-100 text-center">
            <h1>
              <a href="/">
                N Parking
              </a>
            </h1>
          </div>

            @auth
            <form action="/logout" method="post">
              @csrf
              <button type="submit">
                Logout
              </button>
            </form>
            @else
                <a class="nav-link {{ $title == 'Login' ? 'active' : '' }}" href="/login">Login</a>
                <a class="nav-link {{ $title == 'Register' ? 'active' : '' }}" href="/register">Register</a>
            @endauth
            @can('admin')
              <a class="nav-link {{ $title == 'Record' ? 'active' : '' }}" href="/record">Record</a>
            @endcan
        </div>
    </nav>
    <body class="container">
        @yield('container')
    </body>
</html>
