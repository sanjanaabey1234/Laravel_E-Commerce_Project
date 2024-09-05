@extends('layouts.user')

@section('showHeroSection', false)

@section('content')
<div class="wrapper">
    <h1>Chat Bot</h1>

    <style>
        /* Basic styles for the chat interface */
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        .chat-container { 
            max-width: 600px; 
            margin: 50px auto; 
            padding: 20px; 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            background-color: #fff; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
        }
        .chat-box { 
            border: 1px solid #ddd; 
            border-radius: 10px; 
            height: 300px; 
            overflow-y: scroll; 
            padding: 15px; 
            background: #f9f9f9; 
            margin-bottom: 20px; 
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); 
            animation: fadeIn 0.5s ease-out; 
        }
        .chat-input { 
            width: calc(100% - 22px); 
            padding: 10px; 
            border: 1px solid #ddd; 
            border-radius: 5px; 
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.1); 
        }
        .chat-message { 
            margin: 10px 0; 
            padding: 10px; 
            border-radius: 10px; 
            background: #e9ecef; 
            max-width: 80%; 
            animation: slideIn 0.3s ease-out; 
        }
        .chat-message.bot { 
            color: #000; 
            background: #e1f5fe; 
            margin-left: auto; 
            text-align: left; 
        }
        .chat-message.user { 
            color: #007bff; 
            background: #d1e7dd; 
            margin-right: auto; 
            text-align: right; 
        }
        .suggestions { 
            margin-top: 20px; 
            display: flex; 
            flex-wrap: wrap; 
            gap: 10px; 
        }
        .suggestion-btn { 
            padding: 10px 15px; 
            margin: 5px; 
            border: none; 
            background-color: #007bff; 
            color: #fff; 
            cursor: pointer; 
            border-radius: 5px; 
            font-size: 16px; 
            transition: background-color 0.3s ease, transform 0.2s ease; 
        }
        .suggestion-btn:hover { 
            background-color: #0056b3; 
            transform: scale(1.05); 
        }
        .suggestion-btn:active { 
            transform: scale(0.95); 
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes slideIn {
            from { transform: translateX(-10px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>

    <div class="chat-container">
        <div class="chat-box" id="chat-box"></div>
        <input type="text" id="chat-input" class="chat-input" placeholder="Type your message...">
        <div class="suggestions">
            <button class="suggestion-btn" onclick="sendSuggestion('hello')">Hello</button>
            <button class="suggestion-btn" onclick="sendSuggestion('fruits')">Fruits</button>
            <button class="suggestion-btn" onclick="sendSuggestion('vegetables')">Vegetables</button>
            <button class="suggestion-btn" onclick="sendSuggestion('clothes')">Clothes</button>
            <button class="suggestion-btn" onclick="sendSuggestion('handmade products')">Handmade Products</button>
            <button class="suggestion-btn" onclick="sendSuggestion('order')">Order History</button>
            <button class="suggestion-btn" onclick="sendSuggestion('help')">Help</button>
            <a href="{{ route('seller.dashboard') }}">
                <button class="suggestion-btn">Go Back to Dashboard</button>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatBox = document.getElementById('chat-box');
            const chatInput = document.getElementById('chat-input');

            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const message = chatInput.value.trim();
                    if (message) {
                        sendMessage(message);
                        chatInput.value = '';
                    }
                }
            });

            window.sendSuggestion = function(suggestion) {
                sendMessage(suggestion);
            }

            function sendMessage(message) {
                chatBox.innerHTML += `<div class="chat-message user">${message}</div>`;
                fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    chatBox.innerHTML += `<div class="chat-message bot">${data.message}</div>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</div>
@endsection
