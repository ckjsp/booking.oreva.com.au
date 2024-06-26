<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class OrderConfirmation extends Mailable

{
    use Queueable, SerializesModels;

    public $orderData; // Data to be passed to the view

    /**
     * Create a new message instance.
     *
     * @param array 
     * $orderData
     * @return void
     */

   public function __construct($orderData)

{

    $this->orderData = $orderData;

}

public function build()

{

    return $this->view('emails.order_confirmation')
                ->with('orderData', $this->orderData);

}

    
}
