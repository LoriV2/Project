<div id="message-board">
    @foreach($messages as $message)
    <p>echo $message->User_name;

    </p>
    <p>echo $message->message;</p>
    @endforeach
</div>