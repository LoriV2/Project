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


<div id="message-board">
    @foreach($message as $messages)
    <p>{{$message->User_name}}

    </p>
    <p>{{$message->message}}</p>
    @endforeach
</div>