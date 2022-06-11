<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Leeee</title>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="pr-3 navbar-brand" href="https://heheeeee.herokuapp.com/"><img style="max-height: 90px; margin-left:10px;" src='favicon.ico' /></a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://heheeeee.herokuapp.com/">Home</a>
            </li>
            <li class="nav-item">

            </li>
            <li style="align-content:right ;" class="nav-item">
                @auth
                <a href="{{ url('/dashboard') }}" class="nav-link active">Pliki i konto</a>
                @else
                <a href="{{ route('login') }}" class="nav-link active">Log in</a>


            </li>
            <li class="nav-item">
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="nav-link active">Register</a>
                @endif
                @endauth
            </li>
            <li>
                <a href="{{route('chat')}}" class="nav-link active">Chat</a>
            </li>
        </ul>
</nav>

<body class="antialiased bg-light ">


    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('dc89faadd64e9671ab01', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('message-board');
        channel.bind('Chat-Event', function(data) {
                    console.log(data.message);
                    board = document.getElementById('message-board');
                    board.insertAdjacentHTML(
                        'beforeend',
                        `<span style="background-color: lime">,`, data.message ,`</span>`,)
                    });
    </script>
    </head>

    <form method="POST" action="/send">
        <input type="text" name="message">
        <input type="submit">
        {{ csrf_field() }}
    </form>
    <div id="message-board">

    </div>

</body>

</html>