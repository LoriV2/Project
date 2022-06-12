<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>


<script src="https://js.pusher.com/7.1/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dc89faadd64e9671ab01', {
        cluster: 'eu'
    });

    var channel = pusher.subscribe('message-board');
    channel.bind('Chat-Event', function(data) {
        document.location.reload(true)
    });
</script>



<body style="background-color:#7A7E7E" onLoad="window.scroll(0, 10000000000000000000)">
    <div id="message-board" ;>
        @foreach($messages as $messages)
        <p>{{$messages->user_name}}
            @if ($messages->zweryfikowany == 2)
            {{"😎"}}
            @else
            {{"🤣"}}
            @endif
            : {{$messages->message}}
        </p>
        <p></p>
        @endforeach
    </div>
    <div style="background-color:#8D8B8B; width:30%">
        @auth
        <form method="POST" action="/sendverified">
            <p>Zacznij wpisywać wiadomość</p>
            <input type="text" name="message">
            <input type="submit">
            {{ csrf_field() }}
        </form>
        @else
        <form method="POST" action="/sendnonverified">
            <input type="text" name="user_name" placeholder="Wpisz swój nick">
            <input type="text" name="message">
            <input type="submit">
            {{ csrf_field() }}
        </form>
        @endauth
    </div>
</body>