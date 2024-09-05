<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // Process the message to get a response
        $response = $this->getChatBotResponse($message);

        return response()->json(['message' => $response]);
    }

    private function getChatBotResponse($message)
    {
        // Define responses with links to pages
        $responses = [
            'hello' => 'Hi there! How can I assist you today?',
            'fruits' => 'You can view our Fruits here: <a href="buyer/fruits">Fruits</a>',
            'vegetables' => 'You can view our Vegetables here: <a href="buyer/vegetables">Vegetables</a>',
            'clothes' => 'You can view our Clothes here: <a href="buyer/clothes">Clothes</a>',
            'handmade products' => 'You can view our Handmade Products here: <a href="buyer/handmade">Handmade Products</a>',
            'order' => 'View your order history: <a href="buyer/order-history">Order History</a>',
            'contact' => 'Contact us through our <a href="buyer/aboutus">Contact Page</a>',
            'help' => 'How can I assist you? You can ask about our products, view your order history, or contact us. This Our Email address smartsell@gmail.com',
            'default' => 'Sorry, I did not understand that. You can ask about our products, view your order history, or contact us for help.',
        ];

        // Normalize the message for better matching
        $normalizedMessage = strtolower(trim($message));

        // Return the response if available, otherwise a default message
        return $responses[$normalizedMessage] ?? $responses['default'];
    }
}
