<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $sellerName;
    public $orderDetails;

    public $orderId;
    public $totalAmount;

    /**
     * Create a new message instance.
     */
    public function __construct($order_id, $sellerName, $orderDetails, $totalAmount)
    {
        $this->orderId = $order_id;
        $this->sellerName = $sellerName;
        $this->orderDetails = $orderDetails;
        $this->totalAmount = $totalAmount;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Order Shipped Notification')
            ->view('Seller.Orders.sellerordershippedemail')
            ->with([
                'sellerName' => $this->sellerName,
                'orderDetails' => $this->orderDetails,
                'orderId' => $this->orderId,
                'totalAmount' => $this->totalAmount
            ]);
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
