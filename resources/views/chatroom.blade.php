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



<body onLoad="window.scroll(0, 1000000)">
    <div id="message-board">
        @foreach($messages as $messages)
        <p>{{$messages->user_name}}
            @if ($messages->zweryfikowany == 2)
            {{"😎"}}
            @else
            {{"🤣"}}
            @endif
            : </p>
        <p>{{$messages->message}}</p>
        <p></p>
        @endforeach
    </div>
<div style="background-color:black ;">
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