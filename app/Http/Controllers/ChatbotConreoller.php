<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotConreoller extends Controller
{
    public function sellerChat()
    {
        return view('seller.chatbot');
    }

    public function sellerSendMessage(Request $request)
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
            'fruits' => 'You can view our Fruits here: <a href="seller/addFruits">Fruits</a>',
            'vegetables' => 'You can view our Vegetables here: <a href="seller/addVegitable">Vegetables</a>',
            'clothes' => 'You can view our Clothes here: <a href="seller/addClothes">Clothes</a>',
            'handmade products' => 'You can view our Handmade Products here: <a href="seller/addProduct">Handmade Products</a>',
            'contact' => 'Contact us through our <a href="seller/aboutus">Contact Page</a>',
            'help' => 'How can I assist you? You can ask about our products, view your order history, or contact us. This Our Email address smartsell@gmail.com',
            'default' => 'Sorry, I did not understand that. You can ask about our products, view your order history, or contact us for help.',
        ];

        // Normalize the message for better matching
        $normalizedMessage = strtolower(trim($message));

        // Return the response if available, otherwise a default message
        return $responses[$normalizedMessage] ?? $responses['default'];
    }
}