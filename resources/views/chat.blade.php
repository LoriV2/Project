<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Leeee</title>

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

<body class="antialiased bg-dark ">

    <div style="width:100%;margin-top:1%;margin-left:1%;margin-right:1%;" class="container bg-white shadow-xl sm:rounded-lg">
        <div class="row mt-3">
            <div class="col-6 offset-3">
                <div class="card">
                    <div class="card-header">
                        Chat pokój
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form control" placeholder="Twoje imie" id="Name">
                        </div>
                        <div style="padding-top:10px ;" class="form-group" id="data-message">

                        </div>
                        <div class="form-group">
                            <textarea id="message" class="form-control" placeholder="Twoja wiadomość"></textarea>
                        </div>
                        <div class="form-group">
                            <button id="przycisk" class="btn btn-block btn-primary">
                                Wyślij
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('js/app.js') }}"></script>
    <script>
        event(new ChatEvent('hello world'));
        $(function() {
            const Http = window.axios;
            const Echo = window.Echo;
            const name = $("#name");
            const message = $("#message");
            let value = '';

            $("input, textarea").keyup(function() {
                $(this).removeClass('is-invalid');
            });

            $('#przycisk').click(function() {
                if (name.val() == '') {
                    name.addClass('is-invalid');
                } else if (message.val() == '') {
                    message.addClass('is-invalid')
                } else {
                    Http.post("{{ url('send')}}", {
                        'name': name.val(),
                        'message': message.val()
                    }).then(() => {
                        message.val('');
                    });
                }
            });

            let channel = Echo.channel('channel-chat');
            channel.listen('ChatEvent', function(data) {
                $('#data-message').append('<p>${data.message.name}</p> : ${data.message.message} <br>');

            })
        })
    </script>
</body>

</html>