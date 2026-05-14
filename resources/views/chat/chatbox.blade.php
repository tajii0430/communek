<!DOCTYPE html>
<html>

<head>

    <title>Chat with {{ $receiver->name }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-form {
            display: flex;
            padding: 20px;
            gap: 10px;
            border-top: 1px solid #ddd;
        }

        .chat-form input {
            flex: 1;
            padding: 14px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }

        .chat-form button {
            background: #2563eb;
            color: white;
            border: none;
            padding: 14px 20px;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="chat-container">

        <div class="chat-header">
            Chat with {{ $receiver->name }}
        </div>

        <div class="chat-body" id="chatBody">

            @foreach($messages as $message)

            <div class="message {{ $message->sender_id == auth()->id() ? 'mine' : 'other' }}">
                {{ $message->message }}
            </div>

            @endforeach

        </div>

        <form action="{{ url('/send-message') }}" method="POST" class="chat-form">

            @csrf

            <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">

            <input type="text" name="message" placeholder="Type message..." required>

            <button type="submit">
                Send
            </button>

        </form>

    </div>

    <script>
        let chatBody = document.getElementById('chatBody');
        chatBody.scrollTop = chatBody.scrollHeight;
    </script>

</body>

</html>