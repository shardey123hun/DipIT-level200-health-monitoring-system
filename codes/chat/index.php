<?php
$receiver=$_GET['user'];
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient-Doctor Chat</title>
    <link rel="stylesheet" href="chat.css">
</head>
<body>
   
    <div class="container">

        <main class="main-content">
            <section class="chat-section">
                <div class="chat-header">
                    <h3>Chat with Doctor</h3>
                </div>
                <div class="chat-window" id="chat-window">
                    <!-- Messages will be appended here -->
                </div>
                <div class="chat-input">
                    <input type="text" id="message-input" placeholder="Type your message...">
                    <button id="send">Send</button>
                    <input type="hidden" value="<?=$receiver?>" id="receiver">
            <input type="hidden" value="<?=$_SESSION['id']?>" id="user_id">
                </div>
            </section>
        </main>
    </div>
    <script src="chat.js"></script>
    <!-- <script>
        const socket = new WebSocket('ws://yourserver.com/chat'); // Replace with your WebSocket server URL

        socket.onmessage = function(event) {
            const chatWindow = document.getElementById('chat-window');
            const message = document.createElement('div');
            message.className = 'message';
            message.innerText = event.data;
            chatWindow.appendChild(message);
            chatWindow.scrollTop = chatWindow.scrollHeight;
        };

        function sendMessage() {
            const input = document.getElementById('message-input');
            if (input.value.trim() !== '') {
                socket.send(input.value);
                const chatWindow = document.getElementById('chat-window');
                const message = document.createElement('div');
                message.className = 'message patient-message';
                message.innerText = input.value;
                chatWindow.appendChild(message);
                chatWindow.scrollTop = chatWindow.scrollHeight;
                input.value = '';
            }
        }
    </script> -->
</body>
</html>
