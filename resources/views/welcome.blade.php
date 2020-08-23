<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col align-content-center">
                @auth
                    <a href="{{ url('logout') }}" class="btn btn-primary">Logout</a>
                    <a href="{{ url('calendar') }}" class="btn btn-success">Go To Calendar</a>
                @else
                    <a href="{{ url('login') }}" class="btn btn-primary">Login</a>
                @endauth
            </div>
        </div>
    </div>
</body>
<script src="{{ url('js/app.js') }}"></script>
</html>
